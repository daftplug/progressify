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

    register_activation_hook($this->pluginFile, [$this, 'createSubscribersTable']);
    register_activation_hook($this->pluginFile, [$this, 'generateVapidKeys']);
    add_action('rest_api_init', [$this, 'registerRoutes']);
    add_filter("{$this->optionName}_frontend_js_vars", [$this, 'addPublicVapidKeyToFrontJs']);
    add_filter("{$this->optionName}_serviceworker", [$this, 'addPushJsToServiceWorker']);
    add_action("wp_ajax_{$this->optionName}_fetch_push_notifications_subscribers", [$this, 'fetchPushNotificationsSubscribers']);
    add_action('transition_post_status', [$this, 'doNewContentPush'], 10, 3);
    add_action('save_post', [$this, 'doWooPriceStockPush'], 10, 2);
    add_filter('wp_insert_post_data', [$this, 'filterWoocommercePostData'], 10, 2);
    add_action('woocommerce_order_status_changed', [$this, 'doWooOrderStatusUpdatePush'], 10, 4);
    add_action('comment_post', [$this, 'doNewCommentPush'], 10, 2);
    add_action('woocommerce_new_order', [$this, 'doWooNewOrderPush']);
    add_action('woocommerce_thankyou', [$this, 'doWooLowStockPush']);
    add_action('bp_activity_sent_mention_email', [$this, 'doBpMemberMentionPush'], 10, 5);
    add_action('bp_activity_sent_reply_to_update_notification', [$this, 'doBpMemberCommentPush'], 10, 4);
    add_action('bp_activity_sent_reply_to_reply_notification', [$this, 'doBpMemberReplyPush'], 10, 4);
    add_action('messages_message_sent', [$this, 'doBpNewMessagePush'], 10, 1);
    add_action('friends_friendship_requested', [$this, 'doBpFriendRequestPush'], 1, 4);
    add_action('friends_friendship_accepted', [$this, 'doBpFriendAcceptedPush'], 1, 4);
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

    register_rest_route($this->slug, '/doModalPushNotification', [
      'methods' => 'POST',
      'callback' => [$this, 'doModalPushNotification'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);
  }

  public function createSubscribersTable()
  {
    $charset_collate = $this->wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $this->tableName (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      endpoint varchar(500) NOT NULL,
      auth_key varchar(255) NOT NULL,
      p256dh_key varchar(255) NOT NULL,
      content_encoding varchar(50) NULL,
      country_name varchar(100) NULL,
      country_icon varchar(255) NULL,
      device_name varchar(100) NULL,
      device_icon varchar(255) NULL,
      os_name varchar(100) NULL,
      os_icon varchar(255) NULL,
      browser_name varchar(100) NULL,
      browser_icon varchar(255) NULL,
      wp_user_id bigint(20) NULL,
      date datetime DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (id),
      UNIQUE KEY unique_endpoint (endpoint(191)),
      KEY wp_user_id (wp_user_id)
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
                  country_name,
                  country_icon,
                  device_name,
                  device_icon,
                  os_name,
                  os_icon,
                  browser_name,
                  browser_icon,
                  wp_user_id,
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
                          case 'action0':
                            event.waitUntil(clients.openWindow(event.notification.data.pushActionButton0Url));
                          break;
                          case 'action1':
                            event.waitUntil(clients.openWindow(event.notification.data.pushActionButton1Url));
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
    $userData = Plugin::getUserData();

    $data = [
      'endpoint' => $endpoint,
      'auth_key' => $authKey,
      'p256dh_key' => $p256dhKey,
      'content_encoding' => $contentEncoding,
      'country_name' => $userData['country']['name'],
      'country_icon' => $userData['country']['icon'],
      'device_name' => $userData['device']['name'],
      'device_icon' => $userData['device']['icon'],
      'os_name' => $userData['os']['name'],
      'os_icon' => $userData['os']['icon'],
      'browser_name' => $userData['browser']['name'],
      'browser_icon' => $userData['browser']['icon'],
      'wp_user_id' => get_current_user_id() ?: null,
      'date' => current_time('mysql'),
    ];

    $formats = [
      '%s', // endpoint
      '%s', // auth_key
      '%s', // p256dh_key
      '%s', // content_encoding
      '%s', // country_name
      '%s', // country_icon
      '%s', // device_name
      '%s', // device_icon
      '%s', // os_name
      '%s', // os_icon
      '%s', // browser_name
      '%s', // browser_icon
      '%d', // wp_user_id
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

  public function sendPushNotification($to = 'everyone', $notificationData = [])
  {
    try {
      $webPush = $this->setupWebPush();

      // Default notification data
      $notificationData = wp_parse_args($notificationData, [
        'title' => '',
        'badge' => '',
        'body' => '',
        'icon' => esc_url_raw(@wp_get_attachment_image_src(Plugin::getSetting('webAppManifest[appIdentity][appIcon]'), [150, 150])[0] ?? ''),
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
          $subscribers = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM {$this->tableName} WHERE wp_user_id = %d", $to), ARRAY_A);
          break;
        case is_array($to):
          $placeholders = array_fill(0, count($to), '%d');
          $placeholders = implode(',', $placeholders);
          $subscribers = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM {$this->tableName} WHERE wp_user_id IN ($placeholders)", $to), ARRAY_A);
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
          $this->wpdb->delete($this->tableName, ['endpoint' => $endpoint], ['%s']);

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

  public function doModalPushNotification(\WP_REST_Request $request)
  {
    if (!wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest')) {
      return new \WP_Error('invalid_nonce', 'Invalid nonce', ['status' => 403]);
    }

    $notificationData = $request->get_param('notificationData');
    if (empty($notificationData)) {
      return new \WP_Error('invalid_data', 'Invalid notification data', ['status' => 400]);
    }

    $pushNotificationData = [
      'image' => !empty($notificationData['image']) ? wp_get_attachment_url($notificationData['image']) : '',
      'title' => sanitize_text_field($notificationData['title']),
      'body' => sanitize_textarea_field($notificationData['message']),
      'data' => [
        'url' => esc_url_raw($notificationData['url']),
      ],
      'requireInteraction' => $notificationData['persistent'] === 'on',
      'vibrate' => $notificationData['vibration'] === 'on' ? [200, 100, 200] : [],
      'actions' => [],
    ];

    // Handle action buttons
    if (!empty($notificationData['actionButtons'])) {
      foreach ($notificationData['actionButtons'] as $index => $button) {
        if (!empty($button['text']) && !empty($button['url'])) {
          $actionId = 'action' . $index;
          $pushNotificationData['actions'][] = [
            'action' => $actionId,
            'title' => sanitize_text_field($button['text']),
          ];
          $pushNotificationData['data']["pushActionButton{$index}Url"] = esc_url_raw($button['url']);
        }
      }
    }

    $sentReport = $this->sendPushNotification('everyone', $pushNotificationData);

    // Process the report
    $sent = 0;
    $failed = 0;

    if (is_array($sentReport)) {
      foreach ($sentReport as $report) {
        if ($report['status'] === 'success') {
          $sent++;
        } else {
          $failed++;
        }
      }

      return new \WP_REST_Response(
        [
          'status' => '1',
          'message' => sprintf(esc_html__('The notification was sent to %d out of %d recipients, with %d failure.', $this->textDomain), $sent, $sent + $failed, $failed),
        ],
        200
      );
    }

    // Handle error case
    return new \WP_Error('sending_failed', $sentReport['message'] ?? esc_html__('Sending failed. There was an error on server.', $this->textDomain), ['status' => 500]);
  }

  public function doNewContentPush($new_status, $old_status, $post)
  {
    if ($new_status !== 'publish' || $old_status === 'publish' || Plugin::getSetting('pushNotifications[automation][feature]') != 'on' || !Plugin::getSetting('pushNotifications[automation][wordpress][newContent][feature]') == 'on' || !in_array($post->post_type, (array) Plugin::getSetting('pushNotifications[automation][wordpress][newContent][postTypes]'))) {
      return;
    }

    $postTypeLabel = 'Post';

    if ($post->post_type === 'product' && Plugin::isPluginActive('woocommerce')) {
      $postTypeLabel = 'Product';
    } else {
      $postTypeObject = get_post_type_object($post->post_type);
      if ($postTypeObject && !empty($postTypeObject->labels->singular_name)) {
        $postTypeLabel = $postTypeObject->labels->singular_name;
      }
    }

    $notificationData = [
      'title' => sprintf(__('New %s - %s', $this->textDomain), $postTypeLabel, $post->post_title),
      'body' => substr(strip_tags($post->post_content), 0, 77) . '...',
      'data' => ['url' => trailingslashit(get_permalink($post->ID))],
    ];

    if (has_post_thumbnail($post->ID)) {
      $notificationData['image'] = get_the_post_thumbnail_url($post->ID);
    }

    $this->sendPushNotification('everyone', $notificationData);
  }

  public function doWooPriceStockPush($id, $post)
  {
    $isAutosave = (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || wp_is_post_autosave($id);
    $isRevision = wp_is_post_revision($id);
    $isNotPublished = $post->post_status != 'publish';

    if (!Plugin::isPluginActive('woocommerce') || Plugin::getSetting('pushNotifications[automation][feature]') != 'on' || $isNotPublished || $isAutosave || $isRevision) {
      return;
    }

    $wooNotifications = [
      'priceDrop' => [
        'condition' => get_transient($this->optionName . '_dropped_price'),
        'title' => sprintf(__('Price Drop - %s', $this->textDomain), $post->post_title),
        'body' => sprintf(__('Price dropped from %s to %s', $this->textDomain), get_transient($this->optionName . '_regular_price'), get_transient($this->optionName . '_dropped_price')),
      ],
      'salePrice' => [
        'condition' => get_transient($this->optionName . '_sale_price'),
        'title' => sprintf(__('New Sale Price - %s', $this->textDomain), $post->post_title),
        'body' => sprintf(__('New Sale Price: %s', $this->textDomain), get_transient($this->optionName . '_sale_price')),
      ],
      'backInStock' => [
        'condition' => get_transient($this->optionName . '_back_in_stock'),
        'title' => sprintf(__('Back In Stock - %s', $this->textDomain), $post->post_title),
        'body' => sprintf(__('%s is now back in stock', $this->textDomain), $post->post_title),
      ],
    ];

    foreach ($wooNotifications as $type => $notification) {
      if (Plugin::getSetting("pushNotifications[automation][woocommerce][$type]") == 'on' && $notification['condition']) {
        $notificationData = [
          'title' => $notification['title'],
          'body' => $notification['body'],
          'data' => ['url' => trailingslashit(get_permalink($id))],
        ];

        if (has_post_thumbnail($id)) {
          $notificationData['image'] = get_the_post_thumbnail_url($id);
        }

        $this->sendPushNotification('everyone', $notificationData);
      }
    }
  }

  public function filterWoocommercePostData($data, $postArr)
  {
    global $post;

    if (!Plugin::isPluginActive('woocommerce') || !$post || $post->post_type != 'product') {
      return $data;
    }

    $wooCurrency = html_entity_decode(get_woocommerce_currency_symbol(get_option('woocommerce_currency')) ?? '$', ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $priceFormat = str_replace('&nbsp;', ' ', get_woocommerce_price_format() ?? '%1$s%2$s');
    $oldSalePrice = get_post_meta($post->ID, '_sale_price', true);
    $newSalePrice = $postArr['_sale_price'];
    $oldRegularPrice = get_post_meta($post->ID, '_regular_price', true);
    $newRegularPrice = $postArr['_regular_price'];
    $oldStock = get_post_meta($post->ID, '_stock', true);
    $newStock = $postArr['_stock'];

    // Format prices with decoded currency
    if ($oldRegularPrice) {
      set_transient($this->optionName . '_regular_price', html_entity_decode(sprintf($priceFormat, $wooCurrency, $oldRegularPrice), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 5);
    } else {
      set_transient($this->optionName . '_regular_price', html_entity_decode(sprintf($priceFormat, $wooCurrency, $newRegularPrice), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 5);
    }

    if ((!$oldSalePrice && $newSalePrice) || ($oldSalePrice > $newSalePrice && $newSalePrice != 0)) {
      set_transient($this->optionName . '_sale_price', html_entity_decode(sprintf($priceFormat, $wooCurrency, $newSalePrice), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 5);
    }

    if ($newRegularPrice < $oldRegularPrice) {
      set_transient($this->optionName . '_dropped_price', html_entity_decode(sprintf($priceFormat, $wooCurrency, $newRegularPrice), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 5);
    }

    if ($oldStock == 0 && $newStock > 0) {
      set_transient($this->optionName . '_back_in_stock', true, 5);
    }

    return $data;
  }

  public function doWooOrderStatusUpdatePush($orderId, $oldStatus, $newStatus, $order)
  {
    if (!Plugin::isPluginActive('woocommerce') || Plugin::getSetting('pushNotifications[automation][woocommerce][orderStatusUpdate][feature]') != 'on' || $oldStatus == $newStatus) {
      return;
    }

    $notificationData = [
      'title' => __('Your Order Status Updated', $this->textDomain),
      'body' => sprintf(__('Your order (ID %s) status has updated from %s to %s. Click on this notification to see the order.', $this->textDomain), $orderId, $oldStatus, $newStatus),
      'data' => [
        'url' => trailingslashit($order->get_view_order_url()),
      ],
    ];

    $this->sendPushNotification($order->get_user_id(), $notificationData);
  }

  public function doNewCommentPush($commentId, $commentApproved)
  {
    if (!Plugin::isWpCommentsEnabled() || Plugin::getSetting('pushNotifications[automation][wordpress][newComment]') != 'on' || !$commentApproved) {
      return;
    }

    $comment = get_comment($commentId);

    if (!$comment) {
      return;
    }

    // Get only the necessary fields and user IDs to optimize query
    $allComments = get_comments([
      'post_id' => $comment->comment_post_ID,
      'status' => 'approve',
      'fields' => 'ids',
      'user_id__not_in' => [$comment->user_id],
    ]);

    if (empty($allComments)) {
      return;
    }

    $authorsIds = array_unique(
      array_filter(
        array_map(function ($commentId) {
          $comment = get_comment($commentId);
          return $comment ? $comment->user_id : null;
        }, $allComments)
      )
    );

    if (empty($authorsIds)) {
      return;
    }

    $commentContent = wp_trim_words($comment->comment_content, 20, '...');

    $notificationData = [
      'title' => sprintf(__('New Comment By %s', $this->textDomain), $comment->comment_author),
      'body' => $commentContent,
      'icon' => get_avatar_url($comment->user_id),
      'data' => [
        'url' => get_permalink($comment->comment_post_ID),
      ],
      'tag' => 'comment_' . $comment->comment_post_ID,
    ];

    $this->sendPushNotification($authorsIds, $notificationData);
  }

  public function doWooNewOrderPush($orderId)
  {
    if (!Plugin::isPluginActive('woocommerce') || Plugin::getSetting('pushNotifications[automation][woocommerce][newOrder][feature]') != 'on' || !$orderId) {
      return;
    }

    $admin_users = get_users([
      'role__in' => ['administrator', 'shop_manager'],
      'fields' => 'ID',
    ]);

    if (empty($admin_users)) {
      return;
    }

    $order = wc_get_order($orderId);

    if (!$order) {
      return;
    }

    $wooCurrency = html_entity_decode(get_woocommerce_currency_symbol($order->get_currency()) ?? '$', ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $items_count = $order->get_item_count();
    $customer_name = $order->get_formatted_billing_full_name();

    $notificationData = [
      'title' => sprintf(__('New Order #%s', $this->textDomain), $order->get_order_number()),
      'body' => sprintf(__('New order from %s for %s%s (%d items)', $this->textDomain), $customer_name, $wooCurrency, $order->get_total(), $items_count),
      'data' => [
        'url' => $order->get_edit_order_url(),
      ],
      'tag' => 'new_order_' . $orderId,
      'requireInteraction' => true,
    ];

    $this->sendPushNotification($admin_users, $notificationData);
  }

  public function doWooLowStockPush($orderId)
  {
    if (!Plugin::isPluginActive('woocommerce') || Plugin::getSetting('pushNotifications[automation][woocommerce][lowStock][feature]') != 'on' || !$orderId) {
      return;
    }

    $admin_users = get_users([
      'role__in' => ['administrator', 'shop_manager'],
      'fields' => 'ID',
    ]);

    if (empty($admin_users)) {
      return;
    }

    $order = wc_get_order($orderId);
    if (!$order) {
      return;
    }

    $items = $order->get_items();
    if (empty($items)) {
      return;
    }

    $default_threshold = get_option('woocommerce_notify_low_stock_amount', 2);
    $low_stock_items = [];

    foreach ($items as $item) {
      $product = $item->get_product();
      if (!$product || !$product->managing_stock()) {
        continue;
      }

      $product_id = $product->get_id();
      $stock = $product->get_stock_quantity();

      // Skip if stock is not numeric (like when stock management is disabled)
      if (!is_numeric($stock)) {
        continue;
      }

      $low_stock_threshold = $product->get_low_stock_amount() ?: $default_threshold;

      if ($stock <= $low_stock_threshold) {
        $low_stock_items[] = [
          'name' => $product->get_name(),
          'stock' => $stock,
          'threshold' => $low_stock_threshold,
          'url' => $product->get_edit_product_url(),
          'sku' => $product->get_sku(),
        ];
      }
    }

    foreach ($low_stock_items as $item) {
      $notificationData = [
        'title' => sprintf(__('Low Stock Alert: %s', $this->textDomain), $item['name']),
        'body' => sprintf(__('Stock level: %d (Threshold: %d)%s. SKU: %s', $this->textDomain), $item['stock'], $item['threshold'], $item['stock'] === 0 ? ' - OUT OF STOCK' : '', $item['sku'] ?: 'N/A'),
        'data' => [
          'url' => $item['url'],
        ],
        'tag' => 'low_stock_' . $item['sku'],
        'requireInteraction' => true,
      ];

      $this->sendPushNotification($admin_users, $notificationData);
    }
  }

  public function doBpMemberMentionPush($activity, $subject, $message, $content, $receiverUserId)
  {
    if (!Plugin::isPluginActive('buddypress') || Plugin::getSetting('pushNotifications[automation][buddypress][memberMention][feature]') != 'on' || !$activity) {
      return;
    }

    $currentUser = get_userdata($activity->user_id);
    $friendDetail = get_userdata($receiverUserId);

    if (!$currentUser || !$friendDetail) {
      return;
    }

    $body = sprintf(__('%s has just mentioned you in a %s', $this->textDomain), $currentUser->display_name, $activity->type == 'activity_comment' ? 'comment' : 'update');

    $notificationData = [
      'title' => sprintf(__('New mention from %s', $this->textDomain), $currentUser->display_name),
      'body' => $body,
      'data' => [
        'url' => get_permalink(get_option('bp-pages')['members']) . $friendDetail->user_nicename . '/activity/mentions/',
      ],
    ];

    $this->sendPushNotification($receiverUserId, $notificationData);
  }

  public function doBpMemberCommentPush($activity, $commentId, $commenterId, $params)
  {
    if (!Plugin::isPluginActive('buddypress') || Plugin::getSetting('pushNotifications[automation][buddypress][memberReply][feature]') != 'on' || !$activity) {
      return;
    }

    $currentUser = get_userdata($commenterId);
    $receiverDetail = get_userdata($activity->user_id);

    if (!$currentUser || !$receiverDetail) {
      return;
    }

    $notificationData = [
      'title' => sprintf(__('New comment from %s', $this->textDomain), $currentUser->display_name),
      'body' => sprintf(__('%s has just commented on your post.', $this->textDomain), $currentUser->display_name),
      'data' => [
        'url' => get_permalink(get_option('bp-pages')['members']) . $receiverDetail->user_nicename . '/activity/' . $activity->id . '/#acomment-' . $commentId,
      ],
    ];

    $this->sendPushNotification($activity->user_id, $notificationData);
  }

  public function doBpMemberReplyPush($activity, $commentId, $commenterId, $params)
  {
    if (!Plugin::isPluginActive('buddypress') || Plugin::getSetting('pushNotifications[automation][buddypress][memberReply][feature]') != 'on' || !$activity) {
      return;
    }

    $currentUser = get_userdata($commenterId);
    $receiverDetail = get_userdata($activity->user_id);

    if (!$currentUser || !$receiverDetail) {
      return;
    }

    $notificationData = [
      'title' => sprintf(__('New reply from %s', $this->textDomain), $currentUser->display_name),
      'body' => sprintf(__('%s has just replied to you.', $this->textDomain), $currentUser->display_name),
      'data' => [
        'url' => get_permalink(get_option('bp-pages')['activity']) . 'p/' . $activity->item_id . '/#acomment-' . $commentId,
      ],
    ];

    $this->sendPushNotification($activity->user_id, $notificationData);
  }

  public function doBpNewMessagePush($params)
  {
    if (!Plugin::isPluginActive('buddypress') || Plugin::getSetting('pushNotifications[automation][buddypress][newMessage][feature]') != 'on' || !$params) {
      return;
    }

    $senderDetail = get_userdata($params->sender_id);
    if (!$senderDetail) {
      return;
    }

    foreach ($params->recipients as $recipient) {
      $recipientDetail = get_userdata($recipient->user_id);
      if (!$recipientDetail) {
        continue;
      }

      $notificationData = [
        'title' => sprintf(__('New message from %s', $this->textDomain), $senderDetail->display_name),
        'body' => wp_trim_words(wp_strip_all_tags($params->message), 20, '...'),
        'data' => [
          'url' => get_permalink(get_option('bp-pages')['members']) . $recipientDetail->user_nicename . '/messages/view/' . $params->thread_id,
        ],
        'tag' => 'bp_message_' . $params->thread_id, // Group notifications by thread
      ];

      $this->sendPushNotification($recipient->user_id, $notificationData);
    }
  }

  public function doBpFriendRequestPush($id, $userId, $friendId, $friendship)
  {
    if (!Plugin::isPluginActive('buddypress') || Plugin::getSetting('pushNotifications[automation][buddypress][friendRequest][feature]') != 'on') {
      return;
    }

    $friendDetail = get_userdata($friendId);
    $currentUser = get_userdata($userId);

    if (!$friendDetail || !$currentUser) {
      return;
    }

    $notificationData = [
      'title' => sprintf(__('New friend request from %s', $this->textDomain), $currentUser->display_name),
      'body' => sprintf(__('%s has just sent you a friend request.', $this->textDomain), $currentUser->display_name),
      'data' => [
        'url' => get_permalink(get_option('bp-pages')['members']) . $friendDetail->user_nicename . '/friends/requests/?new',
      ],
      'tag' => 'bp_friend_request_' . $userId, // Group notifications by sender
      'renotify' => true, // Ensure notification shows even if there's an existing one
    ];

    $this->sendPushNotification($friendId, $notificationData);
  }

  public function doBpFriendAcceptedPush($id, $userId, $friendId, $friendship)
  {
    if (!Plugin::isPluginActive('buddypress') || Plugin::getSetting('pushNotifications[automation][buddypress][friendAccepted][feature]') != 'on') {
      return;
    }

    $friendDetail = get_userdata($userId);
    $currentUser = get_userdata($friendId);

    if (!$friendDetail || !$currentUser) {
      return;
    }

    $notificationData = [
      'title' => sprintf(__('Friend request accepted', $this->textDomain)),
      'body' => sprintf(__('%s has just accepted your friend request.', $this->textDomain), $currentUser->display_name),
      'data' => [
        'url' => get_permalink(get_option('bp-pages')['members']) . $friendDetail->user_nicename . '/friends',
      ],
      'tag' => 'bp_friend_accepted_' . $friendId, // Group notifications by accepter
      'renotify' => true,
    ];

    $this->sendPushNotification($userId, $notificationData);
  }
}