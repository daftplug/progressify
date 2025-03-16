<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\{Plugin, Frontend};

if (!defined('ABSPATH')) {
  exit();
}

class WebAppManifest
{
  public $name;
  public $description;
  public $slug;
  public $version;
  public $optionName;
  public $pluginFile;
  public $pluginBasename;
  public $pluginDirUrl;
  public $pluginDirPath;
  public static $pluginUploadDir;
  public static $pluginUploadUrl;
  public $menuTitle;
  public $menuIcon;
  public $menuId;
  protected $dependencies;
  public $capability;
  public $settings;
  public static $manifestName;

  public function __construct($config)
  {
    $this->name = $config['name'];
    $this->description = $config['description'];
    $this->slug = $config['slug'];
    $this->version = $config['version'];
    $this->optionName = $config['option_name'];
    $this->pluginFile = $config['plugin_file'];
    $this->pluginBasename = $config['plugin_basename'];
    $this->pluginDirPath = $config['plugin_dir_path'];
    self::$pluginUploadDir = $config['plugin_upload_dir'];
    self::$pluginUploadUrl = $config['plugin_upload_url'];
    $this->menuTitle = $config['menu_title'];
    $this->menuIcon = $config['menu_icon'];
    $this->dependencies = [];
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];
    self::$manifestName = 'manifest.webmanifest';

