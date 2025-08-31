import { config } from '../admin.js';
import { navigateToPage, setCookie, getCookie } from '../components/utils.js';

export function initIntroGuide() {
  jQuery(window).on('load', startIntroGuide);
}

// start plugin intro
function startIntroGuide() {
  if (config.daftplugAdminElm.find('main[data-page-id="activation"]').length || getCookie(config.jsVars.slug + '-intro-shown')) {
    return;
  }

  setCookie(config.jsVars.slug + '-intro-shown', true, 9999);

  introJs('#daftplugAdminWrapper')
    .setOptions({
      dontShowAgain: false,
      showBullets: false,
      showProgress: true,
      hidePrev: true,
      nextToDone: true,
      exitOnEsc: true,
      exitOnOverlayClick: false,
      showStepNumbers: false,
      keyboardNavigation: true,
      scrollToElement: false,
      disableInteraction: true,
      steps: [
        {
          title: 'Hello 👋',
          element: document.querySelector('#daftplugAdminLogo'),
          intro: wp.i18n.__('Thank you for installing Progressify! Let me guide you through the plugin really quick.', config.jsVars.slug),
          position: 'right',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Navigation',
          element: document.querySelector('#daftplugAdminMenu'),
          intro: wp.i18n.__('This is the main navigation menu. You can use it to navigate through the different pages.', config.jsVars.slug),
          position: 'right',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Search',
          element: document.querySelector('#settingsSearch'),
          intro: wp.i18n.__('Use the search bar to search settings and features.', config.jsVars.slug),
          position: 'bottom',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Active Users',
          element: document.querySelector('#activePwaUsers'),
          intro: wp.i18n.__('Here will be the number of users who installed your web app and are actively using it as PWA.', config.jsVars.slug),
          position: 'right',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Scorecard',
          element: document.querySelector('#pwaScorecard'),
          intro: wp.i18n.__('This shows the status and overall condition of your PWA setup. Your goal should be to resolve all action items and achieve an excellent score.', config.jsVars.slug),
          position: 'left',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Installation Analytics',
          element: document.querySelector('#pwaInstallations'),
          intro: wp.i18n.__('Here you will see the analytics of PWA installations over time.', config.jsVars.slug),
          position: 'top',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Configuration',
          element: document.querySelector('#subsectionNavigationTabBar'),
          intro: wp.i18n.__('Enable features and configure their options as you need.', config.jsVars.slug),
          position: 'bottom',
          onChange: function () {
            navigateToPage('uiComponents');
          },
        },
        {
          title: 'Save Changes',
          element: document.querySelector('#saveSettingsButton'),
          intro: wp.i18n.__('After making changes to the settings, you can save them by clicking buttons placed at the bottom of the settings section.', config.jsVars.slug),
          position: 'left',
          onChange: function () {
            navigateToPage('uiComponents');
          },
        },
        {
          title: 'Get Mobile Apps',
          element: document.querySelector('#androidAndIosPlan'),
          intro: wp.i18n.__('When you finish setting up your PWA, you can optionally request generation of Android and iOS mobile apps that mirror your website in real-time, requiring no updates, and publish your web app to the Google Play Store and App Store to reach more users.', config.jsVars.slug),
          position: 'left',
          onChange: function () {
            navigateToPage('generateMobileApps');
          },
        },
      ],
    })
    .onchange(function () {
      if (this._introItems[this._currentStep].onChange) {
        this._introItems[this._currentStep].onChange();
      }
    })
    .start();
}
