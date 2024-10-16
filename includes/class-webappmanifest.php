<?php

namespace DaftPlug;

if (!defined('ABSPATH')) {
  exit();
}

class WebAppManifest
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

    add_action("wp_ajax_{$this->optionName}_generate_launch_screens_and_maskable_icons", [$this, 'generateLaunchScreensAndMakableIcons']);
    add_action('parse_request', [$this, 'generateManifest']);
    add_action('parse_request', [$this, 'generateWebAppOriginAssociation']);
    add_action('wp_head', [$this, 'renderMetaTagsInHeader'], 0);
    add_filter("{$this->optionName}_public_css", [$this, 'addAccentColor']);
    add_action("wp_ajax_{$this->optionName}_display_coupon_reward", [$this, 'generateCouponPopup']);
    add_action("wp_ajax_nopriv_{$this->optionName}_display_coupon_reward", [$this, 'generateCouponPopup']);
    add_shortcode('pwa-install-button', [$this, 'renderInstallationButton']);

    if (wp_is_mobile()) {
      if (daftplugInstantify::getSetting('pwaOverlays') == 'on' || daftplugInstantify::getSetting('pwaInstallButton') == 'on') {
        add_filter("{$this->optionName}_public_html", [$this, 'renderFullscreenOverlays']);
        if (daftplugInstantify::getSetting('pwaOverlays') == 'on') {
          if (daftplugInstantify::getSetting('pwaOverlaysTypeHeader') == 'on') {
            add_filter("{$this->optionName}_public_html", [$this, 'renderHeaderOverlay']);
          }
          if (daftplugInstantify::getSetting('pwaOverlaysTypeSnackbar') == 'on') {
            add_filter("{$this->optionName}_public_html", [$this, 'renderSnackbarOverlay']);
          }
          if (daftplugInstantify::getSetting('pwaOverlaysTypePost') == 'on') {
            add_filter("{$this->optionName}_public_html", [$this, 'renderPostOverlay']);
          }
          if (daftplugInstantify::getSetting('pwaOverlaysTypeIos') == 'on' && in_array('safari', (array) daftplugInstantify::getSetting('pwaOverlaysBrowsers'))) {
            add_filter("{$this->optionName}_public_html", [$this, 'renderIosOverlay']);
          }
          if (daftplugInstantify::getSetting('pwaOverlaysTypeMenu') == 'on') {
            add_filter('wp_nav_menu_items', [$this, 'renderMenuOverlay'], 10, 2);
          }
          if (daftplugInstantify::getSetting('pwaOverlaysTypeFeed') == 'on') {
            add_action('loop_start', [$this, 'renderFeedOverlay']);
          }
          if (daftplugInstantify::isWooCommerceActive()) {
            if (daftplugInstantify::getSetting('pwaOverlaysTypeCheckout') == 'on') {
              add_action('woocommerce_review_order_after_payment', [$this, 'renderCheckoutOverlay']);
            }
            if (daftplugInstantify::getSetting('pwaOverlaysTypeCoupon') == 'on' && get_option('woocommerce_enable_coupons') == 'yes') {
              add_filter("{$this->optionName}_public_html", [$this, 'renderCouponOverlay']);
            }
          }
        }
      }
    }
  }

  public function generateLaunchScreensAndMakableIcons()
  {
    if (isset($this->settings['pwaIcon'])) {
      if (isset($_POST['launchScreen']) && !empty($_POST['launchScreen']) && (isset($_POST['maskableIcon']) && !empty($_POST['maskableIcon']))) {
        $launchScreen = substr($_POST['launchScreen'], strpos($_POST['launchScreen'], ',') + 1);
        $maskableIcon = substr($_POST['maskableIcon'], strpos($_POST['maskableIcon'], ',') + 1);
        $decodedLaunchScreen = base64_decode($launchScreen);
        $decodedMaskableIcon = base64_decode($maskableIcon);
        $launchScreenName = $this->pluginUploadDir . 'img-pwa-apple-launch.png';
        $maskableIconName = $this->pluginUploadDir . 'icon-pwa-maskable.png';

        Plugin::putContent($launchScreenName, $decodedLaunchScreen);
        Plugin::putContent($maskableIconName, $decodedMaskableIcon);

        if (file_exists($launchScreenName)) {
          $launchScreenImage = wp_get_image_editor($launchScreenName);
          if (!is_wp_error($launchScreenImage)) {
            $sizesArray = [['width' => 640, 'height' => 1136, 'crop' => true], ['width' => 750, 'height' => 1334, 'crop' => true], ['width' => 828, 'height' => 1792, 'crop' => true], ['width' => 1125, 'height' => 2436, 'crop' => true], ['width' => 1170, 'height' => 2532, 'crop' => true], ['width' => 1179, 'height' => 2256, 'crop' => true], ['width' => 1242, 'height' => 2208, 'crop' => true], ['width' => 1242, 'height' => 2688, 'crop' => true], ['width' => 1284, 'height' => 2778, 'crop' => true], ['width' => 1290, 'height' => 2796, 'crop' => true], ['width' => 1536, 'height' => 2048, 'crop' => true], ['width' => 1620, 'height' => 2160, 'crop' => true], ['width' => 1640, 'height' => 2360, 'crop' => true], ['width' => 1668, 'height' => 2224, 'crop' => true], ['width' => 1668, 'height' => 2388, 'crop' => true], ['width' => 2048, 'height' => 2732, 'crop' => true]];

            $launchScreenImage->multi_resize($sizesArray);
            $launchScreenImage->save();
          }
        }

        if (file_exists($maskableIconName)) {
          $maskableIconImage = wp_get_image_editor($maskableIconName);
          if (!is_wp_error($maskableIconImage)) {
            $sizesArray = [['width' => 192, 'height' => 192, 'crop' => true], ['width' => 180, 'height' => 180, 'crop' => true]];

            $maskableIconImage->multi_resize($sizesArray);
            $maskableIconImage->save();
          }
        }

        wp_send_json_success([
          'message' => esc_html__('Launch Screens and Makable Icons are generated successfully!', $this->textDomain),
        ]);
      }
    } else {
      wp_send_json_error([
        'message' => esc_html__('Launch Screens and Makable Icons generation failed!', $this->textDomain),
      ]);
    }
  }

  public function generateManifest()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === self::$manifestName) {
      $wp_query->set(self::$manifestName, 1);
    }

    if ($wp_query->get(self::$manifestName)) {
      @ini_set('display_errors', 0);
      @header('Cache-Control: no-cache');
      @header('X-Robots-Tag: noindex, follow');
      @header('Content-Type: application/manifest+json; charset=utf-8');
      $homeUrlParts = wp_parse_url(trailingslashit(strtok(home_url('/', 'https'), '?')));
      $scope = '/';
      if (array_key_exists('path', $homeUrlParts)) {
        $scope = $homeUrlParts['path'];
      }

      if (daftplugInstantify::getSetting('pwaDetectionMode') == 'queryParameter') {
        $startUrl = add_query_arg('isPwa', 'true', !empty($_GET['start_url']) ? $_GET['start_url'] : trailingslashit(wp_make_link_relative(daftplugInstantify::getSetting('pwaStartPage'))));
      } else {
        $startUrl = !empty($_GET['start_url']) ? $_GET['start_url'] : trailingslashit(wp_make_link_relative(daftplugInstantify::getSetting('pwaStartPage')));
      }

      $manifestShortName = strlen(daftplugInstantify::getSetting('pwaShortName')) > 12 ? substr(daftplugInstantify::getSetting('pwaShortName'), 0, 9) . '...' : daftplugInstantify::getSetting('pwaShortName');

      if (get_bloginfo('language')) {
        $this->manifest['lang'] = get_bloginfo('language');
      }

      $this->manifest['id'] = hash('crc32', daftplugInstantify::getDomainFromUrl(trailingslashit(strtok(home_url('/', 'https'), '?'))));
      $this->manifest['dir'] = is_rtl() ? 'rtl' : 'ltr';
      $this->manifest['name'] = trim(!empty($_GET['name']) ? $_GET['name'] : daftplugInstantify::getSetting('pwaName'));
      $this->manifest['scope'] = $scope;
      $this->manifest['start_url'] = $startUrl;
      $this->manifest['scope_extensions'][] = ['origin' => 'https://*.' . daftplugInstantify::getDomainFromUrl(trailingslashit(strtok(home_url('/', 'https'), '?')))];
      $this->manifest['short_name'] = trim(!empty($_GET['short_name']) ? $_GET['short_name'] : $manifestShortName);
      $this->manifest['description'] = trim(!empty($_GET['description']) ? $_GET['description'] : daftplugInstantify::getSetting('pwaDescription'));
      $this->manifest['display_override'] = (array) daftplugInstantify::getSetting('pwaDisplayMode');
      $this->manifest['display'] = daftplugInstantify::getSetting('pwaDisplayMode');
      $this->manifest['orientation'] = daftplugInstantify::getSetting('pwaOrientation');
      $this->manifest['handle_links'] = daftplugInstantify::getSetting('pwaHandleLinks');
      $this->manifest['theme_color'] = daftplugInstantify::getSetting('pwaThemeColor');
      $this->manifest['background_color'] = daftplugInstantify::getSetting('pwaBackgroundColor');
      $this->manifest['categories'] = (array) daftplugInstantify::getSetting('pwaCategories');
      if (!empty(daftplugInstantify::getSetting('pwaIarcRatingId'))) {
        $this->manifest['iarc_rating_id'] = daftplugInstantify::getSetting('pwaIarcRatingId');
      }
      $this->manifest['prefer_related_applications'] = daftplugInstantify::getSetting('pwaRelatedApplication1') == 'on' ? true : false;
      for ($ra = 1; $ra <= 3; $ra++) {
        if (daftplugInstantify::getSetting(sprintf('pwaRelatedApplication%s', $ra)) == 'on') {
          $this->manifest['related_applications'][] = [
            'platform' => daftplugInstantify::getSetting(sprintf('pwaRelatedApplication%sPlatform', $ra)),
            'url' => daftplugInstantify::getSetting(sprintf('pwaRelatedApplication%sUrl', $ra)),
            'id' => daftplugInstantify::getSetting(sprintf('pwaRelatedApplication%sId', $ra)),
          ];
        }
      }
      $icon = !empty($_GET['icon']) ? $_GET['icon'] : daftplugInstantify::getSetting('pwaIcon');
      $iconWidth = wp_get_attachment_image_src($icon, 'full')[1];
      $iconSizes = [180, 192, 512];
      if (wp_attachment_is_image(intval($icon))) {
        foreach ($iconSizes as $iconSize) {
          if ($iconWidth < $iconSize) {
            continue;
          }

          $newIcon = daftplugInstantifyPwa::resizeImage($icon, $iconSize, $iconSize, 'png', true);

          if ($newIcon[1] != $iconSize) {
            continue;
          }

          $this->manifest['icons'][] = [
            'src' => $newIcon[0],
            'sizes' => "{$iconSize}x{$iconSize}",
            'type' => 'image/png',
            'purpose' => 'any',
          ];

          if (file_exists($this->pluginUploadDir . 'icon-pwa-maskable.png')) {
            $this->manifest['icons'][] = [
              'src' => "{$this->pluginUploadUrl}icon-pwa-maskable-{$iconSize}x{$iconSize}.png",
              'sizes' => "{$iconSize}x{$iconSize}",
              'type' => 'image/png',
              'purpose' => 'maskable',
            ];
          } else {
            $this->manifest['icons'][] = [
              'src' => $newIcon[0],
              'sizes' => "{$iconSize}x{$iconSize}",
              'type' => 'image/png',
              'purpose' => 'maskable',
            ];
          }
        }
      }

      $screenshotOptionNames = ['pwaScreenshot1', 'pwaScreenshot2', 'pwaScreenshot3', 'pwaScreenshot4', 'pwaScreenshot5'];
      foreach ($screenshotOptionNames as $screenshotOptionName) {
        $screenshotId = daftplugInstantify::getSetting($screenshotOptionName);
        if (wp_attachment_is_image(intval($screenshotId))) {
          $this->manifest['screenshots'][] = [
            'src' => wp_get_attachment_image_src($screenshotId, 'full')[0],
            'sizes' => wp_get_attachment_image_src($screenshotId, 'full')[1] . 'x' . wp_get_attachment_image_src($screenshotId, 'full')[2],
            'type' => 'image/png',
          ];
        } else {
          if ($screenshotOptionName == 'pwaScreenshot1') {
            $this->manifest['screenshots'][] = [
              'src' => 'https://s0.wp.com/mshots/v1/' . trailingslashit(daftplugInstantify::getSetting('pwaStartPage')) . '?vpw=750&vph=1334',
              'sizes' => '750x1334',
              'type' => 'image/png',
            ];
          }

          if ($screenshotOptionName == 'pwaScreenshot2') {
            $this->manifest['screenshots'][] = [
              'src' => 'https://s0.wp.com/mshots/v1/' . trailingslashit(daftplugInstantify::getSetting('pwaStartPage')) . '?vpw=1280&vph=800',
              'sizes' => '1280x800',
              'type' => 'image/png',
            ];
          }
        }
      }

      $appShortcutOptionNames = ['pwaAppShortcut1', 'pwaAppShortcut2', 'pwaAppShortcut3', 'pwaAppShortcut4'];
      foreach ($appShortcutOptionNames as $appShortcutOptionName) {
        $icon = daftplugInstantifyPwa::resizeImage(daftplugInstantify::getSetting($appShortcutOptionName . 'Icon'), '96', '96', 'png', true);
        if (daftplugInstantify::getSetting($appShortcutOptionName) == 'on') {
          $this->manifest['shortcuts'][] = [
            'name' => daftplugInstantify::getSetting($appShortcutOptionName . 'Name'),
            'short_name' => substr(daftplugInstantify::getSetting($appShortcutOptionName . 'Name'), 0, 12),
            'url' => daftplugInstantify::getSetting($appShortcutOptionName . 'Url'),
          ];

          if (wp_attachment_is_image(intval(daftplugInstantify::getSetting($appShortcutOptionName . 'Icon')))) {
            $this->manifest['shortcuts'][0]['icons'][] = [
              'src' => $icon[0],
              'sizes' => '96x96',
              'type' => 'image/png',
            ];
          }
        }
      }

      $this->manifest = apply_filters("{$this->optionName}_pwa_manifest", $this->manifest);
      $this->manifest = wp_json_encode($this->manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

      echo $this->manifest;
      exit();
    }
  }

  public function generateWebAppOriginAssociation()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === '.well-known/web-app-origin-association') {
      $wp_query->set('.well-known/web-app-origin-association', 1);
    }

    if ($wp_query->get('.well-known/web-app-origin-association')) {
      @ini_set('display_errors', 0);
      @header('Cache-Control: no-cache');
      @header('X-Robots-Tag: noindex, follow');
      @header('Content-Type: application/json; charset=utf-8');

      $webAppOriginAssociation = [
        'web_apps' => [
          [
            'manifest' => $this->getManifestUrl(false),
            'details' => [
              'paths' => ['/*'],
            ],
          ],
        ],
      ];

      echo wp_json_encode($webAppOriginAssociation, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      exit();
    }
  }

  public function addAccentColor()
  {
    if (!daftplugInstantifyPwa::isPwaAvailable()) {
      return;
    }

    echo '
          :root {
              accent-color: ' .
      daftplugInstantify::getSetting('pwaThemeColor') .
      ';
          }
      ';
  }

  public function renderMetaTagsInHeader()
  {
    if (!daftplugInstantifyPwa::isPwaAvailable()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['metaTags'];
  }

  public function renderFullscreenOverlays()
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['fullscreenOverlays'];
  }

  public function renderHeaderOverlay()
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['headerOverlay'];
  }

  public function renderSnackbarOverlay()
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['snackbarOverlay'];
  }

  public function renderPostOverlay()
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable() || !is_single()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['postOverlay'];
  }

  public function renderIosOverlay()
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['iosOverlay'];
  }

  public function renderMenuOverlay($items, $args)
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
      return $items;
    } else {
      $appIcon = @wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), [150, 150])[0];
      $message = esc_html__(daftplugInstantify::getSetting('pwaOverlaysTypeMenuMessage'), $this->textDomain);
      $backgroundColor = daftplugInstantify::getSetting('pwaOverlaysTypeMenuBackgroundColor');
      $textColor = daftplugInstantify::getSetting('pwaOverlaysTypeMenuTextColor');
      $notNow = esc_html__('Not now', $this->textDomain);
      $install = esc_html__('Install', $this->textDomain);

      $items .=
        '<div class="daftplugPublic" data-daftplug-plugin="' .
        $this->optionName .
        '">
                        <div class="daftplugPublicMenuOverlay" style="background: ' .
        $backgroundColor .
        '; color: ' .
        $textColor .
        ';">
                            <div class="daftplugPublicMenuOverlay_content">
                                <img class="daftplugPublicMenuOverlay_icon" src="' .
        $appIcon .
        '">
                                <span class="daftplugPublicMenuOverlay_msg">' .
        $message .
        '</span>
                            </div>
                            <div class="daftplugPublicMenuOverlay_buttons">
                                <div class="daftplugPublicMenuOverlay_dismiss" style="color: ' .
        $textColor .
        ';">' .
        $notNow .
        '</div>
                                <div class="daftplugPublicMenuOverlay_install" style="background: ' .
        $textColor .
        '; color: ' .
        $backgroundColor .
        ';">' .
        $install .
        '</div>
                            </div>
                        </div>
                    </div>';

      return $items;
    }
  }

  public function renderFeedOverlay($query)
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
      return;
    }

    if ($query->is_main_query()) {
      add_action('the_post', function () {
        static $nr = 0;
        if (++$nr == 4) {
          $appIcon = @wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), [150, 150])[0];
          $message = esc_html__(daftplugInstantify::getSetting('pwaOverlaysTypeFeedMessage'), $this->textDomain);
          $backgroundColor = daftplugInstantify::getSetting('pwaOverlaysTypeFeedBackgroundColor');
          $textColor = daftplugInstantify::getSetting('pwaOverlaysTypeFeedTextColor');
          $notNow = esc_html__('Not now', $this->textDomain);
          $install = esc_html__('Install', $this->textDomain);

          echo '<div class="daftplugPublic" data-daftplug-plugin="' .
            $this->optionName .
            '">
                            <div class="daftplugPublicFeedOverlay" style="background: ' .
            $backgroundColor .
            '; color: ' .
            $textColor .
            ';">
                                <div class="daftplugPublicFeedOverlay_content">
                                    <img class="daftplugPublicFeedOverlay_icon" src="' .
            $appIcon .
            '">
                                    <span class="daftplugPublicFeedOverlay_msg">' .
            $message .
            '</span>
                                </div>
                                <div class="daftplugPublicFeedOverlay_buttons">
                                    <div class="daftplugPublicFeedOverlay_dismiss" style="color: ' .
            $textColor .
            ';">' .
            $notNow .
            '</div>
                                    <div class="daftplugPublicFeedOverlay_install" style="background: ' .
            $textColor .
            '; color: ' .
            $backgroundColor .
            ';">' .
            $install .
            '</div>
                                </div>
                            </div>
                        </div>';
        }
      });
    }
  }

  public function renderCheckoutOverlay()
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable() || !daftplugInstantify::isWooCommerceActive()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['checkoutOverlay'];
  }

  public function renderCouponOverlay()
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable() || !daftplugInstantify::isWooCommerceActive()) {
      return;
    }

    include_once $this->daftplugInstantifyPwaPublic->partials['couponOverlay'];
  }

  public function renderInstallationButton($atts)
  {
    if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable() || daftplugInstantify::getSetting('pwaInstallButton') !== 'on') {
      return;
    }

    $backgroundColor = daftplugInstantify::getSetting('pwaInstallButtonBackgroundColor');
    $textColor = daftplugInstantify::getSetting('pwaInstallButtonTextColor');
    $text = esc_html__(daftplugInstantify::getSetting('pwaInstallButtonText'), $this->textDomain);

    $installButton =
      '<div class="daftplugPublic" data-daftplug-plugin="' .
      $this->optionName .
      '">
                          <button class="daftplugPublicInstallButton" style="background: ' .
      $backgroundColor .
      '; color: ' .
      $textColor .
      ';">' .
      $text .
      '</button>
                        </div>';

    return $installButton;
  }

  public function generateCouponPopup()
  {
    if (wp_is_mobile() && !daftplugInstantify::isAmpPage() && daftplugInstantify::isWooCommerceActive() && daftplugInstantify::getSetting('pwaOverlaysTypeCoupon') == 'on' && get_option('woocommerce_enable_coupons') == 'yes') {
      $couponCode = strtoupper(substr(substr('ABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(0, 50), 1) . substr(md5(time()), 1), 0, 7));
      $discountPercentage = daftplugInstantify::getSetting('pwaOverlaysTypeCouponPercentage');
      $coupon = [
        'post_title' => $couponCode,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'shop_coupon',
      ];
      $couponId = wp_insert_post($coupon);
      update_post_meta($couponId, 'discount_type', 'percent');
      update_post_meta($couponId, 'coupon_amount', $discountPercentage);
      update_post_meta($couponId, 'individual_use', 'yes');
      update_post_meta($couponId, 'product_ids', '');
      update_post_meta($couponId, 'exclude_product_ids', '');
      update_post_meta($couponId, 'usage_limit', '1');
      update_post_meta($couponId, 'expiry_date', strtotime('+10 days'));
      update_post_meta($couponId, 'apply_before_tax', 'no');
      update_post_meta($couponId, 'free_shipping', 'no');
      update_post_meta($couponId, 'exclude_sale_items', 'no');
      update_post_meta($couponId, 'free_shipping', 'no');
      update_post_meta($couponId, 'product_categories', '');
      update_post_meta($couponId, 'exclude_product_categories', '');
      update_post_meta($couponId, 'minimum_amount', '');

      if ($couponCode) {
        wp_send_json_success([
          'couponCode' => $couponCode,
          'iconUrl' => plugins_url('pwa/public/assets/img/icon-present.png', $this->pluginFile),
          'title' => __('CONGRATULATIONS', $this->textDomain),
          'message' => sprintf(__('Thank you for installing and using our web app. Your %s%% reward coupon is available below. Tap on it to copy your coupon code.', $this->textDomain), $discountPercentage),
        ]);
      } else {
        wp_send_json_error();
      }
    } else {
      wp_send_json_error();
    }
  }

  public function getManifestUrl($encoded = true)
  {
    $url = untrailingslashit(strtok(home_url('/', 'https'), '?') . self::$manifestName);
    $queryArgs = [];

    if (is_singular()) {
      global $post;
      $postPwaName = get_post_meta($post->ID, 'pwaName', true);
      $postPwaShortName = get_post_meta($post->ID, 'pwaShortName', true);
      $postPwaDescription = get_post_meta($post->ID, 'pwaDescription', true);
      $postPwaIcon = get_post_meta($post->ID, 'pwaIcon', true);

      if (!empty($postPwaName)) {
        $queryArgs['name'] = $postPwaName;
      } else {
        if (daftplugInstantify::getSetting('pwaDynamicManifest') == 'on') {
          $queryArgs['name'] = get_the_title();
        }
      }

      if (!empty($postPwaShortName)) {
        $queryArgs['short_name'] = $postPwaShortName;
      } else {
        if (daftplugInstantify::getSetting('pwaDynamicManifest') == 'on') {
          $queryArgs['short_name'] = strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 9) . '...' : get_the_title();
        }
      }

      if (!empty($postPwaDescription)) {
        $queryArgs['description'] = $postPwaDescription;
      } else {
        if (daftplugInstantify::getSetting('pwaDynamicManifest') == 'on') {
          $queryArgs['description'] = strlen(strip_tags(get_the_excerpt())) > 70 ? substr(strip_tags(get_the_excerpt()), 0, 70) . '...' : strip_tags(get_the_excerpt());
        }
      }

      if (!empty($postPwaIcon)) {
        $queryArgs['icon'] = $postPwaIcon;
      }

      if (!empty($postPwaName) || !empty($postPwaShortName) || !empty($postPwaDescription) || !empty($postPwaIcon) || daftplugInstantify::getSetting('pwaDynamicManifest') == 'on') {
        $queryArgs['start_url'] = wp_make_link_relative(daftplugInstantify::getCurrentUrl());
      }
    }

    $manifestUrl = add_query_arg($queryArgs, $url);
    if ($encoded) {
      return wp_json_encode($manifestUrl);
    }

    return $manifestUrl;
  }
}
