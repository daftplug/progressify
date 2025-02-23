<?php

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {
  exit();
}

$optionName = 'daftplug_progressify';
$options = ['license_key', 'settings'];

if (get_option("{$optionName}_license_key")) {
  $params = [
    'sslverify' => false,
    'body' => [
      'license_key' => get_option("{$optionName}_license_key"),
      'action' => 'deactivate',
    ],
    'user-agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
  ];

  wp_remote_post('https://daftplug.com/wp-json/daftplugify/v1/process-license/', $params);
}

foreach ($options as $option) {
  delete_option("{$optionName}_{$option}");
}

if (function_exists('plwp_drop_data')) {
  plwp_drop_data();
}