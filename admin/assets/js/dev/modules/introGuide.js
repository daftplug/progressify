import { navigateToPage } from '../components/utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');
const { __ } = wp.i18n;

export function initIntroGuide() {
  jQuery(window).on('load', startIntroGuide);
}

// start plugin intro
function startIntroGuide() {
  if (daftplugAdmin.find('main[data-page-id="activation"]').length || localStorage.getItem(slug + '-intro-shown')) {
    return;
  }

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
          intro: __('Thank you for installing Progressify! Let me guide you through the plugin really quick.', slug),
          position: 'right',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Navigation',
          element: document.querySelector('#daftplugAdminMenu'),
          intro: __('This is the main navigation menu. You can use it to navigate through the different pages.', slug),
          position: 'right',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Search',
          element: document.querySelector('#settingsSearch'),
          intro: __('Use the search bar to search settings and features.', slug),
          position: 'bottom',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Active Users',
          element: document.querySelector('#activePwaUsers'),
          intro: __('Here will be the number of users who installed your web app and are actively using it as PWA.', slug),
          position: 'right',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Scorecard',
          element: document.querySelector('#pwaScorecard'),
          intro: __('This shows the status and overall condition of your PWA setup. Your goal should be to resolve all action items and achieve an excellent score.', slug),
          position: 'left',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Installation Analytics',
          element: document.querySelector('#pwaInstallations'),
          intro: __('Here you will see the analytics of PWA installations over time.', slug),
          position: 'top',
          onChange: function () {
            navigateToPage('dashboard');
          },
        },
        {
          title: 'Configuration',
          element: document.querySelector('#subsectionNavigationTabBar'),
          intro: __('Enable features and configure their options as you need.', slug),
          position: 'bottom',
          onChange: function () {
            navigateToPage('uiComponents');
          },
        },
        {
          title: 'Save Changes',
          element: document.querySelector('#saveSettingsButton'),
          intro: __('After making changes to the settings, you can save them by clicking buttons placed at the bottom of the settings section.', slug),
          position: 'left',
          onChange: function () {
            navigateToPage('uiComponents');
          },
        },
        {
          title: 'Get Mobile Apps',
          element: document.querySelector('#androidAndIosPlan'),
          intro: __('When you finish setting up your PWA, you can optionally request generation of Android and iOS mobile apps that mirror your website in real-time, requiring no updates, and publish your web app to the Google Play Store and App Store to reach more users.', slug),
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
    .oncomplete(function () {
      localStorage.setItem(slug + '-intro-shown', true);
    })
    .onexit(function () {
      localStorage.setItem(slug + '-intro-shown', true);
    })
    .start();
}
