<?php

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {
  exit();
}

$optionName = 'daftplug_instantify';
$options = ['purchase_code', 'installed_devices', 'subscribed_devices', 'settings'];

if (get_option("{$optionName}_purchase_code")) {
  $params = [
    'sslverify' => false,
    'body' => [
      'action' => 'deactivate',
      'purchase_code' => get_option("{$optionName}_purchase_code"),
    ],
    'user-agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
  ];

  wp_remote_post('https://daftplug.com/wp-json/daftplugify/purchase-verify/', $params);
}

if (get_option("{$optionName}_settings")['uninstallSettings'] == 'delete') {
  foreach ($options as $option) {
    delete_option("{$optionName}_{$option}");
  }
}

if (function_exists('plwp_drop_data')) {
  plwp_drop_data();
}
