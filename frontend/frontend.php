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
  }

  public function loadAssets()
  {
    $this->dependencies[] = 'wp-i18n';

    wp_enqueue_script("{$this->slug}-frontend", plugins_url('frontend/assets/js/frontend.min.js', $this->pluginFile), $this->dependencies, $this->version, true);
    $this->dependencies[] = "{$this->slug}-frontend";

    // Register translations - standard WordPress way
    wp_set_script_translations("{$this->slug}-frontend", $this->slug, plugin_dir_path($this->pluginFile) . 'languages/');

    // Other localizations
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
        'language' => Plugin::$language === 'default' ? determine_locale() : Plugin::$language,
        'translations' => $this->getTranslationsJson(),
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
    include self::$partials[$key];
  }

  private function getTranslationsJson()
  {
    // Get current locale
    $locale = Plugin::$language === 'default' ? determine_locale() : Plugin::$language;

    // Skip for English
    if ($locale === 'en_US') {
      return '{}';
    }

    // Find all JSON translation files for this locale
    $files = glob(plugin_dir_path($this->pluginFile) . "languages/{$this->slug}-{$locale}-*.json");
    $merged_translations = [];

    // Process each file
    foreach ($files as $file) {
      $json = file_get_contents($file);
      if ($json) {
        $data = json_decode($json, true);
        if (isset($data['locale_data'][$this->slug])) {
          // Extract the actual translations (ignoring metadata)
          foreach ($data['locale_data'][$this->slug] as $original => $translated) {
            if ($original !== '') {
              // Skip the metadata entry
              $merged_translations[$original] = $translated;
            }
          }
        }
      }
    }

    // Return JSON-encoded translation map
    return json_encode($merged_translations);
  }
}