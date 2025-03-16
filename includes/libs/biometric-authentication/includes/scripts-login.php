<?php

use PasswordlessWP\AssetResolver;
use PasswordlessWP\PublicKeyCredentialSourceRepository;

if (!defined('ABSPATH')) {
  die();
}

function plwp_login_enqueue_scripts()
{
  global $action;

  //$is_debug = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG;

  $t = [
    'errorNoCreds' => __('No credentials available or not confirmed. Please try more or re-attach using Username and Password.', 'daftplug-instantify'),
    'tokenAdded' => __('Your token was registered, now you can use it to login.', 'daftplug-instantify'),
    'loginDesc' => __('Use Face ID or Touch ID to log into your account.', 'daftplug-instantify'),
    'requiredSSL' => __('Secure context are required. You must have HTTPS and SSL enabled.', 'daftplug-instantify'),
    'anotherUser' => __('Choose user', 'daftplug-instantify'),
    'suportedText' => __('Attach your Face ID or Touch ID credentials on the next step for fast authentication.', 'daftplug-instantify'),
    'useCorrectBrowserOrLogin' => __('<strong>Try supported browser or use your Username and Password to log in.</strong>', 'daftplug-instantify'),
    'unsuportedText' => __('Your browser does not support passwordless authentication using Touch or Face IDs or your system does not have device.', 'daftplug-instantify'),
  ];

  $settings = [
    'cantWork' => plwp_cant_work() !== false,
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'pluginUrl' => PLWP_URL,
    't' => $t,
  ];

  if ($action === 'login') {
    AssetResolver::resolveAll(PLWP_SLUG, 'login', true, [
      'WP_TOUCH_LOGIN' => array_merge($settings, [
        'nonce' => wp_create_nonce('plwp_login'),
        'hasCredentials' => get_option('plwp_has_credentials', false),
      ]),
    ]);
  } elseif ($action === 'attach_touch' || $action === 'attach_touch_success') {
    AssetResolver::resolveAll(PLWP_SLUG, 'attach', true, [
      'WP_TOUCH_LOGIN' => array_merge($settings, [
        'nonce' => wp_create_nonce('plwp_register'),
      ]),
    ]);
  }
}

function plwp_login_form_login()
{
  if (isset($_REQUEST['plwp_supported']) && !empty($_REQUEST['plwp_supported'])) {
    add_filter('login_redirect', 'plwp_login_form_login_redirect', 1000, 3);
  }
}

function plwp_get_url_attach_touch()
{
  $url = wp_login_url();
  $url = add_query_arg('action', 'attach_touch', $url);
  return $url;
}
function plwp_get_url_attach_touch_success()
{
  $url = wp_login_url();
  $url = add_query_arg('action', 'attach_touch_success', $url);
  return $url;
}

function plwp_login_form_login_redirect($redirect_to, $requested_redirect_to, $user)
{
  if (!$user || is_wp_error($user) || !is_ssl()) {
    return $redirect_to;
  }

  if ($user) {
    $credentialSourceRepository = new PublicKeyCredentialSourceRepository($user->ID);
    if ($credentialSourceRepository->hasCredentials()) {
      return $redirect_to;
    }
  }

  $url = plwp_get_url_attach_touch();
  $url = add_query_arg('redirect_to', $redirect_to, $url);
  return $url;
}

function plwp_wp_login_errors($errors, $redirect_to)
{
  if (isset($_REQUEST['plwp_redirected'])) {
    $reason = $_REQUEST['plwp_redirected'];

    if ($reason == 'not_logged') {
      $errors->add('loggedout', __('Please log in to attach your passwordless credentials.', 'daftplug-instantify'), 'message');
    } elseif ($reason == 'no_ssl') {
      $errors->add('loggedout', __('PasswordlessWP supports only HTTPS. You can test it on localhost without HTTPS.', 'daftplug-instantify'), 'message');
    }
  }

  return $errors;
}

