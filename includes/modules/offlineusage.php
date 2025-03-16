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
  public static $serviceWorkerName;

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
    $this->workboxVersion = '7.3.0';
    self::$serviceWorkerName = 'serviceworker.js';

    add_action('rest_api_init', [$this, 'registerRoutes']);
    add_action('parse_request', [$this, 'renderServiceWorker']);
    add_action('parse_request', [$this, 'renderOfflineFallbackPage']);
    add_action('wp_head', [$this, 'renderRegisterServiceWorker']);
  }

  public function registerRoutes()
  {
    register_rest_route($this->slug, '/generateServiceWorkerFile', [
      'methods' => 'POST',
      'callback' => [$this, 'generateServiceWorkerFile'],
      'permission_callback' => function () {
        return current_user_can($this->capability);
      },
    ]);
  }

  public function renderOfflineFallbackPage()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === 'offline-fallback') {
      $wp_query->set('offline-fallback', 1);
    }

    if ($wp_query->get('offline-fallback')) {
      nocache_headers();
      header('X-Robots-Tag: noindex, follow');
      header('Content-Type: text/html; charset=utf-8');

      Frontend::renderPartial('offlineFallbackPage');

      exit();
    }
  }

  public function renderServiceWorker()
  {
    global $wp;
    global $wp_query;

    if (!$wp_query->is_main_query()) {
      return;
    }

    if ($wp->request === self::$serviceWorkerName) {
      $wp_query->set(self::$serviceWorkerName, 1);
    }

    if ($wp_query->get(self::$serviceWorkerName)) {
      nocache_headers();
      header('X-Robots-Tag: noindex, follow');
      header('Content-Type: application/javascript; charset=utf-8');
      header('Service-Worker-Allowed: /');

      include $this->pluginUploadDir . self::$serviceWorkerName;

      exit();
    }
  }

  public function generateServiceWorkerFile()
  {
    try {
      // Build the service worker content.
      $serviceWorkerContent = $this->buildServiceworkerData();

      // Generate a cache key based on content and plugin version.
      $cacheKey = hash('crc32', $serviceWorkerContent . $this->version);
      $safe_slug = sanitize_key($this->slug);

      // Create header variables (they will be part of the file).
      $header = "const CACHE_VERSION = '" . esc_js($cacheKey) . "';\n";
      $header .= "const CACHE_PREFIX = '" . esc_js($safe_slug) . "';\n";

      $finalContent = $header . $serviceWorkerContent;
      $serviceWorkerPath = $this->pluginUploadDir . self::$serviceWorkerName;

      Plugin::putContent($serviceWorkerPath, $finalContent);

      return new \WP_REST_Response(
        [
          'status' => 'success',
          'message' => 'Service worker file generated successfully',
        ],
        200
      );
    } catch (\Exception $e) {
      return new \WP_Error('save_failed', $e->getMessage(), ['status' => 500]);
    }
  }

  public function buildServiceworkerData()
  {
    $isOfflineCacheEnabled = Plugin::getSetting('offlineUsage[cache][feature]') == 'on';
    $offlineFallbackPage = Plugin::getSetting('offlineUsage[cache][customFallbackPage][feature]') == 'on' ? Plugin::getSetting('offlineUsage[cache][customFallbackPage][page]') : home_url('/offline-fallback');
    $cachingStrategy = Plugin::getSetting('offlineUsage[cache][strategy]');
    $cacheExpiration = intval(Plugin::getSetting('offlineUsage[cache][expirationTime]')) ?: 10;

    $serviceworker = $this->loadWorkbox($this->workboxVersion);
    $serviceworker .= $this->getBasicEventListeners();
    if ($isOfflineCacheEnabled) {
      $serviceworker .= $this->getOfflinePageCaching($offlineFallbackPage);
      $serviceworker .= $this->getRoutingRules($cachingStrategy, $cacheExpiration);
      $serviceworker .= $this->getCacheCleanupLogic();
    }
    $serviceworker .= $this->getThirdPartyIntegrations();

    return apply_filters("{$this->optionName}_serviceworker", $serviceworker);
  }

  private function loadWorkbox($workboxVersion)
  {
    return "importScripts('https://storage.googleapis.com/workbox-cdn/releases/{$workboxVersion}/workbox-sw.js');";

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
  }

  private function getBasicEventListeners()
  {
    return "
      self.addEventListener('install', () => self.skipWaiting());
      self.addEventListener('activate', () => self.clients.claim());
      self.addEventListener('message', (event) => {
        if (event.data?.type === 'SKIP_WAITING') {
          self.skipWaiting();
        }
      });
    ";
  }

  private function getOfflinePageCaching($offlineFallbackPage)
  {
    return "
      workbox.loadModule('workbox-cacheable-response');
      workbox.loadModule('workbox-range-requests');

      if (workbox.navigationPreload.isSupported()) {
          workbox.navigationPreload.enable();
      }

      const cacheName = {
        pages: CACHE_PREFIX + '-pages-' + CACHE_VERSION,
        resources: CACHE_PREFIX + '-resources-' + CACHE_VERSION
      };
  
      self.addEventListener('install', async(event) => {
        event.waitUntil(
          caches.open(cacheName.pages).then((cache) => {
            return Promise.resolve(fetch('{$offlineFallbackPage}', {credentials: 'same-origin'}).then(response => response))
              .then(response => cache.put('offline-fallback', response))
              .catch(error => console.error('Failed to cache offline page:', error));
          })
        );
      });
    ";
  }

  private function getRoutingRules($cachingStrategy, $cacheExpiration)
  {
    return "
      workbox.routing.registerRoute(/wp-admin(.*)|wp-json(.*)|(.*)preview=true(.*)/,
        new workbox.strategies.NetworkOnly()
      );

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
  }

  private function getCacheCleanupLogic()
  {
    return "
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
  }

  private function getThirdPartyIntegrations()
  {
    if (Plugin::isPluginActive('onesignal')) {
      return "importScripts('https://cdn.onesignal.com/sdks/OneSignalSDKWorker.js');";
    }

    if (Plugin::isPluginActive('webpushr')) {
      return "importScripts('https://cdn.webpushr.com/sw-server.min.js');";
    }
  }

  public function renderRegisterServiceWorker()
  {
    ?>
<script type="text/javascript" id="serviceworker">
if ('serviceWorker' in navigator) {
  window.addEventListener('load', async () => {
    try {
      const registration = await navigator.serviceWorker.register(
        '<?php echo esc_url($this->getServiceWorkerUrl(true)); ?>', {
          scope: '<?php echo esc_url($this->getServiceWorkerScope()); ?>'
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
    return isset($homeUrlParts['path']) ? wp_json_encode($homeUrlParts['path']) : '/';
  }

  public static function getServiceWorkerUrl($encoded = true)
  {
    $serviceWorkerUrl = untrailingslashit(strtok(home_url('/', 'https'), '?') . self::$serviceWorkerName);
    return $encoded ? wp_json_encode($serviceWorkerUrl) : $serviceWorkerUrl;
  }
}