<?php

namespace DaftPlug\Progressify;

use DaftPlug\Progressify\Module\WebAppManifest;

if (!defined('ABSPATH')) {
  exit();
}

class Frontend
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
  public $pluginUploadDir;
  public $pluginUploadUrl;
  protected $dependencies;
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
    wp_enqueue_script("{$this->slug}-frontend", plugins_url('frontend/assets/js/dev/main.js', $this->pluginFile), $this->dependencies, $this->version, true);

    wp_enqueue_script('wp-i18n');
    wp_set_script_translations("{$this->slug}-frontend", $this->slug);

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
        'generalError' => __('An unexpected error occurred', $this->slug),
        'homeUrl' => trailingslashit(strtok(home_url('/', 'https'), '?')),
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'restUrl' => get_rest_url(),
        'restNonce' => wp_create_nonce('wp-rest'),
        'iconUrl' => WebAppManifest::getPwaIconUrl('maskable', 180),
        'slug' => $this->slug,
        'settings' => $this->settings,
        'userData' => [
          'device' => [
            'isSmartphone' => Plugin::isPlatform('smartphone'),
            'isTablet' => Plugin::isPlatform('tablet'),
            'isDesktop' => Plugin::isPlatform('desktop'),
          ],
          'os' => [
            'isAndroid' => Plugin::isPlatform('android'),
            'isIos' => Plugin::isPlatform('ios'),
            'isWindows' => Plugin::isPlatform('windows'),
            'isLinux' => Plugin::isPlatform('linux'),
            'isMac' => Plugin::isPlatform('mac'),
            'isUbuntu' => Plugin::isPlatform('ubuntu'),
            'isFreebsd' => Plugin::isPlatform('freebsd'),
            'isChromeos' => Plugin::isPlatform('chromeos'),
          ],
          'browser' => [
            'isChrome' => Plugin::isPlatform('chrome'),
            'isSafari' => Plugin::isPlatform('safari'),
            'isFirefox' => Plugin::isPlatform('firefox'),
            'isOpera' => Plugin::isPlatform('opera'),
            'isEdge' => Plugin::isPlatform('edge'),
            'isSamsung' => Plugin::isPlatform('samsung'),
            'isDuckduckgo' => Plugin::isPlatform('duckduckgo'),
            'isBrave' => Plugin::isPlatform('brave'),
            'isQq' => Plugin::isPlatform('qq'),
            'isUc' => Plugin::isPlatform('uc'),
            'isYandex' => Plugin::isPlatform('yandex'),
          ],
          'platform' => [
            'isBrowser' => Plugin::isPlatform('browser'),
            'isPwa' => Plugin::isPlatform('pwa'),
          ],
        ],
        'pluginsData' => [
          'dirUrl' => $this->pluginDirUrl,
          'isActive' => [
            'woocommerce' => Plugin::isPluginActive('woocommerce'),
          ],
        ],
        'pageData' => [
          'builder' => Plugin::isPageBuilder(),
          'type' => [
            'isHome' => is_front_page() || is_home(),
            'isSingle' => is_single(),
            'isSingular' => is_singular(),
            'isBlogPost' => is_singular('post'),
            'isPage' => is_page(),
            'isSearch' => is_search(),
            'is404' => is_404(),
            'isCategory' => is_category(),
            'isTag' => is_tag(),
            'isAuthor' => is_author(),
            'isWooShop' => function_exists('is_shop') && is_shop(),
            'isWooProduct' => function_exists('is_product') && is_product(),
            'isWooCart' => function_exists('is_cart') && is_cart(),
            'isWooCheckout' => function_exists('is_checkout') && is_checkout(),
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
      'metaTags' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['partials', 'metatags.php']),
      'offlineFallbackPage' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['partials', 'offlinefallbackpage.php']),
    ];

    return $partials;
  }

  public static function renderPartial($key)
  {
    ob_start();
    include self::$partials[$key];
    return ob_get_clean();
  }
}
