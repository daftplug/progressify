<?php

namespace DaftPlug;

if (!defined('ABSPATH')) {
  exit();
}
if (!class_exists('ProgressifyPushNotifications')) {
  class ProgressifyPushNotifications
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
    public $menuTitle;
    public $menuIcon;
    public $menuId;
    protected $dependencies;
    public $purchaseCode;
    public $capability;
    public $settings;

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
      $this->pluginDirPath = $config['plugin_dir_path'];
      $this->pluginUploadDir = $config['plugin_upload_dir'];
      $this->menuTitle = $config['menu_title'];
      $this->menuIcon = $config['menu_icon'];
      $this->dependencies = [];
      $this->purchaseCode = get_option("{$this->optionName}_purchase_code");
      $this->capability = 'manage_options';
      $this->settings = $config['settings'];

      add_action('wp_ajax_' . self::$optionName . '_send_notification', [$this, 'doModalPush']);
      add_action('wp_ajax_' . self::$optionName . '_handle_scheduled_notification', [$this, 'handleScheduledNotification']);
      add_action('wp_ajax_' . self::$optionName . '_get_subscriber_analytics', [$this, 'getSubscriberAnalytics']);
      add_action('wp_ajax_' . self::$optionName . '_get_subscriber_stats', [$this, 'getSubscriberStats']);
      add_action('wp_ajax_' . self::$optionName . '_get_all_subscribers', [$this, 'getAllSubscribers']);
      add_filter(self::$optionName . '_pwa_serviceworker', [$this, 'addPushToServiceWorker']);
      add_filter(self::$optionName . '_public_js_vars', [$this, 'addPushJsVars']);
      add_action('wp_ajax_' . self::$optionName . '_handle_subscription', [$this, 'handleSubscription']);
      add_action('wp_ajax_nopriv_' . self::$optionName . '_handle_subscription', [$this, 'handleSubscription']);
      add_action('wp_ajax_' . self::$optionName . '_handle_subscription_update', [$this, 'handleSubscriptionUpdate']);
      add_action('wp_ajax_nopriv_' . self::$optionName . '_handle_subscription_update', [$this, 'handleSubscriptionUpdate']);
      add_action('add_meta_boxes', [$this, 'addMetaBoxes'], 10, 2);

      if (daftplugInstantify::getSetting('pwaPushNewComment') == 'on') {
        add_action('comment_post', [$this, 'doNewCommentPush'], 10, 2);
      }

      if (daftplugInstantify::isWooCommerceActive()) {
        if (daftplugInstantify::getSetting('pwaPushWooNewOrder') == 'on') {
          add_action('woocommerce_new_order', [$this, 'doWooNewOrderPush']);
        }
        if (daftplugInstantify::getSetting('pwaPushWooLowStock') == 'on') {
          add_action('woocommerce_thankyou', [$this, 'doWooLowStockPush']);
        }
        if (daftplugInstantify::getSetting('pwaPushWooAbandonedCart') == 'on') {
          add_action('wp', [$this, 'doWooAbandonedCartPush']);
        }
      }

      if (daftplugInstantify::isBuddyPressActive()) {
        if (daftplugInstantify::getSetting('pwaPushBpMemberMention') == 'on') {
          add_action('bp_activity_sent_mention_email', [$this, 'doBpMemberMentionPush'], 10, 5);
        }
        if (daftplugInstantify::getSetting('pwaPushBpMemberReply') == 'on') {
          add_action('bp_activity_sent_reply_to_update_notification', [$this, 'doBpMemberCommentPush'], 10, 4);
          add_action('bp_activity_sent_reply_to_reply_notification', [$this, 'doBpMemberReplyPush'], 10, 4);
        }
        if (daftplugInstantify::getSetting('pwaPushBpNewMessage') == 'on') {
          add_action('messages_message_sent', [$this, 'doBpNewMessagePush'], 10, 1);
        }
        if (daftplugInstantify::getSetting('pwaPushBpFriendRequest') == 'on') {
          add_action('friends_friendship_requested', [$this, 'doBpFriendRequestPush'], 1, 4);
        }
        if (daftplugInstantify::getSetting('pwaPushBpFriendAccepted') == 'on') {
          add_action('friends_friendship_accepted', [$this, 'doBpFriendAcceptedPush'], 1, 4);
        }
      }

      if (daftplugInstantify::isPeepsoActive()) {
        if (daftplugInstantify::getSetting('pwaPushPeepsoNotifications') == 'on') {
          add_filter('peepso_notifications_data_before_add', [$this, 'doPeepsoNotification'], 99);
        }
      }

      if (daftplugInstantify::isUltimateMemberActive() && daftplugInstantify::isUltimateMemberActive('um-notifications')) {
        if (daftplugInstantify::getSetting('pwaPushUmNewComment') == 'on' || daftplugInstantify::getSetting('pwaPushUmGuestComment') == 'on' || daftplugInstantify::getSetting('pwaPushUmCommentReply') == 'on') {
          add_action('comment_post', [$this, 'doUmCommentReplyPush'], 10, 2);
        }
        if (daftplugInstantify::getSetting('pwaPushUmProfileView') == 'on' || daftplugInstantify::getSetting('pwaPushUmGuestProfileView') == 'on') {
          add_action('wp_head', [$this, 'doUmProfileViewsPush'], 100);
        }
        if (daftplugInstantify::isUltimateMemberActive('um-messaging') && daftplugInstantify::getSetting('pwaPushUmPrivateMessage') == 'on') {
          add_action('um_after_new_message', [$this, 'doUmPrivateMessagePush'], 50, 4);
        }
        if (daftplugInstantify::isUltimateMemberActive('um-followers') && daftplugInstantify::getSetting('pwaPushUmNewFollow') == 'on') {
          add_action('um_followers_after_user_follow', [$this, 'doUmNewFollowPush'], 10, 2);
        }
        if (daftplugInstantify::isUltimateMemberActive('um-friends')) {
          if (daftplugInstantify::getSetting('pwaPushUmFriendRequest') == 'on') {
            add_action('um_friends_after_user_friend_request', [$this, 'doUmFriendRequestPush'], 10, 2);
          }
          if (daftplugInstantify::getSetting('pwaPushUmFriendRequestAccepted') == 'on') {
            add_action('um_friends_after_user_friend', [$this, 'doUmFriendRequestAcceptedPush'], 10, 2);
          }
        }
        if (daftplugInstantify::isUltimateMemberActive('um-social-activity')) {
          if (daftplugInstantify::getSetting('pwaPushUmWallPost') == 'on') {
            add_action('um_activity_after_wall_post_published', [$this, 'doUmWallPostPush'], 90, 3);
          }
          if (daftplugInstantify::getSetting('pwaPushUmWallComment') == 'on') {
            add_action('um_notification_activity_comment', [$this, 'doUmWallCommentPush'], 90, 4);
          }
          if (daftplugInstantify::getSetting('pwaPushUmPostLike') == 'on') {
            add_action('um_activity_after_wall_post_liked', [$this, 'doUmPostLikePush'], 90, 2);
          }
          if (daftplugInstantify::getSetting('pwaPushUmNewMention') == 'on') {
            add_action('um_followers_new_mention', [$this, 'doUmNewMentionPush'], 10, 3);
            add_action('um_following_new_mention', [$this, 'doUmNewMentionPush'], 10, 3);
            add_action('um_friends_new_mention', [$this, 'doUmNewMentionPush'], 10, 3);
          }
        }
        if (daftplugInstantify::isUltimateMemberActive('um-groups')) {
          if (daftplugInstantify::getSetting('pwaPushUmGroupApprove') == 'on') {
            add_action('um_groups_after_member_changed_status__approved', [$this, 'doUmGroupApprovePush'], 1, 5);
            add_action('um_groups_after_member_changed_status__hidden_approved', [$this, 'doUmGroupApprovePush'], 1, 5);
          }
          if (daftplugInstantify::getSetting('pwaPushUmGroupJoinRequest') == 'on') {
            add_action('um_groups_after_member_changed_status__pending_admin_review', [$this, 'doUmGroupJoinRequestPush'], 1, 3);
          }
          if (daftplugInstantify::getSetting('pwaPushUmGroupInvitation') == 'on') {
            add_action('um_groups_after_member_changed_status__pending_member_review', [$this, 'doUmGroupInvitationPush'], 1, 3);
          }
          if (daftplugInstantify::getSetting('pwaPushUmGroupRoleChange') == 'on') {
            add_action('um_groups_after_member_changed_role', [$this, 'doUmGroupRoleChangePush'], 1, 4);
          }
          if (daftplugInstantify::getSetting('pwaPushUmGroupPost') == 'on') {
            add_action('um_groups_after_wall_post_published', [$this, 'doUmGroupPostPush'], 55, 3);
          }
          if (daftplugInstantify::getSetting('pwaPushUmGroupComment') == 'on') {
            add_action('um_groups_after_wall_comment_published', [$this, 'doUmGroupCommentPush'], 55, 4);
          }
        }
      }

      add_action(self::$optionName . '_send_scheduled_notification', [$this, 'sendScheduledNotification'], 10, 1);

      if (daftplugInstantify::getSetting('pwaPushButton') == 'on') {
        add_filter(self::$optionName . '_public_html', [$this, 'renderPushButton']);
      }

      if (daftplugInstantify::getSetting('pwaPushPrompt') == 'on') {
        add_filter(self::$optionName . '_public_html', [$this, 'renderPushPrompt']);
      }

      if (daftplugInstantify::isWooCommerceActive()) {
        add_filter('wp_insert_post_data', [$this, 'filterWooCommercePostData'], 10, 2);
        if (daftplugInstantify::getSetting('pwaPushWooOrderStatusUpdate') == 'on') {
          add_action('woocommerce_order_status_changed', [$this, 'doWooOrderStatusUpdatePush'], 10, 4);
        }
      }
      if (daftplugInstantify::isUltimateMemberActive() && daftplugInstantify::isUltimateMemberActive('um-notifications')) {
        if (daftplugInstantify::getSetting('pwaPushUmRoleUpdate') == 'on') {
          add_action('um_after_member_role_upgrade', [$this, 'doUmRoleUpdatePush'], 10, 3);
        }
      }
      add_action('save_post', [$this, 'doAutoPush'], 10, 2);

      foreach (self::$subscribedDevices as $key => $value) {
        if (!array_key_exists('endpoint', self::$subscribedDevices[$key])) {
          unset(self::$subscribedDevices[$key]);
        }
      }

      update_option(self::$optionName . '_subscribed_devices', self::$subscribedDevices);
    }

    public function doModalPush()
    {
      $notificationData = json_decode(stripslashes($_POST['notificationData']), true);
      $nonce = $_POST['nonce'];
      $pushData = [
        'title' => !empty($notificationData['pushTitle']) ? $notificationData['pushTitle'] : '',
        'body' => !empty($notificationData['pushBody']) ? $notificationData['pushBody'] : '',
        'image' => !empty($notificationData['pushImage']) ? esc_url_raw(wp_get_attachment_image_src($notificationData['pushImage'], 'full')[0] ?? '') : '',
        'icon' => !empty($notificationData['pushIcon']) ? esc_url_raw(wp_get_attachment_image_src($notificationData['pushIcon'], 'full')[0] ?? '') : '',
        'data' => [
          'url' => !empty($notificationData['pushUrl']) ? trailingslashit(esc_url_raw($notificationData['pushUrl'])) . '?utm_source=pwa-notification' : '',
        ],
        'requireInteraction' => $notificationData['pushFixed'] == 'on' ? true : false,
        'vibrate' => $notificationData['pushVibrate'] == 'on' ? [200, 100, 200] : [],
      ];

      if ($notificationData['pushActionButton1'] == 'on') {
        $pushData['actions'][] = ['action' => 'action1', 'title' => $notificationData['pushActionButton1Text']];
        $pushData['data']['pushActionButton1Url'] = trailingslashit(esc_url_raw($notificationData['pushActionButton1Url']));
      }

      if ($notificationData['pushActionButton2'] == 'on') {
        $pushData['actions'][] = ['action' => 'action2', 'title' => $notificationData['pushActionButton2Text']];
        $pushData['data']['pushActionButton2Url'] = trailingslashit(esc_url_raw($notificationData['pushActionButton2Url']));
      }

      $segment = $notificationData['pushSegment'];

      if (wp_verify_nonce($nonce, self::$optionName . '_send_notification_nonce')) {
        if ($notificationData['pushScheduled'] == 'on') {
          $userTimezone = (get_option('gmt_offset') > 0 ? '+' : '-') . get_option('gmt_offset');
          $dateTime = strtotime($notificationData['pushScheduledDatetime'] . ' ' . $userTimezone);
          $scheduleNotification = wp_schedule_single_event($dateTime, self::$optionName . '_send_scheduled_notification', ['notificationData' => $notificationData]);
          if ($scheduleNotification) {
            set_transient(self::$optionName . '_send_scheduled_notification_date_' . $dateTime, $dateTime - time(), $dateTime - time());
            htmlspecialchars(
              wp_send_json_success(
                [
                  'scheduled' => true,
                  'message' => esc_html__('Notification scheduled successfully', self::$textDomain),
                  'date' => get_date_from_gmt(date('Y-m-d H:i:s', $dateTime), 'd-M-Y'),
                  'time' => get_date_from_gmt(date('Y-m-d H:i:s', $dateTime), 'h:i A'),
                  'datetime' => $dateTime,
                  'timeleft' => $dateTime - time(),
                  'timetotal' => get_transient(self::$optionName . '_send_scheduled_notification_date_' . $dateTime),
                  'args' => ['notificationData' => $notificationData],
                ],
                null,
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
              )
            );
          } else {
            wp_send_json_error([
              'scheduled' => false,
              'message' => esc_html__('Notification scheduling failed', self::$textDomain),
            ]);
          }
        } else {
          $reportNumbers = self::sendNotification($pushData, $segment);
          if ($reportNumbers) {
            wp_send_json_success([
              'message' => esc_html__('Out of ' . $reportNumbers['sent'] + $reportNumbers['failed'] . ' recipients, notification successfully sent to ' . $reportNumbers['sent'] . ' and failed for ' . $reportNumbers['failed'] . '.', self::$textDomain),
            ]);
          } else {
            wp_send_json_error([
              'message' => esc_html__('Something went wrong.', self::$textDomain),
            ]);
          }
        }
      } else {
        wp_send_json_error([
          'message' => esc_html__('Something went wrong in system.', self::$textDomain),
        ]);
      }
    }

    public function handleScheduledNotification()
    {
      $hook = self::$optionName . '_send_scheduled_notification';
      $time = intval($_REQUEST['time']);
      $args = json_decode(stripslashes($_REQUEST['args']), true);
      $method = $_REQUEST['method'];
      $unscheduled = wp_unschedule_event($time, $hook, $args, false);
      delete_transient(self::$optionName . '_send_scheduled_notification_date_' . $time);

      if ($unscheduled) {
        switch ($method) {
          case 'send':
            $sentNotification = self::sendScheduledNotification($args['notificationData']);
            if ($sentNotification) {
              wp_send_json_success();
            } else {
              wp_send_json_error();
            }
            break;
          case 'edit':
            $notificationData = json_decode(stripslashes($_REQUEST['notificationData']), true);
            $userTimezone = (get_option('gmt_offset') > 0 ? '+' : '-') . get_option('gmt_offset');
            $dateTime = strtotime($notificationData['pushScheduledDatetime'] . ' ' . $userTimezone);
            $scheduleNotification = wp_schedule_single_event($dateTime, self::$optionName . '_send_scheduled_notification', ['notificationData' => $notificationData]);
            if ($scheduleNotification) {
              set_transient(self::$optionName . '_send_scheduled_notification_date_' . $dateTime, $dateTime - time(), $dateTime - time());
              htmlspecialchars(
                wp_send_json_success(
                  [
                    'scheduled' => true,
                    'message' => esc_html__('Notification scheduled successfully', self::$textDomain),
                    'date' => get_date_from_gmt(date('Y-m-d H:i:s', $dateTime), 'd-M-Y'),
                    'time' => get_date_from_gmt(date('Y-m-d H:i:s', $dateTime), 'h:i A'),
                    'datetime' => $dateTime,
                    'timeleft' => $dateTime - time(),
                    'timetotal' => get_transient(self::$optionName . '_send_scheduled_notification_date_' . $dateTime),
                    'args' => ['notificationData' => $notificationData],
                    'oldSchedule' => $time,
                  ],
                  null,
                  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                )
              );
            } else {
              wp_send_json_error([
                'scheduled' => false,
                'message' => esc_html__('Notification scheduling failed.', self::$textDomain),
              ]);
            }
            break;
          case 'remove':
            wp_send_json_success();
            break;
          default:
            echo 'Error: method not handled';
            return;
        }
      } else {
        wp_send_json_error();
      }
    }

    public function renderMetaBoxContent($post, $callbackArgs)
    {
      $pwaNoPushNewContent = get_post_meta($post->ID, 'pwaNoPushNewContent', true);
      $pwaNoPushWooNewProduct = get_post_meta($post->ID, 'pwaNoPushWooNewProduct', true);
      $pwaNoPushWooPriceDrop = get_post_meta($post->ID, 'pwaNoPushWooPriceDrop', true);
      $pwaNoPushWooSalePrice = get_post_meta($post->ID, 'pwaNoPushWooSalePrice', true);
      $pwaNoPushWooBackInStock = get_post_meta($post->ID, 'pwaNoPushWooBackInStock', true);
      wp_nonce_field(self::$optionName . '_no_push_meta_nonce', self::$optionName . '_no_push_meta_nonce');
      if (daftplugInstantify::isWooCommerceActive() && $post->post_type == 'product') {
        if (daftplugInstantify::getSetting('pwaPushWooNewProduct') == 'on') { ?>
<label style="display: block; margin: 5px;">
  <input type="checkbox" name="pwaNoPushWooNewProduct" value="on" <?php checked($pwaNoPushWooNewProduct, 'on'); ?>>
  <?php esc_html_e('Don\'t Send WooCommerce New Product Notification', self::$textDomain); ?>
</label style="display: block; margin: 5px;">
<?php }
        if (daftplugInstantify::getSetting('pwaPushWooPriceDrop') == 'on') { ?>
<label style="display: block; margin: 5px;">
  <input type="checkbox" name="pwaNoPushWooPriceDrop" value="on" <?php checked($pwaNoPushWooPriceDrop, 'on'); ?>>
  <?php esc_html_e('Don\'t Send WooCommerce Price Drop Notification', self::$textDomain); ?>
</label>
<?php }
        if (daftplugInstantify::getSetting('pwaPushWooSalePrice') == 'on') { ?>
<label style="display: block; margin: 5px;">
  <input type="checkbox" name="pwaNoPushWooSalePrice" value="on" <?php checked($pwaNoPushWooSalePrice, 'on'); ?>>
  <?php esc_html_e('Don\'t Send WooCommerce Sale Price Notification', self::$textDomain); ?>
</label>
<?php }
        if (daftplugInstantify::getSetting('pwaPushWooBackInStock') == 'on') { ?>
<label style="display: block; margin: 5px;">
  <input type="checkbox" name="pwaNoPushWooBackInStock" value="on" <?php checked($pwaNoPushWooBackInStock, 'on'); ?>>
  <?php esc_html_e('Don\'t Send WooCommerce Back In Stock Notification', self::$textDomain); ?>
</label>
<?php }
      } else {
        if (daftplugInstantify::getSetting('pwaPushNewContent') == 'on') { ?>
<label style="display: block; margin: 5px;">
  <input type="checkbox" name="pwaNoPushNewContent" value="on" <?php checked($pwaNoPushNewContent, 'on'); ?>>
  <?php esc_html_e('Don\'t Send New Content Notification', self::$textDomain); ?>
</label>
<?php }
      }
    }

    public function addMetaBoxes($postType, $post)
    {
      if ((daftplugInstantify::getSetting('pwaPushNewContent') == 'on' && in_array($post->post_type, (array) daftplugInstantify::getSetting('pwaPushNewContentPostTypes'))) || $post->post_type == 'product') {
        add_meta_box(self::$optionName . '_no_push_meta_box', esc_html__('Push Notifications', self::$textDomain), [$this, 'renderMetaBoxContent'], $postType, 'side', 'default', []);
      }
    }

    public function filterWooCommercePostData($data, $postArr)
    {
      global $post;

      if (!$post || $post->post_type != 'product') {
        return $data;
      }

      $wooCurrency = html_entity_decode(get_woocommerce_currency_symbol(get_option('woocommerce_currency')));
      $priceFormat = get_woocommerce_price_format();
      $oldSalePrice = get_post_meta($post->ID, '_sale_price', true);
      $newSalePrice = $postArr['_sale_price'];
      $oldRegularPrice = get_post_meta($post->ID, '_regular_price', true);
      $newRegularPrice = $postArr['_regular_price'];
      $oldStock = get_post_meta($post->ID, '_stock', true);
      $newStock = $postArr['_stock'];

      if ($oldRegularPrice) {
        set_transient(self::$optionName . '_regular_price', sprintf($priceFormat, $wooCurrency, $oldRegularPrice), 5);
      } else {
        set_transient(self::$optionName . '_regular_price', sprintf($priceFormat, $wooCurrency, $newRegularPrice), 5);
      }

      if ((!$oldSalePrice && $newSalePrice) || ($oldSalePrice > $newSalePrice && $newSalePrice != 0)) {
        set_transient(self::$optionName . '_sale_price', sprintf($priceFormat, $wooCurrency, $newSalePrice), 5);
      }

      if ($newRegularPrice < $oldRegularPrice) {
        set_transient(self::$optionName . '_dropped_price', sprintf($priceFormat, $wooCurrency, $newRegularPrice), 5);
      }

      if ($oldStock == 0 && $newStock > 0) {
        set_transient(self::$optionName . '_back_in_stock', true, 5);
      }

      return $data;
    }

    public function doWooOrderStatusUpdatePush($orderId, $oldStatus, $newStatus, $order)
    {
      if ($oldStatus != $newStatus) {
        $pushData = [
          'title' => __('Your Order Status Updated', self::$textDomain),
          'body' => sprintf(__('Your order (ID %s) status has updated from %s to %s. Click on this notification to see the order.', self::$textDomain), $orderId, $oldStatus, $newStatus),
          'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
          'data' => [
            'url' => trailingslashit($order->get_view_order_url()),
          ],
        ];

        self::sendNotification($pushData, '', $order->get_user_id());
      }
    }

    public function doUmRoleUpdatePush($new_roles, $old_roles, $user_id)
    {
      $diff = array_diff($old_roles, $new_roles);
      if (count($old_roles) != count($new_roles) || !empty($diff)) {
        $oldMembership = array_map(function ($item) {
          return UM()->roles()->get_role_name($item);
        }, $old_roles);
        $oldMembership = implode(', ', $oldMembership);
        $newMembership = array_map(function ($item) {
          return UM()->roles()->get_role_name($item);
        }, $new_roles);
        $newMembership = implode(', ', $newMembership);
        $pushData = [
          'title' => __('Your membership level has been changed', self::$textDomain),
          'body' => sprintf(__('Your membership level has been changed from %s to %s.', self::$textDomain), $oldMembership, $newMembership),
          'icon' => um_get_avatar_url(get_avatar($user_id, 40)),
          'data' => [
            'url' => um_user_profile_url(),
          ],
        ];

        self::sendNotification($pushData, '', $user_id);
      }
    }

    public function doAutoPush($id, $post)
    {
      $isAutosave = (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || wp_is_post_autosave($id);
      $isRevision = wp_is_post_revision($id);
      $isValidNonce = isset($_POST[self::$optionName . '_no_push_meta_nonce']) && wp_verify_nonce($_POST[self::$optionName . '_no_push_meta_nonce'], self::$pluginBasename) ? 'true' : 'false';
      $pwaNoPushNewContentMeta = isset($_POST['pwaNoPushNewContent']) ? $_POST['pwaNoPushNewContent'] : 'off';
      $pwaNoPushWooNewProductMeta = isset($_POST['pwaNoPushWooNewProduct']) ? $_POST['pwaNoPushWooNewProduct'] : 'off';
      $pwaNoPushWooPriceDropMeta = isset($_POST['pwaNoPushWooPriceDrop']) ? $_POST['pwaNoPushWooPriceDrop'] : 'off';
      $pwaNoPushWooSalePriceMeta = isset($_POST['pwaNoPushWooSalePrice']) ? $_POST['pwaNoPushWooSalePrice'] : 'off';
      $pwaNoPushWooBackInStockMeta = isset($_POST['pwaNoPushWooBackInStock']) ? $_POST['pwaNoPushWooBackInStock'] : 'off';

      if ($post->post_status != 'publish' || $isAutosave || $isRevision || !$isValidNonce) {
        return;
      }

      if ($post->post_type !== 'product') {
        // New Content Push
        if (daftplugInstantify::getSetting('pwaPushNewContent') == 'on' && $pwaNoPushNewContentMeta == 'off' && in_array($post->post_type, (array) daftplugInstantify::getSetting('pwaPushNewContentPostTypes'))) {
          if (strpos($_POST['_wp_http_referer'], 'post-new.php') !== false) {
            $pushData = [
              'title' => sprintf(__('New %s - %s', self::$textDomain), get_post_type_labels($post)->singular_name, $post->post_title),
              'body' => substr(strip_tags($post->post_content), 0, 77) . '...',
              'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
              'data' => [
                'url' => trailingslashit(get_permalink($id)),
              ],
            ];

            if (has_post_thumbnail($id)) {
              $pushData['image'] = get_the_post_thumbnail_url($id);
            }

            self::sendNotification($pushData, 'all');
          }
        }
      } else {
        // New Product Push
        if (daftplugInstantify::getSetting('pwaPushWooNewProduct') == 'on' && $pwaNoPushWooNewProductMeta == 'off') {
          if (strpos($_POST['_wp_http_referer'], 'post-new.php') !== false) {
            $pushData = [
              'title' => sprintf(__('New Product - %s', self::$textDomain), $post->post_title),
              'body' => substr(strip_tags($post->post_content), 0, 77) . '...',
              'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
              'data' => [
                'url' => trailingslashit(get_permalink($id)),
              ],
            ];

            if (has_post_thumbnail($id)) {
              $pushData['image'] = get_the_post_thumbnail_url($id);
            }

            self::sendNotification($pushData, 'all');
          }
        }

        // Price Drop Push
        if (daftplugInstantify::getSetting('pwaPushWooPriceDrop') == 'on' && $pwaNoPushWooPriceDropMeta == 'off' && get_transient(self::$optionName . '_dropped_price')) {
          $pushData = [
            'title' => sprintf(__('Price Drop - %s', self::$textDomain), $post->post_title),
            'body' => sprintf(__('Price dropped from %s to %s', self::$textDomain), get_transient(self::$optionName . '_regular_price'), get_transient(self::$optionName . '_dropped_price')),
            'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
            'data' => [
              'url' => trailingslashit(get_permalink($id)),
            ],
          ];

          if (has_post_thumbnail($id)) {
            $pushData['image'] = get_the_post_thumbnail_url($id);
          }

          self::sendNotification($pushData, 'all');
        }

        // Sale Price Push
        if (daftplugInstantify::getSetting('pwaPushWooSalePrice') == 'on' && $pwaNoPushWooSalePriceMeta == 'off' && get_transient(self::$optionName . '_sale_price')) {
          $pushData = [
            'title' => sprintf(__('New Sale Price - %s', self::$textDomain), $post->post_title),
            'body' => sprintf(__('New Sale Price: %s', self::$textDomain), get_transient(self::$optionName . '_sale_price')),
            'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
            'data' => [
              'url' => trailingslashit(get_permalink($id)),
            ],
          ];

          if (has_post_thumbnail($id)) {
            $pushData['image'] = get_the_post_thumbnail_url($id);
          }

          self::sendNotification($pushData, 'all');
        }

        // Back In Stock Push
        if (daftplugInstantify::getSetting('pwaPushWooBackInStock') == 'on' && $pwaNoPushWooBackInStockMeta == 'off' && get_transient(self::$optionName . '_back_in_stock')) {
          $pushData = [
            'title' => sprintf(__('Back In Stock - %s', self::$textDomain), $post->post_title),
            'body' => sprintf(__('%s is now back in stock', self::$textDomain), $post->post_title),
            'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
            'data' => [
              'url' => trailingslashit(get_permalink($id)),
            ],
          ];

          if (has_post_thumbnail($id)) {
            $pushData['image'] = get_the_post_thumbnail_url($id);
          }

          self::sendNotification($pushData, 'all');
        }
      }
    }

    public static function sendNotification($pushData, $segment = 'all', $targetUserId = null)
    {
      require_once plugin_dir_path(self::$pluginFile) . implode(DIRECTORY_SEPARATOR, ['pwa', 'includes', 'libs', 'vendor', 'autoload.php']);

      $auth = [
        'VAPID' => [
          'subject' => get_bloginfo('wpurl'),
          'publicKey' => self::$vapidKeys['pwaPublicKey'],
          'privateKey' => self::$vapidKeys['pwaPrivateKey'],
        ],
      ];

      $defaultOptions = [
        'TTL' => (int) daftplugInstantify::getSetting('pwaPushTtl'),
        'batchSize' => (int) daftplugInstantify::getSetting('pwaPushBatchSize'),
      ];

      $webPush = new WebPush($auth, $defaultOptions, 6, ['verify' => false]);
      $webPush->setDefaultOptions($defaultOptions);
      $webPush->setAutomaticPadding(false);
      $webPush->setReuseVAPIDHeaders(true);

      $pushData = wp_parse_args($pushData, [
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

      if ($targetUserId !== null) {
        $subscriptions = [];
        foreach (self::$subscribedDevices as $subscribedDevice) {
          if ($targetUserId == $subscribedDevice['user']) {
            $subscriptions[] = [
              'subscription' => Subscription::create([
                'endpoint' => $subscribedDevice['endpoint'],
                'publicKey' => $subscribedDevice['userKey'],
                'authToken' => $subscribedDevice['userAuth'],
              ]),
              'payload' => null,
            ];
          }
        }

        foreach ($subscriptions as $subscription) {
          $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
        }
      } else {
        switch ($segment) {
          case 'all':
            $subscriptions = [];
            foreach (self::$subscribedDevices as $subscribedDevice) {
              $subscriptions[] = [
                'subscription' => Subscription::create([
                  'endpoint' => $subscribedDevice['endpoint'],
                  'publicKey' => $subscribedDevice['userKey'],
                  'authToken' => $subscribedDevice['userAuth'],
                ]),
                'payload' => null,
              ];
            }

            foreach ($subscriptions as $subscription) {
              $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
            }
            break;
          case 'mobile':
            $subscriptions = [];
            foreach (self::$subscribedDevices as $subscribedDevice) {
              if (preg_match('[Android|iOS]', $subscribedDevice['deviceInfo'])) {
                $subscriptions[] = [
                  'subscription' => Subscription::create([
                    'endpoint' => $subscribedDevice['endpoint'],
                    'publicKey' => $subscribedDevice['userKey'],
                    'authToken' => $subscribedDevice['userAuth'],
                  ]),
                  'payload' => null,
                ];
              }
            }

            foreach ($subscriptions as $subscription) {
              $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
            }
            break;
          case 'desktop':
            $subscriptions = [];
            foreach (self::$subscribedDevices as $subscribedDevice) {
              if (preg_match('[Windows|Linux|Mac|Ubuntu|Solaris]', $subscribedDevice['deviceInfo'])) {
                $subscriptions[] = [
                  'subscription' => Subscription::create([
                    'endpoint' => $subscribedDevice['endpoint'],
                    'publicKey' => $subscribedDevice['userKey'],
                    'authToken' => $subscribedDevice['userAuth'],
                  ]),
                  'payload' => null,
                ];
              }
            }

            foreach ($subscriptions as $subscription) {
              $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
            }
            break;
          case 'registered':
            $subscriptions = [];
            foreach (self::$subscribedDevices as $subscribedDevice) {
              if (is_numeric($subscribedDevice['user'])) {
                $subscriptions[] = [
                  'subscription' => Subscription::create([
                    'endpoint' => $subscribedDevice['endpoint'],
                    'publicKey' => $subscribedDevice['userKey'],
                    'authToken' => $subscribedDevice['userAuth'],
                  ]),
                  'payload' => null,
                ];
              }
            }

            foreach ($subscriptions as $subscription) {
              $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
            }
            break;
          case 'unregistered':
            $subscriptions = [];
            foreach (self::$subscribedDevices as $subscribedDevice) {
              if ($subscribedDevice['user'] == 'Unregistered') {
                $subscriptions[] = [
                  'subscription' => Subscription::create([
                    'endpoint' => $subscribedDevice['endpoint'],
                    'publicKey' => $subscribedDevice['userKey'],
                    'authToken' => $subscribedDevice['userAuth'],
                  ]),
                  'payload' => null,
                ];
              }
            }

            foreach ($subscriptions as $subscription) {
              $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
            }
            break;
          case substr($segment, 0, 7) === 'Country':
            $country = str_replace('Country - ', '', $segment);
            $subscriptions = [];
            foreach (self::$subscribedDevices as $subscribedDevice) {
              if ($subscribedDevice['country'] == $country) {
                $subscriptions[] = [
                  'subscription' => Subscription::create([
                    'endpoint' => $subscribedDevice['endpoint'],
                    'publicKey' => $subscribedDevice['userKey'],
                    'authToken' => $subscribedDevice['userAuth'],
                  ]),
                  'payload' => null,
                ];
              }
            }

            foreach ($subscriptions as $subscription) {
              $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
            }
            break;
          default:
            $subscription = [
              'subscription' => Subscription::create([
                'endpoint' => self::$subscribedDevices[$segment]['endpoint'],
                'publicKey' => self::$subscribedDevices[$segment]['userKey'],
                'authToken' => self::$subscribedDevices[$segment]['userAuth'],
              ]),
              'payload' => null,
            ];

            $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
            break;
        }
      }

      $reportNumbers = [
        'sent' => 0,
        'failed' => 0,
      ];

      foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();
        if ($report->isSuccess()) {
          $reportNumbers['sent'] += 1;
        } else {
          unset(self::$subscribedDevices[$endpoint]);
          update_option(self::$optionName . '_subscribed_devices', self::$subscribedDevices);
          $reportNumbers['failed'] += 1;
        }
      }

      return $reportNumbers;
    }

    public static function sendScheduledNotification($notificationData)
    {
      $pushData = [
        'title' => !empty($notificationData['pushTitle']) ? $notificationData['pushTitle'] : '',
        'body' => !empty($notificationData['pushBody']) ? $notificationData['pushBody'] : '',
        'image' => !empty($notificationData['pushImage']) ? esc_url_raw(wp_get_attachment_image_src($notificationData['pushImage'], 'full')[0] ?? '') : '',
        'icon' => !empty($notificationData['pushIcon']) ? esc_url_raw(wp_get_attachment_image_src($notificationData['pushIcon'], 'full')[0] ?? '') : '',
        'data' => [
          'url' => !empty($notificationData['pushUrl']) ? trailingslashit(esc_url_raw($notificationData['pushUrl'])) . '?utm_source=pwa-notification' : '',
        ],
        'requireInteraction' => $notificationData['pushFixed'] == 'on' ? true : false,
        'vibrate' => $notificationData['pushVibrate'] == 'on' ? [200, 100, 200] : [],
      ];

      if ($notificationData['pushActionButton1'] == 'on') {
        $pushData['actions'][] = ['action' => 'action1', 'title' => $notificationData['pushActionButton1Text']];
        $pushData['data']['pushActionButton1Url'] = trailingslashit(esc_url_raw($notificationData['pushActionButton1Url']));
      }

      if ($notificationData['pushActionButton2'] == 'on') {
        $pushData['actions'][] = ['action' => 'action2', 'title' => $notificationData['pushActionButton2Text']];
        $pushData['data']['pushActionButton2Url'] = trailingslashit(esc_url_raw($notificationData['pushActionButton2Url']));
      }

      $segment = $notificationData['pushSegment'];

      return self::sendNotification($pushData, $segment);
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

    public function getScheduledNotifications()
    {
      $crons = _get_cron_array();
      $events = [];

      if (empty($crons)) {
        return [];
      }

      foreach ($crons as $time => $cron) {
        foreach ($cron as $hook => $dings) {
          foreach ($dings as $sig => $data) {
            if ($hook == self::$optionName . '_send_scheduled_notification') {
              $events["$hook-$sig-$time"] = [
                'time' => $time,
                'sig' => $sig,
                'args' => $data['args'],
              ];
            }
          }
        }
      }

      return $events;
    }

    public function getSubscriberAnalytics()
    {
      $dates = $this->getLastNDays(365);
      $subscribeDates = array_count_values(array_column(self::$subscribedDevices, 'date'));
      $fullSubscribeData = array_merge($dates, $subscribeDates);

      wp_send_json_success($fullSubscribeData);
    }

    public function getSubscriberStats()
    {
      $browser = [];
      $device = [];
      $country = [];
      $status = [];

      foreach (self::$subscribedDevices as $key => $value) {
        $browser[] = trim(explode(' on ', self::$subscribedDevices[$key]['deviceInfo'])[0]);
        $device[] = trim(explode(' on ', self::$subscribedDevices[$key]['deviceInfo'])[1]);
        $country[] = self::$subscribedDevices[$key]['country'];
        $status[] = self::$subscribedDevices[$key]['user'];
      }

      $browserData = @array_count_values($browser);
      $deviceData = @array_count_values($device);
      $countryData = @array_count_values($country);
      $statusData = @array_count_values($status);
      $statusNames = [];
      $statusCount = [];

      if (!empty($statusData)) {
        if (array_key_exists('Unregistered', $statusData) && count($statusData) > 1) {
          $statusNames[] = 'Unregistered';
          $statusNames[] = 'Registered';
          $statusCount[] = $statusData['Unregistered'];
          $statusCount[] = array_sum(array_diff_key($statusData, array_flip(['Unregistered'])));
        } elseif (array_key_exists('Unregistered', $statusData) && count($statusData) > 0) {
          $statusNames[] = 'Unregistered';
          $statusCount[] = $statusData['Unregistered'];
        } elseif (!array_key_exists('Unregistered', $statusData) && count($statusData) > 0) {
          $statusNames[] = 'Registered';
          $statusCount[] = array_sum($statusData);
        }
      }

      wp_send_json_success([
        'browserNames' => array_keys($browserData),
        'browserCount' => array_values($browserData),
        'deviceNames' => array_keys($deviceData),
        'deviceCount' => array_values($deviceData),
        'countryNames' => array_keys($countryData),
        'countryCount' => array_values($countryData),
        'statusNames' => $statusNames,
        'statusCount' => $statusCount,
      ]);
    }

    public function getLastNDays($days, $format = 'j M Y')
    {
      $m = date('m');
      $de = date('d');
      $y = date('Y');
      $dateArray = [];
      for ($i = 0; $i <= $days - 1; $i++) {
        $dateArray[date($format, mktime(0, 0, 0, $m, $de - $i, $y))] = 0;
      }

      return array_reverse($dateArray);
    }

    public function getAllSubscribers()
    {
      htmlspecialchars(
        wp_send_json_success(
          [
            'subscribedDevices' => array_slice(self::$subscribedDevices, 6),
          ],
          null,
          JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        )
      );
    }

    public function handleSubscription()
    {
      $subscribedDevices = self::$subscribedDevices;
      $endpoint = $_REQUEST['endpoint'];
      $userKey = $_REQUEST['userKey'];
      $userAuth = $_REQUEST['userAuth'];
      $deviceInfo = $_REQUEST['deviceInfo'];
      $date = date('j M Y');
      $country = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $_SERVER['REMOTE_ADDR']), true);
      $method = $_REQUEST['method'];
      $user = is_user_logged_in() ? get_current_user_id() : 'Unregistered';
      $roles = is_user_logged_in() ? (array) wp_get_current_user()->roles : [];
      $cartItemCount = daftplugInstantify::isWooCommerceActive() ? WC()->cart->get_cart_contents_count() : 0;
      $lastUpdated = date('Y-m-d H:i:s');

      switch ($method) {
        case 'add':
          $subscribedDevices[$endpoint] = [
            'endpoint' => $endpoint,
            'userKey' => $userKey,
            'userAuth' => $userAuth,
            'deviceInfo' => $deviceInfo,
            'date' => $date,
            'country' => @$country['geoplugin_countryName'],
            'user' => $user,
            'roles' => $roles,
            'cartItemCount' => $cartItemCount,
            'lastUpdated' => $lastUpdated,
          ];
          break;
        case 'remove':
          unset($subscribedDevices[$endpoint]);
          break;
        default:
          echo 'Error: method not handled';
          return;
      }

      $handled = update_option(self::$optionName . '_subscribed_devices', $subscribedDevices);

      if ($handled) {
        wp_send_json_success();
      } else {
        wp_send_json_error();
      }
    }

    public function handleSubscriptionUpdate()
    {
      $subscribedDevices = self::$subscribedDevices;
      $oldEndpoint = $_REQUEST['oldEndpoint'];
      $newEndpoint = $_REQUEST['newEndpoint'];
      $newUserKey = $_REQUEST['newUserKey'];
      $newUserAuth = $_REQUEST['newUserAuth'];
      $newSubscription = [
        'endpoint' => $newEndpoint,
        'userKey' => $newUserKey,
        'userAuth' => $newUserAuth,
      ];

      if (array_key_exists($oldEndpoint, $subscribedDevices)) {
        $subscribedDevices[$newEndpoint] = array_merge($subscribedDevices[$oldEndpoint], $newSubscription);
        unset($subscribedDevices[$oldEndpoint]);
      }

      $handled = update_option(self::$optionName . '_subscribed_devices', $subscribedDevices);

      if ($handled) {
        wp_send_json_success();
      } else {
        wp_send_json_error();
      }
    }

    public function doNewCommentPush($commentId, $commentApproved)
    {
      if ($commentApproved) {
        $allComments = get_comments(['post_id' => $comment->comment_post_ID]);
        $authorsIds = [];
        $comment = get_comment($commentId);
        $pushData = [
          'title' => sprintf(__('New Comment By %s', self::$textDomain), $comment->comment_author),
          'body' => $comment->comment_content,
          'icon' => get_avatar_url($comment->user_id),
          'data' => [
            'url' => get_permalink($comment->comment_post_ID),
          ],
        ];

        foreach ($allComments as $allComment) {
          if ($allComment->user_id !== $comment->user_id) {
            $authorsIds[] = $allComment->user_id;
          }
        }

        foreach (array_unique($authorsIds) as $authorsId) {
          self::sendNotification($pushData, 'private', $authorsId);
        }
      }
    }

    public function doWooNewOrderPush($orderId)
    {
      if (!$orderId) {
        return;
      }

      $order = wc_get_order($orderId);
      $pushData = [
        'title' => esc_html__('WooCommerce New Order', self::$textDomain),
        'body' => sprintf(__('You have new order for total %s%s. Click on notification to see it.', self::$textDomain), html_entity_decode(get_woocommerce_currency_symbol($order->get_currency())), $order->get_total()),
        'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
        'data' => [
          'url' => $order->get_view_order_url(),
        ],
      ];

      self::sendNotification($pushData, 'wooNewOrder');
    }

    public function doWooLowStockPush($orderId)
    {
      if (!$orderId) {
        return;
      }

      $order = wc_get_order($orderId);
      $items = $order->get_items();

      foreach ($items as $item) {
        if ($item['variation_id'] > 0) {
          $productId = $item['variation_id'];
          $stock = get_post_meta($item['variation_id'], '_stock', true);
          $sku = get_post_meta($item['variation_id'], '_sku', true);
          $lowStockThreshold = get_post_meta($item['variation_id'], '_low_stock_amount', true);
        } else {
          $productId = $item['product_id'];
          $stock = get_post_meta($item['product_id'], '_stock', true);
          $sku = get_post_meta($item['product_id'], '_sku', true);
          $lowStockThreshold = get_post_meta($item['product_id'], '_low_stock_amount', true);
        }

        $lowStockThreshold = !empty($lowStockThreshold) ? $lowStockThreshold : daftplugInstantify::getSetting('pwaPushWooLowStockThreshold');

        if ($stock <= $lowStockThreshold && !get_post_meta($orderId, 'pwaPushWooLowStock', true)) {
          update_post_meta($orderId, 'pwaPushWooLowStock', 1);
          $pushData = [
            'title' => esc_html__('WooCommerce Low Stock', self::$textDomain),
            'body' => sprintf(__('The product "%s" is running out of stock. Currently left %s in stock. Click on notification to see it.', self::$textDomain), $item['name'], $stock),
            'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
            'data' => [
              'url' => get_permalink($productId),
            ],
          ];

          self::sendNotification($pushData, 'wooLowStock');
        }
      }
    }

    public function doWooAbandonedCartPush()
    {
      foreach (self::$subscribedDevices as $subscribedDevice) {
        if (time() - strtotime($subscribedDevice['lastUpdated']) > daftplugInstantify::getSetting('pwaPushWooAbandonedCartInterval') * 3599 && $subscribedDevice['cartItemCount'] > 0) {
          $pushData = [];
          $cartItemCount = $subscribedDevice['cartItemCount'];
          $itemWord = $cartItemCount > 1 ? esc_html__('items', self::$textDomain) : esc_html__('item', self::$textDomain);
          $pushData = [
            'segment' => $subscribedDevice['endpoint'],
            'title' => esc_html__('Your cart is waiting!', self::$textDomain),
            'body' => sprintf(__('You have left %s %s you love in your cart. We are holding on them, but not for long!', self::$textDomain), $cartItemCount, $itemWord),
            'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
            'data' => [
              'url' => wc_get_cart_url(),
            ],
          ];

          if (!get_transient(self::$optionName . '_sent_abandoned_cart_notification_' . hash('crc32', $subscribedDevice['endpoint'], false))) {
            $sendAbandonedCartNotification = self::sendNotification($pushData, 'wooAbandonedCart');
            if ($sendAbandonedCartNotification) {
              set_transient(self::$optionName . '_sent_abandoned_cart_notification_' . hash('crc32', $subscribedDevice['endpoint'], false), 'yes', daftplugInstantify::getSetting('pwaPushWooAbandonedCartInterval') * 3599);
            }
          }
        }
      }
    }

    public function doBpMemberMentionPush($activity, $subject, $message, $content, $receiverUserId)
    {
      $currentUser = get_userdata($activity->user_id);
      $friendDetail = get_userdata($receiverUserId);

      if ($activity->type == 'activity_comment') {
        $body = sprintf(__('%s has just mentioned you in a comment.', self::$textDomain), $currentUser->display_name);
      } else {
        $body = sprintf(__('%s has just mentioned you in an update.', self::$textDomain), $currentUser->display_name);
      }

      $pushData = [
        'title' => sprintf(__('New mention from %s', self::$textDomain), $currentUser->display_name),
        'body' => $body,
        'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
        'data' => [
          'url' => get_permalink(get_option('bp-pages')['members']) . $friendDetail->user_nicename . '/activity/mentions/',
        ],
      ];

      self::sendNotification($pushData, 'private', $receiverUserId);
    }

    public function doBpMemberCommentPush($activity, $commentId, $commenterId, $params)
    {
      $currentUser = get_userdata($commenterId);
      $receiverDetail = get_userdata($activity->user_id);
      $pushData = [
        'title' => sprintf(__('New comment from %s', self::$textDomain), $currentUser->display_name),
        'body' => sprintf(__('%s has just commented on your post.', self::$textDomain), $currentUser->display_name),
        'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
        'data' => [
          'url' => get_permalink(get_option('bp-pages')['members']) . $receiverDetail->user_nicename . '/activity/' . $activity->id . '/#acomment-' . $commentId,
        ],
      ];

      self::sendNotification($pushData, 'private', $activity->user_id);
    }

    public function doBpMemberReplyPush($activity, $commentId, $commenterId, $params)
    {
      $currentUser = get_userdata($commenterId);
      $pushData = [
        'title' => sprintf(__('New reply from %s', self::$textDomain), $currentUser->display_name),
        'body' => sprintf(__('%s has just replied you.', self::$textDomain), $currentUser->display_name),
        'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
        'data' => [
          'url' => get_permalink(get_option('bp-pages')['activity']) . 'p/' . $activity->item_id . '/#acomment-' . $commenterId,
        ],
      ];

      self::sendNotification($pushData, 'private', $activity->user_id);
    }

    public function doBpNewMessagePush($params)
    {
      $senderDetail = get_userdata($params->sender_id);
      foreach ($params->recipients as $r) {
        $recipientDetail = get_userdata($r->user_id);
        $pushData = [
          'title' => sprintf(__('New message from %s', self::$textDomain), $senderDetail->display_name),
          'body' => substr(strip_tags($params->message), 0, 77) . '...',
          'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
          'data' => [
            'url' => get_permalink(get_option('bp-pages')['members']) . $recipientDetail->user_nicename . '/messages/view/' . $params->thread_id,
          ],
        ];

        self::sendNotification($pushData, 'private', $r->user_id);
      }
    }

    public function doBpFriendRequestPush($id, $userId, $friendId, $friendship)
    {
      $friendDetail = get_userdata($friendId);
      $currentUser = get_userdata($userId);
      $pushData = [
        'title' => sprintf(__('New friend request from %s', self::$textDomain), $currentUser->display_name),
        'body' => sprintf(__('%s has just sent you a friend request.', self::$textDomain), $currentUser->display_name),
        'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
        'data' => [
          'url' => get_permalink(get_option('bp-pages')['members']) . $friendDetail->user_nicename . '/friends/requests/?new',
        ],
      ];

      self::sendNotification($pushData, 'private', $friendId);
    }

    public function doBpFriendAcceptedPush($id, $userId, $friendId, $friendship)
    {
      $friendDetail = get_userdata($userId);
      $currentUser = get_userdata($friendId);
      $pushData = [
        'title' => sprintf(__('%s accepted your friend request', self::$textDomain), $currentUser->display_name),
        'body' => sprintf(__('%s has just accepted your friend request.', self::$textDomain), $currentUser->display_name),
        'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
        'data' => [
          'url' => get_permalink(get_option('bp-pages')['members']) . $friendDetail->user_nicename . '/friends',
        ],
      ];

      self::sendNotification($pushData, 'private', $userId);
    }

    public function doPeepsoNotification($notification)
    {
      self::$noteData = $notification;
      if (self::$noteData['not_external_id'] > 0) {
        self::$noteData['post_title'] = get_the_title(self::$noteData['not_external_id']);
      }
      $PeepSoUser = PeepSoUser::get_instance(self::$noteData['not_from_user_id']);
      $notificationArgs = self::peepsoNotificationLink(false);
      $pushData = [
        'title' => sprintf(__('New Notification From %s', self::$textDomain), $PeepSoUser->get_firstname()),
        'body' => strip_tags($PeepSoUser->get_firstname() . ' ' . self::$noteData['not_message'] . $notificationArgs['message']),
        'icon' => esc_url_raw(@wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), 'full')[0]),
        'data' => [
          'url' => $notificationArgs['link'],
        ],
      ];

      self::sendNotification($pushData, 'private', self::$noteData['not_user_id']);

      return $notification;
    }

    private static function peepsoNotificationLink($echo = true)
    {
      $link = PeepSo::get_page('activity_status') . self::$noteData['post_title'] . '/';
      $link = apply_filters('peepso_profile_notification_link', $link, self::$noteData);
      $isComment = 0;
      if ('user_comment' === self::$noteData['not_type']) {
        $isComment = 1;
      }
      if ('like_post' == self::$noteData['not_type']) {
        global $wpdb;
        $sql = 'SELECT COUNT(id) as `is_comment_like` FROM `' . $wpdb->prefix . 'posts` WHERE `post_type`=\'peepso-comment\' AND ID=' . self::$noteData['not_external_id'];
        $res = $wpdb->get_row($sql);
        $isComment = $res->is_comment_like;
      }
      $printLink = '';
      $activityType = [
        'type' => 'post',
        'text' => __('post', 'peepso-core'),
      ];
      if ('stream_reply_comment' === self::$noteData['not_type']) {
        $activities = PeepSoActivity::get_instance();
        $notActivity = $activities->get_activity_data(self::$noteData['not_external_id'], self::$noteData['not_module_id']);
        $commentActivity = $activities->get_activity_data($notActivity->act_comment_object_id, $notActivity->act_comment_module_id);
        $postActivity = $activities->get_activity_data($commentActivity->act_comment_object_id, $commentActivity->act_comment_module_id);

        if (is_object($commentActivity) && is_object($postActivity)) {
          $parentComment = $activities->get_activity_post($commentActivity->act_id);
          $parentPost = $activities->get_activity_post($postActivity->act_id);
          $parentId = $parentComment->act_external_id;
          $postLink = PeepSo::get_page('activity_status') . $parentPost->post_title . '/';
          $commentLink = $postLink . '?t=' . time() . '#comment.' . $postActivity->act_id . '.' . $parentComment->ID . '.' . $commentActivity->act_id . '.' . $notActivity->act_external_id;
          if (0 === intval($echo)) {
            $hyperlink = $commentLink;
          }
          ob_start();
          echo ' ';
          $postContent = __('a comment', 'peepso-core');
          if (intval($parentComment->post_author) === get_current_user_id()) {
            $postContent = self::$noteData['not_message'] != __('replied to', 'peepso-core') ? __('on ', 'peepso-core') : '';
            $postContent .= __('your comment', 'peepso-core');
          }
          echo $postContent;
          $printLink = ob_get_clean();
        }
      } elseif ('profile_like' === self::$noteData['not_type']) {
        $author = PeepSoUser::get_instance(self::$noteData['not_from_user_id']);
        $link = $author->get_profileurl();
        if (0 === intval($echo)) {
          $hyperlink = $link;
        }
      } elseif (1 == $isComment) {
        $activities = PeepSoActivity::get_instance();
        $notActivity = $activities->get_activity_data(self::$noteData['not_external_id'], self::$noteData['not_module_id']);
        $parentActivity = $activities->get_activity_data($notActivity->act_comment_object_id, $notActivity->act_comment_module_id);
        if (is_object($parentActivity)) {
          $notPost = $activities->get_activity_post($notActivity->act_id);
          $parentPost = $activities->get_activity_post($parentActivity->act_id);
          $parentId = $parentPost->act_external_id;
          $activityType = apply_filters('peepso_notifications_activity_type', $activityType, $parentId, null);
          if ($parentPost->post_type == 'peepso-comment') {
            $commentActivity = $activities->get_activity_data($notActivity->act_comment_object_id, $notActivity->act_comment_module_id);
            $postActivity = $activities->get_activity_data($commentActivity->act_comment_object_id, $commentActivity->act_comment_module_id);
            $parentPost = $activities->get_activity_post($postActivity->act_id);
            $parentComment = $activities->get_activity_post($commentActivity->act_id);
            $parentLink = PeepSo::get_page('activity_status') . $parentPost->post_title . '/?t=' . time() . '#comment.' . $postActivity->act_id . '.' . $parentComment->ID . '.' . $commentActivity->act_id . '.' . $notActivity->act_external_id;
          } else {
            $parentLink = PeepSo::get_page('activity_status') . $parentPost->post_title . '/#comment.' . $parentActivity->act_id . '.' . $notPost->ID . '.' . $notActivity->act_external_id;
          }
          if (0 === intval($echo)) {
            $hyperlink = $parentLink;
          }
          ob_start();
          $postContent = '';
          $on = '';
          if ($activityType['type'] == 'post') {
            $on = ' ' . __('on', 'peepso-core');
            $postContent = sprintf(__('a %s', 'peepso-core'), $activityType['text']);
          }
          if (intval($parentPost->post_author) === get_current_user_id() || (intval($parentPost->post_author) === get_current_user_id() && in_array($activityType['type'], ['cover', 'avatar']))) {
            $on = ' ' . __('on', 'peepso-core');
            $postContent = sprintf(__('your %s', 'peepso-core'), $activityType['text']);
          }
          if (in_array($activityType['type'], ['cover', 'avatar']) && intval($parentPost->post_author) !== get_current_user_id()) {
            $on = ' ' . __('on', 'peepso-core');
            if (preg_match('/^[aeiou]/i', strtolower($activityType['text']))) {
              $postContent = sprintf(__('an %s', 'peepso-core'), $activityType['text']);
            } else {
              $postContent = sprintf(__('a %s', 'peepso-core'), $activityType['text']);
            }
          }
          echo $on, ' ';
          echo $postContent;
          $printLink = ob_get_clean();
        }
      } else {
        if (0 === intval($echo)) {
          $hyperlink = $link;
        }
        if ('share' === self::$noteData['not_type']) {
          $activities = PeepSoActivity::get_instance();
          $repost = $activities->get_activity_data(self::$noteData['not_external_id'], self::$noteData['not_module_id']);
          $originalPost = $activities->get_activity_post($repost->act_repost_id);
          $activityType = apply_filters('peepso_notifications_activity_type', $activityType, $originalPost->ID, null);
          ob_start();
          echo ' ', sprintf(__('your %s', 'peepso-core'), $activityType['text']);
          $printLink = ob_get_clean();
        }
      }

      $printLink = apply_filters('peepso_modify_link_item_notification', [$printLink, $link], self::$noteData);

      if (is_array($printLink)) {
        return ['message' => $printLink[0], 'link' => $hyperlink];
      } else {
        return ['message' => $printLink, 'link' => $hyperlink];
      }
    }

    public function doUmCommentReplyPush($comment_ID, $status)
    {
      if ($status == 1) {
        $comment = get_comment($comment_ID);
        $parent = $comment->comment_parent;
        if ($parent) {
          $parentc = get_comment($parent);
          $author = $parentc->user_id;
          if ($author == $comment->user_id) {
            return;
          }
          if ($comment->user_id == 0 || $author == 0) {
            return;
          }
          $pushData = [
            'title' => sprintf(__('%s has replied to one of your comments', self::$textDomain), um_user('display_name')),
            'body' => sprintf(__('Comment: %s', self::$textDomain), get_comment_excerpt($comment->comment_ID)),
            'icon' => um_get_avatar_url(get_avatar($comment->user_id, 40)),
            'data' => [
              'url' => get_comment_link($comment->comment_ID),
            ],
          ];
          if (daftplugInstantify::getSetting('pwaPushUmCommentReply') == 'on') {
            self::sendNotification($pushData, 'private', $author);
          }
        } else {
          $post = get_post($comment->comment_post_ID);
          $author = $post->post_author;
          $pushData = [
            'body' => sprintf(__('Comment: %s', self::$textDomain), get_comment_excerpt($comment->comment_ID)),
            'data' => [
              'url' => get_comment_link($comment->comment_ID),
            ],
          ];
          if ($comment->user_id == $author && is_user_logged_in()) {
            return;
          }
          if ($comment->user_id > 0) {
            um_fetch_user($comment->user_id);
            $pushData['title'] = sprintf(__('%s has commented on your post', self::$textDomain), um_user('display_name'));
            $pushData['icon'] = um_get_avatar_url(get_avatar($comment->user_id, 40));
            if (daftplugInstantify::getSetting('pwaPushUmNewComment') == 'on') {
              self::sendNotification($pushData, 'private', $author);
            }
          } else {
            $pushData['title'] = __('A guest has commented on your post', self::$textDomain);
            $pushData['icon'] = '';
            if (daftplugInstantify::getSetting('pwaPushUmGuestComment') == 'on') {
              self::sendNotification($pushData, 'private', $author);
            }
          }
        }
      }
    }

    public function doUmProfileViewsPush($args)
    {
      if (!um_is_core_page('user')) {
        return;
      }
      global $post;
      if (is_user_logged_in() && get_current_user_id() != um_profile_id()) {
        um_fetch_user(get_current_user_id());
        $pushData = [
          'title' => sprintf(__('%s has viewed your profile', self::$textDomain), um_user('display_name')),
          'body' => sprintf(__('%s has viewed your profile', self::$textDomain), um_user('display_name')),
          'icon' => um_get_avatar_url(get_avatar(get_current_user_id(), 40)),
          'data' => [
            'url' => um_user_profile_url(),
          ],
        ];
        um_fetch_user(um_profile_id());
        if (daftplugInstantify::getSetting('pwaPushUmProfileView') == 'on') {
          self::sendNotification($pushData, 'private', um_profile_id());
        }
      }

      if (!is_user_logged_in() && isset($post->ID)) {
        if (
          UM()
            ->access()
            ->is_restricted($post->ID)
        ) {
          return;
        }
        $pushData = [
          'title' => __('A guest has viewed your profile.', self::$textDomain),
          'body' => __('A guest has viewed your profile.', self::$textDomain),
          'icon' => um_get_avatar_url(get_avatar('123456789', 40)),
          'data' => [
            'url' => '',
          ],
        ];
        um_fetch_user(um_profile_id());
        if (daftplugInstantify::getSetting('pwaPushUmGuestProfileView') == 'on') {
          self::sendNotification($pushData, 'private', um_profile_id());
        }
      }
    }

    public function doUmPrivateMessagePush($to, $from, $conversation_id, $message_data = [])
    {
      um_fetch_user($from);

      $pushData = [
        'title' => __('New Message', self::$textDomain),
        'body' => sprintf(__('%s has just sent you a private message.', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($from, 40)),
      ];

      um_fetch_user($to);

      $notification_uri = add_query_arg('profiletab', 'messages', um_user_profile_url());
      $notification_uri = add_query_arg('conversation_id', $conversation_id, $notification_uri);
      $pushData['data']['url'] = $notification_uri;

      self::sendNotification($pushData, 'private', $to);
    }

    public function doUmNewFollowPush($user_id1, $user_id2)
    {
      um_fetch_user($user_id2);
      $pushData = [
        'title' => __('New Follow', self::$textDomain),
        'body' => sprintf(__('%s has just followed you!', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($user_id2, 40)),
        'data' => [
          'url' => um_user_profile_url(),
        ],
      ];
      um_fetch_user($user_id1);

      self::sendNotification($pushData, 'private', $user_id1);
    }

    public function doUmFriendRequestPush($user_id1, $user_id2)
    {
      um_fetch_user($user_id2);
      $pushData = [
        'title' => __('New Friend Request', self::$textDomain),
        'body' => sprintf(__('%s has sent you a friendship request.', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($user_id2, 40)),
        'data' => [
          'url' => um_user_profile_url(),
        ],
      ];
      um_fetch_user($user_id1);

      self::sendNotification($pushData, 'private', $user_id1);
    }

    public function doUmFriendRequestAcceptedPush($user_id1, $user_id2)
    {
      um_fetch_user($user_id2);
      $pushData = [
        'title' => __('Friend Request Accepted', self::$textDomain),
        'body' => sprintf(__('%s has accepted your friendship request.', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($user_id2, 40)),
        'data' => [
          'url' => um_user_profile_url(),
        ],
      ];
      um_fetch_user($user_id1);

      self::sendNotification($pushData, 'private', $user_id1);
    }

    public function doUmWallPostPush($post_id, $writer, $wall)
    {
      if ($writer == $wall) {
        return false;
      }
      um_fetch_user($writer);
      $pushData = [
        'title' => __('New Wall Post', self::$textDomain),
        'body' => sprintf(__('%s has posted on your wall.', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($writer, 80)),
      ];
      um_fetch_user($wall);
      $pushData['data']['url'] = UM()->Activity_API()->api()->get_permalink($post_id);

      self::sendNotification($pushData, 'private', $wall);
    }

    public function doUmWallCommentPush($comment_id, $comment_parent, $post_id, $user_id)
    {
      if ($comment_parent > 0) {
        return false;
      }
      $author = UM()->Activity_API()->api()->get_author($post_id);
      if ($author == $user_id) {
        return false;
      }
      um_fetch_user($user_id);
      $pushData = [
        'title' => __('New Wall Post Comment', self::$textDomain),
        'body' => sprintf(__('%s has commented on your wall post.', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($user_id, 80)),
      ];
      um_fetch_user($author);
      $pushData['data']['url'] = UM()->Activity_API()->api()->get_permalink($post_id);

      self::sendNotification($pushData, 'private', $author);
    }

    public function doUmPostLikePush($post_id, $user_id)
    {
      $author = UM()->Activity_API()->api()->get_author($post_id);
      if ($author == $user_id) {
        return false;
      }
      um_fetch_user($user_id);
      $pushData = [
        'title' => __('New Wall Post Like', self::$textDomain),
        'body' => sprintf(__('%s likes your wall post.', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($user_id, 80)),
      ];
      um_fetch_user($author);
      $pushData['data']['url'] = UM()->Activity_API()->api()->get_permalink($post_id);

      self::sendNotification($pushData, 'private', $author);
    }

    public function doUmNewMentionPush($user_id1, $user_id2, $post_id)
    {
      um_fetch_user($user_id1);
      $pushData = [
        'title' => __('New Mention', self::$textDomain),
        'body' => sprintf(__('%s has just mentioned you.', self::$textDomain), um_user('display_name')),
        'icon' => um_get_avatar_url(get_avatar($user_id1, 80)),
        'data' => [
          'url' => UM()->Activity_API()->api()->get_permalink($post_id),
        ],
      ];

      self::sendNotification($pushData, 'private', $user_id2);
    }

    public function doUmGroupApprovePush($user_id, $group_id, $invited_by_user_id, $group_role, $new_group)
    {
      if ($new_group) {
        return;
      }
      um_fetch_user($user_id);
      $pushData = [
        'title' => __('Group Join Request Approved', self::$textDomain),
        'body' => sprintf(__('Your request to join %s have been approved.', self::$textDomain), ucwords(get_the_title($group_id))),
        'icon' => UM()->Groups()->api()->get_group_image($group_id, 'default', 50, 50, true),
        'data' => [
          'url' => UM()->Activity_API()->api()->get_permalink($post_id),
        ],
      ];

      self::sendNotification($pushData, 'private', $user_id);
      um_reset_user();
    }

    public function doUmGroupJoinRequestPush($user_id, $group_id, $invited_by_user_id)
    {
      if ($user_id == $invited_by_user_id) {
        um_fetch_user($user_id);
        $pushData = [
          'title' => __('New Group Join Request', self::$textDomain),
          'body' => sprintf(__('%s has requested to join %s.', self::$textDomain), um_user('display_name'), ucwords(get_the_title($group_id))),
          'icon' => um_get_avatar_url(get_avatar($user_id, 40)),
          'data' => [
            'url' => get_the_permalink($group_id) . '?tab=requests',
          ],
        ];

        $moderators = UM()->Groups()->member()->get_moderators($group_id);
        foreach ($moderators as $key => $mod) {
          um_fetch_user($mod->uid);
          self::sendNotification($pushData, 'private', $mod->uid);
        }
        um_reset_user();
      }
    }

    public function doUmGroupInvitationPush($invited_user_id, $group_id, $invited_by_user_id)
    {
      um_fetch_user($invited_by_user_id);
      $pushData = [
        'title' => __('New Group Join Invitation', self::$textDomain),
        'body' => sprintf(__('%s has invited you to join %s.', self::$textDomain), um_user('display_name'), ucwords(get_the_title($group_id))),
        'icon' => um_get_avatar_url(get_avatar($invited_by_user_id, 40)),
        'data' => [
          'url' => get_the_permalink($group_id),
        ],
      ];

      self::sendNotification($pushData, 'private', $invited_user_id);
      um_reset_user();
    }

    public function doUmGroupRoleChangePush($user_id, $group_id, $new_role, $old_role)
    {
      um_fetch_user($user_id);
      $group_member_roles = UM()->Groups()->api()->get_member_roles();
      $pushData = [
        'title' => __('Group Role Changed', self::$textDomain),
        'body' => sprintf(__('Your group role %s has been changed to %s in %s.', self::$textDomain), $group_member_roles[$new_role], $group_member_roles[$old_role], ucwords(get_the_title($group_id))),
        'icon' => UM()->Groups()->api()->get_group_image($group_id, 'default', 50, 50, true),
        'data' => [
          'url' => get_the_permalink($group_id),
        ],
      ];

      self::sendNotification($pushData, 'private', $user_id);
      um_reset_user();
    }

    public function doUmGroupPostPush($post_id, $user_id, $wall_id)
    {
      $key = 'groups_new_post';
      if (
        !UM()
          ->options()
          ->get("log_$key")
      ) {
        return;
      }

      global $wpdb;
      $table_name = UM()->Groups()->setup()->db_groups_table;
      $group_id = get_post_meta($post_id, '_group_id', true);
      $members = $wpdb->get_col("SELECT `user_id1` FROM $table_name WHERE `group_id` = $group_id AND `status` = 'approved'");

      foreach ($members as $i => $member_id) {
        if ($user_id == $member_id) {
          unset($members[$i]);
          continue;
        }
        $prefs = get_user_meta($user_id, '_notifications_prefs', true);
        if (isset($prefs[$key]) && !$prefs[$key]) {
          unset($members[$i]);
          continue;
        }
      }

      if (empty($members)) {
        return;
      }

      um_fetch_user($user_id);
      $pushData = [
        'title' => __('New Group Post', self::$textDomain),
        'body' => sprintf(__('%s has just posted on the group %s.', self::$textDomain), um_user('display_name'), ucwords(get_the_title($group_id))),
        'icon' => um_get_avatar_url(get_avatar($user_id, 40)),
        'data' => [
          'url' => UM()->Groups()->discussion()->get_permalink($post_id),
        ],
      ];

      foreach ($members as $member_id) {
        self::sendNotification($pushData, 'private', $member_id);
      }

      um_reset_user();
    }

    public function doUmGroupCommentPush($commentid, $comment_parent, $post_id, $user_id)
    {
      $key = 'groups_new_comment';

      if (
        !UM()
          ->options()
          ->get("log_$key")
      ) {
        return;
      }

      global $wpdb;
      $table_name = UM()->Groups()->setup()->db_groups_table;
      $group_id = get_post_meta($post_id, '_group_id', true);
      $members = $wpdb->get_col("SELECT `user_id1` FROM $table_name WHERE `group_id` = $group_id AND `status` = 'approved'");

      foreach ($members as $i => $member_id) {
        if ($user_id == $member_id) {
          unset($members[$i]);
          continue;
        }
        $prefs = get_user_meta($user_id, '_notifications_prefs', true);
        if (isset($prefs[$key]) && !$prefs[$key]) {
          unset($members[$i]);
          continue;
        }
      }
      if (empty($members)) {
        return;
      }

      um_fetch_user($user_id);
      $pushData = [
        'title' => __('New Group Post Comment', self::$textDomain),
        'body' => sprintf(__('%s has just commented on post in %s.', self::$textDomain), um_user('display_name'), ucwords(get_the_title($group_id))),
        'icon' => um_get_avatar_url(get_avatar($user_id, 40)),
        'data' => [
          'url' => UM()->Groups()->discussion()->get_comment_link($post_url, $commentid),
        ],
      ];

      foreach ($members as $member_id) {
        self::sendNotification($pushData, 'private', $member_id);
      }

      um_reset_user();
    }

    public function sendScheduledNotification($notificationData)
    {
      $pushData = [
        'title' => !empty($notificationData['pushTitle']) ? $notificationData['pushTitle'] : '',
        'body' => !empty($notificationData['pushBody']) ? $notificationData['pushBody'] : '',
        'image' => !empty($notificationData['pushImage']) ? esc_url_raw(wp_get_attachment_image_src($notificationData['pushImage'], 'full')[0] ?? '') : '',
        'icon' => !empty($notificationData['pushIcon']) ? esc_url_raw(wp_get_attachment_image_src($notificationData['pushIcon'], 'full')[0] ?? '') : '',
        'data' => [
          'url' => !empty($notificationData['pushUrl']) ? trailingslashit(esc_url_raw($notificationData['pushUrl'])) . '?utm_source=pwa-notification' : '',
        ],
        'requireInteraction' => $notificationData['pushFixed'] == 'on' ? true : false,
        'vibrate' => $notificationData['pushVibrate'] == 'on' ? [200, 100, 200] : [],
      ];

      if ($notificationData['pushActionButton1'] == 'on') {
        $pushData['actions'][] = ['action' => 'action1', 'title' => $notificationData['pushActionButton1Text']];
        $pushData['data']['pushActionButton1Url'] = trailingslashit(esc_url_raw($notificationData['pushActionButton1Url']));
      }

      if ($notificationData['pushActionButton2'] == 'on') {
        $pushData['actions'][] = ['action' => 'action2', 'title' => $notificationData['pushActionButton2Text']];
        $pushData['data']['pushActionButton2Url'] = trailingslashit(esc_url_raw($notificationData['pushActionButton2Url']));
      }

      $pushData['segment'] = $notificationData['pushSegment'];

      return self::sendNotification($pushData, 'scheduled');
    }

    public function addPushToServiceWorker($serviceWorker)
    {
      $serviceWorker .=
        "self.addEventListener('push', (event) => {
                              if (event.data) {
                                  const pushData = event.data.json();
                                  event.waitUntil(self.registration.showNotification(pushData.title, pushData));
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
        admin_url('admin-ajax.php') .
        "', {
                                      method: 'POST',
                                      headers: {'Content-Type': 'application/json'},
                                      body: JSON.stringify({
                                          action: '" .
        self::$optionName .
        "_handle_subscription_update',
                                          oldEndpoint: event.oldSubscription ? event.oldSubscription.endpoint : null,
                                          newEndpoint: event.newSubscription ? event.newSubscription.endpoint : null,
                                          newUserKey: event.newSubscription ? event.newSubscription.toJSON().keys.p256dh : null,
                                          newUserAuth: event.newSubscription ? event.newSubscription.toJSON().keys.auth : null
                                      })
                                  })
                              );
                          });\n";

      return $serviceWorker;
    }

    public function addPushJsVars($vars)
    {
      $vars['pwaPublicKey'] = self::$vapidKeys['pwaPublicKey'];
      $vars['pwaSubscribeOnMsg'] = esc_html__('Notifications are turned on', self::$textDomain);
      $vars['pwaSubscribeOffMsg'] = esc_html__('Notifications are turned off', self::$textDomain);

      return $vars;
    }

    public function renderPushPrompt()
    {
      if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
        return;
      }

      include_once $this->daftplugInstantifyPwaPublic->partials['pushPrompt'];
    }

    public function renderPushButton()
    {
      if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
        return;
      }

      include_once $this->daftplugInstantifyPwaPublic->partials['pushButton'];
    }

    public static function sendNotification($pushData, $type, $targetUserId = null)
    {
      require_once plugin_dir_path(self::$pluginFile) . implode(DIRECTORY_SEPARATOR, ['pwa', 'includes', 'libs', 'vendor', 'autoload.php']);

      $auth = [
        'VAPID' => [
          'subject' => get_bloginfo('wpurl'),
          'publicKey' => self::$vapidKeys['pwaPublicKey'],
          'privateKey' => self::$vapidKeys['pwaPrivateKey'],
        ],
      ];

      $defaultOptions = [
        'TTL' => (int) daftplugInstantify::getSetting('pwaPushTtl'),
        'batchSize' => (int) daftplugInstantify::getSetting('pwaPushBatchSize'),
      ];

      $webPush = new WebPush($auth, $defaultOptions, 6, ['verify' => false]);
      $webPush->setDefaultOptions($defaultOptions);
      $webPush->setAutomaticPadding(false);
      $webPush->setReuseVAPIDHeaders(true);

      $pushData = wp_parse_args($pushData, [
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

      switch ($type) {
        case 'wooNewOrder':
          $subscriptions = [];
          foreach (self::$subscribedDevices as $subscribedDevice) {
            if (in_array(daftplugInstantify::getSetting('pwaPushWooNewOrderRole'), $subscribedDevice['roles'])) {
              $subscriptions[] = [
                'subscription' => Subscription::create([
                  'endpoint' => $subscribedDevice['endpoint'],
                  'publicKey' => $subscribedDevice['userKey'],
                  'authToken' => $subscribedDevice['userAuth'],
                ]),
                'payload' => null,
              ];
            }
          }

          foreach ($subscriptions as $subscription) {
            $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
          }
          break;
        case 'wooLowStock':
          $subscriptions = [];
          foreach (self::$subscribedDevices as $subscribedDevice) {
            if (in_array(daftplugInstantify::getSetting('pwaPushWooLowStockRole'), $subscribedDevice['roles'])) {
              $subscriptions[] = [
                'subscription' => Subscription::create([
                  'endpoint' => $subscribedDevice['endpoint'],
                  'publicKey' => $subscribedDevice['userKey'],
                  'authToken' => $subscribedDevice['userAuth'],
                ]),
                'payload' => null,
              ];
            }
          }

          foreach ($subscriptions as $subscription) {
            $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
          }
          break;
        case 'wooAbandonedCart':
          $subscription = [
            'subscription' => Subscription::create([
              'endpoint' => self::$subscribedDevices[$pushData['segment']]['endpoint'],
              'publicKey' => self::$subscribedDevices[$pushData['segment']]['userKey'],
              'authToken' => self::$subscribedDevices[$pushData['segment']]['userAuth'],
            ]),
            'payload' => null,
          ];

          $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
          break;
        case 'private':
          $subscriptions = [];
          foreach (self::$subscribedDevices as $subscribedDevice) {
            if ($targetUserId == $subscribedDevice['user']) {
              $subscriptions[] = [
                'subscription' => Subscription::create([
                  'endpoint' => $subscribedDevice['endpoint'],
                  'publicKey' => $subscribedDevice['userKey'],
                  'authToken' => $subscribedDevice['userAuth'],
                ]),
                'payload' => null,
              ];
            }
          }

          foreach ($subscriptions as $subscription) {
            $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
          }
          break;
        case 'scheduled':
          switch ($pushData['segment']) {
            case 'all':
              $subscriptions = [];
              foreach (self::$subscribedDevices as $subscribedDevice) {
                $subscriptions[] = [
                  'subscription' => Subscription::create([
                    'endpoint' => $subscribedDevice['endpoint'],
                    'publicKey' => $subscribedDevice['userKey'],
                    'authToken' => $subscribedDevice['userAuth'],
                  ]),
                  'payload' => null,
                ];
              }

              foreach ($subscriptions as $subscription) {
                $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
              }
              break;
            case 'mobile':
              $subscriptions = [];
              foreach (self::$subscribedDevices as $subscribedDevice) {
                if (preg_match('[Android|iOS]', $subscribedDevice['deviceInfo'])) {
                  $subscriptions[] = [
                    'subscription' => Subscription::create([
                      'endpoint' => $subscribedDevice['endpoint'],
                      'publicKey' => $subscribedDevice['userKey'],
                      'authToken' => $subscribedDevice['userAuth'],
                    ]),
                    'payload' => null,
                  ];
                }
              }

              foreach ($subscriptions as $subscription) {
                $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
              }
              break;
            case 'desktop':
              $subscriptions = [];
              foreach (self::$subscribedDevices as $subscribedDevice) {
                if (preg_match('[Windows|Linux|Mac|Ubuntu|Solaris]', $subscribedDevice['deviceInfo'])) {
                  $subscriptions[] = [
                    'subscription' => Subscription::create([
                      'endpoint' => $subscribedDevice['endpoint'],
                      'publicKey' => $subscribedDevice['userKey'],
                      'authToken' => $subscribedDevice['userAuth'],
                    ]),
                    'payload' => null,
                  ];
                }
              }

              foreach ($subscriptions as $subscription) {
                $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
              }
              break;
            case 'registered':
              $subscriptions = [];
              foreach (self::$subscribedDevices as $subscribedDevice) {
                if (is_numeric($subscribedDevice['user'])) {
                  $subscriptions[] = [
                    'subscription' => Subscription::create([
                      'endpoint' => $subscribedDevice['endpoint'],
                      'publicKey' => $subscribedDevice['userKey'],
                      'authToken' => $subscribedDevice['userAuth'],
                    ]),
                    'payload' => null,
                  ];
                }
              }

              foreach ($subscriptions as $subscription) {
                $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
              }
              break;
            case 'unregistered':
              $subscriptions = [];
              foreach (self::$subscribedDevices as $subscribedDevice) {
                if ($subscribedDevice['user'] == 'Unregistered') {
                  $subscriptions[] = [
                    'subscription' => Subscription::create([
                      'endpoint' => $subscribedDevice['endpoint'],
                      'publicKey' => $subscribedDevice['userKey'],
                      'authToken' => $subscribedDevice['userAuth'],
                    ]),
                    'payload' => null,
                  ];
                }
              }

              foreach ($subscriptions as $subscription) {
                $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
              }
              break;
            case substr($pushData['segment'], 0, 7) === 'Country':
              $country = str_replace('Country - ', '', $pushData['segment']);
              $subscriptions = [];
              foreach (self::$subscribedDevices as $subscribedDevice) {
                if ($subscribedDevice['country'] == $country) {
                  $subscriptions[] = [
                    'subscription' => Subscription::create([
                      'endpoint' => $subscribedDevice['endpoint'],
                      'publicKey' => $subscribedDevice['userKey'],
                      'authToken' => $subscribedDevice['userAuth'],
                    ]),
                    'payload' => null,
                  ];
                }
              }

              foreach ($subscriptions as $subscription) {
                $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
              }
              break;
            default:
              $subscription = [
                'subscription' => Subscription::create([
                  'endpoint' => self::$subscribedDevices[$pushData['segment']]['endpoint'],
                  'publicKey' => self::$subscribedDevices[$pushData['segment']]['userKey'],
                  'authToken' => self::$subscribedDevices[$pushData['segment']]['userAuth'],
                ]),
                'payload' => null,
              ];

              $webPush->queueNotification($subscription['subscription'], json_encode($pushData));
          }
          break;
        default:
          echo 'Undefined Push Type.';
      }

      $reportMessages = [];
      foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();
        if ($report->isSuccess()) {
          $reportMessages[] = '[V] Notification sent successfully for ' . self::$subscribedDevices[$endpoint]['deviceInfo'];
        } else {
          unset(self::$subscribedDevices[$endpoint]);
          update_option(self::$optionName . '_subscribed_devices', self::$subscribedDevices);
          $reportMessages[] = '[X] Notification failed to sent for ' . self::$subscribedDevices[$endpoint]['deviceInfo'];
        }
      }

      return $reportMessages;
    }
  }
}
