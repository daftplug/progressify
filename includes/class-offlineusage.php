<?php

namespace DaftPlug;

if (!defined('ABSPATH')) {
  exit();
}
if (!class_exists('ProgressifyOfflineUsage')) {
  class ProgressifyOfflineUsage
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

      if ($wp->request === self::$serviceWorkerName) {
        $wp_query->set(self::$serviceWorkerName, 1);
      }

      if ($wp_query->get(self::$serviceWorkerName)) {
        @ini_set('display_errors', 0);
        @header('Cache-Control: no-cache');
        @header('X-Robots-Tag: noindex, follow');
        @header('Content-Type: application/javascript; charset=utf-8');
        $offlinePage = daftplugInstantify::getSetting('pwaOfflineFallbackPage');
        $cacheExpiration = daftplugInstantify::getSetting('pwaOfflineCacheExpiration');
        $routes = [
          'html' => [
            'destination' => 'document',
            'strategy' => daftplugInstantify::getSetting('pwaOfflineHtmlStrategy'),
          ],
          'javascript' => [
            'destination' => 'script',
            'strategy' => daftplugInstantify::getSetting('pwaOfflineJavascriptStrategy'),
          ],
          'stylesheets' => [
            'destination' => 'style',
            'strategy' => daftplugInstantify::getSetting('pwaOfflineStylesheetsStrategy'),
          ],
          'fonts' => [
            'destination' => 'font',
            'strategy' => daftplugInstantify::getSetting('pwaOfflineFontsStrategy'),
          ],
          'images' => [
            'destination' => 'image',
            'strategy' => daftplugInstantify::getSetting('pwaOfflineImagesStrategy'),
          ],
          'videos' => [
            'destination' => 'video',
            'strategy' => daftplugInstantify::getSetting('pwaOfflineVideosStrategy'),
          ],
          'audios' => [
            'destination' => 'audio',
            'strategy' => daftplugInstantify::getSetting('pwaOfflineAudiosStrategy'),
          ],
        ];

        $this->serviceWorker .= "importScripts('" . plugins_url('pwa/public/assets/js/workbox-v6.5.3/workbox-sw.js', $this->pluginFile) . "');\n\n";

        $this->serviceWorker .=
          "workbox.setConfig({
                                      modulePathPrefix: '" .
          plugins_url('pwa/public/assets/js/workbox-v6.5.3/', $this->pluginFile) .
          "',
                                  });\n\n";

        $this->serviceWorker .=
          "workbox.core.setCacheNameDetails({
                                      prefix: '" .
          $this->slug .
          "',
                                      suffix: 'v" .
          $this->version .
          "',
                                      precache: '',
                                      runtime: '',
                                  });\n\n";

        $this->serviceWorker .= "if (workbox) {\n";
        $this->serviceWorker .= "workbox.core.skipWaiting();\n";
        $this->serviceWorker .= "workbox.core.clientsClaim();\n";

        $this->serviceWorker .= "self.addEventListener('message', (event) => {
                                          if (event.data && event.data.type === 'SKIP_WAITING') {
                                              self.skipWaiting();
                                          }
                                      });\n";

        if (!empty($offlinePage)) {
          $this->serviceWorker .= "self.addEventListener('install', async(event) => {
                                              event.waitUntil(
                                                  caches.open(CACHE + '-html').then((cache) => cache.add('{$offlinePage}'))
                                              );
                                          });\n";
        }

        $this->serviceWorker .= "if (workbox.navigationPreload.isSupported()) {
                                          workbox.navigationPreload.enable();
                                      }\n";

        $this->serviceWorker .= "workbox.loadModule('workbox-cacheable-response');\n";
        $this->serviceWorker .= "workbox.loadModule('workbox-range-requests');\n";

        $this->serviceWorker .= "workbox.routing.registerRoute(/wp-admin(.*)|wp-json(.*)|(.*)preview=true(.*)/, new workbox.strategies.NetworkOnly());\n";
        $this->serviceWorker .= "workbox.routing.registerRoute(/(.*)cdn\.ampproject\.org(.*)/,
                                          new workbox.strategies.StaleWhileRevalidate({
                                              cacheName: CACHE + '-amp',
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
                                      );\n";

        $this->serviceWorker .= "workbox.routing.registerRoute(/(.*)fonts\.googleapis\.com(.*)|(.*)fonts\.gstatic\.com(.*)/,
                                          new workbox.strategies.StaleWhileRevalidate({
                                              cacheName: CACHE + '-google-fonts',
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
                                      );\n";

        foreach ($routes as $key => $values) {
          switch ($key) {
            case 'html':
              $this->serviceWorker .= "workbox.routing.registerRoute(({event}) => event.request.destination === '{$values['destination']}',
                                                      async (params) => {
                                                          try {
                                                              const response = await new workbox.strategies.{$values['strategy']}({
                                                                  cacheName: CACHE + '-{$key}',
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
                                                  );\n\n";
              break;
            case 'videos':
            case 'audios':
              $this->serviceWorker .= "workbox.routing.registerRoute(({event}) => event.request.destination === '{$values['destination']}',
                                                      new workbox.strategies.{$values['strategy']}({
                                                          cacheName: CACHE + '-{$key}',
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
                                                  );\n";
              break;
            default:
              $this->serviceWorker .= "workbox.routing.registerRoute(({event}) => event.request.destination === '{$values['destination']}',
                                                      new workbox.strategies.{$values['strategy']}({
                                                          cacheName: CACHE + '-{$key}',
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
                                                  );\n";
              break;
          }
        }

        if (daftplugInstantify::getSetting('pwaOfflineGoogleAnalytics') == 'on') {
          $this->serviceWorker .= "workbox.googleAnalytics.initialize();\n";
        }

        $this->serviceWorker = apply_filters("{$this->optionName}_pwa_serviceworker_workbox", $this->serviceWorker);

        $this->serviceWorker .= "}\n";

        $this->serviceWorker .= "self.addEventListener('activate', (event) => {
                                      event.waitUntil(
                                          caches.keys()
                                              .then(keys => {
                                                  return Promise.all(
                                                      keys.map(key => {
                                                          if (/^(workbox-precache)/.test(key)) {
                                                              console.log(key);
                                                          } else if (/^(([a-zA-Z0-9]{8})-([a-z]*))/.test(key)) {
                                                              console.log(key);
                                                              if (key.indexOf(CACHE) !== 0) {
                                                                  return caches.delete(key);
                                                                  key.keys().then(keys => {
                                                                      return Promise.all(
                                                                          keys.map(key => {
                                                                              registration.index.delete(key.url);
                                                                          })
                                                                      )
                                                                  })
                                                              }
                                                          }
                                                      })
                                                  );
                                              })
                                      );
                                  });\n\n";

        if (daftplugInstantify::isOnesignalActive()) {
          $this->serviceWorker .= "importScripts('https://cdn.onesignal.com/sdks/OneSignalSDKWorker.js');\n";
        }

        if (daftplugInstantify::isWebpushrActive()) {
          $this->serviceWorker .= "importScripts('https://cdn.webpushr.com/sw-server.min.js');\n";
        }

        $this->serviceWorker = apply_filters("{$this->optionName}_pwa_serviceworker", $this->serviceWorker);

        echo "const CACHE = '" . hash('crc32', $this->serviceWorker, false) . '-' . $this->slug . "';\n\n" . $this->serviceWorker;
        die();
      }
    }

    public function renderRegisterServiceWorker()
    {
      if (!daftplugInstantifyPwa::isPwaAvailable()) {
        return;
      }

      include_once $this->daftplugInstantifyPwaPublic->partials['registerServiceWorker'];
    }

    public static function getServiceWorkerUrl($encoded = true)
    {
      $serviceWorkerUrl = untrailingslashit(strtok(home_url('/', 'https'), '?') . self::$serviceWorkerName);
      if ($encoded) {
        return wp_json_encode($serviceWorkerUrl);
      }

      return $serviceWorkerUrl;
    }
  }
}