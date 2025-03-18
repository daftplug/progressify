<?php

namespace DaftPlug\Progressify\Module;

use DaftPlug\Progressify\{Plugin};
use DaftPlug\Progressify\Module\WebAppManifest;

if (!defined('ABSPATH')) {
  exit();
}

class AppCapabilities
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

    add_action('template_redirect', [$this, 'wrapAllContentWithSwup']);
    add_filter("{$this->optionName}_manifest", [$this, 'addUrlProtocolHandlerToManifest']);
    add_filter("{$this->optionName}_manifest", [$this, 'addWebShareTargetToManifest']);
    add_action('plugin_loaded', [$this, 'initBiometricAuthentication']);
    add_filter("{$this->optionName}_serviceworker", [$this, 'addBackgroundSyncToServiceWorker']);
    add_filter("{$this->optionName}_serviceworker", [$this, 'addPeriodicBackgroundSyncToServiceWorker']);
    add_filter('wp_footer', [$this, 'renderPeriodicSyncRegistration']);
    add_filter("{$this->optionName}_serviceworker", [$this, 'addContentIndexingToServiceWorker']);
    add_filter('wp_footer', [$this, 'renderContentIndexing']);
    add_filter('wp_footer', [$this, 'renderPersistentStorage']);
  }

  public function wrapAllContentWithSwup()
  {
    if (Plugin::getSetting('appCapabilities[smoothPageTransitions][compatibilityMode]') !== 'on') {
      return;
    }

    if (is_admin() || wp_doing_ajax()) {
      return;
    }

    ob_start();

    add_action(
      'shutdown',
      function () {
        $content = ob_get_clean();

        if (!empty($content) && false !== strpos($content, '<body')) {
          libxml_use_internal_errors(true);
          $dom = new \DOMDocument();
          $dom->loadHTML($content, LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED);

          $body = $dom->getElementsByTagName('body')->item(0);
          if ($body) {
            $wrapper = $dom->createElement('div');
            $wrapper->setAttribute('id', 'swup');

            while ($body->firstChild) {
              $wrapper->appendChild($body->firstChild);
            }
            $body->appendChild($wrapper);
            $content = $dom->saveHTML();
          }
        }

        echo $content;
      },
      0
    );
  }

  public function addUrlProtocolHandlerToManifest($manifest)
  {
    if (Plugin::getSetting('appCapabilities[urlProtocolHandler][feature]') !== 'on') {
      return $manifest;
    }

    $manifest['protocol_handlers'][] = [
      'protocol' => 'web+' . Plugin::getSetting('appCapabilities[urlProtocolHandler][protocol]'),
      'url' => Plugin::getSetting('appCapabilities[urlProtocolHandler][url]'),
    ];

    return $manifest;
  }

  public function addWebShareTargetToManifest($manifest)
  {
    if (Plugin::getSetting('appCapabilities[webShareTarget][feature]') !== 'on') {
      return $manifest;
    }

    $manifest['share_target'] = [
      'action' => Plugin::getSetting('appCapabilities[webShareTarget][action]'),
      'method' => 'GET',
      'enctype' => 'application/x-www-form-urlencoded',
      'params' => [
        'title' => 'title',
        'text' => 'text',
        'url' => Plugin::getSetting('appCapabilities[webShareTarget][urlQuery]'),
      ],
    ];

    return $manifest;
  }

  public function initBiometricAuthentication()
  {
    if (Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on' || Plugin::getSetting('appCapabilities[advancedWebCapabilities][biometricAuthentication]') !== 'on') {
      return;
    }

    require_once plugin_dir_path(dirname(__FILE__)) . 'libs/biometric-authentication/biometric-authentication.php';

    if (function_exists('plwp_create_tables')) {
      plwp_create_tables();
    }
  }

  public function addBackgroundSyncToServiceWorker($serviceWorker)
  {
    if (Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on' || Plugin::getSetting('appCapabilities[advancedWebCapabilities][backgroundSync]') !== 'on') {
      return $serviceWorker;
    }

    $serviceWorker .= "
    workbox.loadModule('workbox-background-sync');
    workbox.routing.registerRoute(
    new RegExp('^(?!.*wp-admin).*$'),
    new workbox.strategies.NetworkOnly({
    plugins: [
    new workbox.backgroundSync.BackgroundSyncPlugin('backgroundSyncQueue', {
    maxRetentionTime: 24 * 60, // Retry for 24 Hours (in minutes)
    onSync: async ({queue}) => {
    try {
    await queue.replayRequests();
    console.log('Background sync completed');
    } catch (error) {
    console.error('Background sync failed:', error);
    }
    }
    })
    ]
    }),
    'POST'
    );";

    return $serviceWorker;
  }

  public function addPeriodicBackgroundSyncToServiceWorker($serviceWorker)
  {
    if (Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on' || Plugin::getSetting('appCapabilities[advancedWebCapabilities][periodicBackgroundSync]') !== 'on') {
      return $serviceWorker;
    }

    $serviceWorker .=
      "
    async function fetchAndCacheContent() {
    try {
    const request = '" .
      trailingslashit(strtok(home_url('/', 'https'), '?')) .
      "';
    const cache = await caches.open(CACHE_PREFIX + '-periodic-' + CACHE_VERSION);

    const response = await fetch(request, {
    credentials: 'same-origin',
    headers: {
    'Accept': 'text/html',
    'Cache-Control': 'no-cache'
    }
    });

    if (!response.ok) {
    throw new Error('Periodic sync fetch failed: ' + response.status);
    }

    await cache.put(request, response.clone());

    // Clean up old cached responses
    const keys = await cache.keys();
    await Promise.all(
    keys.map(key => {
    if (key.url !== request) {
    return cache.delete(key);
    }
    })
    );

    console.log('Periodic sync completed successfully');
    } catch (error) {
    console.error('Periodic sync error:', error);
    }
    }

    self.addEventListener('periodicsync', (event) => {
    if (event.tag === 'content-sync') {
    event.waitUntil(fetchAndCacheContent());
    }
    });
    ";

    return $serviceWorker;
  }

  public function renderPeriodicSyncRegistration()
  {
    if (Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on' || Plugin::getSetting('appCapabilities[advancedWebCapabilities][periodicBackgroundSync]') !== 'on') {
      return;
    } ?>
<script>
window.addEventListener('load', async function() {
  try {
    if (!('serviceWorker' in navigator)) {
      return;
    }
    const registration = await navigator.serviceWorker.ready;

    if (!('periodicSync' in registration)) {
      console.log('Periodic sync not supported');
      return;
    }
    const status = await navigator.permissions.query({
      name: 'periodic-background-sync',
    });
    if (status.state === 'granted') {
      try {
        await registration.periodicSync.register('content-sync', {
          minInterval: 24 * 60 * 60 * 1000 // 24 hours
        });
        console.log('Periodic sync registered');
      } catch (error) {
        console.error('Periodic sync registration failed:', error);
      }
    }
  } catch (error) {
    console.error('Periodic sync setup failed:', error);
  }
});
</script>
<?php
  }

  public function addContentIndexingToServiceWorker($serviceWorker)
  {
    if (Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on' || Plugin::getSetting('appCapabilities[advancedWebCapabilities][contentIndexing]') !== 'on') {
      return $serviceWorker;
    }

    $serviceWorker .= "
        self.addEventListener('activate', event => {
            event.waitUntil(
                (async () => {
                    // Clean up content index
                    if ('index' in self.registration) {
                        try {
                            const entries = await self.registration.index.getAll();
                            await Promise.all(
                                entries.map(async entry => {
                                    const isCached = await caches.match(entry.url);
                                    if (!isCached) {
                                        await self.registration.index.delete(entry.id);
                                        console.log('Removed uncached entry from content index:', entry.url);
                                    }
                                })
                            );
                        } catch (error) {
                            console.error('Error cleaning up content index:', error);
                        }
                    }
                })()
            );
        });
    ";

    return $serviceWorker;
  }

  public function renderContentIndexing()
  {
    if (Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on' || Plugin::getSetting('appCapabilities[advancedWebCapabilities][contentIndexing]') !== 'on') {
      return;
    } ?>
<script>
window.addEventListener('load', async function() {
  try {
    if (!('serviceWorker' in navigator)) {
      return;
    }

    const registration = await navigator.serviceWorker.ready;

    if (!('index' in registration)) {
      console.log('Content indexing not supported');
      return;
    }

    // Get the current page metadata
    const pageMetadata = {
      id: window.location.href,
      url: window.location.href,
      title: document.title,
      description: document.querySelector('meta[name=\"description\"]')?.content || '',
      icons: [{
        src: "<?php echo esc_url(WebAppManifest::getPwaIconUrl('maskable', 180)); ?>",
        sizes: '150x150',
        type: 'image/png',
      }],
      category: 'article'
    };

    // Check if the page is cached before adding to index
    const cacheNames = await caches.keys();
    const htmlCaches = cacheNames.filter(name => name.endsWith('-html'));

    for (const cacheName of htmlCaches) {
      const cache = await caches.open(cacheName);
      const keys = await cache.keys();
      const isPageCached = keys.some(key => key.url === window.location.href);

      if (isPageCached) {
        await registration.index.add(pageMetadata);
        console.log('Page added to content index:', pageMetadata.url);
        break;
      }
    }

    // Remove from index when page is unloaded
    window.addEventListener('unload', async () => {
      try {
        await registration.index.delete(pageMetadata.id);
        console.log('Page removed from content index:', pageMetadata.url);
      } catch (error) {
        console.error('Error removing from content index:', error);
      }
    });

  } catch (error) {
    console.error('Content indexing setup failed:', error);
  }
});
</script>
<?php
  }

  public function renderPersistentStorage()
  {
    if (Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]') !== 'on' || Plugin::getSetting('appCapabilities[advancedWebCapabilities][persistentStorage]') !== 'on') {
      return;
    } ?>
<script>
async function requestPersistentStorage() {
  try {
    if (!('storage' in navigator) || !('persist' in navigator.storage)) {
      console.log('Persistent storage not supported');
      return false;
    }

    const isPersisted = await navigator.storage.persisted();
    if (isPersisted) {
      console.log('Storage persistence already granted');
      return true;
    }

    // First try the Storage API directly
    let persisted = await navigator.storage.persist();
    if (persisted) {
      console.log('Storage persistence granted');

      if ('estimate' in navigator.storage) {
        const estimate = await navigator.storage.estimate();
        console.log('Storage quota:', Math.round(estimate.quota / 1024 / 1024), 'MB');
        console.log('Storage usage:', Math.round(estimate.usage / 1024 / 1024), 'MB');
      }
      return true;
    }

    console.log('Storage persistence not granted. The site may need to be installed as a PWA or meet other browser requirements.');
    return false;
  } catch (error) {
    console.error('Error requesting persistent storage:', error);
    return false;
  }
}

// Try requesting when the page loads
requestPersistentStorage();

// Also try again if the page becomes installed as a PWA
window.addEventListener('appinstalled', () => {
  requestPersistentStorage();
});
</script>
<?php
  }
}