    add_action('rest_api_init', [$this, 'registerRoutes']);
    add_action('parse_request', [$this, 'renderManifest']);
    add_action('parse_request', [$this, 'renderWebAppOriginAssociation']);
    add_action('wp_head', [$this, 'renderMetaTagsInHeader'], 0);
  }

  public function registerRoutes()
  {
    register_rest_route($this->slug, '/savePwaAssets', [
      'methods' => 'POST',
      'callback' => [$this, 'savePwaAssets'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);
  }

  public function savePwaAssets(\WP_REST_Request $request)
  {
    try {
      if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
        return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
      }

      // Get parameters
      $splashScreens = $request->get_param('splashScreens');
      $roundedIcon = $request->get_param('roundedIcon');
      $maskableIcon = $request->get_param('maskableIcon');

      // Validate input
      if (!$splashScreens || !$maskableIcon || !$roundedIcon) {
        return new \WP_Error('invalid_input', 'Missing required assets', ['status' => 400]);
      }

      // Ensure directories exist
      $dirs = [self::$pluginUploadDir . 'splash-screens/', self::$pluginUploadDir . 'pwa-icons/', self::$pluginUploadDir . 'qr-codes/'];

      foreach ($dirs as $dir) {
        if (!file_exists($dir)) {
          wp_mkdir_p($dir);
        }
      }

      // Save icons
      $iconPaths = [
        'rounded' => self::$pluginUploadDir . 'pwa-icons/icon-rounded.png',
        'maskable' => self::$pluginUploadDir . 'pwa-icons/icon-maskable.png',
      ];

      $this->saveImage($roundedIcon, $iconPaths['rounded'], true);
      $this->saveImage($maskableIcon, $iconPaths['maskable'], true);

      // Process maskable icon variants
      $this->processMaskableIconVariants($iconPaths['maskable']);

      // Save and process splash screens
      foreach ($splashScreens as $name => $base64Data) {
        $orientation = str_ends_with($name, '_landscape') ? 'landscape' : 'portrait';
        $deviceName = str_replace(['_landscape', '_portrait'], '', $name);

        $filename = sprintf('%s-%s.png', $deviceName, $orientation);

        $path = self::$pluginUploadDir . 'splash-screens/' . $filename;
        $this->saveImage($base64Data, $path, true);
      }

      // Generate and save QR code
      $installationQrCodeData = Plugin::generateQrCode(add_query_arg('performInstallation', 'true', trailingslashit(strtok(home_url('/', 'https'), '?'))), '160x160', $roundedIcon);
      $this->saveImage($installationQrCodeData, self::$pluginUploadDir . 'qr-codes/qr-pwa-installation.png', false);

      return new \WP_REST_Response(
        [
          'status' => 'success',
          'message' => 'PWA assets saved successfully',
        ],
        200
      );
    } catch (\Exception $e) {
      return new \WP_Error('save_failed', $e->getMessage(), ['status' => 500]);
    }
  }

  private function saveImage($imageData, $path, $isBase64 = true)
  {
    if ($isBase64 && is_string($imageData)) {
      $imageData = base64_decode($imageData);
    }

    if (!$imageData) {
      throw new \Exception('Invalid image data for ' . esc_html(basename($path)));
    }

    // Save the file
    if (!Plugin::putContent($path, $imageData)) {
      throw new \Exception('Failed to save ' . esc_html(basename($path)));
    }

    return true;
  }

  private function processMaskableIconVariants($sourcePath)
  {
    if (!file_exists($sourcePath)) {
      throw new \Exception('Source maskable icon not found');
    }

    $editor = wp_get_image_editor($sourcePath);
    if (is_wp_error($editor)) {
      throw new \Exception('Failed to create image editor for maskable icon');
    }

    // Define maskable icon sizes
    $sizes = [['width' => 192, 'height' => 192, 'crop' => true], ['width' => 180, 'height' => 180, 'crop' => true], ['width' => 512, 'height' => 512, 'crop' => true]];

    // Generate variants
    $resized = $editor->multi_resize($sizes);

    if (is_wp_error($resized)) {
      throw new \Exception('Failed to generate maskable icon variants');
    }

    return true;
  }

  public function renderWebAppOriginAssociation()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === '.well-known/web-app-origin-association') {
      $wp_query->set('.well-known/web-app-origin-association', 1);
    }

    if ($wp_query->get('.well-known/web-app-origin-association')) {
      nocache_headers();
      header('X-Robots-Tag: noindex, follow');
      header('Content-Type: application/json; charset=utf-8');

      $webAppOriginAssociation = [
        'web_apps' => [
          [
            'manifest' => $this->getManifestUrl(false),
            'details' => [
              'paths' => ['/*'],
            ],
          ],
          [
            'web_app_identity' => Plugin::getDomainFromUrl(trailingslashit(strtok(home_url('/', 'https'), '?'))),
          ],
        ],
      ];

      wp_send_json($webAppOriginAssociation, 200, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

      exit();
    }
  }

  public function renderManifest()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === self::$manifestName) {
      $wp_query->set(self::$manifestName, 1);
    }

    if ($wp_query->get(self::$manifestName)) {
      nocache_headers();
      header('X-Robots-Tag: noindex, follow');
      header('Content-Type: application/manifest+json; charset=utf-8');

      $manifest = $this->buildManifestData();

      wp_send_json($manifest, 200, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      exit();
    }
  }

  public function buildManifestData()
  {
    $homeUrlParts = wp_parse_url(trailingslashit(strtok(home_url('/', 'https'), '?')));
    $scope = '/';
    if (isset($homeUrlParts['path'])) {
      $scope = $homeUrlParts['path'];
    }

    $manifest = [
      'lang' => get_bloginfo('language') ?: 'en-US',
      'id' => hash('crc32', Plugin::getDomainFromUrl(trailingslashit(strtok(home_url('/', 'https'), '?')))),
      'dir' => is_rtl() ? 'rtl' : 'ltr',
      'name' => trim(Plugin::getSetting('webAppManifest[appIdentity][appName]')),
      'scope' => $scope,
      'start_url' => add_query_arg('isPwa', 'true', trailingslashit(wp_make_link_relative(Plugin::getSetting('webAppManifest[displaySettings][startPage]')))),
      'scope_extensions' => [['origin' => 'https://*.' . Plugin::getDomainFromUrl(trailingslashit(strtok(home_url('/', 'https'), '?')))]],
      'short_name' => trim(substr(Plugin::getSetting('webAppManifest[appIdentity][shortName]'), 0, 12)),
      'description' => trim(Plugin::getSetting('webAppManifest[appIdentity][description]')),
      'display' => Plugin::getSetting('webAppManifest[displaySettings][displayMode]'),
      'display_override' => [Plugin::getSetting('webAppManifest[displaySettings][displayMode]'), 'window-controls-overlay', 'browser'],
      'orientation' => Plugin::getSetting('webAppManifest[displaySettings][orientation]'),
      'theme_color' => Plugin::getSetting('webAppManifest[appearance][themeColor]'),
      'background_color' => Plugin::getSetting('webAppManifest[appearance][backgroundColor]'),
      'categories' => (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'),
      'handle_links' => 'preferred',
      'launch_handler' => ['client_mode' => 'focus-existing'],
      'edge_side_panel' => ['preferred_width' => 400],
    ];

    // IARC Rating ID
    if (!empty(Plugin::getSetting('webAppManifest[advancedFeatures][iarcRatingId]'))) {
      $manifest['iarc_rating_id'] = Plugin::getSetting('webAppManifest[advancedFeatures][iarcRatingId]');
    }

    // Related Applications
    $relatedApplications = Plugin::getSetting('webAppManifest[advancedFeatures][relatedApplications]');
    $relatedApplicationsNotEmpty = !empty($relatedApplications) && !(count($relatedApplications) === 1 && empty($relatedApplications[0]['platform']) && empty($relatedApplications[0]['id']));

    $manifest['prefer_related_applications'] = $relatedApplicationsNotEmpty;

    if ($relatedApplicationsNotEmpty) {
      $manifest['related_applications'] = [];
      foreach ($relatedApplications as $relatedApplication) {
        if (!empty($relatedApplication['platform']) && !empty($relatedApplication['id'])) {
          $url = '';
          switch ($relatedApplication['platform']) {
            case 'play':
              $url = "https://play.google.com/store/apps/details?id={$relatedApplication['id']}";
              break;
            case 'itunes':
              $url = "https://apps.apple.com/us/app/{$relatedApplication['id']}";
              break;
            case 'windows':
              $url = "https://apps.microsoft.com/detail/{$relatedApplication['id']}";
              break;
          }

          $manifest['related_applications'][] = [
            'platform' => $relatedApplication['platform'],
            'url' => $url,
            'id' => $relatedApplication['id'],
          ];
        }
      }
    }

    // Icons
    if (wp_attachment_is_image(intval(Plugin::getSetting('webAppManifest[appIdentity][appIcon]')))) {
      $manifest['icons'][] = [
        'src' => self::getPwaIconUrl('rounded'),
        'sizes' => '512x512',
        'type' => 'image/png',
        'purpose' => 'any',
      ];

      $manifest['icons'][] = [
        'src' => self::getPwaIconUrl('maskable', 180),
        'sizes' => '180x180',
        'type' => 'image/png',
        'purpose' => 'maskable',
      ];

      $manifest['icons'][] = [
        'src' => self::getPwaIconUrl('maskable', 192),
        'sizes' => '192x192',
        'type' => 'image/png',
        'purpose' => 'maskable',
      ];

      $manifest['icons'][] = [
        'src' => self::getPwaIconUrl('maskable'),
        'sizes' => '512x512',
        'type' => 'image/png',
        'purpose' => 'maskable',
      ];
    }

    // Screenshots
    $screenshots = Plugin::getSetting('webAppManifest[appIdentity][appScreenshots]');
    if (!empty($screenshots) && is_array($screenshots)) {
      foreach ($screenshots as $screenshotKey => $screenshotId) {
        $screenshotId = intval($screenshotId);
        if (wp_attachment_is_image($screenshotId)) {
          $image_src = wp_get_attachment_image_src($screenshotId, 'full');
          if ($image_src) {
            $manifest['screenshots'][] = [
              'src' => $image_src[0],
              'sizes' => $image_src[1] . 'x' . $image_src[2],
              'type' => get_post_mime_type($screenshotId),
              'form_factor' => 'wide',
              'label' => 'Screenshot ' . $screenshotKey + 1,
            ];
          }
        }
      }
    }

    if (empty($manifest['screenshots'])) {
      $startPage = trailingslashit(Plugin::getSetting('webAppManifest[displaySettings][startPage]'));
      $manifest['screenshots'][] = [
        'src' => 'https://s0.wp.com/mshots/v1/' . urlencode($startPage) . '?vpw=750&vph=1334&format=png',
        'sizes' => '750x1334',
        'form_factor' => 'narrow',
        'type' => 'image/png',
      ];
      $manifest['screenshots'][] = [
        'src' => 'https://s0.wp.com/mshots/v1/' . urlencode($startPage) . '?vpw=1280&vph=800&format=png',
        'sizes' => '1280x800',
        'form_factor' => 'wide',
        'type' => 'image/png',
      ];
    }

    // Shortcuts
    $appShortcuts = Plugin::getSetting('webAppManifest[advancedFeatures][appShortcuts]');
    $appShortcutsNotEmpty = !empty($appShortcuts) && !(count($appShortcuts) === 1 && empty($appShortcuts[0]['name']) && empty($appShortcuts[0]['url']));

    if ($appShortcutsNotEmpty) {
      $manifest['shortcuts'] = [];
      foreach ($appShortcuts as $appShortcut) {
        $name = sanitize_text_field($appShortcut['name']);
        $url = esc_url_raw($appShortcut['url']);
        $iconId = !empty($appShortcut['icon']) ? intval($appShortcut['icon']) : null;

        if (!empty($name) && !empty($url)) {
          $shortcut = [
            'name' => $name,
            'short_name' => substr($name, 0, 12),
            'url' => $url,
          ];

          if ($iconId && wp_attachment_is_image($iconId)) {
            $icon = Plugin::resizeImage($iconId, '96', '96', 'png', true);
            if ($icon && !is_wp_error($icon)) {
              $shortcut['icons'] = [
                [
                  'src' => $icon['url'],
                  'sizes' => $icon['width'] . 'x' . $icon['height'],
                  'type' => 'image/png',
                ],
              ];
            }
          }

          $manifest['shortcuts'][] = $shortcut;
        }
      }

      if (empty($manifest['shortcuts'])) {
        unset($manifest['shortcuts']);
      }
    }

    return apply_filters("{$this->optionName}_manifest", $manifest);
  }

  public function renderMetaTagsInHeader()
  {
    Frontend::renderPartial('metaTags');
  }

  public static function getManifestUrl($encoded = true)
  {
    $manifestUrl = untrailingslashit(strtok(home_url('/', 'https'), '?') . self::$manifestName);

    if ($encoded) {
      return wp_json_encode($manifestUrl);
    }

    return $manifestUrl;
  }

  public static function getPwaIconUrl($type = 'maskable', $size = '')
  {
    // Check if we have a valid app icon set
    if (!wp_attachment_is_image(intval(Plugin::getSetting('webAppManifest[appIdentity][appIcon]')))) {
      return '';
    }

    // Construct the filename
    if ($type === 'maskable' && $size !== '') {
      $filename = sprintf('icon-%s-%sx%s.png', $type, $size, $size);
    } else {
      $filename = sprintf('icon-%s.png', $type);
    }

    // Build paths
    $iconPath = self::$pluginUploadDir . 'pwa-icons/' . $filename;
    $iconUrl = self::$pluginUploadUrl . 'pwa-icons/' . $filename;

    // Check if file exists and return URL with version hash
    if (file_exists($iconPath)) {
      // Add version hash to prevent caching issues
      $version = hash('crc32', filemtime($iconPath));
      return $iconUrl . '?v=' . $version;
    }

    return '';
  }

  public static function getSplashScreenUrl($name)
  {
    // Check if we have a valid app icon set (required for splash screens)
    if (!wp_attachment_is_image(intval(Plugin::getSetting('webAppManifest[appIdentity][appIcon]')))) {
      return '';
    }

    // Parse device name and orientation from the provided name
    $orientation = str_ends_with($name, '_landscape') ? 'landscape' : 'portrait';
    $deviceName = str_replace(['_landscape', '_portrait'], '', $name);

    // Construct the filename
    $filename = sprintf('%s-%s.png', $deviceName, $orientation);

    // Build paths
    $splashScreenPath = self::$pluginUploadDir . 'splash-screens/' . $filename;
    $splashScreenUrl = self::$pluginUploadUrl . 'splash-screens/' . $filename;

    // Check if file exists and return URL with version hash
    if (file_exists($splashScreenPath)) {
      // Add version hash to prevent caching issues
      $version = hash('crc32', filemtime($splashScreenPath));
      return $splashScreenUrl . '?v=' . $version;
    }

    return '';
  }

  public static function getInstallationQrCodeUrl()
  {
    // Check if we have a valid app icon set (required for splash screens)
    if (!wp_attachment_is_image(intval(Plugin::getSetting('webAppManifest[appIdentity][appIcon]')))) {
      return '';
    }

    // Build paths
    $qrCodePath = self::$pluginUploadDir . 'qr-codes/qr-pwa-installation.png';
    $qrCodeUrl = self::$pluginUploadUrl . 'qr-codes/qr-pwa-installation.png';

    // Check if file exists and return URL with version hash
    if (file_exists($qrCodePath)) {
      // Add version hash to prevent caching issues
      $version = hash('crc32', filemtime($qrCodePath));
      return $qrCodeUrl . '?v=' . $version;
    }

    return '';
  }
}