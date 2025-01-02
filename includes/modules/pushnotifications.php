<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\{Plugin, Frontend};
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\VAPID;

if (!defined('ABSPATH')) {
  exit();
}

class PushNotifications
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
    $this->tableName = $wpdb->prefix . $config['optionName'] . '_push_subscribers';

    add_action('rest_api_init', [$this, 'registerRoutes']);
    register_activation_hook($this->pluginFile, [$this, 'createSubscribersTable']);
    register_activation_hook($this->pluginFile, [$this, 'generateVapidKeys']);
  }

  public function registerRoutes()
  {
    register_rest_route($this->slug, '/addSubscription', [
      'methods' => 'POST',
      'callback' => [$this, 'addSubscription'],
      'permission_callback' => '__return_true',
    ]);

    register_rest_route($this->slug, '/updateSubscription', [
      'methods' => 'PUT',
      'callback' => [$this, 'updateSubscription'],
      'permission_callback' => '__return_true',
    ]);

    register_rest_route($this->slug, '/removeSubscription', [
      'methods' => 'POST',
      'callback' => [$this, 'removeSubscription'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);
  }

  public function createSubscribersTable()
  {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $this->tableName (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      endpoint varchar(500) NOT NULL,
      auth_key varchar(255) NOT NULL,
      p256dh_key varchar(255) NOT NULL,
      device varchar(100) NULL,
      browser varchar(100) NULL,
      content_encoding varchar(50) NULL,
      country_name varchar(100) NULL,
      country_code varchar(10) NULL,
      user_id bigint(20) NULL,
      date datetime DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (id),
      UNIQUE KEY unique_endpoint (endpoint(191)),
      KEY user_id (user_id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
  }

  public function generateVapidKeys()
  {
    if (!version_compare(PHP_VERSION, '7.3', '<') && extension_loaded('mbstring') && extension_loaded('openssl')) {
      // Check if VAPID keys already exist
      $existingKeys = get_option($this->optionName . '_vapid_keys');
      if (!empty($existingKeys)) {
        return $existingKeys;
      }

      try {
        $vapidKeys = VAPID::createVapidKeys();
        $added = add_option($this->optionName . '_vapid_keys', [
          'public' => $vapidKeys['publicKey'],
          'private' => $vapidKeys['privateKey'],
        ]);

        if (!$added) {
          throw new \Exception('Failed to save VAPID keys');
        }

        return $vapidKeys;
      } catch (\Exception $e) {
        error_log('Failed to generate VAPID keys: ' . $e->getMessage());
        return false;
      }
    }

    return false;
  }

  public function getVapidKeys()
  {
    $keys = get_option($this->optionName . '_vapid_keys');
    if (empty($keys)) {
      $keys = $this->generateVapidKeys();
    }
    return $keys;
  }

  public function setupWebPush()
  {
    $vapidKeys = $this->getVapidKeys();

    if (!$vapidKeys) {
      throw new \Exception('VAPID keys not available');
    }

    $auth = [
      'VAPID' => [
        'subject' => get_bloginfo('wpurl'),
        'publicKey' => $vapidKeys['publicKey'],
        'privateKey' => $vapidKeys['privateKey'],
      ],
    ];

    $defaultOptions = [
      'TTL' => (int) Plugin::getSetting('pushNotifications[settings][timeToLive]'),
      'batchSize' => (int) Plugin::getSetting('pushNotifications[settings][batchSize]'),
    ];

    $webPush = new WebPush($auth, $defaultOptions, 6, ['verify' => false]);
    $webPush->setDefaultOptions($defaultOptions);
    $webPush->setAutomaticPadding(false);
    $webPush->setReuseVAPIDHeaders(true);

    return $webPush;
  }

  public function addSubscription(\WP_REST_Request $request)
  {
    if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
      return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
    }

    $endpoint = sanitize_text_field($request->get_param('endpoint'));
    $authKey = sanitize_text_field($request->get_param('authKey'));
    $p256dhKey = sanitize_text_field($request->get_param('p256dhKey'));
    $device = sanitize_text_field($request->get_param('device'));
    $browser = sanitize_text_field($request->get_param('browser'));
    $contentEncoding = sanitize_text_field($request->get_param('contentEncoding'));
    $user_id = get_current_user_id() ?: null;

    // Fetch user location data safely with timeout
    $context = stream_context_create([
      'http' => [
        'timeout' => 2, // 2 seconds timeout
      ],
    ]);
    $userData = @file_get_contents('http://ip-api.com/json/' . $_SERVER['REMOTE_ADDR'], false, $context);
    $userData = $userData ? json_decode($userData, true) : [];

    $data = [
      'endpoint' => $endpoint,
      'auth_key' => $authKey,
      'p256dh_key' => $p256dhKey,
      'device' => $device,
      'browser' => $browser,
      'content_encoding' => $contentEncoding,
      'country_name' => isset($userData['country']) ? $userData['country'] : '',
      'country_code' => isset($userData['countryCode']) ? $userData['countryCode'] : '',
      'user_id' => $user_id,
      'date' => current_time('mysql'),
    ];

    $formats = [
      '%s', // endpoint
      '%s', // auth_key
      '%s', // p256dh_key
      '%s', // device
      '%s', // browser
      '%s', // content_encoding
      '%s', // country_name
      '%s', // country_code
      '%d', // user_id
      '%s', // date
    ];

    $inserted = $this->wpdb->insert($this->tableName, $data, $formats);

    if ($inserted) {
      return new \WP_REST_Response(
        [
          'status' => 'success',
          'message' => 'Successfully subscribed to push notifications',
        ],
        200
      );
    }

    return new \WP_Error('subscription_failed', 'Failed to save subscription: ' . $this->wpdb->last_error, ['status' => 500]);
  }

  public function updateSubscription(\WP_REST_Request $request)
  {
    if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
      return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
    }

    $oldEndpoint = sanitize_text_field($request->get_param('oldEndpoint'));
    $newEndpoint = sanitize_text_field($request->get_param('newEndpoint'));
    $newAuthKey = sanitize_text_field($request->get_param('newAuthKey'));
    $newP256dhKey = sanitize_text_field($request->get_param('newP256dhKey'));

    $updated = $this->wpdb->update(
      $this->tableName,
      [
        'endpoint' => $newEndpoint,
        'auth_key' => $newAuthKey,
        'p256dh_key' => $newP256dhKey,
      ],
      ['endpoint' => $oldEndpoint],
      ['%s', '%s', '%s'],
      ['%s']
    );

    if ($updated !== false) {
      return new \WP_REST_Response(
        [
          'status' => 'success',
          'message' => 'Subscription updated successfully',
        ],
        200
      );
    }

    return new \WP_Error('update_failed', 'Failed to update subscription: ' . $this->wpdb->last_error, ['status' => 500]);
  }

  public function removeSubscription(\WP_REST_Request $request)
  {
    if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
      return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
    }

    $endpoint = sanitize_text_field($request->get_param('endpoint'));
    $deleted = $this->wpdb->delete($this->tableName, ['endpoint' => $endpoint], ['%s']);

    if ($deleted) {
      return new \WP_REST_Response(
        [
          'status' => 'success',
          'message' => 'Subscription removed successfully',
        ],
        200
      );
    }

    return new \WP_Error('delete_failed', 'Failed to remove subscription: ' . $this->wpdb->last_error, ['status' => 500]);
  }

  public function sendPushNotification($to, $notificationData = [])
  {
    try {
      $webPush = $this->setupWebPush();

      // Default notification data
      $notificationData = wp_parse_args($notificationData, [
        'title' => '',
        'badge' => '',
        'body' => '',
        'icon' => '',
        'image' => '',
        'data' => '',
        'tag' => 'notification',
        'renotify' => true,
        'requireInteraction' => false,
        'vibrate' => [],
      ]);

      // Get subscribers based on target
      $subscribers = [];
      switch ($to) {
        case 'everyone':
          $subscribers = $this->wpdb->get_results("SELECT * FROM {$this->tableName}", ARRAY_A);
          break;

        case is_numeric($to):
          $subscribers = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM {$this->tableName} WHERE user_id = %d", $to), ARRAY_A);
          break;

        default:
          if (is_array($to)) {
            $placeholders = array_fill(0, count($to), '%d');
            $placeholders = implode(',', $placeholders);
            $subscribers = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM {$this->tableName} WHERE user_id IN ($placeholders)", $to), ARRAY_A);
          }
          break;
      }

      if (empty($subscribers)) {
        return ['error' => 'No subscribers found'];
      }

      // Queue notifications
      foreach ($subscribers as $subscriber) {
        $subscription = Subscription::create([
          'endpoint' => $subscriber['endpoint'],
          'publicKey' => $subscriber['p256dh_key'],
          'authToken' => $subscriber['auth_key'],
          'contentEncoding' => $subscriber['content_encoding'] ?? 'aesgcm',
        ]);

        $webPush->queueNotification($subscription, json_encode($notificationData));
      }

      // Send notifications and collect reports
      $reports = [];
      foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();

        if ($report->isSuccess()) {
          $reports[] = [
            'status' => 'success',
            'endpoint' => $endpoint,
            'message' => 'Notification sent successfully',
          ];
        } else {
          if ($report->getReason() === 'expired' || $report->getReason() === 'invalid-subscription') {
            $this->wpdb->delete($this->tableName, ['endpoint' => $endpoint], ['%s']);
          }

          $reports[] = [
            'status' => 'failed',
            'endpoint' => $endpoint,
            'message' => $report->getReason(),
          ];
        }
      }

      return $reports;
    } catch (\Exception $e) {
      return [
        'error' => true,
        'message' => $e->getMessage(),
      ];
    }
  }
}