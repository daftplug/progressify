<?php
/*
Plugin Name: DaftPlug Progressify - Progressive Web App (PWA)
Description: Progressify empowers your website with Progressive Web App (PWA) features that use modern web capabilities to deliver fast, native-app experiences with no app stores or downloads, and all the goodness of the web directly in the browser.
Plugin URI: https://daftplug.com/progressify/
Version: 1.2.0
Author: DaftPlug
Author URI: https://daftplug.com/
Text Domain: daftplug-progressify
Domain Path: /languages
Requires at least: 5.0
Requires PHP: 8.2
*/

use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}

require_once __DIR__ . '/includes/plugin.php';

new Plugin([
  'name' => esc_html__('DaftPlug Progressify - Progressive Web App (PWA)', 'daftplug-progressify'),
  'description' => esc_html__('Progressify empowers your website with Progressive Web App (PWA) features that use modern web capabilities to deliver fast, native-app experiences with no app stores or downloads, and all the goodness of the web directly in the browser.', 'daftplug-progressify'),
  'slug' => 'daftplug-progressify',
  'version' => '1.2.0',
  'option_name' => 'daftplug_progressify',
  'plugin_file' => __FILE__,
  'plugin_basename' => plugin_basename(__FILE__),
  'plugin_dir_url' => plugin_dir_url(__FILE__),
  'plugin_dir_path' => plugin_dir_path(__FILE__),
  'plugin_upload_dir' => trailingslashit(wp_upload_dir()['basedir']) . 'daftplug-progressify/',
  'plugin_upload_url' => trailingslashit(wp_upload_dir()['baseurl']) . 'daftplug-progressify/',
  'menu_title' => esc_html__('Progressify', 'daftplug-progressify'),
  'menu_icon' => plugins_url('admin/assets/media/icons/menu.png', __FILE__),
  'settings' => get_option('daftplug_progressify_settings', true),
  'license_endpoint' => 'https://daftplug.com/wp-json/daftplug/v1/license/',
  'envato_item_id' => '25757693',
]);