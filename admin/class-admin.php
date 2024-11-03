<?php

namespace DaftPlug\Progressify;

if (!defined('ABSPATH')) {
  exit();
}

class Admin
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
  public $verifyUrl;
  public $itemId;
  public $pages;

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
    $this->verifyUrl = $config['verify_url'];
    $this->itemId = $config['item_id'];
    $this->menuTitle = $config['menu_title'];
    $this->menuIcon = $config['menu_icon'];
    $this->dependencies = [];
    $this->purchaseCode = get_option("{$this->optionName}_purchase_code");
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];
    $this->pages = $this->generatePages();

    add_action('admin_menu', [$this, 'addMenuPage']);
    add_action('admin_enqueue_scripts', [$this, 'loadAssets']);
    add_action('rest_api_init', [$this, 'registerRoutes']);
  }

  public function addMenuPage()
  {
    $this->menuId = add_menu_page($this->menuTitle, !$this->purchaseCode ? $this->menuTitle . ' <span class="awaiting-mod">1</span>' : $this->menuTitle, $this->capability, $this->slug, [$this, 'createAdminPage'], $this->menuIcon);
  }

  public function loadAssets($hook)
  {
    if ($hook && $hook == $this->menuId) {
      $this->dependencies[] = 'jquery';

      wp_enqueue_script("{$this->slug}-preline", plugins_url('node_modules/preline/dist/preline.js', $this->pluginFile), $this->dependencies, $this->version, true);
      $this->dependencies[] = "{$this->slug}-preline";

      wp_enqueue_style("{$this->slug}-admin", plugins_url('admin/assets/css/admin.css', $this->pluginFile), [], $this->version);
      wp_enqueue_script("{$this->slug}-admin", plugins_url('admin/assets/js/main.js', $this->pluginFile), $this->dependencies, $this->version, true);

      // Ensure the script is loaded as a module
      add_filter(
        'script_loader_tag',
        function ($tag, $handle, $src) {
          if ("{$this->slug}-admin" !== $handle) {
            return $tag;
          }
          return '<script type="module" src="' . esc_url($src) . '"></script>';
        },
        10,
        3
      );

      $this->dependencies[] = "{$this->slug}-admin";

      // WP media
      wp_enqueue_media();

      // Pass PHP variables to JS
      wp_localize_script(
        "{$this->slug}-admin",
        "{$this->optionName}_admin_js_vars",
        apply_filters("{$this->optionName}_admin_js_vars", [
          'generalError' => __('An unexpected error occurred', $this->textDomain),
          'homeUrl' => trailingslashit(home_url('/', 'https')),
          'adminUrl' => trailingslashit(admin_url('/', 'https')),
          'slug' => $this->slug,
          'settings' => $this->settings,
        ])
      );
    }
  }

  public function generatePages()
  {
    $pages = [
      [
        'id' => 'dashboard',
        'menuTitle' => esc_html__('Dashboard', $this->textDomain),
        'pageTitle' => esc_html__('Dashboard', $this->textDomain),
        'description' => esc_html__('View your PWA\'s performance at a glance, including user stats, browser breakdown, and a PWA readiness score. Manage plugin features globally with a single toggle for easy control.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-dashboard.php']),
      ],
      [
        'id' => 'webAppManifest',
        'menuTitle' => esc_html__('Web App Manifest', $this->textDomain),
        'pageTitle' => esc_html__('Web App Manifest', $this->textDomain),
        'description' => esc_html__('The web app manifest is a JSON file that provides essential information about your web application to the browser, including how it should appear and behave when installed on a user\'s device. This file is necessary for enabling the "Add to Home Screen" prompt, enhancing the integration of your web app with the user\'s device.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-webappmanifest.php']),
      ],
      [
        'id' => 'installation',
        'menuTitle' => esc_html__('Installation', $this->textDomain),
        'pageTitle' => esc_html__('Installation', $this->textDomain),
        'description' => esc_html__('Installation features allows displaying prompts that encourage users to add your website to their home screens. This feature helps increase user engagement by making your site easily accessible with a single tap, just like any native mobile application.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-installation.php']),
      ],
      [
        'id' => 'offlineUsage',
        'menuTitle' => esc_html__('Offline Usage', $this->textDomain),
        'pageTitle' => esc_html__('Offline Usage', $this->textDomain),
        'description' => esc_html__('Enhance your web app with offline support and reliable performance, enabling users to access previously viewed pages even without an internet connection or on low connectivity.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-offlineusage.php']),
      ],
      [
        'id' => 'uiComponents',
        'menuTitle' => esc_html__('UI Components', $this->textDomain),
        'pageTitle' => esc_html__('UI Components', $this->textDomain),
        'description' => esc_html__('Enhance the user experience by adding interactive elements and features that make your web app look and feel more like a native application, including options like pull-down refresh, a navigation tab bar, dark mode, and toast messages.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-uicomponents.php']),
      ],
      [
        'id' => 'appCapabiilities',
        'menuTitle' => esc_html__('App Capabilities', $this->textDomain),
        'pageTitle' => esc_html__('App Capabilities', $this->textDomain),
        'description' => esc_html__('Enable advanced features and capabilities to enhance your website with native app-like functionalities. This includes passwordless login, background sync, periodic background sync, content indexing, persistent storage, and other advanced web APIs, providing a seamless mobile-like experience.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-appcapabiilities.php']),
      ],
      [
        'id' => 'pushNotifications',
        'menuTitle' => esc_html__('Push Notifications', $this->textDomain),
        'pageTitle' => esc_html__('Push Notifications', $this->textDomain),
        'description' => esc_html__('Push notifications allow your web app to send messages directly to users\' devices, providing a powerful tool for engaging users with timely updates, alerts, and personalized content. This feature helps keep your audience informed and connected, even when they are not actively using the app.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-pushnotifications.php']),
      ],
      [
        'id' => 'generateMobileApps',
        'pageTitle' => esc_html__('Generate Native Mobile Apps', $this->textDomain),
        'description' => esc_html__('Create Android, iOS, Windows, and Meta store-ready apps that mirror your website in real-time, requiring no extra maintenance, and publish them to the Google Play Store, App Store, Microsoft Store, and Meta Quest app store.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-generatemobileapps.php']),
      ],
      [
        'id' => 'helpCenter',
        'pageTitle' => esc_html__('Help Center', $this->textDomain),
        'description' => esc_html__('We understand all the importance of product support for our customers. That’s why we are ready to solve all your issues and answer any questions related to our plugin.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-helpcenter.php']),
      ],
      [
        'id' => 'changelog',
        'pageTitle' => esc_html__('What\'s New', $this->textDomain),
        'description' => esc_html__('See what\'s new added, changed, fixed, improved or updated.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-changelog.php']),
      ],
      [
        'id' => 'tools',
        'pageTitle' => esc_html__('Tools', $this->textDomain),
        'description' => esc_html__('Control what to do with your settings and data, reset/export/import settings or deactivate license to activate the plugin on another website.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-tools.php']),
      ],
      // [
      //   'id' => 'activation',
      //   'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-activation.php']),
      // ],
      [
        'id' => 'error',
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'page-error.php']),
      ],
    ];

    return $pages;
  }

  public function createAdminPage()
  {
    ?>
<div id="daftplugAdmin" data-option-name="<?php echo $this->optionName; ?>" data-slug="<?php echo $this->slug; ?>">
  <div class="relative mr-6 mt-6 rounded-xl bg-gray-50 shadow-[0_5px_25px_0_rgba(0,0,0,.1)]">
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'header.php']); ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'sidebar.php']); ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'main.php']); ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'footer.php']); ?>
  </div>
