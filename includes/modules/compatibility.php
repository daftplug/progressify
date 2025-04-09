<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\{Plugin};

if (!defined('ABSPATH')) {
  exit();
}

class Compatibility
{
  public $name;
  public $description;
  public $slug;
  public $version;
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
  public $capability;
  public $settings;

  public function __construct($config)
  {
    $this->name = $config['name'];
    $this->description = $config['description'];
    $this->slug = $config['slug'];
    $this->version = $config['version'];
    $this->optionName = $config['option_name'];
    $this->pluginFile = $config['plugin_file'];
    $this->pluginBasename = $config['plugin_basename'];
    $this->pluginDirPath = $config['plugin_dir_path'];
    $this->pluginUploadDir = $config['plugin_upload_dir'];
    $this->menuTitle = $config['menu_title'];
    $this->menuIcon = $config['menu_icon'];
    $this->dependencies = [];
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];

    add_filter('wp_headers', [$this, 'servePwaHeaderWithNoCache']);
  }

  // Prevent caching header when browsing PWA mode
  public function servePwaHeaderWithNoCache($headers)
  {
    if (Plugin::isPlatform('pwa')) {
      $headers['Cache-Control'] = 'no-cache';
    }

    return $headers;
  }
}