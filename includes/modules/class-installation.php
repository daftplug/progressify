<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\Plugin;
use DaftPlug\Progressify\Frontend;

if (!defined('ABSPATH')) {
  exit();
}

class Installation
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
  public $pluginUploadUrl;
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
    $this->pluginUploadUrl = $config['plugin_upload_url'];
    $this->dependencies = [];
    $this->purchaseCode = get_option("{$this->optionName}_purchase_code");
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];

    add_shortcode('pwa-install-button', [$this, 'renderInstallationButton']);
    
  }

  public function renderInstallationButton($atts)
  {
    if (Plugin::getSetting('installation[button][feature]') !== 'on') {
      return;
    }

    return Frontend::renderPartial('installButton');
  }
}