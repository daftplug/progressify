<?php
namespace DaftPlug\Progressify;

use DaftPlug\Progressify\{Admin, Frontend};
use DaftPlug\Progressify\Module\{Dashboard, WebAppManifest, Installation, OfflineUsage, UiComponents, AppCapabilities, PushNotifications};
use DeviceDetector\DeviceDetector;
use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\{Version, EccLevel};
use chillerlan\QRCode\Output\QROutputInterface;

if (!defined('ABSPATH')) {
  exit();
}

class Plugin
{
  public $name;
  public $description;
  public $version;
  public static $slug;
  public $optionName;
  public static $pluginOptionName;
  public static $pluginFile;
  public $pluginBasename;
  public static $pluginDirPath;
  public static $pluginDirUrl;
  public static $pluginUploadDir;
  public static $pluginUploadUrl;
  public $menuTitle;
  public static $licenseEndpoint;
  public static $envatoItemId;
  public static $domain;
  public static $licenseKey;
  public $capability;
  public $defaultSettings;
  public static $settings;

  public $Admin;
  public $Frontend;
  public $Dashboard;
  public $WebAppManifest;
  public $Installation;
  public $OfflineUsage;
  public $UiComponents;
  public $AppCapabilities;
  public $PushNotifications;

  public function __construct($config)
  {
    $this->name = $config['name'];
    $this->description = $config['description'];
    self::$slug = $config['slug'];
    $this->version = $config['version'];
    $this->optionName = $config['option_name'];
    self::$pluginOptionName = $config['option_name'];
    self::$pluginFile = $config['plugin_file'];
    $this->pluginBasename = $config['plugin_basename'];
    self::$pluginDirPath = $config['plugin_dir_path'];
    self::$pluginDirUrl = $config['plugin_dir_url'];
    self::$pluginUploadDir = $config['plugin_upload_dir'];
    self::$pluginUploadUrl = $config['plugin_upload_url'];
    $this->menuTitle = $config['menu_title'];
    self::$licenseEndpoint = $config['license_endpoint'];
    self::$envatoItemId = $config['envato_item_id'];
    self::$domain = self::getDomainFromUrl(trailingslashit(strtok(home_url('/', 'https'), '?')));
    self::$licenseKey = get_option("{$this->optionName}_license_key");
    $this->capability = 'manage_options';

    self::$settings = $config['settings'];

    $autoload_path = self::$pluginDirPath . 'vendor/autoload.php';
    if (file_exists($autoload_path)) {
      require_once $autoload_path;
    } else {
      error_log('DaftPlug Progressify: Autoload file not found.');
    }

    // Init Admin
    require_once self::$pluginDirPath . 'admin/admin.php';
    $this->Admin = new Admin($config);

    if (self::$licenseKey && !isset($_GET['noprogressify'])) {
      // Init Modules
      require_once self::$pluginDirPath . 'includes/modules/dashboard.php';
      $this->Dashboard = new Dashboard($config);
      require_once self::$pluginDirPath . 'includes/modules/webappmanifest.php';
      $this->WebAppManifest = new WebAppManifest($config);
      require_once self::$pluginDirPath . 'includes/modules/installation.php';
      $this->Installation = new Installation($config);
      require_once self::$pluginDirPath . 'includes/modules/offlineusage.php';
      $this->OfflineUsage = new OfflineUsage($config);
      require_once self::$pluginDirPath . 'includes/modules/uicomponents.php';
      $this->UiComponents = new UiComponents($config);
      require_once self::$pluginDirPath . 'includes/modules/appcapabilities.php';
      $this->AppCapabilities = new AppCapabilities($config);
      require_once self::$pluginDirPath . 'includes/modules/pushnotifications.php';
      $this->PushNotifications = new PushNotifications($config);

      // Init Frontend
      require_once self::$pluginDirPath . 'frontend/frontend.php';
      $this->Frontend = new Frontend($config);

      if (!wp_next_scheduled("{$this->optionName}_validate_license_schedule")) {
        wp_schedule_event(time(), 'weekly', "{$this->optionName}_validate_license_schedule");
      }
    }

    // Init default settings
    $this->defaultSettings = [
      'webAppManifest' => [
        'appIdentity' => [
          'appIcon' => get_option('site_icon') && file_exists(get_attached_file(get_option('site_icon'))) ? get_option('site_icon') : '',
          'appScreenshots' => '',
          'appName' => get_bloginfo('name') ?: '',
          'shortName' => mb_substr(get_bloginfo('name') ?: '', 0, 12, 'UTF-8'),
          'description' => get_bloginfo('description') ?: '',
          'categories' => [],
        ],
        'displaySettings' => [
          'startPage' => trailingslashit(strtok(home_url('/', 'https'), '?')),
          'displayMode' => 'standalone',
          'orientation' => 'any',
        ],
        'appearance' => [
          'iosStatusBarStyle' => 'default',
          'themeColor' => '#000000',
          'backgroundColor' => '#ffffff',
        ],
        'advancedFeatures' => [
          'iarcRatingId' => '',
          'relatedApplications' => [],
          'appShortcuts' => [],
        ],
      ],
      'installation' => [
        'prompts' => [
          'feature' => 'on',
          'types' => [
            'headerBanner' => 'on',
            'snackbar' => 'off',
            'navigationMenu' => 'on',
            'inFeed' => 'off',
            'blogPopup' => 'off',
            'woocommerceCheckout' => 'off',
          ],
          'text' => 'Install Web App',
          'skipFirstVisit' => 'off',
          'timeout' => 2,
        ],
      ],
      'offlineUsage' => [
        'cache' => [
          'feature' => 'on',
          'customFallbackPage' => [
            'feature' => 'off',
            'page' => '',
          ],
          'strategy' => 'NetworkFirst',
          'expirationTime' => 10,
        ],
        'capabilities' => [
          'feature' => 'on',
          'notification' => 'on',
          'forms' => 'off',
          'googleAnalytics' => 'off',
        ],
      ],
      'uiComponents' => [
        'navigationTabBar' => [
          'feature' => 'off',
          'supportedDevices' => [],
          'navigationItems' => [],
        ],
        'scrollProgressBar' => [
          'feature' => 'off',
          'supportedDevices' => [],
        ],
        'darkMode' => [
          'feature' => 'off',
          'type' => '',
          'osAware' => 'off',
          'batteryLow' => 'off',
          'supportedDevices' => [],
        ],
        'pullDownRefresh' => [
          'feature' => 'off',
          'supportedDevices' => [],
        ],
        'shakeRefresh' => [
          'feature' => 'off',
          'supportedDevices' => [],
        ],
        'loader' => [
          'feature' => 'on',
          'type' => 'default',
          'supportedDevices' => ['smartphone', 'tablet', 'desktop'],
        ],
        'inactiveBlur' => [
          'feature' => 'off',
          'supportedDevices' => [],
        ],
        'toastMessages' => [
          'feature' => 'off',
          'supportedDevices' => [],
        ],
      ],
      'appCapabilities' => [
        'smoothPageTransitions' => [
          'feature' => 'off',
          'progressBar' => 'off',
          'transition' => '',
          'supportedDevices' => [],
          'compatibilityMode' => 'off',
        ],
        'urlProtocolHandler' => [
          'feature' => 'off',
          'protocol' => '',
          'url' => '',
        ],
        'webShareTarget' => [
          'feature' => 'off',
          'action' => '',
          'urlQuery' => '',
        ],
        'vibrations' => [
          'feature' => 'off',
          'supportedDevices' => [],
        ],
        'idleDetection' => [
          'feature' => 'off',
          'threshold' => 10,
          'supportedDevices' => [],
        ],
        'screenWakeLock' => [
          'feature' => 'off',
          'supportedDevices' => [],
        ],
        'advancedWebCapabilities' => [
          'feature' => 'on',
          'biometricAuthentication' => 'off',
          'backgroundSync' => 'on',
          'periodicBackgroundSync' => 'on',
          'contentIndexing' => 'off',
          'persistentStorage' => 'off',
        ],
      ],
      'pushNotifications' => [
        'settings' => [
          'timeToLive' => 2419200,
          'batchSize' => 1000,
        ],
        'prompt' => [
          'feature' => 'off',
          'message' => 'Would you like to enable notifications to stay updated with important alerts and updates?',
          'skipFirstVisit' => 'off',
          'timeout' => '2',
        ],
        'button' => [
          'feature' => 'on',
          'position' => 'bottom-left',
          'behavior' => 'shown',
        ],
        'automation' => [
          'feature' => 'off',
          'wordpress' => [
            'newContent' => [
              'feature' => 'off',
              'postTypes' => [],
            ],
            'newComment' => 'off',
          ],
          'woocommerce' => [
            'priceDrop' => 'off',
            'salePrice' => 'off',
            'backInStock' => 'off',
            'orderStatusUpdate' => 'off',
            'newOrder' => 'off',
            'lowStock' => 'off',
          ],
          'buddypress' => [
            'memberMention' => 'off',
            'memberReply' => 'off',
            'newMessage' => 'off',
            'friendRequest' => 'off',
            'friendAccepted' => 'off',
          ],
        ],
      ],
    ];

    if (get_transient("{$this->optionName}_updated")) {
      update_option("{$this->optionName}_settings", wp_parse_args(self::$settings, $this->defaultSettings));
      delete_transient("{$this->optionName}_updated");
    }

    add_action('plugins_loaded', [$this, 'loadTextDomain']);
    add_filter("plugin_action_links_{$this->pluginBasename}", [$this, 'addPluginActionLinks']);
    register_activation_hook(self::$pluginFile, [$this, 'onActivate']);
    add_action('upgrader_process_complete', [$this, 'onUpdate'], 10, 2);
    register_deactivation_hook(self::$pluginFile, [$this, 'onDeactivate']);
    register_uninstall_hook(self::$pluginFile, [self::class, 'onUninstall']);
    add_action("{$this->optionName}_validate_license_schedule", [$this, 'checkLicenseValidity']);
  }

