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
import { initNavigation } from './modules/navigation.js';
import { initSettings } from './modules/settings.js';
import { initAppIconUpload } from './modules/appIconUpload.js';
import { initAppShortcutIconUpload } from './modules/appShortcutIconUpload.js';
import { initAppScreenshotsUpload } from './modules/appScreenshotsUpload.js';
import { initPushImageUpload } from './modules/pushImageUpload.js';
import { initSupportAttachments } from './modules/supportAttachments.js';
import { initOverlayBackdropFix } from './modules/overlayBackdropFix.js';
import { initChangelog } from './modules/changelog.js';
// import { initApexcharts } from './modules/apexcharts.js';
// import { initInstallationsChart } from './modules/installationsChart.js';

// Load modules
document.addEventListener('DOMContentLoaded', async function () {
  // Components
  initCopyMarkup();
  initDependentMarkup();
  initSelect();
  initClipboard();
  initTextareaAutoHeight();

  // Modules
  initNavigation();
  initSettings();
  initAppIconUpload();
  initAppShortcutIconUpload();
  initAppScreenshotsUpload();
  initInputValidation();
  initPushImageUpload();
  initSupportAttachments();
  initOverlayBackdropFix();
  initChangelog();
  // initApexcharts();
  // initInstallationsChart();
});