function plwp_login_form_attach_touch()
{
  $error = false;

  if (!is_user_logged_in()) {
    $error = 'not_logged';
  } else {
    $cant_error = plwp_cant_work();
    if ($cant_error) {
      $error = $cant_error;
    }
  }

  if ($error !== false) {
    $url = wp_login_url();
    $url = add_query_arg('plwp_redirected', $error, $url);
    $url = add_query_arg('redirect_url', plwp_get_url_attach_touch(), $url);
    wp_safe_redirect($url);
    exit();
  }

  login_header(__('Attaching your Passwordless credentials', 'daftplug-instantify'));

  $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : admin_url('profile.php');

  $current_user = wp_get_current_user();
  ?>
  <form id="attachform" class="admin-attach" onSubmit="return false;">
    <h1 class="admin-email__heading"><?php esc_html_e('Passwordless credentials adding', 'daftplug-instantify'); ?></h1>
    <div class="admin-attach__body">
      <div class="admin-attach__body-left">
        <p class="admin-email__details">
          <?php esc_html_e('Generate token for biometric authentication, touch your fingerprint device or use you camera if your device use that method.', 'daftplug-instantify'); ?> <a href="javascript: void(0)" rel="noopener noreferrer" target="_blank"><?php esc_html_e('Which devices are supported?', 'daftplug-instantify'); ?></a> </p>
        <p class="admin-email__details">
          <?php esc_html_e('Username:', 'daftplug-instantify'); ?> <strong><?php esc_html_e($current_user->user_login); ?></strong> </p>

        <div class="admin-email__actions">
          <div class="wtl-error"></div>

          <div class="admin-email__actions-primary">
            <a id="attach-btn" class="button button-primary button-large" style="margin: 0;"><?php esc_html_e('Register Token', 'daftplug-instantify'); ?></a>
          </div>
          <div class="admin-email__actions-secondary" style="margin-top: 20px;">
            <a href="<?php esc_attr_e($redirect_to); ?>" rel="noopener noreferrer"><?php esc_html_e('Skip', 'daftplug-instantify'); ?></a>
          </div>
        </div>
      </div>
      <div class="admin-attach__body-image">
      </div>
    </div>
  </form>
<?php
login_footer();
exit();
}
function plwp_login_form_attach_touch_success()
{
  $error = false;

  if (!is_user_logged_in()) {
    $error = 'not_logged';
  } elseif (!is_ssl()) {
    $error = 'no_ssl';
  }

  if ($error !== false) {
    $url = wp_login_url();
    $url = add_query_arg('plwp_redirected', $error, $url);
    $url = add_query_arg('redirect_url', plwp_get_url_attach_touch(), $url);
    wp_safe_redirect($url);
    exit();
  }

  login_header(__('Attaching your Passwordless credentials', 'daftplug-instantify'));

  $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : false;

  $btn = [
    'href' => $redirect_to,
    'text' => __('Next', 'daftplug-instantify'),
  ];

  if (!$redirect_to) {
    $btn = [
      'href' => get_edit_profile_url() . '#wtl',
      'text' => __('Go to My Profile', 'daftplug-instantify'),
    ];
  }

  $btn = apply_filters('plwp_attach_success_btn', $btn);
  ?>
  <form id="attachform" class="admin-attach" onSubmit="return false;">
    <h1 class="admin-email__heading"><?php esc_html_e('Passwordless credentials added', 'daftplug-instantify'); ?></h1>
    <div class="admin-attach__body">
      <div class="admin-attach__body-left">
        <p class="admin-email__details">
          <?php esc_html_e('Congrats! You have adeded you token, you can you it for Biometric authentication to WordPress. You can manage it in you profile page.'); ?></a> </p>

        <?php do_action('plwp_attach_success'); ?>

        <div class="admin-email__actions">
          <div class="wtl-error"></div>

          <div class="admin-email__actions-primary">
            <a href="<?php esc_attr_e($btn['href']); ?>" class="button button-primary button-large" style="margin: 0;"><?php esc_html_e($btn['text']); ?></a>
          </div>
        </div>
      </div>
      <div class="admin-attach__body-image">
      </div>
    </div>
  </form>
<?php
login_footer();
exit();
}

add_action('login_enqueue_scripts', 'plwp_login_enqueue_scripts', 10);
add_action('login_form_login', 'plwp_login_form_login');
add_filter('wp_login_errors', 'plwp_wp_login_errors', 100, 2);

add_action('login_form_attach_touch', 'plwp_login_form_attach_touch');
add_action('login_form_attach_touch_success', 'plwp_login_form_attach_touch_success');
