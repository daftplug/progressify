// Components
import { initCopyMarkup } from './components/copyMarkup.js';
import { initDependentMarkup } from './components/dependentMarkup.js';
import { initSelect } from './components/select.js';
import { initClipboard } from './components/clipboard.js';
import { initTextareaAutoHeight } from './components/autoHeightTextarea.js';
import { initInputValidation } from './components/inputValidation.js';
import { initTooltip } from './components/tooltip.js';
import { initOverlay } from './components/overlay.js';
import { initDropdown } from './components/dropdown.js';
import { initThemeMode } from './components/themeMode.js';
import { initLanguageSelect } from './components/languageSelect.js';
// Modules
import { initProcessLicense } from './modules/processLicense.js';
import { initNavigation } from './modules/navigation.js';
import { initSettings } from './modules/settings.js';
import { initSearch } from './modules/search.js';
import { initPwaUsersData } from './modules/pwaUsersData.js';
import { initPwaScoreData } from './modules/pwaScoreData.js';
import { initAppIconUpload } from './modules/appIconUpload.js';
import { initAppShortcutIconUpload } from './modules/appShortcutIconUpload.js';
import { initAppScreenshotsUpload } from './modules/appScreenshotsUpload.js';
import { initPushImageUpload } from './modules/pushImageUpload.js';
import { initPushSubscribers } from './modules/pushSubscribers.js';
import { initModalPushNotifications } from './modules/modalPushNotifications.js';
import { initPublishToAppStores } from './modules/publishToAppStores.js';
import { initSupportRequest } from './modules/supportRequest.js';
import { initChangelog } from './modules/changelog.js';

// Track which modules have been initialized
const initializedModules = new Set();

// Core modules that should always be initialized
const coreModules = [
  { init: initTooltip, name: 'tooltip' },
  { init: initOverlay, name: 'overlay' },
  { init: initInputValidation, name: 'inputValidation' },
  { init: initNavigation, name: 'navigation' },
  { init: initDropdown, name: 'dropdown' },
  { init: initSelect, name: 'select' },
  { init: initLanguageSelect, name: 'languageSelect' },
  { init: initThemeMode, name: 'themeMode' },
];

// Common modules that should be loaded on all pages except activation and error
const commonModules = [
  { init: initSearch, name: 'search' },
  { init: initSettings, name: 'settings' },
  { init: initClipboard, name: 'clipboard' },
  { init: initCopyMarkup, name: 'copyMarkup' },
  { init: initDependentMarkup, name: 'dependentMarkup' },
  { init: initTextareaAutoHeight, name: 'textareaAutoHeight' },
];

// Hash-based module mapping
const moduleMap = {
  '#/activation/': [{ init: initProcessLicense, name: 'processLicense' }],
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
};

// Initialize modules in the desired order
const initializeModules = () => {
  // Check if we're on the activation page by DOM element
  const activationElement = document.querySelector('#daftplugAdmin main[data-page-id="activation"]');
  const isActivationPage = activationElement !== null;

  // If we're on activation page but hash doesn't reflect it, update the hash
  if (isActivationPage && !window.location.hash.startsWith('#/activation/')) {
    // Set the hash without triggering another hashchange event
    history.replaceState(null, null, '#/activation/');
  }

  // Get current hash after possible update
  const currentHash = window.location.hash || '#/';

  // Initialize common modules (except on activation and error pages)
  if (!isActivationPage && !currentHash.startsWith('#/error/')) {
    commonModules.forEach((module) => {
      if (!initializedModules.has(module.name)) {
        module.init();
        initializedModules.add(module.name);
      }
    });
  }

  // Initialize core modules
  coreModules.forEach((module) => {
    if (!initializedModules.has(module.name)) {
      module.init();
      initializedModules.add(module.name);
    }
  });

  // Initialize hash-specific modules
  Object.entries(moduleMap).forEach(([hash, modules]) => {
    if (currentHash.startsWith(hash)) {
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
window.addEventListener('DOMContentLoaded', () => {
  // Explicitly call handleNavigation to ensure initial page routing
  if (typeof window.handleHashChange === 'function') {
    window.handleHashChange();
  }
});

window.addEventListener('load', () => {
  // Initialize all remaining modules in the correct order
  initializeModules();

  // Remove loading state after page is loaded
  document.querySelector('#daftplugAdminWrapper').classList.remove('-daftplugLoading');
});

// Handle hash changes - ensure navigation happens first
window.addEventListener('hashchange', () => {
  if (typeof window.handleHashChange === 'function') {
    window.handleHashChange();
  }
  setTimeout(initializeModules, 0);
});

window.addEventListener('beforeunload', () => {
  // Add loading state before page is unloaded
  document.querySelector('#daftplugAdminWrapper').classList.add('-daftplugLoading');
});
