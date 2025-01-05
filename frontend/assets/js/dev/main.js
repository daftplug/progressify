export const config = (() => {
  const daftplugFrontend = document.getElementById('daftplugFrontend');
  const optionName = daftplugFrontend.getAttribute('data-option-name');
  const jsVars = window[optionName + '_frontend_js_vars'] || {};

  return {
    daftplugFrontend,
    optionName,
    jsVars,
  };
})();

// Load modules
document.addEventListener('DOMContentLoaded', async function () {
  // Loader
  if (config.jsVars.settings.uiComponents?.loader?.feature === 'on') {
    const { initLoader } = await import('./modules/loader.js');
    await initLoader();
  }

  // Installation Overlays and Button
  if (config.jsVars.settings.installation?.prompts?.feature === 'on') {
    // Install Url
    const { initInstallUrl } = await import('./modules/installUrl.js');
    await initInstallUrl();

    // Installation Button
    const { initInstallButton } = await import('./modules/installButton.js');
    await initInstallButton();

    // Installation Overlay - Header Banner
    if (config.jsVars.settings.installation?.prompts?.types?.headerBanner === 'on') {
      const { initInstallOverlayHeaderBanner } = await import('./modules/installOverlayHeaderBanner.js');
      await initInstallOverlayHeaderBanner();
    }

    // Installation Overlay - Snackbar
    if (config.jsVars.settings.installation?.prompts?.types?.snackbar === 'on') {
      const { initInstallOverlaySnackbar } = await import('./modules/installOverlaySnackbar.js');
      await initInstallOverlaySnackbar();
    }

    // Installation Overlay - Blog Popup
    if (config.jsVars.settings.installation?.prompts?.types?.blogPopup === 'on') {
      const { initInstallOverlayBlogPopup } = await import('./modules/installOverlayBlogPopup.js');
      await initInstallOverlayBlogPopup();
    }

    // Installation Overlay - Navigation Menu
    if (config.jsVars.settings.installation?.prompts?.types?.navigationMenu === 'on') {
      const { initInstallOverlayNavigationMenu } = await import('./modules/installOverlayNavigationMenu.js');
      await initInstallOverlayNavigationMenu();
    }

    // Installation Overlay - In Feed
    if (config.jsVars.settings.installation?.prompts?.types?.inFeed === 'on') {
      const { initInstallOverlayInFeed } = await import('./modules/installOverlayInFeed.js');
      await initInstallOverlayInFeed();
    }

    // Installation Overlay - Woocommerce Checkout
    if (config.jsVars.settings.installation?.prompts?.types?.woocommerceCheckout === 'on') {
      const { initInstallOverlayWoocommerceCheckout } = await import('./modules/installOverlayWoocommerceCheckout.js');
      await initInstallOverlayWoocommerceCheckout();
    }
  }

  // Offline Capabilities
  if (config.jsVars.settings.offlineUsage?.capabilities?.feature === 'on') {
    // Offline Notification
    if (config.jsVars.settings.offlineUsage?.capabilities?.notification === 'on') {
      const { initOfflineNotification } = await import('./modules/offlineNotification.js');
      await initOfflineNotification();
    }

    // Offline Forms
    if (config.jsVars.settings.offlineUsage?.capabilities?.forms === 'on') {
      const { initOfflineForms } = await import('./modules/offlineForms.js');
      await initOfflineForms();
    }
  }

  // Navigation Tab Bar
  if (config.jsVars.settings.uiComponents?.navigationTabBar?.feature === 'on') {
    const { initNavigationTabBar } = await import('./modules/navigationTabBar.js');
    await initNavigationTabBar();
  }

  // Scroll Progress Bar
  if (config.jsVars.settings.uiComponents?.scrollProgressBar?.feature === 'on') {
    const { initScrollProgressBar } = await import('./modules/scrollProgressBar.js');
    await initScrollProgressBar();
  }

  // Dark Mode
  if (config.jsVars.settings.uiComponents?.darkMode?.feature === 'on') {
    const { initDarkMode } = await import('./modules/darkMode.js');
    await initDarkMode();
  }

  // Pull Down Refresh
  if (config.jsVars.settings.uiComponents?.pullDownRefresh?.feature === 'on') {
    const { initPullDownRefresh } = await import('./modules/pullDownRefresh.js');
    await initPullDownRefresh();
  }

  // Shake Refresh
  if (config.jsVars.settings.uiComponents?.shakeRefresh?.feature === 'on') {
    const { initShakeRefresh } = await import('./modules/shakeRefresh.js');
    await initShakeRefresh();
  }

  // Inactive Blur
  if (config.jsVars.settings.uiComponents?.inactiveBlur?.feature === 'on') {
    const { initInactiveBlur } = await import('./modules/inactiveBlur.js');
    await initInactiveBlur();
  }

  // Toast Messages
  if (config.jsVars.settings.uiComponents?.toastMessages?.feature === 'on') {
    const { initToastMessages } = await import('./modules/toastMessages.js');
    await initToastMessages();
  }

  // Smooth Page Transitions
  if (config.jsVars.settings.appCapabilities?.smoothPageTransitions?.feature === 'on') {
    const { initSmoothPageTransitions } = await import('./modules/smoothPageTransitions.js');
    await initSmoothPageTransitions();
  }

  // Vibrations
  if (config.jsVars.settings.appCapabilities?.vibrations?.feature === 'on') {
    const { initVibrations } = await import('./modules/vibrations.js');
    await initVibrations();
  }

  // Idle Detection
  if (config.jsVars.settings.appCapabilities?.idleDetection?.feature === 'on') {
    const { initIdleDetection } = await import('./modules/idleDetection.js');
    await initIdleDetection();
  }

  // Screen Wake Lock
  if (config.jsVars.settings.appCapabilities?.screenWakeLock?.feature === 'on') {
    const { initScreenWakeLock } = await import('./modules/screenWakeLock.js');
    await initScreenWakeLock();
  }

  // Push Notifications Prompt
  if (config.jsVars.settings.pushNotifications?.prompt?.feature === 'on') {
    const { initPushNotificationsPrompt } = await import('./modules/pushNotificationsPrompt.js');
    await initPushNotificationsPrompt();
  }

  // Push Notifications Button
  if (config.jsVars.settings.pushNotifications?.button?.feature === 'on') {
    const { initPushNotificationsButton } = await import('./modules/pushNotificationsButton.js');
    await initPushNotificationsButton();
  }
});