  public function onActivate()
  {
    // PHP version check
    if (version_compare(PHP_VERSION, '8.2', '<')) {
      $message = sprintf('<p>%s %s <i>support@daftplug.com</i></p>', sprintf(__('⚠️ %s requires PHP version at least 8.2 to function properly.', self::$slug), $this->menuTitle), __('If you have trouble fixing this, please contact us on', self::$slug));
      wp_die($message, 'Plugin Activation Error', [
        'back_link' => true,
        'text_direction' => 'ltr',
        'response' => 200,
      ]);
    }

    // Required extensions check
    $required_extensions = ['mbstring', 'openssl', 'curl', 'dom', 'iconv', 'libxml', 'spl'];
    foreach ($required_extensions as $extension) {
      if (!extension_loaded($extension)) {
        $message = sprintf('<p>%s %s <i>support@daftplug.com</i></p>', sprintf(__('⚠️ %s features require <i>%s</i> extension to function properly.', self::$slug), $this->menuTitle, $extension), __('If you have trouble fixing this, please contact us on', self::$slug));
        wp_die($message, 'Plugin Activation Error', [
          'back_link' => true,
          'text_direction' => 'ltr',
          'response' => 200,
        ]);
      }
    }

    // Add default settings
    add_option("{$this->optionName}_settings", $this->defaultSettings);
  }

