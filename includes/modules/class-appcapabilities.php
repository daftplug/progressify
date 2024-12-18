<?php

namespace DaftPlug;

if (!defined('ABSPATH')) {
  exit();
}
if (!class_exists('ProgressifyAppCapabilities')) {
  class ProgressifyAppCapabilities
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

      if (daftplugInstantify::getSetting('pwaBackgroundSync') == 'on') {
        add_filter("{$this->optionName}_pwa_serviceworker_workbox", [$this, 'addBackgroundSyncToServiceWorker']);
      }

      if (daftplugInstantify::getSetting('pwaPeriodicBackgroundSync') == 'on') {
        add_filter("{$this->optionName}_pwa_serviceworker", [$this, 'addPeriodicBackgroundSyncToServiceWorker']);
      }

      if (daftplugInstantify::getSetting('pwaUrlProtocolHandler') == 'on') {
        add_filter("{$this->optionName}_pwa_manifest", [$this, 'addUrlProtocolHandlerToManifest']);
      }

      if (daftplugInstantify::getSetting('pwaWebShareTarget') == 'on') {
        add_filter("{$this->optionName}_pwa_manifest", [$this, 'addWebShareTargetToManifest']);
      }

      if (daftplugInstantify::getSetting('pwaAdaptiveLoading') == 'on' && !daftplugInstantify::isAmpPluginActive() && daftplugInstantify::getSetting('amp') == 'on' && ((in_array('desktop', (array) daftplugInstantify::getSetting('pwaAdaptiveLoadingPlatforms')) && daftplugInstantify::isPlatform('desktop')) || (in_array('mobile', (array) daftplugInstantify::getSetting('pwaAdaptiveLoadingPlatforms')) && daftplugInstantify::isPlatform('somartphone')) || (in_array('tablet', (array) daftplugInstantify::getSetting('pwaAdaptiveLoadingPlatforms')) && daftplugInstantify::isPlatform('tablet')) || (in_array('pwa', (array) daftplugInstantify::getSetting('pwaAdaptiveLoadingPlatforms')) && daftplugInstantify::isPwaPage()))) {
        add_filter("{$this->optionName}_public_js_vars", [$this, 'addAmpUrlJsVars']);
      }

      if (daftplugInstantify::getSetting('pwaIdleDetection') == 'on') {
        add_filter("{$this->optionName}_public_html", [$this, 'renderIdleReload']);
      }

      if (!empty(daftplugInstantify::getSetting('pwaCustomCss'))) {
        add_filter("{$this->optionName}_public_css", [$this, 'injectCustomCss']);
      }
    }

    public function addBackgroundSyncToServiceWorker($serviceWorker)
    {
      $serviceWorker .= "
      workbox.routing.registerRoute(
          new RegExp('/*'),
          new workbox.strategies.NetworkOnly({
              plugins: [
                  new workbox.backgroundSync.BackgroundSyncPlugin('bgSyncQueue', {
                      maxRetentionTime: 24 * 60
                  })
              ]
          }),
          'POST'
      );";

      return $serviceWorker;
    }

    public function addPeriodicBackgroundSyncToServiceWorker($serviceWorker)
    {
      $serviceWorker .=
        "
          async function fetchAndCacheContent() {
              var request = '" .
        trailingslashit(strtok(home_url('/', 'https'), '?')) .
        "';
              return caches.open(CACHE + '-html').then(function(cache) {
                  return fetch(request).then(function(response) {
                      return cache.put(request, response.clone()).then(function() {
                          return response;
                      });
                  });
              });
          }

          self.addEventListener('periodicsync', (event) => {
              if (event.tag === 'periodicSync') {
                  event.waitUntil(fetchAndCacheContent());
              }
          });
      ";

      return $serviceWorker;
    }

    public function addUrlProtocolHandlerToManifest($manifest)
    {
      $manifest['protocol_handlers'][] = [
        'protocol' => 'web+' . daftplugInstantify::getSetting('pwaUrlProtocolHandlerProtocol'),
        'url' => daftplugInstantify::getSetting('pwaUrlProtocolHandlerUrl'),
      ];

      return $manifest;
    }

    public function addWebShareTargetToManifest($manifest)
    {
      $manifest['share_target'] = [
        'action' => daftplugInstantify::getSetting('pwaWebShareTargetAction'),
        'method' => 'GET',
        'enctype' => 'application/x-www-form-urlencoded',
        'params' => [
          'title' => 'title',
          'text' => 'text',
          'url' => daftplugInstantify::getSetting('pwaWebShareTargetUrlQuery'),
        ],
      ];

      return $manifest;
    }

    public function addAmpUrlJsVars($vars)
    {
      if (amp_is_canonical() || !amp_is_available()) {
        return $vars;
      }

      $vars['ampUrl'] = amp_add_paired_endpoint(remove_query_arg(array_merge(wp_removable_query_args(), ['noamp']), amp_get_current_url()));

      return $vars;
    }

    public function renderIdleReload()
    {
      if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
        return;
      }

      $updateContents = esc_html__('Update Contents', $this->textDomain);

      echo '<div class="daftplugPublicIdleReloadButton">' . $updateContents . '</div>';
    }

    public function injectCustomCss()
    {
      if (daftplugInstantify::isAmpPage() || !daftplugInstantifyPwa::isPwaAvailable()) {
        return;
      }

      echo htmlspecialchars(wp_unslash(daftplugInstantify::getSetting('pwaCustomCss')));
    }
  }
}
