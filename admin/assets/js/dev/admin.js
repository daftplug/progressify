export const config = (() => {
  const daftplugAdminElm = jQuery('#daftplugAdmin');
  const optionName = daftplugAdminElm.attr('data-option-name');
  const jsVars = window[optionName + '_admin_js_vars'] || {};

  return {
    daftplugAdminElm,
    optionName,
    jsVars,
  };
})();

// Navigation function
import { navigateToPage } from './components/utils.js';

// Components
import { initCopyMarkup } from './components/copyMarkup.js';
import { initDependentMarkup } from './components/dependentMarkup.js';
import { initSelect } from './components/select.js';
import { initClipboard } from './components/clipboard.js';
import { initInputValidation } from './components/inputValidation.js';
import { initTooltip } from './components/tooltip.js';
import { initOverlay } from './components/overlay.js';
import { initDropdown } from './components/dropdown.js';
// Modules
import { initProcessLicense } from './modules/processLicense.js';
import { initIntroGuide } from './modules/introGuide.js';
import { initSettings } from './modules/settings.js';
import { initSearch } from './modules/search.js';
import { initPwaUsersData } from './modules/pwaUsersData.js';
import { initPwaScoreData } from './modules/pwaScoreData.js';
import { initAppIconUpload } from './modules/appIconUpload.js';
import { initAppShortcutIconUpload } from './modules/appShortcutIconUpload.js';
import { initAppScreenshotsUpload } from './modules/appScreenshotsUpload.js';
import { initCustomCssJsEditor } from './modules/customCssJsEditor.js';
import { initPushImageUpload } from './modules/pushImageUpload.js';
import { initPushSubscribers } from './modules/pushSubscribers.js';
import { initModalPushNotifications } from './modules/modalPushNotifications.js';
import { initGenerateMobileApps } from './modules/generateMobileApps.js';
import { initSupportRequest } from './modules/supportRequest.js';
import { initChangelog } from './modules/changelog.js';

// Track which modules have been initialized
const initializedModules = new Set();

// Core modules that should always be initialized
const coreModules = [
  { init: initTooltip, name: 'tooltip' },
  { init: initOverlay, name: 'overlay' },
  { init: initInputValidation, name: 'inputValidation' },
  { init: initDropdown, name: 'dropdown' },
  { init: initSelect, name: 'select' },
];

// Common modules that should be loaded on all pages except activation and error
const commonModules = [
  { init: initSearch, name: 'search' },
  { init: initSettings, name: 'settings' },
  { init: initClipboard, name: 'clipboard' },
  { init: initCopyMarkup, name: 'copyMarkup' },
  { init: initDependentMarkup, name: 'dependentMarkup' },
  { init: initIntroGuide, name: 'introGuide' },
];

// Hash-based module mapping
const moduleMap = {
  '#/activation': [{ init: initProcessLicense, name: 'processLicense' }],
  '#/dashboard': [
    { init: initPwaUsersData, name: 'pwaUsersData' },
    { init: initPwaScoreData, name: 'pwaScoreData' },
  ],
  '#/webAppManifest': [
    { init: initAppIconUpload, name: 'appIconUpload' },
    { init: initAppShortcutIconUpload, name: 'appShortcutIconUpload' },
    { init: initAppScreenshotsUpload, name: 'appScreenshotsUpload' },
  ],
  '#/pushNotifications': [
    { init: initPushImageUpload, name: 'pushImageUpload' },
    { init: initPushSubscribers, name: 'pushSubscribers' },
    { init: initModalPushNotifications, name: 'modalPushNotifications' },
  ],
  '#/uiComponents': [{ init: initCustomCssJsEditor, name: 'customCssJsEditor' }],
  '#/generateMobileApps': [{ init: initGenerateMobileApps, name: 'generateMobileApps' }],
  '#/helpCenter': [{ init: initSupportRequest, name: 'supportRequest' }],
  '#/changelog': [{ init: initChangelog, name: 'changelog' }],
};

// Initialize modules in the desired order
const initializeModules = () => {
  // Check if we're on the activation page by DOM element
  const activationElement = document.querySelector('#daftplugAdmin main[data-page-id="activation"]');
  const isActivationPage = activationElement !== null;
  const normalizeHash = (hash) => {
    if (!hash || hash === '#/' || hash === '#') return '#/dashboard';
    return hash.replace(/\/$/, '');
  };

  // If we're on activation page but hash doesn't reflect it, update the hash
  if (isActivationPage && !window.location.hash.startsWith('#/activation')) {
    // Set the hash without triggering another hashchange event
    history.replaceState(null, null, '#/activation');
  }

  // Get current hash after possible update
  const currentHash = normalizeHash(window.location.hash);

  // Initialize common modules (except on activation and error pages)
  if (!isActivationPage && !currentHash.startsWith('#/error')) {
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

const initializeNavigation = () => {
  if (config.daftplugAdminElm.find('main[data-page-id="activation"]').length) {
    return navigateToPage('activation');
  }

  if (location.hash) {
    const hashValue = location.hash.replace(/#|\//g, '');
    const [pageId, subPageId] = hashValue.split('-');
    return navigateToPage(pageId, subPageId);
  } else {
    return navigateToPage('dashboard');
  }
};

const initializeLoaderRemoving = () => {
  document.querySelector('#daftplugAdminWrapper').classList.remove('-daftplugLoading');
};

const initializeMenuFolding = () => {
  const wpAdminMenu = document.querySelector('#adminmenumain');
  if (wpAdminMenu) {
    wpAdminMenu.addEventListener('mouseenter', () => {
      document.body.classList.remove('folded');
    });
    wpAdminMenu.addEventListener('mouseleave', () => {
      document.body.classList.add('folded');
    });
  }
};

window.addEventListener('DOMContentLoaded', () => {
  initializeNavigation().then(() => {
    initializeModules();
    initializeLoaderRemoving();
    initializeMenuFolding();
  });
});

window.addEventListener('hashchange', () => {
  initializeNavigation().then(() => {
    initializeModules();
  });
});