  public function onUpdate($upgraderObject, $options)
  {
    if ($options['action'] == 'update' && $options['type'] == 'plugin' && isset($options['plugins'])) {
      foreach ($options['plugins'] as $plugin) {
        if ($plugin == $this->pluginBasename) {
          set_transient("{$this->optionName}_updated", 'yes', 3600);
        }
      }
    }
  }

  public function onDeactivate()
  {
    // Do nothing, just deactivate the plugin.
  }

  public static function onUninstall()
  {
    $optionName = self::$pluginOptionName;
    self::daftplugProcessLicense(self::$licenseKey, 'deactivate');
    delete_option("{$optionName}_license_key");
    delete_option("{$optionName}_settings");
  }

  public function checkLicenseValidity()
  {
    $licenseResponse = self::daftplugProcessLicense(self::$licenseKey, 'validate');
    if (!is_wp_error($licenseResponse) && !$licenseResponse->valid) {
      delete_option("{$this->optionName}_license_key");
    }
  }

  public function loadTextDomain()
  {
    load_plugin_textdomain(self::$slug, false, dirname($this->pluginBasename) . '/languages/');
  }

  public function addPluginActionLinks($links)
  {
    $links[] = '<a href="' . esc_url(admin_url('admin.php?page=' . self::$slug)) . '">Settings</a>';

    return $links;
  }

  public static function daftplugProcessLicense($licenseKey, $action)
  {
    @ini_set('display_errors', 0);
    error_reporting(0);

    $params = [
      'sslverify' => false,
      'body' => [
        'license_key' => $licenseKey,
        'action' => $action,
        'slug' => self::$slug,
        'domain' => self::$domain,
        'envato_item_id' => self::$envatoItemId,
      ],
      'user-agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
    ];

    $response = wp_remote_post(self::$licenseEndpoint, $params);

    if (is_wp_error($response)) {
      return $response;
    }

    $body = wp_remote_retrieve_body($response);
    $result = json_decode($body);

    return $result;
  }

