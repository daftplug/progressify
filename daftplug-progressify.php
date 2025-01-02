<?php
/*
Plugin Name: DaftPlug Progressify - Progressive Web Apps (PWA) for WordPress
Description: Enhance your website with Progressive Web Apps (PWA) features and take the user experience to the next level with future of mobile web.
Plugin URI: https://daftplug.com/applications/progressify
Version: 1.0.0
Author: DaftPlug
Author URI: https://daftplug.com/
Text Domain: daftplug-progressify
Domain Path: /languages
Requires at least: 5.0
Requires PHP: 7.0
*/

use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}

require_once __DIR__ . '/includes/plugin.php';

new Plugin([
  'name' => __('DaftPlug Progressify - Progressive Web Apps (PWA) for WordPress'),
  'description' => __('Enhance your website with Progressive Web Apps (PWA) features and take the user experience to the next level with future of mobile web.'),
  'slug' => 'daftplug-progressify',
  'version' => '1.0.0',
  'text_domain' => 'daftplug-progressify',
  'option_name' => 'daftplug_progressify',
  'plugin_file' => __FILE__,
  'plugin_basename' => plugin_basename(__FILE__),
  'plugin_dir_url' => plugin_dir_url(__FILE__),
  'plugin_dir_path' => plugin_dir_path(__FILE__),
  'plugin_upload_dir' => trailingslashit(wp_upload_dir()['basedir']) . 'daftplug-progressify/',
  'plugin_upload_url' => trailingslashit(wp_upload_dir()['baseurl']) . 'daftplug-progressify/',
  'menu_title' => __('Progressify'),
  'menu_icon' => plugins_url('admin/assets/media/icons/menu.png', __FILE__),
  'settings' => get_option('daftplug_progressify_settings', true),
  'verify_url' => 'https://daftplug.com/wp-json/daftplugify/purchase-verify/',
  'item_id' => '25757693',
]);

// echo json_encode(get_option('daftplug_progressify_settings', true));
// echo print_r(get_option('daftplug_progressify_settings', true));