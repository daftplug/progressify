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
    $this->tableName = $wpdb->prefix . $this->optionName . '_push_notifications_subscribers';

    add_action('rest_api_init', [$this, 'registerRoutes']);
    add_filter("{$this->optionName}_frontend_js_vars", [$this, 'addPublicVapidKeyToFrontJs']);
    add_filter("{$this->optionName}_serviceworker", [$this, 'addPushJsToServiceWorker']);
    add_action("wp_ajax_{$this->optionName}_fetch_push_notifications_subscribers", [$this, 'fetchPushNotificationsSubscribers']);
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
      'methods' => 'DELETE',
      'callback' => [$this, 'removeSubscription'],
      'permission_callback' => '__return_true',
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
      content_encoding varchar(50) NULL,
      device_name varchar(100) NULL,
      device_icon varchar(255) NULL,
      browser_name varchar(100) NULL,
      browser_icon varchar(255) NULL,
      country_name varchar(100) NULL,
      country_icon varchar(255) NULL,
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
      $existingKeys = get_option($this->optionName . '_vapid_keys');
      if (!empty($existingKeys)) {
        return $existingKeys;
      }

      try {
        $vapidKeys = VAPID::createVapidKeys();
        $added = add_option($this->optionName . '_vapid_keys', [
          'publicKey' => $vapidKeys['publicKey'],
          'privateKey' => $vapidKeys['privateKey'],
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

  public function fetchPushNotificationsSubscribers()
  {
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $data = $this->getSubscribers($page);
    wp_send_json_success($data);
  }

  public function getSubscribers($page = 1, $per_page = 7)
  {
    $offset = ($page - 1) * $per_page;
    $total = (int) $this->wpdb->get_var("SELECT COUNT(*) FROM {$this->tableName}");

    // Simplified date formatting query
    $subscribers = $this->wpdb->get_results(
      $this->wpdb->prepare(
        "SELECT 
                  id,
                  endpoint,
                  auth_key,
                  p256dh_key,
                  content_encoding,
                  device_name,
                  device_icon,
                  browser_name,
                  browser_icon,
                  country_name,
                  country_icon,
                  user_id,
                  DATE_FORMAT(date, '%b %e, %Y') as date
              FROM {$this->tableName} 
              ORDER BY date DESC 
              LIMIT %d OFFSET %d",
        $per_page,
        $offset
      ),
      ARRAY_A
    );

    return [
      'subscribers' => $subscribers ?: [],
      'total' => $total, // This is already cast to int
      'pages' => $total > 0 ? ceil($total / $per_page) : 1,
    ];
  }

  public function getVapidKeys()
  {
    $keys = get_option($this->optionName . '_vapid_keys');
    if (empty($keys)) {
      $keys = $this->generateVapidKeys();
    }
    return $keys;
  }

  public function addPublicVapidKeyToFrontJs($jsVars)
  {
    $vapidKeys = $this->getVapidKeys();
    if ($vapidKeys) {
      $jsVars['vapidPublicKey'] = $vapidKeys['publicKey'];
    }
    return $jsVars;
  }

  public function addPushJsToServiceWorker($serviceWorker)
  {
    $serviceWorker .=
      "self.addEventListener('push', (event) => {
                          if (event.data) {
                              const notificationData = event.data.json();
                              event.waitUntil(self.registration.showNotification(notificationData.title, notificationData));
                              navigator.setAppBadge(1).catch((error) => {
                                  console.log('Error setting App badge');
                              });
                          } else {
                              console.log('No push data fetched');
                          }
                      });
                      
                      self.addEventListener('notificationclick', (event) => {
                        event.notification.close();
                        switch (event.action) {
                          case 'action1':
                            event.waitUntil(clients.openWindow(event.notification.data.pushActionButton1Url));
                          break;
                          case 'action2':
                            event.waitUntil(clients.openWindow(event.notification.data.pushActionButton2Url));
                          break;
                          default:
                            event.waitUntil(clients.openWindow(event.notification.data.url));
                          break;
                        }
                        navigator.clearAppBadge().catch((error) => {
                          console.log('Error clearing App badge');
                        });
                      });
                      
                      self.addEventListener('pushsubscriptionchange', function(event) {
                        event.waitUntil(
                          fetch('" .
      get_rest_url() .
      "' + '" .
      $this->slug .
      "' + '/updateSubscription', {
                            method: 'PUT',
                            headers: {
                              'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                              oldEndpoint: event.oldSubscription ? event.oldSubscription.endpoint : null,
                              newEndpoint: event.newSubscription ? event.newSubscription.endpoint : null,
                              newAuthKey: event.newSubscription ? event.newSubscription.toJSON().keys.auth : null,
                              newP256dhKey: event.newSubscription ? event.newSubscription.toJSON().keys.p256dh : null,
                            })
                          })
                          .then(response => {
                            if (!response.ok) {
                              throw new Error('Network response was not ok');
                            }
                            return response.json();
                          })
                          .then(data => {
                            if (data.status === 'success') {
                              return subscription;
                            }
                            throw new Error('Subscription updating failed');
                          })
                        );
                      });\n";

    return $serviceWorker;
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
    $endpoint = sanitize_text_field($request->get_param('endpoint'));
    $authKey = sanitize_text_field($request->get_param('authKey'));
    $p256dhKey = sanitize_text_field($request->get_param('p256dhKey'));
    $contentEncoding = sanitize_text_field($request->get_param('contentEncoding'));

    // User Country
    $context = stream_context_create([
      'http' => [
        'timeout' => 2,
      ],
    ]);
    $locationData = @file_get_contents('http://ip-api.com/json/', false, $context);
    $locationData = $locationData ? json_decode($locationData, true) : [];
    if ($locationData && $locationData['status'] === 'success' && isset($locationData['country']) && isset($locationData['countryCode'])) {
      $countryName = $locationData['country'];
      $countryIcon = plugins_url('admin/assets/media/icons/flags/' . $locationData['countryCode'] . '.svg', $this->pluginFile);
    } else {
      $countryName = 'Unknown';
      $countryIcon = plugins_url('admin/assets/media/icons/unknown.png', $this->pluginFile);
    }

    // User OS
    switch (true) {
      case Plugin::isPlatform('android'):
        $deviceName = 'Android';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('ios'):
        $deviceName = 'iOS';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/ios.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('windows'):
        $deviceName = 'Windows';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/windows.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('mac'):
        $deviceName = 'Mac';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('linux'):
        $deviceName = 'Linux';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/linux.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('ubuntu'):
        $deviceName = 'Ubuntu';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/ubuntu.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('freebsd'):
        $deviceName = 'FreeBSD';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/freebsd.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('chromeos'):
        $deviceName = 'Chrome OS';
        $deviceIcon = plugins_url('admin/assets/media/icons/operating-systems/chromeos.png', $this->pluginFile);
        break;
      default:
        $deviceName = 'Unknown';
        $deviceIcon = plugins_url('admin/assets/media/icons/unknown.png', $this->pluginFile);
    }

    // User Browser
    switch (true) {
      case Plugin::isPlatform('chrome'):
        $browserName = 'Chrome';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/chrome.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('safari'):
        $browserName = 'Safari';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/safari.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('firefox'):
        $browserName = 'Firefox';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/firefox.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('opera'):
        $browserName = 'Opera';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/opera.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('edge'):
        $browserName = 'Edge';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/edge.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('samsung'):
        $browserName = 'Samsung Internet';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/samsunginternet.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('duckduckgo'):
        $browserName = 'DuckDuckGo';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/duckduckgo.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('brave'):
        $browserName = 'Brave';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/brave.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('qq'):
        $browserName = 'QQ Browser';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/qq.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('uc'):
        $browserName = 'UC Browser';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/uc.png', $this->pluginFile);
        break;
      case Plugin::isPlatform('yandex'):
        $browserName = 'Yandex Browser';
        $browserIcon = plugins_url('admin/assets/media/icons/browsers/yandex.png', $this->pluginFile);
        break;
      default:
        $browserName = 'Unknown';
        $browserIcon = plugins_url('admin/assets/media/icons/unknown.png', $this->pluginFile);
    }

    // User ID
    $userId = get_current_user_id() ?: null;

    // Date
    $date = current_time('mysql');

    $data = [
      'endpoint' => $endpoint,
      'auth_key' => $authKey,
      'p256dh_key' => $p256dhKey,
      'content_encoding' => $contentEncoding,
      'device_name' => $deviceName,
      'device_icon' => $deviceIcon,
      'browser_name' => $browserName,
      'browser_icon' => $browserIcon,
      'country_name' => $countryName,
      'country_icon' => $countryIcon,
      'user_id' => $userId,
      'date' => $date,
    ];

    $formats = [
      '%s', // endpoint
      '%s', // auth_key
      '%s', // p256dh_key
      '%s', // content_encoding
      '%s', // device_name
      '%s', // device_icon
      '%s', // browser_name
      '%s', // browser_icon
      '%s', // country_name
      '%s', // country_icon
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
      switch (true) {
        // Changed to true for string pattern matching
        case $to === 'everyone':
          $subscribers = $this->wpdb->get_results("SELECT * FROM {$this->tableName}", ARRAY_A);
          break;
        case is_numeric($to):
          $subscribers = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM {$this->tableName} WHERE user_id = %d", $to), ARRAY_A);
          break;
        case is_array($to):
          $placeholders = array_fill(0, count($to), '%d');
          $placeholders = implode(',', $placeholders);
          $subscribers = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM {$this->tableName} WHERE user_id IN ($placeholders)", $to), ARRAY_A);
          break;
        default:
          return ['error' => 'Invalid target specified'];
      }

      if (empty($subscribers)) {
        return ['error' => 'No subscribers found for the specified target'];
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
          // If failed due to expired subscription, remove it
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
