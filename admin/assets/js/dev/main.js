// Preline
import '../../../../node_modules/preline/dist/preline.js';

// Components
import { initCopyMarkup } from './components/copyMarkup.js';
import { initDependentMarkup } from './components/dependentMarkup.js';
import { initSelect } from './components/select.js';
import { initClipboard } from './components/clipboard.js';
import { initTextareaAutoHeight } from './components/autoHeightTextarea.js';
import { initInputValidation } from './components/inputValidation.js';

// Modules
import { initProcessLicense } from './modules/processLicense.js';
import { initNavigation } from './modules/navigation.js';
import { initSettings } from './modules/settings.js';
import { initSearch } from './modules/search.js';
import { initOverlayBackdropFix } from './modules/overlayBackdropFix.js';
import { initPwaUsersData } from './modules/pwaUsersData.js';
import { initPwaScoreData } from './modules/pwaScoreData.js';
import { initAppIconUpload } from './modules/appIconUpload.js';
import { initAppShortcutIconUpload } from './modules/appShortcutIconUpload.js';
import { initAppScreenshotsUpload } from './modules/appScreenshotsUpload.js';
import { initPushImageUpload } from './modules/pushImageUpload.js';
import { initPushSubscribers } from './modules/pushSubscribers.js';
import { initModalPushNotifications } from './modules/modalPushNotifications.js';
import { initPublishToAppStores } from './modules/publishAppStores.js';
import { initSupportRequest } from './modules/supportRequest.js';
import { initChangelog } from './modules/changelog.js';

// Track which modules have been initialized
const initializedModules = new Set();

// Core modules that should always be initialized
const coreModules = [
  { init: initProcessLicense, name: 'processLicense' },
  { init: initCopyMarkup, name: 'copyMarkup' },
  { init: initDependentMarkup, name: 'dependentMarkup' },
  { init: initSelect, name: 'select' },
  { init: initClipboard, name: 'clipboard' },
  { init: initInputValidation, name: 'inputValidation' },
  { init: initNavigation, name: 'navigation' },
];

// Hash-based module mapping
const moduleMap = {
  '#/dashboard/': [
    { init: initPwaUsersData, name: 'pwaUsersData' },
    { init: initPwaScoreData, name: 'pwaScoreData' },
  ],
  '#/webAppManifest/': [
    { init: initAppIconUpload, name: 'appIconUpload' },
    { init: initAppShortcutIconUpload, name: 'appShortcutIconUpload' },
    { init: initAppScreenshotsUpload, name: 'appScreenshotsUpload' },
  ],
  '#/pushNotifications/': [
    { init: initPushImageUpload, name: 'pushImageUpload' },
    { init: initPushSubscribers, name: 'pushSubscribers' },
    { init: initModalPushNotifications, name: 'modalPushNotifications' },
  ],
  '#/publishToAppStores/': [{ init: initPublishToAppStores, name: 'publishToAppStores' }],
  '#/helpCenter/': [{ init: initSupportRequest, name: 'supportRequest' }],
  '#/changelog/': [{ init: initChangelog, name: 'changelog' }],
  '!#/error/': [
    { init: initSearch, name: 'search' },
    { init: initSettings, name: 'settings' },
    { init: initOverlayBackdropFix, name: 'overlayBackdropFix' },
    { init: initTextareaAutoHeight, name: 'textareaAutoHeight' },
  ],
};

// Initialize modules for current hash
const loadHashModules = () => {
  const currentHash = window.location.hash || '#/';

  // Initialize hash-specific modules if not already initialized
  Object.entries(moduleMap).forEach(([hash, modules]) => {
    // Check if this is a negative condition (hash starts with !)
    if (hash.startsWith('!')) {
      const excludeHash = hash.substring(1); // Remove the ! character
      // Initialize modules only if current hash does NOT start with the specified hash
      if (!currentHash.startsWith(excludeHash)) {
        modules.forEach((module) => {
          if (!initializedModules.has(module.name)) {
            module.init();
            initializedModules.add(module.name);
          }
        });
      }
    } else if (currentHash.startsWith(hash)) {
      // Regular positive hash condition
      modules.forEach((module) => {
        if (!initializedModules.has(module.name)) {
          module.init();
          initializedModules.add(module.name);
        }
      });
    }
  });
};

// Initialize on page load
window.addEventListener('load', () => {
  // Initialize core modules once
  coreModules.forEach((module) => {
    if (!initializedModules.has(module.name)) {
      module.init();
      initializedModules.add(module.name);
    }
  });

  // Load hash-specific modules
  loadHashModules();

  // Remove loading state after page is loaded
  document.querySelector('#daftplugAdmin .-daftplugLoading').classList.remove('-daftplugLoading');
});

// Handle hash changes
window.addEventListener('hashchange', loadHashModules);
