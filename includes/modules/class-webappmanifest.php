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
  public $textDomain;
  public $optionName;
  public $pluginFile;
  public $pluginBasename;
  public $pluginDirUrl;
  public $pluginDirPath;
  public $pluginUploadDir;
  public $pluginUploadUrl;
  public $menuTitle;
  public $menuIcon;
  public $menuId;
  protected $dependencies;
  public $purchaseCode;
  public $capability;
  public $settings;

  public function __construct($config)
  {
    $this->name = $config['name'];
    $this->description = $config['description'];
    $this->slug = $config['slug'];
    $this->version = $config['version'];
    $this->textDomain = $config['text_domain'];
    $this->optionName = $config['option_name'];
    $this->pluginFile = $config['plugin_file'];
    $this->pluginBasename = $config['plugin_basename'];
    $this->pluginDirPath = $config['plugin_dir_path'];
    $this->pluginUploadDir = $config['plugin_upload_dir'];
    $this->pluginUploadUrl = $config['plugin_upload_url'];
    $this->menuTitle = $config['menu_title'];
    $this->menuIcon = $config['menu_icon'];
    $this->dependencies = [];
    $this->purchaseCode = get_option("{$this->optionName}_purchase_code");
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];

    add_action("wp_ajax_{$this->optionName}_generate_launch_screens_and_maskable_icons", [$this, 'generateLaunchScreensAndMakableIcons']);
    add_action('parse_request', [$this, 'generateManifest']);
    add_action('parse_request', [$this, 'generateWebAppOriginAssociation']);
    add_action('wp_head', [$this, 'renderMetaTagsInHeader'], 0);
  }

  public function generateLaunchScreensAndMakableIcons()
  {
    if (isset($this->settings['webAppManifest[appIdentity][appIcon]'])) {
      if (isset($_POST['launchScreen']) && !empty($_POST['launchScreen']) && (isset($_POST['maskableIcon']) && !empty($_POST['maskableIcon']))) {
        $launchScreen = substr($_POST['launchScreen'], strpos($_POST['launchScreen'], ',') + 1);
        $maskableIcon = substr($_POST['maskableIcon'], strpos($_POST['maskableIcon'], ',') + 1);
        $decodedLaunchScreen = base64_decode($launchScreen);
        $decodedMaskableIcon = base64_decode($maskableIcon);
        $launchScreenName = $this->pluginUploadDir . 'img-apple-launch.png';
        $maskableIconName = $this->pluginUploadDir . 'icon-maskable.png';

        Plugin::putContent($launchScreenName, $decodedLaunchScreen);
        Plugin::putContent($maskableIconName, $decodedMaskableIcon);

        if (file_exists($launchScreenName)) {
          $launchScreenImage = wp_get_image_editor($launchScreenName);
          if (!is_wp_error($launchScreenImage)) {
            $sizesArray = [['width' => 640, 'height' => 1136, 'crop' => true], ['width' => 750, 'height' => 1334, 'crop' => true], ['width' => 828, 'height' => 1792, 'crop' => true], ['width' => 1125, 'height' => 2436, 'crop' => true], ['width' => 1170, 'height' => 2532, 'crop' => true], ['width' => 1179, 'height' => 2256, 'crop' => true], ['width' => 1242, 'height' => 2208, 'crop' => true], ['width' => 1242, 'height' => 2688, 'crop' => true], ['width' => 1284, 'height' => 2778, 'crop' => true], ['width' => 1290, 'height' => 2796, 'crop' => true], ['width' => 1536, 'height' => 2048, 'crop' => true], ['width' => 1620, 'height' => 2160, 'crop' => true], ['width' => 1640, 'height' => 2360, 'crop' => true], ['width' => 1668, 'height' => 2224, 'crop' => true], ['width' => 1668, 'height' => 2388, 'crop' => true], ['width' => 2048, 'height' => 2732, 'crop' => true]];

            $launchScreenImage->multi_resize($sizesArray);
            $launchScreenImage->save();
          }
        }

        if (file_exists($maskableIconName)) {
          $maskableIconImage = wp_get_image_editor($maskableIconName);
          if (!is_wp_error($maskableIconImage)) {
            $sizesArray = [['width' => 192, 'height' => 192, 'crop' => true], ['width' => 180, 'height' => 180, 'crop' => true]];

            $maskableIconImage->multi_resize($sizesArray);
            $maskableIconImage->save();
          }
        }

        wp_send_json_success([
          'message' => esc_html__('Launch Screens and Makable Icons are generated successfully!', $this->textDomain),
        ]);
      }
    } else {
      wp_send_json_error([
        'message' => esc_html__('Launch Screens and Makable Icons generation failed!', $this->textDomain),
      ]);
    }
  }

  public function generateWebAppOriginAssociation()
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

  public function generateManifest()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === 'manifest.webmanifest') {
      $wp_query->set('manifest.webmanifest', 1);
    }

    if ($wp_query->get('manifest.webmanifest')) {
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
    $appIcon = Plugin::getSetting('webAppManifest[appIdentity][appIcon]');
    $iconSizes = [180, 192, 512];

    if (wp_attachment_is_image(intval($appIcon))) {
      $iconSrc = wp_get_attachment_image_src($appIcon, 'full');
      $iconWidth = $iconSrc[1];

      foreach ($iconSizes as $iconSize) {
        if ($iconWidth < $iconSize) {
          continue;
        }

        $newIcon = Plugin::resizeImage($appIcon, $iconSize, $iconSize, 'png', true);

        if ($newIcon === false || $newIcon['width'] != $iconSize) {
          continue;
        }

        $manifest['icons'][] = [
          'src' => $newIcon['url'],
          'sizes' => "{$iconSize}x{$iconSize}",
          'type' => 'image/png',
          'purpose' => 'any',
        ];

        $maskableIconFilename = "icon-maskable-{$iconSize}x{$iconSize}.png";
        $maskableIconPath = $this->pluginUploadDir . $maskableIconFilename;
        $maskableIconUrl = $this->pluginUploadUrl . $maskableIconFilename;

        if (file_exists($maskableIconPath)) {
          $manifest['icons'][] = [
            'src' => $maskableIconUrl,
            'sizes' => "{$iconSize}x{$iconSize}",
            'type' => 'image/png',
            'purpose' => 'maskable',
          ];
        } else {
          $manifest['icons'][] = [
            'src' => $newIcon['url'],
            'sizes' => "{$iconSize}x{$iconSize}",
            'type' => 'image/png',
            'purpose' => 'maskable',
          ];
        }
      }
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
    return Frontend::renderPartial('metaTags');
  }

  public static function getManifestUrl($encoded = true)
  {
    $manifestUrl = untrailingslashit(strtok(home_url('/', 'https'), '?') . 'manifest.webmanifest');

    if ($encoded) {
      return wp_json_encode($manifestUrl);
    }

    return $manifestUrl;
  }
}