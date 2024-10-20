<?php

namespace DaftPlug\Progressify;

use DeviceDetector\DeviceDetector;

if (!defined('ABSPATH')) {
  exit();
}

class Frontend
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
  protected $dependencies;
  public $purchaseCode;
  public $settings;
  public $html;
  public $css;
  public $js;
  private static $partials;

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
    $this->pluginDirUrl = $config['plugin_dir_url'];
    $this->pluginDirPath = $config['plugin_dir_path'];
    $this->pluginUploadDir = $config['plugin_upload_dir'];
    $this->pluginUploadUrl = $config['plugin_upload_url'];
    $this->dependencies = [];
    $this->settings = $config['settings'];
    $this->html = '';
    $this->css = '';
    $this->js = '';
    self::$partials = $this->generatePartials();

    add_action('wp_enqueue_scripts', [$this, 'loadAssets']);
    add_action('wp_footer', [$this, 'addFrontendCssHtmlJs'], 70);
  }

  public function loadAssets()
  {
    $this->dependencies[] = 'jquery';

    wp_enqueue_script("{$this->slug}-frontend", plugins_url('frontend/assets/js/main.js', $this->pluginFile), $this->dependencies, $this->version, true);

    // Ensure the script is loaded as a module
    add_filter(
      'script_loader_tag',
      function ($tag, $handle, $src) {
        if ("{$this->slug}-frontend" !== $handle) {
          return $tag;
        }
        return '<script type="module" src="' . esc_url($src) . '"></script>';
      },
      10,
      3
    );

    // Pass PHP variables to JS
    wp_localize_script(
      "{$this->slug}-frontend",
      "{$this->optionName}_frontend_js_vars",
      apply_filters("{$this->optionName}_frontend_js_vars", [
        'generalError' => __('An unexpected error occurred', $this->textDomain),
        'homeUrl' => trailingslashit(home_url('/', 'https')),
        'adminUrl' => trailingslashit(admin_url('/', 'https')),
        'currentUrl' => Plugin::getCurrentUrl(false),
        'iconUrl' => @wp_get_attachment_image_src(Plugin::getSetting('webAppManifest[appIdentity][appIcon]'), 'full')[0],
        'slug' => $this->slug,
        'settings' => $this->settings,
        'userData' => [
          'device' => [
            'isMobile' => Plugin::isPlatform('mobile'),
            'isTablet' => Plugin::isPlatform('tablet'),
            'isDesktop' => Plugin::isPlatform('desktop'),
          ],
          'os' => [
            'isAndroid' => Plugin::isPlatform('android'),
            'isIos' => Plugin::isPlatform('ios'),
            'isWindows' => Plugin::isPlatform('windows'),
          ],
          'platform' => [
            'isPwa' => Plugin::isPlatform('pwa'),
          ],
          'browser' => [
            'isChrome' => Plugin::isPlatform('chrome'),
            'isSafari' => Plugin::isPlatform('safari'),
            'isFirefox' => Plugin::isPlatform('firefox'),
            'isOpera' => Plugin::isPlatform('opera'),
            'isEdge' => Plugin::isPlatform('edge'),
          ],
        ],
      ])
    );
  }

  public function addFrontendCssHtmlJs()
  {
    ?>
<div id="daftplugFrontend" data-option-name="<?php echo $this->optionName; ?>" data-slug="<?php echo $this->slug; ?>">
  <style type="text/css">
  <?php echo apply_filters("{$this->optionName}_frontend_css", $this->css); ?>
  </style>
  <?php echo apply_filters("{$this->optionName}_frontend_html", $this->html); ?>
  <script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    <?php echo apply_filters("{$this->optionName}_frontend_js", $this->js); ?>
  });
  </script>
</div>
<?php
  }

  private static function generatePartials()
  {
    $partials = [
      'metaTags' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['partials', 'render-metatags.php']),
      'installButton' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['partials', 'render-installbutton.php']),
    ];

    return $partials;
  }

  public static function renderPartial($key)
  {
    include_once self::$partials[$key];
  }
}