</div>
<?php
  }

  public function registerRoutes()
  {
    register_rest_route($this->slug, '/saveSettings', [
      'methods' => 'POST',
      'callback' => [$this, 'saveSettings'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);
  }

  public function saveSettings(\WP_REST_Request $request)
  {
    if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
      return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
    }

    $newSettings = $request->get_param('settings');
    $topLevelKey = $request->get_param('topLevelKey');

    if (!is_array($newSettings) || !is_string($topLevelKey)) {
      return new \WP_Error('invalid_settings', 'Invalid settings format', ['status' => 400]);
    }

    $currentSettings = get_option("{$this->optionName}_settings", []);

    // Replace the entire top-level key
    $currentSettings[$topLevelKey] = $newSettings[$topLevelKey];

    $saved = update_option("{$this->optionName}_settings", $currentSettings);

    if ($saved) {
      return new \WP_REST_Response(['status' => '1'], 200);
    } else {
      return new \WP_Error('save_failed', 'Failed to save settings', ['status' => 500]);
    }
  }

  public function getPostTypes()
  {
    $excludes = ['product', 'attachment'];
    $postTypes = get_post_types(
      [
        'public' => true,
      ],
      'names'
    );

    foreach ($excludes as $exclude) {
      unset($postTypes[$exclude]);
    }

    return array_values($postTypes);
  }
}