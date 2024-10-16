<?php
namespace DaftPlug\Progressify;

use DaftPlug\Progressify\Admin;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\OperatingSystem;
use DeviceDetector\Parser\Client\Browser;

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
  public $pluginUploadDir;
  public $pluginDirPath;
  public static $verifyUrl;
  public static $itemId;
  public static $website;
  public $capability;
  public static $settings;
  public $defaultSettings;

  public $WebAppManifest;
  public $Admin;

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
    $this->pluginDirPath = $config['plugin_dir_path'];
    $this->pluginUploadDir = $config['plugin_upload_dir'];

    self::$verifyUrl = $config['verify_url'];
    self::$itemId = $config['item_id'];

    $this->capability = 'manage_options';

    self::$settings = $config['settings'];

    require_once $this->pluginDirPath . 'vendor/autoload.php';

    // require_once $this->pluginDirPath . 'includes/class-webappmanifest.php';
    // $this->ProgressifyWebAppManifest = new ProgressifyWebAppManifest($config);

    require_once $this->pluginDirPath . 'admin/class-admin.php';
    $this->Admin = new Admin($config);
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

  private static function parseNestedKey($key)
  {
    $keys = preg_split('/\]\[|\[|\]/', $key, -1, PREG_SPLIT_NO_EMPTY);
    return $keys;
  }

  public static function isPwaAvailable()
  {
    if (daftplugInstantify::getSetting('pwaOnAll') == 'off') {
      if (is_singular((array) daftplugInstantify::getSetting('pwaOnPostTypes'))) {
        global $post;
        if (get_post_meta($post->ID, 'pwa', true) == 'disable') {
          return false;
        } else {
          return true;
        }
      } else {
        foreach ((array) daftplugInstantify::getSetting('pwaOnPageTypes') as $PageType) {
          if (is_string($PageType) && substr($PageType, 0, 3) === 'is_' && call_user_func($PageType) == true) {
            return true;
          } else {
            return false;
          }
        }
      }
    } else {
      if (is_singular()) {
        global $post;
        if (get_post_meta($post->ID, 'pwa', true) == 'disable') {
          return false;
        } else {
          return true;
        }
      } else {
        return true;
      }
    }
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

  public static function resizeImage($attachId, $width, $height, $ext, $crop = false)
  {
    if ('attachment' != get_post_type($attachId)) {
      return false;
    }

    $width = intval($width);
    $height = intval($height);
    $srcImg = wp_get_attachment_image_src($attachId, 'full');
    $imageDimensions = @getimagesize($srcImg[0]);
    $oldWidth = 1;
    $oldHeight = 1;
    $srcImgRatio = 1;

    if ($imageDimensions && $imageDimensions[1] != 0) {
      list($oldWidth, $oldHeight) = $imageDimensions;
      $srcImgRatio = $oldWidth / $oldHeight;
    }

    $srcImgPath = get_attached_file($attachId);

    if (!file_exists($srcImgPath)) {
      return false;
    }

    $srcImgInfo = pathinfo($srcImgPath);

    if ($crop) {
      $newWidth = $width;
      $newHeight = $height;
    } elseif ($width / $height <= $srcImgRatio) {
      $newWidth = $width;
      $newHeight = (1 / $srcImgRatio) * $width;
    } else {
      $newWidth = $height * $srcImgRatio;
      $newHeight = $height;
    }

    $newWidth = round($newWidth);
    $newHeight = round($newHeight);

    $changeFiletype = false;
    if ($ext && strtolower($srcImgInfo['extension']) != strtolower($ext)) {
      $changeFiletype = true;
    }

    if (($newWidth > $oldWidth || $newHeight > $oldHeight) && !$changeFiletype) {
      return $srcImg;
    }

    $extension = $srcImgInfo['extension'];
    if ($changeFiletype) {
      $extension = $ext;
    }

    $newImgPath = "{$srcImgInfo['dirname']}/{$srcImgInfo['filename']}-{$newWidth}x{$newHeight}.{$extension}";
    $newImgUrl = str_replace(trailingslashit(ABSPATH), trailingslashit(get_site_url()), $newImgPath);

    if (file_exists($newImgPath)) {
      return [$newImgUrl, $newWidth, $newHeight];
    }

    $image = wp_get_image_editor($srcImgPath);
    if (!is_wp_error($image)) {
      $image->resize($width, $height, $crop);
      $image->save($newImgPath);

      return [$newImgUrl, $newWidth, $newHeight];
    }

    return false;
  }

  public static function isPlatform($platform)
  {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $dd = new DeviceDetector($userAgent);
    $dd->parse();

    switch (strtolower($platform)) {
      case 'mobile':
        $detected = $dd->isSmartphone();
        break;
      case 'tablet':
        $detected = $dd->isTablet();
        break;
      case 'desktop':
        $detected = !$dd->isSmartphone() && !$dd->isTablet();
        break;
      case 'chrome':
      case 'safari':
      case 'firefox':
      case 'opera':
      case 'edge':
        $browserName = strtolower($dd->getClient('name'));
        $detected = $dd->isBrowser() && strpos($browserName, strtolower($platform)) !== false;
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