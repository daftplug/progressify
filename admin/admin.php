<?php

namespace DaftPlug\Progressify;
use DaftPlug\Progressify\Module\WebAppManifest;

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
  public $domain;
  protected $dependencies;
  public $licenseKey;
  public $capability;
  public $settings;
  public $licenseEndpoint;
  public $envatoItemId;
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
    $this->licenseEndpoint = $config['license_endpoint'];
    $this->envatoItemId = $config['envato_item_id'];
    $this->menuTitle = $config['menu_title'];
    $this->menuIcon = $config['menu_icon'];
    $this->dependencies = [];
    $this->licenseKey = get_option("{$this->optionName}_license_key");
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];
    $this->pages = $this->generatePages();
    $this->domain = Plugin::getDomainFromUrl(trailingslashit(strtok(home_url('/', 'https'), '?')));

    add_action('admin_menu', [$this, 'addMenuPage']);
    add_action('admin_enqueue_scripts', [$this, 'loadAssets']);
    add_action('rest_api_init', [$this, 'registerRoutes']);
    add_action('admin_post_delete_support_access', [$this, 'handleSupportAccountDeletion']);
    add_action('admin_bar_menu', [$this, 'addSupportAccountDeleteButton'], 100);
    add_filter('pre_set_site_transient_update_plugins', [$this, 'checkIfUpdateIsAvailable']);
    add_filter('plugins_api', [$this, 'getPluginUpdateInfo'], 10, 3);
  }

  public function addMenuPage()
  {
    remove_all_actions('admin_notices');
    remove_all_actions('all_admin_notices');

    $this->menuId = add_menu_page($this->menuTitle, !$this->licenseKey ? $this->menuTitle . ' <span class="awaiting-mod">1</span>' : $this->menuTitle, $this->capability, $this->slug, [$this, 'createAdminPage'], $this->menuIcon, 55);

    $this->addMenuSeparators();
  }

  private function addMenuSeparators()
  {
    global $menu;

    $position = null;
    foreach ($menu as $key => $item) {
      if (isset($item[2]) && $item[2] === $this->slug) {
        $position = $key;
        break;
      }
    }

    if ($position !== null) {
      if (!isset($menu[$position - 1])) {
        $menu[$position - 1] = ['', 'read', 'separator-' . $this->slug . '-top', '', 'wp-menu-separator ' . $this->slug];
      }

      if (!isset($menu[$position + 1])) {
        $menu[$position + 1] = ['', 'read', 'separator-' . $this->slug . '-bottom', '', 'wp-menu-separator ' . $this->slug];
      }

      ksort($menu);
    }
  }

  public function loadAssets($hook)
  {
    if ($hook && $hook == $this->menuId) {
      $this->dependencies[] = 'jquery';

      wp_enqueue_style("{$this->slug}-admin", plugins_url('admin/assets/css/admin.css', $this->pluginFile), [], $this->version);
      wp_enqueue_script("{$this->slug}-admin", plugins_url('admin/assets/js/dev/main.js', $this->pluginFile), $this->dependencies, $this->version, true);

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
          'iconUrl' => WebAppManifest::getPwaIconUrl('maskable', 180),
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
        'description' => esc_html__('View your PWA\'s performance at a glance, including user stats, browser breakdown, and a PWA readiness score. Manage plugin features globally with a single toggle for easy control.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'dashboard.php']),
      ],
      [
        'id' => 'webAppManifest',
        'menuTitle' => esc_html__('Web App Manifest', $this->textDomain),
        'description' => esc_html__('The web app manifest is a JSON file that provides essential information about your web application to the browser, including how it should appear and behave when installed on a user\'s device. This file is necessary for enabling the "Add to Home Screen" prompt, enhancing the integration of your web app with the user\'s device.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'webappmanifest.php']),
      ],
      [
        'id' => 'installation',
        'menuTitle' => esc_html__('Installation', $this->textDomain),
        'description' => esc_html__('Installation features allows displaying prompts that encourage users to add your website to their home screens. This feature helps increase user engagement by making your site easily accessible with a single tap, just like any native mobile application.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'installation.php']),
      ],
      [
        'id' => 'offlineUsage',
        'menuTitle' => esc_html__('Offline Usage', $this->textDomain),
        'description' => esc_html__('Enhance your web app with offline support and reliable performance, enabling users to access previously viewed pages even without an internet connection or on low connectivity.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'offlineusage.php']),
      ],
      [
        'id' => 'uiComponents',
        'menuTitle' => esc_html__('UI Components', $this->textDomain),
        'description' => esc_html__('Enhance the user experience by adding interactive elements and features that make your web app look and feel more like a native application, including options like pull-down refresh, a navigation tab bar, dark mode, and toast messages.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'uicomponents.php']),
      ],
      [
        'id' => 'appCapabilities',
        'menuTitle' => esc_html__('App Capabilities', $this->textDomain),
        'description' => esc_html__('Enable advanced features and capabilities to enhance your website with native app-like functionalities. This includes passwordless login, background sync, periodic background sync, content indexing, persistent storage, and other advanced web APIs, providing a seamless mobile-like experience.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'appcapabilities.php']),
      ],
      [
        'id' => 'pushNotifications',
        'menuTitle' => esc_html__('Push Notifications', $this->textDomain),
        'description' => esc_html__('Push notifications allow your web app to send messages directly to users\' devices, providing a powerful tool for engaging users with timely updates, alerts, and personalized content. This feature helps keep your audience informed and connected, even when they are not actively using the app.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'pushnotifications.php']),
      ],
      [
        'id' => 'publishOnAppStores',
        'description' => esc_html__('Get Android, iOS, and Windows apps that mirror your website in real-time, requiring no updates, and publish your web app to the Google Play Store, App Store, and Microsoft Store to reach more users.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'publishonappstores.php']),
      ],
      [
        'id' => 'helpCenter',
        'description' => esc_html__('We understand all the importance of product support for our customers. That\'s why we are ready to solve all your issues and answer any questions related to our plugin.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'helpcenter.php']),
      ],
      [
        'id' => 'changelog',
        'description' => esc_html__('See what\'s new added, changed, fixed, improved or updated.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'changelog.php']),
      ],
      [
        'id' => 'tools',
        'description' => esc_html__('Control what to do with your settings and data, reset/export/import settings or deactivate license to activate the plugin on another website.', $this->textDomain),
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'tools.php']),
      ],
      [
        'id' => 'error',
        'template' => plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'error.php']),
      ],
    ];

    return $pages;
  }

  public function createAdminPage()
  {
    ?>
<div id="daftplugAdmin" data-option-name="<?php echo $this->optionName; ?>" data-slug="<?php echo $this->slug; ?>">
  <div class="relative mr-6 mt-6 rounded-xl bg-gray-50 shadow-[0_5px_25px_0_rgba(0,0,0,.1)] -daftplugLoading">
    <?php if (!$this->licenseKey): ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'pages', 'activation.php']); ?>
    <?php else: ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'header.php']); ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'sidebar.php']); ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'main.php']); ?>
    <?php include_once plugin_dir_path(__FILE__) . implode(DIRECTORY_SEPARATOR, ['templates', 'footer.php']); ?>
    <?php endif; ?>
  </div>
