<?php
namespace DaftPlug\Progressify;

use DaftPlug\Progressify\Admin;
use DaftPlug\Progressify\Frontend;
use DaftPlug\Progressify\Module\webAppManifest;
use DaftPlug\Progressify\Module\Installation;
use DeviceDetector\DeviceDetector;

if (!defined('ABSPATH')) {
  exit();
}

class Plugin
{
  public $name;
  public $description;
  public static $slug;
  public $version;
  public $textDomain;
  public $optionName;
  public static $pluginOptionName;
  public static $pluginFile;
  public $pluginBasename;
  public static $pluginDirPath;
  public static $pluginDirUrl;
  public static $pluginUploadDir;
  public static $pluginUploadUrl;
  public static $verifyUrl;
  public static $itemId;
  public static $website;
  public $capability;
  public static $settings;

  public $Admin;
  public $Frontend;
  public $WebAppManifest;
  public $Installation;

  public function __construct($config)
  {
    $this->name = $config['name'];
    $this->description = $config['description'];
    self::$slug = $config['slug'];
    $this->version = $config['version'];
    $this->textDomain = $config['text_domain'];
    $this->optionName = $config['option_name'];
    self::$pluginOptionName = $config['option_name'];
    self::$pluginFile = $config['plugin_file'];
    $this->pluginBasename = $config['plugin_basename'];
    self::$pluginDirPath = $config['plugin_dir_path'];
    self::$pluginDirUrl = $config['plugin_dir_url'];
    self::$pluginUploadDir = $config['plugin_upload_dir'];
    self::$pluginUploadUrl = $config['plugin_upload_url'];
    self::$verifyUrl = $config['verify_url'];
    self::$itemId = $config['item_id'];

    $this->capability = 'manage_options';

    self::$settings = $config['settings'];

    $autoload_path = self::$pluginDirPath . 'vendor/autoload.php';
    if (file_exists($autoload_path)) {
      require_once $autoload_path;
    } else {
      error_log('DaftPlug Progressify: Autoload file not found.');
    }

    // Init Admin
    require_once self::$pluginDirPath . 'admin/class-admin.php';
    $this->Admin = new Admin($config);

    // Init Frontend
    require_once self::$pluginDirPath . 'frontend/class-frontend.php';
    $this->Frontend = new Frontend($config);

    // Init Modules
    require_once self::$pluginDirPath . 'includes/modules/class-webappmanifest.php';
    $this->WebAppManifest = new WebAppManifest($config);
    require_once self::$pluginDirPath . 'includes/modules/class-installation.php';
    $this->Installation = new Installation($config);
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

  public static function isWooCommerceActive()
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    return is_plugin_active('woocommerce/woocommerce.php');
  }

  public static function isBuddyPressActive()
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    return is_plugin_active('buddypress/bp-loader.php');
  }

  public static function isPeepsoActive()
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    return is_plugin_active('peepso-core/peepso.php');
  }

  public static function isUltimateMemberActive($extension = '')
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    if (!empty($extension)) {
      return is_plugin_active("{$extension}/{$extension}.php");
    } else {
      return is_plugin_active('ultimate-member/ultimate-member.php');
    }
  }

  public static function isOnesignalActive()
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    return is_plugin_active('onesignal-free-web-push-notifications/onesignal.php');
  }

  public static function isWebpushrActive()
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    return is_plugin_active('webpushr-web-push-notifications/push.php');
  }

  public static function isWprocketActive()
  {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    return is_plugin_active('wp-rocket/wp-rocket.php');
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

  public static function isPlatform($platform)
  {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $dd = new DeviceDetector($userAgent);
    $dd->parse();

    switch (strtolower($platform)) {
      case 'smartphone':
      case 'tablet':
      case 'desktop':
        $deviceName = strtolower($dd->getDeviceName('name'));
        $detected = strpos($deviceName, strtolower($platform)) !== false;
        break;
      case 'android':
      case 'ios':
      case 'windows':
      case 'linux':
      case 'mac':
        $osName = strtolower($dd->getOs('name'));
        $detected = strpos($osName, strtolower($platform)) !== false;
        break;
      case 'chrome':
      case 'safari':
      case 'firefox':
      case 'opera':
      case 'edge':
      case 'duckduckgo':
        $browserName = strtolower($dd->getClient('name'));
        $detected = self::isPlatform('browser') && strpos($browserName, strtolower($platform)) !== false;
        break;
      case 'pwa':
        $detected = isset($_GET['isPwa']) && $_GET['isPwa'] == 'true';
        break;
      case 'browser':
        $ua = strtolower($userAgent);
        $detected = $dd->isBrowser() && !strpos($ua, 'fban') !== false && !strpos($ua, 'fbios') !== false && !strpos($ua, 'fb_iab') !== false && !strpos($ua, 'telegram') !== false && !strpos($ua, 'instagram') !== false && !strpos($ua, 'messenger') !== false && !strpos($ua, 'micromessenger') !== false && !strpos($ua, 'webview') !== false && !strpos($ua, 'wv') !== false && !(isset($_GET['isPwa']) && $_GET['isPwa'] == 'true');
        break;
      default:
        $detected = false;
    }

    return $detected;
  }

  public static function getQrCodeSrc($data, $size = '200x200', $logo = false)
  {
    $QrCodeUrl = 'https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . '&chl=' . urlencode($data);
    $QrCode = imagecreatefrompng($QrCodeUrl);
    if (!$QrCode) {
      error_log('Failed to create QR code from URL: ' . $QrCodeUrl);
      return $QrCodeUrl; // Fall back to the URL if QR code image creation fails
    }

    if (!empty($logo) && $logo !== false) {
      $logo = imagecreatefromstring(file_get_contents($logo));
      if ($logo === false || gettype($logo) !== 'object' || get_class($logo) !== 'GdImage') {
        error_log('Failed to load logo image.');
        ob_start();
        imagepng($QrCode);
        imagedestroy($QrCode);
        $imagedata = ob_get_clean();
        return 'data:image/png;base64,' . base64_encode($imagedata);
      }

      $QrCodeWidth = imagesx($QrCode);
      $QrCodeHeight = imagesy($QrCode);
      $logoWidth = imagesx($logo);
      $logoHeight = imagesy($logo);
      $logoQrWidth = $QrCodeWidth / 3.7;
      $scale = $logoWidth / $logoQrWidth;
      $logoQrHeight = $logoHeight / $scale;
      imagecopyresampled($QrCode, $logo, $QrCodeWidth / 2.73, $QrCodeHeight / 2.73, 0, 0, $logoQrWidth, $logoQrHeight, $logoWidth, $logoHeight);
      ob_start();
      imagepng($QrCode);
      imagedestroy($QrCode);
      imagedestroy($logo);
      $imagedata = ob_get_clean();

      return 'data:image/png;base64,' . base64_encode($imagedata);
    }

    ob_start();
    imagepng($QrCode);
    imagedestroy($QrCode);
    $imagedata = ob_get_clean();
    return 'data:image/png;base64,' . base64_encode($imagedata);
  }
}