  public static function getSetting($key)
  {
    $keys = self::parseNestedKey($key);
    $settings = self::$settings;

    foreach ($keys as $k) {
      if (isset($settings[$k])) {
        $settings = $settings[$k];
      } else {
        return false;
      }
    }

    return $settings;
  }

  public static function setSetting($key, $value)
  {
    $keys = self::parseNestedKey($key);
    $settings = &self::$settings;

    foreach ($keys as $k) {
      if (!isset($settings[$k])) {
        $settings[$k] = [];
      }
      $settings = &$settings[$k];
    }

    $settings = $value;

    $optionName = self::$pluginOptionName;
    update_option("{$optionName}_settings", self::$settings);
  }

  public static function isPluginActive($pluginSlug)
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    $paths = [
      'woocommerce' => 'woocommerce/woocommerce.php',
      'buddypress' => 'buddypress/bp-loader.php',
      'peepso' => 'peepso-core/peepso.php',
      'ultimatemember' => 'ultimate-member/ultimate-member.php',
      'onesignal' => 'onesignal-free-web-push-notifications/onesignal.php',
      'webpushr' => 'webpushr-web-push-notifications/push.php',
      'wprocket' => 'wp-rocket/wp-rocket.php',
    ];

    return is_plugin_active($paths[strtolower($pluginSlug)] ?? "{$pluginSlug}/{$pluginSlug}.php");
  }

  public static function isPlatform($platform)
  {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $dd = new DeviceDetector($userAgent);
    $dd->parse();

    $platform = strtolower($platform);

    // Device type checks
    if (in_array($platform, ['smartphone', 'tablet', 'desktop'])) {
      return strpos(strtolower(str_replace(' ', '', $dd->getDeviceName('name'))), $platform) !== false;
    }

    // OS checks
    if (in_array($platform, ['android', 'ios', 'windows', 'linux', 'mac', 'ubuntu', 'freebsd', 'chromeos'])) {
      return strpos(strtolower(str_replace(' ', '', $dd->getOs('name'))), $platform) !== false;
    }

    // Browser checks
    if (in_array($platform, ['chrome', 'safari', 'firefox', 'opera', 'edge', 'samsung', 'duckduckgo', 'brave', 'qq', 'uc', 'yandex'])) {
      return self::isPlatform('browser') && strpos(strtolower(str_replace(' ', '', $dd->getClient('name'))), $platform) !== false;
    }

    // Special cases
    if ($platform === 'pwa') {
      return isset($_GET['isPwa']) && $_GET['isPwa'] === 'true';
    }

    if ($platform === 'browser') {
      $ua = strtolower($userAgent);
      $nonBrowserApps = ['fban', 'fbios', 'fb_iab', 'telegram', 'instagram', 'messenger', 'micromessenger', 'webview', 'wv'];

      foreach ($nonBrowserApps as $app) {
        if (strpos($ua, $app) !== false) {
          return false;
        }
      }

      return $dd->isBrowser() && !(isset($_GET['isPwa']) && $_GET['isPwa'] === 'true');
    }

    return false;
  }

  public static function isPageBuilder($pageBuilder = null)
  {
    $currentBuilder = 'unknown';
    $post_id = get_the_ID();

    // Elementor detection
    if ($currentBuilder === 'unknown' && class_exists('\Elementor\Plugin')) {
      $elementor_data = get_post_meta($post_id, '_elementor_data', true);
      $is_elementor = false;

      if (!empty($elementor_data)) {
        $is_elementor = true;
      } else {
        try {
          $elementor = \Elementor\Plugin::instance();
          if ($elementor && $elementor->documents && $post_id) {
            $document = $elementor->documents->get($post_id);
            if ($document && method_exists($document, 'is_built_with_elementor')) {
              $is_elementor = $document->is_built_with_elementor();
            }
          }
        } catch (\Exception $e) {
          // Silently fail if Elementor isn't fully initialized
        }
      }

      if ($is_elementor) {
        $currentBuilder = 'elementor';
      }
    }

    // Divi detection
    if ($currentBuilder === 'unknown' && function_exists('et_pb_is_pagebuilder_used')) {
      if (et_pb_is_pagebuilder_used($post_id) || !empty(et_theme_builder_get_template_layouts())) {
        $currentBuilder = 'divi';
      }
    }

    // Oxygen detection
    if ($currentBuilder === 'unknown' && defined('CT_VERSION')) {
      if (!empty(get_post_meta($post_id, 'ct_builder_shortcodes', true)) || (function_exists('ct_template_output') && ct_template_output(true))) {
        $currentBuilder = 'oxygen';
      }
    }

    // Beaver Builder detection
    if ($currentBuilder === 'unknown' && class_exists('FLBuilder')) {
      if (class_exists('FLBuilderModel') && method_exists('FLBuilderModel', 'is_builder_enabled') && FLBuilderModel::is_builder_enabled($post_id)) {
        $currentBuilder = 'beaver';
      } elseif (class_exists('FLThemeBuilderLayoutData') && method_exists('FLThemeBuilderLayoutData', 'get_current_page_content_ids') && !empty(FLThemeBuilderLayoutData::get_current_page_content_ids())) {
        $currentBuilder = 'beaver';
      }
    }

    // Bricks detection
    if ($currentBuilder === 'unknown' && defined('BRICKS_VERSION')) {
      if (!empty(get_post_meta($post_id, 'bricks_data', true))) {
        $currentBuilder = 'bricks';
      }
    }

    // Block editor detection
    if ($currentBuilder === 'unknown' && function_exists('wp_is_block_theme') && wp_is_block_theme()) {
      $currentBuilder = 'block-editor';
    }

    // If a specific builder is passed, return boolean
    if ($pageBuilder !== null) {
      return $currentBuilder === $pageBuilder;
    }

    // Otherwise return the detected builder name
    return $currentBuilder;
  }

  public static function isWpCommentsEnabled()
  {
    if (get_option('default_comment_status') !== 'open') {
      return false;
    }

    $third_party_plugins = ['disqus-comment-system/disqus.php', 'jetpack/jetpack.php', 'wpDiscuz/class.WpdiscuzCore.php'];

    foreach ($third_party_plugins as $plugin) {
      if (is_plugin_active($plugin)) {
        return false;
      }
    }

    return true;
  }

  public static function getCurrentUrl($clean = false)
  {
    $http = 'http';
    if (isset($_SERVER['HTTPS'])) {
      $http = 'https';
    }
    $host = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];

    if ($clean == true) {
      return trim(strtok($http . '://' . htmlentities($host) . htmlentities($requestUri), '?'));
    } else {
      return $http . '://' . htmlentities($host) . htmlentities($requestUri);
    }
  }

  public static function getDomainFromUrl($url)
  {
    $pieces = wp_parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
      return $regs['domain'];
    }

    return false;
  }

  private static function parseNestedKey($key)
  {
    $keys = preg_split('/\]\[|\[|\]/', $key, -1, PREG_SPLIT_NO_EMPTY);
    return $keys;
  }

  public static function putContent($file, $content = null)
  {
    if (is_file($file)) {
      unlink($file);
    }

    if (empty($file)) {
      return false;
    }

    global $wp_filesystem;

    if (empty($wp_filesystem)) {
      require_once trailingslashit(ABSPATH) . 'wp-admin/includes/file.php';
      WP_Filesystem();
    }

    if (!$wp_filesystem->put_contents($file, $content, 0644)) {
      return false;
    }

    return true;
  }

  public static function resizeImage($attachId, $width, $height, $ext = '', $crop = false)
  {
    // Ensure attachment ID is an integer
    $attachId = intval($attachId);

    // Verify that the attachment exists and is an image
    if (!wp_attachment_is_image($attachId)) {
      return false;
    }

    // Ensure width and height are positive integers
    $width = intval($width);
    $height = intval($height);

    if ($width <= 0 || $height <= 0) {
      return false; // Invalid dimensions
    }

    // Get the image source and dimensions
    $srcImg = wp_get_attachment_image_src($attachId, 'full');

    if (!$srcImg) {
      return false; // Could not get image src
    }

    $oldWidth = $srcImg[1];
    $oldHeight = $srcImg[2];

    if ($oldWidth == 0 || $oldHeight == 0) {
      return false; // Invalid original dimensions
    }

    $srcImgRatio = $oldWidth / $oldHeight;

    // Get the path to the source image
    $srcImgPath = get_attached_file($attachId);

    if (!file_exists($srcImgPath)) {
      return false;
    }

    $srcImgInfo = pathinfo($srcImgPath);

    // Calculate new dimensions
    if ($crop) {
      $newWidth = $width;
      $newHeight = $height;
    } else {
      $targetRatio = $width / $height;
      if ($targetRatio > $srcImgRatio) {
        // Fix height, adjust width
        $newHeight = $height;
        $newWidth = round($height * $srcImgRatio);
      } else {
        // Fix width, adjust height
        $newWidth = $width;
        $newHeight = round($width / $srcImgRatio);
      }
    }

    // Check if we need to change the file type
    $extension = strtolower($srcImgInfo['extension']);
    $desiredExtension = strtolower($ext);
    $changeFiletype = $desiredExtension && $extension != $desiredExtension;

    // If new dimensions are larger than original and not changing file type, return original image
    if ($newWidth >= $oldWidth && $newHeight >= $oldHeight && !$changeFiletype) {
      return [
        'url' => $srcImg[0],
        'width' => $oldWidth,
        'height' => $oldHeight,
      ];
    }

    // Build the new filename
    $filenameBase = $srcImgInfo['filename'];
    $newExtension = $changeFiletype ? $desiredExtension : $extension;
    $newFilename = "{$filenameBase}-{$newWidth}x{$newHeight}.{$newExtension}";

    // Use plugin's upload directory
    $dirname = trailingslashit(self::$pluginUploadDir);
    $newImgPath = $dirname . $newFilename;

    // Build the new image URL
    $uploads_base_url = trailingslashit(self::$pluginUploadUrl);
    $newImgUrl = $uploads_base_url . $newFilename;

    // If the new image already exists, return it
    if (file_exists($newImgPath)) {
      return [
        'url' => $newImgUrl,
        'width' => $newWidth,
        'height' => $newHeight,
      ];
    }

    // Load the image editor
    $image = wp_get_image_editor($srcImgPath);
    if (is_wp_error($image)) {
      return false; // Could not load image editor
    }

    // Resize the image
    $result = $image->resize($width, $height, $crop);
    if (is_wp_error($result)) {
      return false; // Could not resize image
    }

    // Set up save options
    $save_options = [];
    if ($changeFiletype) {
      $save_options['mime_type'] = 'image/' . $newExtension;
    }

    // Save the new image
    $result = $image->save($newImgPath, $save_options);

    if (is_wp_error($result)) {
      return false; // Could not save image
    }

    return [
      'url' => $newImgUrl,
      'width' => $newWidth,
      'height' => $newHeight,
    ];
  }

  public static function getQrCodeSrc($data, $size = '200x200', $logo = false)
  {
    if (empty($data)) {
      return '';
    }

    // Define a scaling factor for higher resolution rendering
    $scaleFactor = 4;

    // Parse size input and apply scaling
    list($width, $height) = explode('x', strtolower($size));
    $targetWidth = (int) $width;
    $targetHeight = (int) $height;
    $scaledWidth = $targetWidth * $scaleFactor;
    $scaledHeight = $targetHeight * $scaleFactor;
    $targetSize = max($scaledWidth, $scaledHeight);

    $options = new QROptions([
      'version' => Version::AUTO,
      'outputType' => QROutputInterface::GDIMAGE_PNG,
      'eccLevel' => EccLevel::H,
      'scale' => max(1, (int) ($targetSize / 33)),
      'imageBase64' => false,
      'addQuietzone' => false,
      'addLogoSpace' => !empty($logo),
      'logoSpaceWidth' => 0,
      'logoSpaceHeight' => 0,
    ]);

    try {
      // Generate the QR code at scaled resolution
      $qrcode = (new QRCode($options))->render($data);

      // Define scaled dimensions
      $padding = 10 * $scaleFactor;
      $totalPadding = $padding * 2;

      // Create base image at scaled size
      $baseImage = imagecreatetruecolor($scaledWidth, $scaledHeight);

      // Enable anti-aliasing for smoother edges
      imageantialias($baseImage, true);

      // Create colors
      $white = imagecolorallocate($baseImage, 255, 255, 255);

      // Enable alpha blending and save full alpha channel information
      imagealphablending($baseImage, true);
      imagesavealpha($baseImage, true);

      // Fill background with white
      imagefill($baseImage, 0, 0, $white);

      // Process QR code
      $qrImage = imagecreatefromstring($qrcode);
      if (!$qrImage) {
        throw new \Exception('Failed to create QR code image from string');
      }

      // Calculate QR code size to fit within padding
      $qrSize = $scaledWidth - $totalPadding;

      // Ensure the QR code fits within the allocated space
      $qrOriginalWidth = imagesx($qrImage);
      $qrOriginalHeight = imagesy($qrImage);
      $qrScale = min($qrSize / $qrOriginalWidth, $qrSize / $qrOriginalHeight);

      $newQrWidth = (int) ($qrOriginalWidth * $qrScale);
      $newQrHeight = (int) ($qrOriginalHeight * $qrScale);

      // Calculate placement coordinates for QR code
      $qrX = (int) ($padding + ($qrSize - $newQrWidth) / 2);
      $qrY = (int) ($padding + ($qrSize - $newQrHeight) / 2);

      // Resize and place QR code
      imagecopyresampled($baseImage, $qrImage, $qrX, $qrY, 0, 0, $newQrWidth, $newQrHeight, $qrOriginalWidth, $qrOriginalHeight);

      // If logo is provided, try to add it but continue if it fails
      if ($logo) {
        try {
          // Handle WordPress attachment
          if (is_numeric($logo)) {
            $attachment_path = get_attached_file($logo);
            if (!$attachment_path || !file_exists($attachment_path)) {
              throw new \Exception('Attachment file not found');
            }
            $logoContent = file_get_contents($attachment_path);
          } else {
            // Try to convert URL to local path if it's rounded PWA icon
            $pwa_icon_url = WebAppManifest::getPwaIconUrl('rounded');
            $pwa_icon_path = self::$pluginUploadDir . 'pwa-icons/icon-rounded.png';

            if ($logo == $pwa_icon_url && file_exists($pwa_icon_path)) {
              $logoContent = file_get_contents($pwa_icon_path);
            } else {
              // Fallback to direct URL with WordPress filters
              $logoContent = wp_remote_get($logo);
              if (is_wp_error($logoContent)) {
                throw new \Exception('Failed to fetch remote logo');
              }
              $logoContent = wp_remote_retrieve_body($logoContent);
            }
          }

          if (empty($logoContent)) {
            throw new \Exception('Empty logo content');
          }

          $logoImage = imagecreatefromstring($logoContent);
          if (!$logoImage) {
            throw new \Exception('Invalid logo image format');
          }

          // Calculate logo size (35% of QR code size) at scaled resolution
          $logoNewWidth = (int) ($newQrWidth * 0.35);
          $logoNewHeight = (int) (imagesy($logoImage) * ($logoNewWidth / imagesx($logoImage)));

          // Center logo on QR code
          $logoX = $qrX + (int) (($newQrWidth - $logoNewWidth) / 2);
          $logoY = $qrY + (int) (($newQrHeight - $logoNewHeight) / 2);

          // Enable transparency for the logo
          imagealphablending($logoImage, true);
          imagesavealpha($logoImage, true);

          // Resize and place logo
          imagecopyresampled($baseImage, $logoImage, $logoX, $logoY, 0, 0, $logoNewWidth, $logoNewHeight, imagesx($logoImage), imagesy($logoImage));

          imagedestroy($logoImage);
        } catch (\Exception $e) {
          error_log('QR code logo processing failed: ' . $e->getMessage());
          // Continue without the logo
        }
      }

      // Clean up QR code image
      imagedestroy($qrImage);

      // Create a temporary image for downscaling
      $finalImageScaled = imagecreatetruecolor($targetWidth, $targetHeight);
      // Enable alpha blending and save alpha for the final image
      imagealphablending($finalImageScaled, false);
      imagesavealpha($finalImageScaled, true);
      // Fill the temporary image with transparent background
      $transparent = imagecolorallocatealpha($finalImageScaled, 0, 0, 0, 127);
      imagefill($finalImageScaled, 0, 0, $transparent);

      // Downscale the image to target size
      imagecopyresampled($finalImageScaled, $baseImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $scaledWidth, $scaledHeight);

      // Output final image
      ob_start();
      imagepng($finalImageScaled);
      $finalImage = ob_get_clean();

      // Clean up
      imagedestroy($baseImage);
      imagedestroy($finalImageScaled);

      return 'data:image/png;base64,' . base64_encode($finalImage);
    } catch (\Exception $e) {
      error_log('QR code generation failed: ' . $e->getMessage());
      return '';
    }
  }

  public static function escapeSvg($svgOrUrl, $classes = 'flex-shrink-0 size-4 fill-gray-400', $isUrl = false)
  {
    if ($isUrl) {
      $path = plugin_dir_path(self::$pluginFile) . str_replace(plugins_url('', self::$pluginFile), '', $svgOrUrl);
      if (!file_exists($path)) {
        return '';
      }
      $svg = file_get_contents($path);
    } else {
      $svg = $svgOrUrl;
    }

    $svg = preg_replace('/class="[^"]*"/', '', $svg);
    $svg = str_replace('<svg', '<svg class="' . esc_attr($classes) . '"', $svg);

    return str_replace(['\\', '"', "\n", "\r", "\t"], ['\\\\', '\\"', '', '', ''], $svg);
  }

  public static function getUserData()
  {
    $baseIconPath = plugins_url('admin/assets/media/icons/', self::$pluginFile);
    $unknownIcon = $baseIconPath . 'unknown.png';

    // Platform mappings
    $platformData = [
      'devices' => [
        'smartphone' => ['name' => 'Smartphone', 'icon' => 'devices/smartphone.svg'],
        'tablet' => ['name' => 'Tablet', 'icon' => 'devices/tablet.svg'],
        'desktop' => ['name' => 'Desktop', 'icon' => 'devices/desktop.svg'],
      ],
      'os' => [
        'android' => ['name' => 'Android', 'icon' => 'operating-systems/android.png'],
        'ios' => ['name' => 'iOS', 'icon' => 'operating-systems/ios.png'],
        'windows' => ['name' => 'Windows', 'icon' => 'operating-systems/windows.png'],
        'mac' => ['name' => 'Mac', 'icon' => 'operating-systems/mac.png'],
        'linux' => ['name' => 'Linux', 'icon' => 'operating-systems/linux.png'],
        'ubuntu' => ['name' => 'Ubuntu', 'icon' => 'operating-systems/ubuntu.png'],
        'freebsd' => ['name' => 'FreeBSD', 'icon' => 'operating-systems/freebsd.png'],
        'chromeos' => ['name' => 'Chrome OS', 'icon' => 'operating-systems/chromeos.png'],
      ],
      'browsers' => [
        'chrome' => ['name' => 'Chrome', 'icon' => 'browsers/chrome.png'],
        'safari' => ['name' => 'Safari', 'icon' => 'browsers/safari.png'],
        'firefox' => ['name' => 'Firefox', 'icon' => 'browsers/firefox.png'],
        'opera' => ['name' => 'Opera', 'icon' => 'browsers/opera.png'],
        'edge' => ['name' => 'Edge', 'icon' => 'browsers/edge.png'],
        'samsung' => ['name' => 'Samsung Internet', 'icon' => 'browsers/samsunginternet.png'],
        'duckduckgo' => ['name' => 'DuckDuckGo', 'icon' => 'browsers/duckduckgo.png'],
        'brave' => ['name' => 'Brave', 'icon' => 'browsers/brave.png'],
        'qq' => ['name' => 'QQ Browser', 'icon' => 'browsers/qq.png'],
        'uc' => ['name' => 'UC Browser', 'icon' => 'browsers/uc.png'],
        'yandex' => ['name' => 'Yandex Browser', 'icon' => 'browsers/yandex.png'],
      ],
    ];

    // Get visitor's real IP address
    $visitor_ip = '';
    $ip_headers = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
    foreach ($ip_headers as $header) {
      if (!empty($_SERVER[$header])) {
        $ip_array = array_map('trim', explode(',', $_SERVER[$header]));
        $visitor_ip = $ip_array[0];
        break;
      }
    }

    // Get country data using visitor's IP
    $locationData = @file_get_contents("https://get.geojs.io/v1/ip/country/{$visitor_ip}.json", false, stream_context_create(['http' => ['timeout' => 2]]));
    $locationData = $locationData ? json_decode($locationData, true) : [];

    $userData = [
      'country' => [
        'name' => 'Unknown',
        'icon' => $unknownIcon,
      ],
      'device' => [
        'name' => 'Unknown',
        'icon' => $unknownIcon,
      ],
      'os' => [
        'name' => 'Unknown',
        'icon' => $unknownIcon,
      ],
      'browser' => [
        'name' => 'Unknown',
        'icon' => $unknownIcon,
      ],
    ];

    // Set country if available
    if ($locationData && isset($locationData['name'], $locationData['country'])) {
      $userData['country'] = [
        'name' => $locationData['name'],
        'icon' => $baseIconPath . 'flags/4x3/' . strtolower($locationData['country']) . '.svg',
      ];
    }

    // Set device type
    foreach ($platformData['devices'] as $platform => $data) {
      if (self::isPlatform($platform)) {
        $userData['device'] = [
          'name' => $data['name'],
          'icon' => $baseIconPath . $data['icon'],
        ];
        break;
      }
    }

    // Set OS
    foreach ($platformData['os'] as $platform => $data) {
      if (self::isPlatform($platform)) {
        $userData['os'] = [
          'name' => $data['name'],
          'icon' => $baseIconPath . $data['icon'],
        ];
        break;
      }
    }

    // Set browser
    foreach ($platformData['browsers'] as $platform => $data) {
      if (self::isPlatform($platform)) {
        $userData['browser'] = [
          'name' => $data['name'],
          'icon' => $baseIconPath . $data['icon'],
        ];
        break;
      }
    }

    return $userData;
  }
}