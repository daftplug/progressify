<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}

class OfflineUsage
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
  private $workboxVersion;

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
    $this->workboxVersion = '6.3.0';

    add_action('parse_request', [$this, 'generateServiceWorker']);
    add_action('wp_head', [$this, 'renderRegisterServiceWorker']);
  }

  public function generateServiceWorker()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === 'serviceworker.js') {
      $wp_query->set('serviceworker.js', 1);
    }

    if ($wp_query->get('serviceworker.js')) {
      nocache_headers();
      header('X-Robots-Tag: noindex, follow');
      header('Content-Type: application/javascript; charset=utf-8');
      header('Service-Worker-Allowed: /');

      $cacheKey = hash('crc32', json_encode($this->settings) . $this->version);
      $serviceworker = $this->buildServiceworkerData();

      echo "
        const CACHE_VERSION = '{$cacheKey}';
        const CACHE_PREFIX = '{$this->slug}';
        {$serviceworker}
      ";

      exit();
    }
  }

  public function buildServiceworkerData()
  {
    $offlinePage = Plugin::getSetting('offlineUsage[cache][fallbackPage]');
    $cachingStrategy = Plugin::getSetting('offlineUsage[cache][strategy]');
    $cacheExpiration = intval(Plugin::getSetting('offlineUsage[cache][expirationTime]')) ?: 10;

    $serviceworker = $this->getWorkboxConfig($this->workboxVersion);
    $serviceworker .= $this->getBasicEventListeners($offlinePage);
    $serviceworker .= $this->getRoutingRules($offlinePage, $cachingStrategy, $cacheExpiration);
    $serviceworker .= $this->getCacheCleanupLogic();
    $serviceworker .= $this->getThirdPartyIntegrations();

    return apply_filters("{$this->optionName}_serviceworker", $serviceworker);
  }

  private function getWorkboxConfig($workboxVersion)
  {
    $workboxConfig = "
      importScripts('https://storage.googleapis.com/workbox-cdn/releases/{$workboxVersion}/workbox-sw.js');

      workbox.core.setCacheNameDetails({
          prefix: CACHE_PREFIX,
          suffix: 'v{$this->version}',
          precache: 'precache',
          runtime: 'runtime'
      });

      workbox.loadModule('workbox-cacheable-response');
      workbox.loadModule('workbox-range-requests');
    ";

    // if (Plugin::getSetting('offlineUsage[capabilities][googleAnalytics]') === 'on') {
    //   $workboxConfig .= "
    //     workbox.loadModule('workbox-google-analytics');

    //     const gaConfig = {
    //       hitFilter: params => {
    //         const queryParams = params.get('hit')?.split('&') || [];
    //         params.set('hit', queryParams.map(param => {
    //           if (param.startsWith('t=')) {
    //             return param + '(offline)';
    //           }
    //           return param;
    //         }).join('&'));
    //       }
    //     };

    //     workbox.googleAnalytics.initialize(gaConfig);
    //   \n\n";
    // }

    return $workboxConfig;
  }

  private function getBasicEventListeners($offlinePage)
  {
    $basicEventListeners = "
      workbox.core.skipWaiting();
      workbox.core.clientsClaim();
      
      self.addEventListener('message', (event) => {
        if (event.data && event.data.type === 'SKIP_WAITING') {
          self.skipWaiting();
        }
      });

      self.addEventListener('install', async(event) => {
        event.waitUntil(
          caches.open(CACHE_PREFIX + '-html').then((cache) => cache.add(new Request('{$offlinePage}', {credentials: 'same-origin'})))
        );
      });

      if (workbox.navigationPreload.isSupported()) {
        workbox.navigationPreload.enable();
      }
    ";

    return $basicEventListeners;
  }

  private function getRoutingRules($offlinePage, $cachingStrategy, $cacheExpiration)
  {
    $routingRules = "
      workbox.routing.registerRoute(/wp-admin(.*)|wp-json(.*)|(.*)preview=true(.*)/,
        new workbox.strategies.NetworkOnly()
      );
    ";

    $routingRules .= "
      workbox.routing.registerRoute(({event}) => event.request.destination === 'document',
        async (params) => {
          try {
            const response = await new workbox.strategies.{$cachingStrategy}({
              cacheName: CACHE_PREFIX + '-html',
              plugins: [
                new workbox.expiration.ExpirationPlugin({
                  maxEntries: 50,
                  maxAgeSeconds: 60 * 60 * 24 * {$cacheExpiration},
                }),
                new workbox.cacheableResponse.CacheableResponsePlugin({
                  statuses: [0, 200]
                }),
              ],
            }).handle(params);
            return response || await caches.match('{$offlinePage}');
          } catch (error) {
            console.log('catch:', error);
            return await caches.match('{$offlinePage}');
          }
        }
      );
    ";

    $routingRules .= "
      workbox.routing.registerRoute(({event}) => event.request.destination !== 'document',
        new workbox.strategies.{$cachingStrategy}({
          cacheName: CACHE_PREFIX + '-all-resources',
          plugins: [
            new workbox.expiration.ExpirationPlugin({
              maxEntries: 30,
              maxAgeSeconds: 60 * 60 * 24 * {$cacheExpiration},
            }),
            new workbox.cacheableResponse.CacheableResponsePlugin({
              statuses: [0, 200]
            }),
          ],
        })
      );
    ";

    return $routingRules;
  }

  private function getCacheCleanupLogic()
  {
    $cacheCleanupLogic = "
      self.addEventListener('activate', event => {
        event.waitUntil(
          caches.keys().then(keys => Promise.all(
            keys.map(key => {
              if (key.startsWith(CACHE_PREFIX) && !key.includes(CACHE_VERSION)) {
                return caches.delete(key);
              }
            })
          ))
        );
      });
    ";

    return $cacheCleanupLogic;
  }

  private function getThirdPartyIntegrations()
  {
    $integrations = '';

    if (Plugin::isPluginActive('onesignal')) {
      $integrations .= "importScripts('https://cdn.onesignal.com/sdks/OneSignalSDKWorker.js');";
    }

    if (Plugin::isPluginActive('webpushr')) {
      $integrations .= "importScripts('https://cdn.webpushr.com/sw-server.min.js');";
    }

    return $integrations;
  }

  public function renderRegisterServiceWorker()
  {
    $scope = $this->getServiceWorkerScope(); ?>
<script type="text/javascript" id="serviceworker">
if ('serviceWorker' in navigator) {
  window.addEventListener('load', async () => {
    try {
      const registration = await navigator.serviceWorker.register(
        <?php echo $this->getServiceWorkerUrl(); ?>, {
          scope: <?php echo wp_json_encode($scope); ?>
        }
      );
      console.log('ServiceWorker registration successful with scope:', registration.scope);
    } catch (error) {
      console.error('ServiceWorker registration failed:', error);
    }
  });
}
</script>
<?php
  }

  private function getServiceWorkerScope()
  {
    $homeUrlParts = wp_parse_url(trailingslashit(strtok(home_url('/', 'https'), '?')));
    return isset($homeUrlParts['path']) ? $homeUrlParts['path'] : '/';
  }

  public static function getServiceWorkerUrl($encoded = true)
  {
    $serviceWorkerUrl = untrailingslashit(strtok(home_url('/', 'https'), '?') . '/serviceworker.js');
    return $encoded ? wp_json_encode($serviceWorkerUrl) : $serviceWorkerUrl;
  }
}