</div>
<?php
  }

  public function registerRoutes()
  {
    register_rest_route($this->slug, '/requestLicenseProcessing', [
      'methods' => 'POST',
      'callback' => [$this, 'requestLicenseProcessing'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);

    register_rest_route($this->slug, '/saveSettings', [
      'methods' => 'POST',
      'callback' => [$this, 'saveSettings'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);

    register_rest_route($this->slug, '/submitSupportRequest', [
      'methods' => 'POST',
      'callback' => [$this, 'submitSupportRequest'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);
  }

  public function requestLicenseProcessing(\WP_REST_Request $request)
  {
    if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
      return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
    }

    $licenseKey = $request->get_param('licenseKey');
    $action = $request->get_param('action');

    if (!is_string($licenseKey) || !is_string($action)) {
      return new \WP_Error('invalid_request', 'Invalid request format', ['status' => 400]);
    }

    $licenseResponse = $this->daftplugProcessLicense($licenseKey, $action);

    if (is_wp_error($licenseResponse)) {
      return new \WP_REST_Response(['status' => 'fail', 'message' => $licenseResponse->get_error_message()], 200);
    }

    if ($action === 'activate') {
      if ($licenseResponse->valid) {
        update_option("{$this->optionName}_license_key", $licenseKey);
        return new \WP_REST_Response(['status' => 'success'], 200);
      } else {
        delete_option("{$this->optionName}_license_key");
        return new \WP_REST_Response(['status' => 'fail', 'message' => $licenseResponse->error], 200);
      }
    }

    if ($action === 'deactivate') {
      if ($licenseResponse->valid) {
        delete_option("{$this->optionName}_license_key");
        return new \WP_REST_Response(['status' => 'success'], 200);
      } else {
        return new \WP_REST_Response(['status' => 'fail', 'message' => $licenseResponse->error], 200);
      }
    }

    return new \WP_Error('invalid_action', 'Invalid action', ['status' => 400]);
  }

  public function daftplugProcessLicense($licenseKey, $action)
  {
    @ini_set('display_errors', 0);
    error_reporting(0);

    $params = [
      'method' => 'POST',
      'sslverify' => false,
      'body' => [
        'license_key' => $licenseKey,
        'action' => $action,
        'slug' => $this->slug,
        'domain' => $this->domain,
        'envato_item_id' => $this->envatoItemId,
      ],
      'user-agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
    ];

    $response = wp_remote_post($this->licenseEndpoint, $params);

    if (is_wp_error($response)) {
      return $response;
    }

    $body = wp_remote_retrieve_body($response);
    $result = json_decode($body);

    return $result;
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
      return new \WP_REST_Response(['status' => 'success'], 200);
    } else {
      return new \WP_Error('save_failed', 'Failed to save settings', ['status' => 500]);
    }
  }

  public function submitSupportRequest(\WP_REST_Request $request)
  {
    @ini_set('display_errors', 0);

    if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
      return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
    }

    $licenseResponse = $this->daftplugProcessLicense($this->licenseKey, 'validate');
    if (is_wp_error($licenseResponse)) {
      return new \WP_Error('server_error', 'There was an error verifying your license. Please try again.', ['status' => 500]);
    }

    if (!$licenseResponse->valid) {
      delete_option("{$this->optionName}_license_key");
      return new \WP_Error('invalid_license', 'Your license key is invalid. You can not request support with an invalid license key.', ['status' => 403]);
    }

    $supportRequest = $request->get_param('supportRequest');

    if (!is_array($supportRequest)) {
      return new \WP_Error('invalid_request', 'Invalid form request format', ['status' => 400]);
    }

    // Create temporary admin account if access is granted
    $tempCredentials = '';
    if ($supportRequest['temporaryAccess'] === 'on') {
      $tempPassword = wp_generate_password(16, true);
      $userdata = [
        'user_login' => 'daftplugSupport',
        'user_pass' => $tempPassword,
        'user_email' => 'support@daftplug.com',
        'role' => 'administrator',
      ];

      // Remove existing temp user if exists
      $existingUser = get_user_by('login', 'daftplugSupport');
      if ($existingUser) {
        require_once ABSPATH . 'wp-admin/includes/user.php';
        wp_delete_user($existingUser->ID);
      }

      $userId = wp_insert_user($userdata);

      if (!is_wp_error($userId)) {
        $tempCredentials = sprintf(
          "<div class='temporary-access'>
              <h3 style='color: #e44d26;'>Temporary Access Credentials</h3>
              <p><strong>Username:</strong> daftplugSupport<br>
              <strong>Password:</strong> %s<br>
              <strong>Login URL:</strong> <a href='%s'>%s</a></p>
          </div>",
          $tempPassword,
          wp_login_url(),
          wp_login_url()
        );
      }
    }

    // Prepare debug information
    $activePlugins = [];
    foreach (get_option('active_plugins') as $plugin) {
      if (!function_exists('get_plugin_data')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
      }
      $pluginData = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
      $activePlugins[] = sprintf('<span class="plugin-item">%s <small>(%s)</small></span>', $pluginData['Name'], $pluginData['Version']);
    }

    $debugInfo = sprintf(
      '<div class="debug-section">
          <p><strong>PHP Version:</strong> %s</p>
          <p><strong>WordPress Version:</strong> %s</p>
          <p><strong>Plugin Version:</strong> %s</p>
          <p><strong>Site URL:</strong> %s</p>
          <p><strong>Active Theme:</strong> %s</p>
          <p><strong>Server Software:</strong> %s</p>
          <p><strong>Memory Limit:</strong> %s</p>
          <p><strong>Max Upload Size:</strong> %s</p>
          <p><strong>Active Plugins:</strong></p>
          <div class="plugins-grid">%s</div>
      </div>',
      PHP_VERSION,
      get_bloginfo('version'),
      $this->version,
      get_site_url(),
      wp_get_theme()->get('Name'),
      $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
      ini_get('memory_limit'),
      ini_get('upload_max_filesize'),
      implode('', $activePlugins)
    );

    // Format settings in a human-readable way
    $settings = get_option("{$this->optionName}_settings", []);
    $formattedSettings = $this->formatSettingsHtml($settings);

    // Process attachments
    $attachments = [];
    if (!empty($supportRequest['problemAttachments'])) {
      foreach ($supportRequest['problemAttachments'] as $attachment) {
        $upload_dir = wp_upload_dir();
        $filename = wp_unique_filename($upload_dir['path'], $attachment['name']);
        $filepath = $upload_dir['path'] . '/' . $filename;

        // Decode and save base64 image
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $attachment['dataUrl']));
        file_put_contents($filepath, $imageData);

        $attachments[] = $filepath;
      }
    }

    // Prepare email content
    $emailContent = sprintf(
      '<html>
          <head>
              <style>
                  body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                  .container { max-width: 800px; margin: 0 auto; padding: 20px; }
                  .header { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
                  .section { margin-bottom: 25px; }
                  .problem-description { background: #fff; padding: 15px; border-left: 4px solid #000; margin: 10px 0; }
                  .debug-section { background: #f8f9fa; padding: 15px; border-radius: 5px; }
                  .debug-section p { margin: 5px 0; }
                  .plugins-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }
                  .plugin-item { background: #fff; padding: 7px 10px; border-radius: 3px; border: 1px solid #ddd; border-radius: 10px; font-size: 13px; line-height: 1;}
                  .temporary-access { background: #fff3cd; padding: 15px; border-radius: 5px; margin: 15px 0; }
                  .settings-tree { background: #f8f9fa; padding: 15px; border-radius: 5px; }
                  .settings-tree ul { list-style: none; margin: 0; padding-left: 20px; }
                  .settings-tree > ul { padding-left: 0; }
                  .settings-value { color: #000; font-weight: 700; }
                  h2, h3 { color: #000; margin-bottom: 10px; }
                  .attachments-info { color: #666; font-style: italic; }
              </style>
          </head>
          <body>
              <div class="container">
                  <div class="header">
                      <h2>New Support Request - %s</h2>
                      <p><strong>From:</strong> %s (%s)</p>
                  </div>
                  
                  <div class="section">
                      <h3>Problem Description</h3>
                      <div class="problem-description">%s</div>
                  </div>
                  
                  %s

                  %s
                  
                  <div class="section">
                      <h3>System Information</h3>
                      %s
                  </div>
                  
                  <div class="section">
                      <h3>Plugin Settings</h3>
                      <div class="settings-tree">%s</div>
                  </div>
              </div>
          </body>
          </html>',
      $this->name,
      $supportRequest['personName'],
      $supportRequest['personEmail'],
      nl2br(esc_html($supportRequest['problemDescription'])),
      !empty($attachments) ? sprintf('<div class="attachments-info">%d attachment(s) included</div>', count($attachments)) : '',
      $tempCredentials,
      $debugInfo,
      $formattedSettings
    );

    // Send email
    $headers = ['From: ' . $supportRequest['personName'] . ' <' . $supportRequest['personEmail'] . '>', 'Reply-To: ' . $supportRequest['personEmail'], 'Content-Type: text/html; charset=UTF-8'];

    $emailSent = wp_mail('support@daftplug.com', "[$this->name] New Support Request", $emailContent, $headers, $attachments);

    // Clean up attachment files
    if (!empty($attachments)) {
      foreach ($attachments as $attachment) {
        unlink($attachment);
      }
    }

    if ($emailSent) {
      return new \WP_REST_Response(['status' => 'success'], 200);
    } else {
      return new \WP_Error('submit_failed', 'Failed to submit support request', ['status' => 500]);
    }
  }

  public function addSupportAccountDeleteButton($wp_admin_bar)
  {
    $current_user = wp_get_current_user();
    if ($current_user && $current_user->user_login === 'daftplugSupport') {
      $wp_admin_bar->add_node([
        'id' => 'delete-support-access',
        'title' => '<span style="color: #ff4444; font-weight: bold;">Delete Account & Logout</span>',
        'href' => wp_nonce_url(admin_url('admin-post.php?action=delete_support_access'), 'delete_support_access'),
        'meta' => [
          'class' => 'delete-support-access-btn',
          'title' => 'Permanently delete this support account and log out',
        ],
        'parent' => 'top-secondary',
      ]);
    }
  }

  public function handleSupportAccountDeletion()
  {
    $current_user = wp_get_current_user();
    if (!$current_user || $current_user->user_login !== 'daftplugSupport' || !wp_verify_nonce($_REQUEST['_wpnonce'], 'delete_support_access')) {
      wp_die('Unauthorized access');
    }

    $user_id = $current_user->ID;
    wp_logout();
    require_once ABSPATH . 'wp-admin/includes/user.php';
    wp_delete_user($user_id);
    wp_redirect(wp_login_url());
    exit();
  }

  private function formatSettingsHtml($array, $level = 0)
  {
    $html = $level === 0 ? '<ul class="settings-root">' : '<ul>';

    foreach ($array as $key => $value) {
      $html .= '<li>';
      if (is_array($value)) {
        $html .= esc_html($key) . ':';
        $html .= $this->formatSettingsHtml($value, $level + 1);
      } else {
        $displayValue = $value === '' ? '(empty)' : $value;
        $html .= sprintf('%s: <span class="settings-value">%s</span>', esc_html($key), esc_html($displayValue));
      }
      $html .= '</li>';
    }

    return $html . '</ul>';
  }

  public function checkIfUpdateIsAvailable($transient)
  {
    $result = $this->daftplugProcessLicense($this->licenseKey, 'update');

    if (!$transient) {
      return false;
    }

    if (empty($transient->response)) {
      $transient->response = [];
    }

    if ($result && empty($result->error) && !empty($result->data) && version_compare($this->version, $result->data->new_version, '<')) {
      $result->data->plugin = $this->pluginBasename;
      $transient->response[$this->pluginBasename] = $result->data;
    }

    return $transient;
  }

  public function getPluginUpdateInfo($result, $action, $args)
  {
    $result = false;

    if (isset($args->slug) && $args->slug === $this->slug) {
      $info = $this->daftplugProcessLicense($this->licenseKey, 'update');

      if (is_object($info) && empty($info->error) && !empty($info->data)) {
        if (!empty($info->data->sections)) {
          $info->data->sections = (array) $info->data->sections;
        }

        $result = $info->data;
      }
    }

    return $result;
  }

  public function getPostTypes()
  {
    $excludes = ['attachment'];
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