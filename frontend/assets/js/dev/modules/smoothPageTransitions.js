import { config } from '../main.js';
import { initSwup, initSwupHeadPlugin } from '../components/swup.js';

export async function initSmoothPageTransitions() {
  initSwup();
  initSwupHeadPlugin();

  let containerSelector;
  let swupPlugins = [new SwupHeadPlugin()];

  switch (config.jsVars.pageData.builder) {
    case 'elementor':
      containerSelector = '.elementor';
      break;
    case 'divi':
      containerSelector = '#page-container';
      break;
    case 'oxygen':
      containerSelector = '.ct-inner-content';
      break;
    case 'beaver':
      containerSelector = '.fl-builder-content';
      break;
    case 'bricks':
      containerSelector = '#brx-content';
      break;
    case 'block-editor':
      containerSelector = '.wp-site-blocks';
      break;
    default:
      containerSelector = '#swup';
      break;
  }

  // Loading Progress Bar
  if (config.jsVars.settings.appCapabilities.smoothPageTransitions.progressBar === 'on') {
    const { initSwupProgressBarPlugin } = await import('../components/swup.js');
    initSwupProgressBarPlugin();
    swupPlugins.push(new SwupProgressPlugin());
  }

  // Transition Type
  if (config.jsVars.settings.appCapabilities.smoothPageTransitions.transition === 'slide') {
    const { initSwupSlideTheme } = await import('../components/swup.js');
    initSwupSlideTheme();
    swupPlugins.push(new SwupSlideTheme({ mainElement: containerSelector }));
  } else {
    const { initSwupFadeTheme } = await import('../components/swup.js');
    initSwupFadeTheme();
    swupPlugins.push(new SwupFadeTheme({ mainElement: containerSelector }));
  }

  // Compatibility Mode
  if (config.jsVars.settings.appCapabilities.smoothPageTransitions.compatibilityMode === 'on') {
    const { initSwupScriptsPlugin } = await import('../components/swup.js');
    initSwupScriptsPlugin();
    swupPlugins.push(new SwupScriptsPlugin());
    containerSelector = '#swup';
  }

  // Supported Devices
  const { device } = config.jsVars.userData;
  const supportedDevices = config.jsVars.settings.appCapabilities.smoothPageTransitions.supportedDevices;
  const isDeviceSupported = supportedDevices.some((supported) => (supported === 'smartphone' && device.isSmartphone) || (supported === 'tablet' && device.isTablet) || (supported === 'desktop' && device.isDesktop));

  if (!isDeviceSupported) {
    return;
  }

  // Init Swup
  new Swup({
    containers: [containerSelector],
    plugins: swupPlugins,
  });
}
