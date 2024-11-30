<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\{Plugin, Frontend};

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
    $this->workboxVersion = '7.3.0';

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

      $serviceworker = $this->buildServiceworkerData();
      $cacheKey = hash('crc32', $serviceworker . $this->version);

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
    $isOfflineCacheEnabled = Plugin::getSetting('offlineUsage[cache][feature]') == 'on';
    $isCustomOfflinePageEnabled = Plugin::getSetting('offlineUsage[cache][customFallbackPage][feature]') == 'on';
    $offlinePage = $isCustomOfflinePageEnabled ? Plugin::getSetting('offlineUsage[cache][customFallbackPage][page]') : Frontend::renderPartial('offlineFallbackPage');
    $cachingStrategy = Plugin::getSetting('offlineUsage[cache][strategy]');
    $cacheExpiration = intval(Plugin::getSetting('offlineUsage[cache][expirationTime]')) ?: 10;
    $fallbackData = [
      'content' => $offlinePage,
      'isCustomPage' => $isCustomOfflinePageEnabled,
    ];

    $serviceworker = '';
    if ($isOfflineCacheEnabled) {
      $serviceworker = $this->loadWorkbox($this->workboxVersion);
      $serviceworker .= $this->getBasicEventListeners($fallbackData);
      $serviceworker .= $this->getRoutingRules($cachingStrategy, $cacheExpiration);
      $serviceworker .= $this->getCacheCleanupLogic();
    }
    $serviceworker .= $this->getThirdPartyIntegrations();

    return apply_filters("{$this->optionName}_serviceworker", $serviceworker);
  }

  private function loadWorkbox($workboxVersion)
  {
    $loadWorkbox = "
      importScripts('https://storage.googleapis.com/workbox-cdn/releases/{$workboxVersion}/workbox-sw.js');

      workbox.loadModule('workbox-cacheable-response');
      workbox.loadModule('workbox-range-requests');
    ";

    // if (Plugin::getSetting('offlineUsage[capabilities][googleAnalytics]') === 'on') {
    //   $loadWorkbox .= "
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

    return $loadWorkbox;
  }

  private function getBasicEventListeners($fallbackData)
  {
    $fallbackContent = $fallbackData['isCustomPage']
      ? "fetch('{$fallbackData['content']}', {credentials: 'same-origin'}).then(response => response)"
      : "new Response(`{$fallbackData['content']}`, {
          headers: {'Content-Type': 'text/html;charset=utf-8'}
        })";

    $basicEventListeners = "
      const cacheName = {
        pages: CACHE_PREFIX + '-pages-' + CACHE_VERSION,
        resources: CACHE_PREFIX + '-resources-' + CACHE_VERSION
      };
  
      workbox.core.skipWaiting();
      workbox.core.clientsClaim();
      
      self.addEventListener('message', (event) => {
        if (event.data && event.data.type === 'SKIP_WAITING') {
          self.skipWaiting();
        }
      });
  
      self.addEventListener('install', async(event) => {
        event.waitUntil(
          caches.open(cacheName.pages).then((cache) => {
            return Promise.resolve({$fallbackContent})
              .then(response => {
                // Store with consistent key name
                return cache.put('offline-fallback', response);
              })
              .catch(error => {
                console.error('Failed to cache offline page:', error);
              });
          })
        );
      });
  
      if (workbox.navigationPreload.isSupported()) {
        workbox.navigationPreload.enable();
      }
    ";

    return $basicEventListeners;
  }

  private function getRoutingRules($cachingStrategy, $cacheExpiration)
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
              cacheName: cacheName.pages,
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
            
            if (response) return response;
            
            console.log('Page not in cache, returning offline fallback');
            const cache = await caches.open(cacheName.pages);
            const fallback = await cache.match('offline-fallback');
            
            if (!fallback) {
              console.error('Offline fallback not found in cache');
              return new Response('Site is offline', {
                status: 200,
                headers: {'Content-Type': 'text/html'}
              });
            }
            
            return fallback;
          } catch (error) {
            console.error('Cache handling error:', error);
            const cache = await caches.open(cacheName.pages);
            return await cache.match('offline-fallback') || new Response('Site is offline', {
              status: 200,
              headers: {'Content-Type': 'text/html'}
            });
          }
        }
      );
    ";

    $routingRules .= "
      workbox.routing.registerRoute(({event}) => event.request.destination !== 'document',
        new workbox.strategies.{$cachingStrategy}({
          cacheName: cacheName.resources,
          plugins: [
            new workbox.expiration.ExpirationPlugin({
              maxEntries: 30,
              maxAgeSeconds: 60 * 60 * 24 * {$cacheExpiration},
            }),
            new workbox.cacheableResponse.CacheableResponsePlugin({
              statuses: [0, 200]
            }),
            new workbox.rangeRequests.RangeRequestsPlugin(),
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
          (async () => {
            // Claim clients immediately
            clients.claim();

            const cacheNames = await caches.keys();
            const expectedCacheNames = [cacheName.pages, cacheName.resources];

            // Delete all caches that don't match the current version
            await Promise.all(
              cacheNames.map(name => {
                if (name.startsWith(CACHE_PREFIX) && !expectedCacheNames.includes(name)) {
                  console.log('Deleting old cache:', name);
                  return caches.delete(name);
                }
              })
            );
          })()
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
    if (Plugin::getSetting('offlineUsage[cache][feature]') !== 'on') {
      return;
    }

    $scope = $this->getServiceWorkerScope();
    ?>
<script type="text/javascript" id="serviceworker">
if ('serviceWorker' in navigator) {
  window.addEventListener('load', async () => {
    try {
      const registration = await navigator.serviceWorker.register(
        <?php echo $this->getServiceWorkerUrl(true); ?>, {
          scope: <?php echo wp_json_encode($scope); ?>
        }
      );
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
    $serviceWorkerUrl = untrailingslashit(strtok(home_url('/', 'https'), '?') . 'serviceworker.js');
    return $encoded ? wp_json_encode($serviceWorkerUrl) : $serviceWorkerUrl;
  }
}