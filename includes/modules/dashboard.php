<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\{Plugin};

if (!defined('ABSPATH')) {
  exit();
}

class Dashboard
{
  public $slug;
  public $version;
  public $textDomain;
  public $optionName;
  public $pluginFile;
  public $pluginBasename;
  public $pluginDirUrl;
  public $pluginDirPath;
  public $pluginUploadDir;
  protected $dependencies;
  public $capability;
  public $settings;
  private $wpdb;
  private $tableName;

  public function __construct($config)
  {
    global $wpdb;
    $this->slug = $config['slug'];
    $this->version = $config['version'];
    $this->textDomain = $config['text_domain'];
    $this->optionName = $config['option_name'];
    $this->pluginFile = $config['plugin_file'];
    $this->pluginBasename = $config['plugin_basename'];
    $this->pluginDirPath = $config['plugin_dir_path'];
    $this->pluginUploadDir = $config['plugin_upload_dir'];
    $this->dependencies = [];
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];
    $this->wpdb = $wpdb;
    $this->tableName = $wpdb->prefix . $this->optionName . '_pwa_users';

    register_activation_hook($this->pluginFile, [$this, 'createPwaUsersTable']);
    add_action('rest_api_init', [$this, 'registerRoutes']);
  }

  public function createPwaUsersTable()
  {
    $charset_collate = $this->wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $this->tableName (
          id bigint(20) NOT NULL AUTO_INCREMENT,
          pwa_user_id varchar(191) NULL,
          country_name varchar(100) NULL,
          country_icon varchar(255) NULL,
          device_name varchar(100) NULL,
          device_icon varchar(255) NULL,
          os_name varchar(100) NULL,
          os_icon varchar(255) NULL,
          browser_name varchar(100) NULL,
          browser_icon varchar(255) NULL,
          wp_user_id bigint(20) UNSIGNED NULL,
          first_open_date datetime DEFAULT CURRENT_TIMESTAMP,
          last_open_date datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (id),
          UNIQUE KEY unique_pwa_user_id (pwa_user_id),
          KEY idx_last_open_date (last_open_date),
          KEY idx_wp_user (wp_user_id)
        ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
  }

  public function registerRoutes()
  {
    register_rest_route($this->slug, '/upsertPwaUser', [
      'methods' => 'PUT',
      'callback' => [$this, 'upsertPwaUser'],
      'permission_callback' => '__return_true',
    ]);

    register_rest_route($this->slug, '/fetchPwaUsersData', [
      'methods' => 'GET',
      'callback' => [$this, 'fetchPwaUsersData'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);

    register_rest_route($this->slug, '/fetchPwaScoreData', [
      'methods' => 'GET',
      'callback' => [$this, 'fetchPwaScoreData'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);
  }

  public function upsertPwaUser(\WP_REST_Request $request)
  {
    $pwaUserId = sanitize_text_field($request->get_param('pwaUserId'));
    $currentDate = current_time('mysql');

    if (empty($pwaUserId)) {
      return new \WP_Error('invalid_data', 'PWA user ID is required', ['status' => 400]);
    }

    // Check if user exists
    $existing_pwa_user = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM {$this->tableName} WHERE pwa_user_id = %s", $pwaUserId));
    if ($existing_pwa_user) {
      // Update last_open_date for existing user
      $updated = $this->wpdb->update($this->tableName, ['last_open_date' => $currentDate], ['pwa_user_id' => $pwaUserId], ['%s'], ['%s']);

      if ($updated === false) {
        return new \WP_Error('update_failed', 'Failed to update PWA user: ' . $this->wpdb->last_error, ['status' => 500]);
      }

      return new \WP_REST_Response(
        [
          'status' => 'success',
          'message' => 'Successfully updated PWA user',
          'type' => 'update',
        ],
        200
      );
    }

    $userData = Plugin::getUserData();
    $data = [
      'pwa_user_id' => $pwaUserId,
      'country_name' => $userData['country']['name'],
      'country_icon' => $userData['country']['icon'],
      'device_name' => $userData['device']['name'],
      'device_icon' => $userData['device']['icon'],
      'os_name' => $userData['os']['name'],
      'os_icon' => $userData['os']['icon'],
      'browser_name' => $userData['browser']['name'],
      'browser_icon' => $userData['browser']['icon'],
      'wp_user_id' => get_current_user_id() ?: null,
      'first_open_date' => $currentDate,
      'last_open_date' => $currentDate,
    ];

    $formats = [
      '%s', // pwa_user_id
      '%s', // country_name
      '%s', // country_icon
      '%s', // device_name
      '%s', // device_icon
      '%s', // os_name
      '%s', // os_icon
      '%s', // browser_name
      '%s', // browser_icon
      '%d', // wp_user_id
      '%s', // first_open_date
      '%s', // last_open_date
    ];

    $inserted = $this->wpdb->insert($this->tableName, $data, $formats);

    if ($inserted === false) {
      return new \WP_Error('insert_failed', 'Failed to insert PWA user: ' . $this->wpdb->last_error, ['status' => 500]);
    }

    return new \WP_REST_Response(
      [
        'status' => 'success',
        'message' => 'Successfully added new PWA user',
        'type' => 'insert',
      ],
      200
    );
  }

  public function fetchPwaUsersData()
  {
    $nowTimestamp = current_time('timestamp');
    $sixMonthsAgo = gmdate('Y-m-d H:i:s', strtotime('-6 months', $nowTimestamp));

    $activeUsers = (int) $this->wpdb->get_var(
      $this->wpdb->prepare(
        "
        SELECT COUNT(*) 
        FROM {$this->tableName}
        WHERE last_open_date >= %s
      ",
        $sixMonthsAgo
      )
    );

    $browsers = $this->wpdb->get_results(
      $this->wpdb->prepare(
        "
        SELECT 
          browser_name,
          browser_icon,
          COUNT(*) as active,
          CASE WHEN %d > 0 
              THEN ROUND(COUNT(*) * 100.0 / %d) 
              ELSE 0 
          END as percentage
        FROM {$this->tableName}
        WHERE last_open_date >= %s
        GROUP BY browser_name, browser_icon
        ORDER BY active DESC
        LIMIT 3
      ",
        $activeUsers, // %d
        $activeUsers, // %d
        $sixMonthsAgo // %s
      )
    );

    $installations = $this->wpdb->get_results("
      SELECT DATE(first_open_date) as date, COUNT(*) as count
      FROM {$this->tableName}
      GROUP BY DATE(first_open_date)
      ORDER BY date ASC
    ");

    return new \WP_REST_Response(
      [
        'status' => 'success',
        'data' => [
          'installations' => $installations,
          'browsers' => $browsers,
          'activeUsers' => $activeUsers,
        ],
      ],
      200
    );
  }

  public function fetchPwaScoreData()
  {
    $allActionItems = [
      'mobileApps' => [
        'weight' => 15,
        'condition' => false, // TODO: Implement real detection if the user has purchased mobile apps or not
        'title' => esc_html__('Generate Android and iOS mobile apps', $this->textDomain),
        'icon' => '<img class="shrink-0 size-5" src="' . plugins_url('admin/assets/media/icons/androios.png', $this->pluginFile) . '" alt="Mobile Apps" />',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'generateMobileApps',
        ],
      ],
      'https' => [
        'condition' => !is_ssl(),
        'title' => esc_html__('Enable secure HTTPS on your server', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>',
        'action' => [
          'type' => 'hover',
          'tooltip' => esc_html__('It appears you do not have a secure HTTPS server and PWA requires HTTPS connection to function correctly. Please set up it on your server or contact to your hosting provider to enable it for you.', $this->textDomain),
        ],
      ],
      'appIcon' => [
        'condition' => !Plugin::getSetting('webAppManifest[appIdentity][appIcon]'),
        'title' => esc_html__('Upload and select your PWA App Icon', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'webAppManifest',
          'highLightElement' => '#settingAppIcon',
        ],
      ],
      'appName' => [
        'condition' => !Plugin::getSetting('webAppManifest[appIdentity][appName]'),
        'title' => esc_html__('Define your PWA web app Name', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 7 4 4 20 4 20 7"/><line x1="9" x2="15" y1="20" y2="20"/><line x1="12" x2="12" y1="4" y2="20"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'webAppManifest',
          'highLightElement' => '#settingAppName',
        ],
      ],
      'shortName' => [
        'condition' => !Plugin::getSetting('webAppManifest[appIdentity][shortName]'),
        'title' => esc_html__('Define your PWA web app Short Name', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 15 4-8 4 8"/><path d="M4 13h6"/><circle cx="18" cy="12" r="3"/><path d="M21 9v6"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'webAppManifest',
          'highLightElement' => '#settingShortName',
        ],
      ],
      'installationPrompts' => [
        'condition' => Plugin::getSetting('installation[prompts][feature]') !== 'on',
        'title' => esc_html__('Enable PWA Installation Prompts', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'installation',
          'highLightElement' => '#subsectionInstallationPrompts',
        ],
      ],
      'installationOverlays' => [
        'condition' => Plugin::getSetting('installation[prompts][feature]') == 'on' && (Plugin::getSetting('installation[prompts][types][headerBanner]') !== 'on' && Plugin::getSetting('installation[prompts][types][snackbar]') !== 'on' && Plugin::getSetting('installation[prompts][types][navigationMenu]') !== 'on' && Plugin::getSetting('installation[prompts][types][inFeed]') !== 'on' && Plugin::getSetting('installation[prompts][types][blogPopup]') !== 'on' && Plugin::getSetting('installation[prompts][types][woocommerceCheckout]]') !== 'on'),
        'title' => esc_html__('Enable one of the PWA Installation Overlays', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M12 7v6"/><path d="M9 10h6"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'installation',
          'highLightElement' => '#settingPromptsOverlays',
        ],
      ],
      'offlineCache' => [
        'condition' => Plugin::getSetting('offlineUsage[cache][feature]') !== 'on',
        'title' => esc_html__('Enable Offline Cache for your PWA', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h.01"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/><path d="M5 12.859a10 10 0 0 1 5.17-2.69"/><path d="M19 12.859a10 10 0 0 0-2.007-1.523"/><path d="M2 8.82a15 15 0 0 1 4.177-2.643"/><path d="M22 8.82a15 15 0 0 0-11.288-3.764"/><path d="m2 2 20 20"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'offlineUsage',
          'highLightElement' => '#subsectionOfflineCache',
        ],
      ],
      'advancedWebCapabilities' => [
        'condition' => Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on',
        'title' => esc_html__('Enable Advanced Web Capabilities for your PWA', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 17v4"/><path d="m15.2 4.9-.9-.4"/><path d="m15.2 7.1-.9.4"/><path d="m16.9 3.2-.4-.9"/><path d="m16.9 8.8-.4.9"/><path d="m19.5 2.3-.4.9"/><path d="m19.5 9.7-.4-.9"/><path d="m21.7 4.5-.9.4"/><path d="m21.7 7.5-.9-.4"/><path d="M22 13v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7"/><path d="M8 21h8"/><circle cx="18" cy="6" r="3"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'appCapabilities',
          'highLightElement' => '#subsectionAdvancedWebCapabilities',
        ],
      ],
      'backgroundSync' => [
        'condition' => Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') == 'on' && Plugin::getSetting('appCapabilities[advancedWebCapabilities][backgroundSync]') !== 'on',
        'title' => esc_html__('Enable the Background Sync feature', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'appCapabilities',
          'highLightElement' => '#settingBackgroundSync',
        ],
      ],
      'periodicBackgroundSync' => [
        'condition' => Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') == 'on' && Plugin::getSetting('appCapabilities[advancedWebCapabilities][periodicBackgroundSync]') !== 'on',
        'title' => esc_html__('Enable the Periodic Background Sync feature', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v6h6"/><path d="M21 12A9 9 0 0 0 6 5.3L3 8"/><path d="M21 22v-6h-6"/><path d="M3 12a9 9 0 0 0 15 6.7l3-2.7"/><circle cx="12" cy="12" r="1"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'appCapabilities',
          'highLightElement' => '#settingPeriodicBackgroundSync',
        ],
      ],
      'pushNotificationsPromptOrButton' => [
        'condition' => Plugin::getSetting('pushNotifications[prompt][feature]') !== 'on' && Plugin::getSetting('pushNotifications[button][feature]') !== 'on',
        'title' => esc_html__('Enable Push Notifications Prompt or Button', $this->textDomain),
        'icon' => '<svg class="shrink-0 size-4 text-gray-600 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.268 21a2 2 0 0 0 3.464 0"/><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/></svg>',
        'action' => [
          'type' => 'click',
          'navigateToPage' => 'pushNotifications',
          'highLightElement' => '#subsectionPushPrompt',
        ],
      ],
    ];

    $definedWeight = 0;
    $itemsWithoutWeight = 0;

    foreach ($allActionItems as $item) {
      if (isset($item['weight'])) {
        $definedWeight += $item['weight'];
      } else {
        $itemsWithoutWeight++;
      }
    }

    // Calculate default weight for remaining items
    $remainingWeight = 100 - $definedWeight;
    $defaultWeight = $itemsWithoutWeight > 0 ? $remainingWeight / $itemsWithoutWeight : 0;

    // Assign default weight to items without defined weight
    foreach ($allActionItems as $key => &$item) {
      if (!isset($item['weight'])) {
        $item['weight'] = $defaultWeight;
      }
    }

    // Filter action items that need attention (where condition is true)
    $actionItems = array_filter($allActionItems, function ($item) {
      return $item['condition'];
    });

    // Calculate weighted score
    $completedWeight = array_reduce(
      array_keys($allActionItems),
      function ($carry, $key) use ($actionItems, $allActionItems) {
        // If item is not in actionItems (meaning condition is false/completed),
        // add its weight to the completed weight
        if (!isset($actionItems[$key])) {
          $carry += $allActionItems[$key]['weight'];
        }
        return $carry;
      },
      0
    );

    // Calculate score percentage based on weights
    $scorePercent = $completedWeight;

    // Determine score result based on percentage
    $scoreResult = match (true) {
      $scorePercent >= 100 => 'Excellent',
      $scorePercent >= 50 => 'Good',
      $scorePercent >= 25 => 'Average',
      default => 'Bad',
    };

    return new \WP_REST_Response(
      [
        'status' => 'success',
        'data' => [
          'scoreResult' => $scoreResult,
          'scorePercent' => $scorePercent,
          'actionItems' => array_map(
            function ($key, $item) {
              return array_merge(['id' => $key], $item);
            },
            array_keys($actionItems),
            array_values($actionItems)
          ),
        ],
      ],
      200
    );
  }
}