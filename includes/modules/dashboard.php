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

    register_rest_route($this->slug, '/fetchPwaUsers', [
      'methods' => 'GET',
      'callback' => [$this, 'fetchPwaUsers'],
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
      201
    );
  }

  public function fetchPwaUsers(\WP_REST_Request $request)
  {
    $activeUsers = (int) $this->wpdb->get_var("
      SELECT COUNT(*)
      FROM {$this->tableName}
      WHERE last_open_date >= NOW() - INTERVAL 6 MONTH
    ");

    $browsers = $this->wpdb->get_results("
      SELECT 
        browser_name,
        browser_icon,
        COUNT(*) as active,
        ROUND(
          COUNT(*) * 100.0 / {$activeUsers}
        ) as percentage
      FROM {$this->tableName}
      WHERE last_open_date >= NOW() - INTERVAL 6 MONTH
      GROUP BY browser_name, browser_icon
      ORDER BY active DESC
      LIMIT 3
    ");

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
}
