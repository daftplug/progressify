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
import { initPublishOnAppStores } from './modules/publishAppStores.js';
import { initSupportRequest } from './modules/supportRequest.js';
import { initChangelog } from './modules/changelog.js';

// Core modules that should always be initialized
const coreModules = [initProcessLicense, initCopyMarkup, initDependentMarkup, initSelect, initClipboard, initTextareaAutoHeight, initInputValidation, initNavigation, initOverlayBackdropFix, initSearch, initSettings];

// Hash-based module mapping
const moduleMap = {
  '#/dashboard/': [initPwaUsersData, initPwaScoreData],
  '#/webAppManifest/': [initAppIconUpload, initAppShortcutIconUpload, initAppScreenshotsUpload],
  '#/pushNotifications/': [initPushImageUpload, initPushSubscribers, initModalPushNotifications],
  '#/publishOnAppStores/': initPublishOnAppStores,
  '#/helpCenter/': initSupportRequest,
  '#/changelog/': initChangelog,
};

// Load modules based on current hash
const loadHashModules = () => {
  const currentHash = window.location.hash || '#/';

  // Initialize core modules
  coreModules.forEach((module) => module());

  // Initialize hash-specific modules
  Object.entries(moduleMap).forEach(([hash, modules]) => {
    if (currentHash.startsWith(hash)) {
      if (Array.isArray(modules)) {
        modules.forEach((module) => module());
      } else {
        modules();
      }
    }
  });
};

// Load modules
document.addEventListener('DOMContentLoaded', loadHashModules);

// Listen for hash changes
window.addEventListener('hashchange', loadHashModules);
