import { config } from '../frontend.js';
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
    document.head.insertAdjacentHTML('beforeend', '<style>.swup-progress-bar { background-color: ' + config.jsVars.settings.webAppManifest.appearance.themeColor + ' !important; }</style>');
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

  // Init Swup
  new Swup({
    containers: [containerSelector],
    plugins: swupPlugins,
  });
}
