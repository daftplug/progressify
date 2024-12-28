<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\{Plugin, Frontend};

if (!defined('ABSPATH')) {
  exit();
}

class AppCapabilities
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
    $this->capability = 'manage_options';
    $this->settings = $config['settings'];

    add_action('after_setup_theme', [$this, 'handleWrapAllSwup']);
  }

  public function handleWrapAllSwup()
  {
    // Don't run if compatibility mode is off or we are on known page builder
    if (Plugin::getSetting('appCapabilities[smoothPageTransitions][compatibilityMode]') !== 'on') {
      return;
    }

    // Don't run for admin pages or AJAX requests
    if (is_admin() || wp_doing_ajax()) {
      return;
    }

    ob_start();
    add_action(
      'shutdown',
      function () {
        $content = ob_get_clean();

        if ($content && strpos($content, '<body') !== false) {
          $content = preg_replace('/(<body[^>]*>)([\s\S]*?)(<\/body>)/i', '$1<div id="swup">$2</div>$3', $content);
          if (!$content) {
            $content = ob_get_clean();
            $content = preg_replace('/(<body[^>]*>)/i', '$1<div id="swup">', $content);
            $content = preg_replace('/(<\/body>)/i', '</div>$1', $content);
          }
        }

        echo $content;
      },
      0
    );
  }
}
