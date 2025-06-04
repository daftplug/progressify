import { isReturningVisitor, getCookie, setCookie, isPwa } from './components/utils.js';
import PushNotificationsSubscription from './components/pushNotificationsSubscription.js';

export const config = (() => {
  const optionName = 'daftplug_progressify';
  const jsVars = window[optionName + '_frontend_js_vars'] || {};

  return {
    optionName,
    jsVars,
  };
})();

const { settings, userData, pluginsData, pageData } = config.jsVars;

// Delayed loading mechanism
let delayedModulesLoaded = false;

const loadDelayedModules = async () => {
  if (delayedModulesLoaded) return;
  delayedModulesLoaded = true;

  // Remove event listeners to prevent multiple executions
  document.removeEventListener('mousemove', loadDelayedModules);
  document.removeEventListener('scroll', loadDelayedModules);
  document.removeEventListener('touchstart', loadDelayedModules);
  document.removeEventListener('keydown', loadDelayedModules);

  // Installation Overlays
  if (settings?.installation?.prompts?.feature === 'on' && !isPwa()) {
    if (settings?.installation?.prompts?.skipFirstVisit !== 'on' || isReturningVisitor()) {
      // Installation Overlay - Header Banner
      if (settings?.installation?.prompts?.types?.headerBanner?.feature === 'on' && !getCookie('pwa_header_banner_overlay_shown')) {
        const { initInstallOverlayHeaderBanner } = await import('./modules/installOverlayHeaderBanner.js');
        await initInstallOverlayHeaderBanner();
        setCookie(`pwa_header_banner_overlay_shown`, 'true', settings?.installation?.prompts?.timeout ?? 1);
      }

      // Installation Overlay - Snackbar
      if (settings?.installation?.prompts?.types?.snackbar?.feature === 'on' && (userData?.device?.isSmartphone || userData?.device?.isTablet) && !getCookie('pwa_snackbar_overlay_shown')) {
        const { initInstallOverlaySnackbar } = await import('./modules/installOverlaySnackbar.js');
        await initInstallOverlaySnackbar();
        setCookie(`pwa_snackbar_overlay_shown`, 'true', settings?.installation?.prompts?.timeout ?? 1);
      }

      // Installation Overlay - Blog Popup
      if (settings?.installation?.prompts?.types?.blogPopup?.feature === 'on' && pageData?.type?.isBlogPost && (userData?.device?.isSmartphone || userData?.device?.isTablet) && !getCookie('pwa_blog_popup_overlay_shown')) {
        const { initInstallOverlayBlogPopup } = await import('./modules/installOverlayBlogPopup.js');
        await initInstallOverlayBlogPopup();
        setCookie(`pwa_blog_popup_overlay_shown`, 'true', settings?.installation?.prompts?.timeout ?? 1);
      }

      // Installation Overlay - Navigation Menu
      if (settings?.installation?.prompts?.types?.navigationMenu?.feature === 'on' && (userData?.device?.isSmartphone || userData?.device?.isTablet)) {
        const { initInstallOverlayNavigationMenu } = await import('./modules/installOverlayNavigationMenu.js');
        await initInstallOverlayNavigationMenu();
      }

      // Installation Overlay - In Feed
      if (settings?.installation?.prompts?.types?.inFeed?.feature === 'on' && (userData?.device?.isSmartphone || userData?.device?.isTablet)) {
        const { initInstallOverlayInFeed } = await import('./modules/installOverlayInFeed.js');
        await initInstallOverlayInFeed();
      }

      // Installation Overlay - Woocommerce Checkout
      if (settings?.installation?.prompts?.types?.woocommerceCheckout?.feature === 'on' && pluginsData?.isActive?.woocommerce && document.body.classList.contains('woocommerce-checkout') && (userData?.device?.isSmartphone || userData?.device?.isTablet)) {
        const { initInstallOverlayWoocommerceCheckout } = await import('./modules/installOverlayWoocommerceCheckout.js');
        await initInstallOverlayWoocommerceCheckout();
      }
    }
  }

  // Offline Capabilities
  if (settings?.offlineUsage?.capabilities?.feature === 'on') {
    // Offline Notification
    if (settings?.offlineUsage?.capabilities?.notification?.feature === 'on') {
      const { initOfflineNotification } = await import('./modules/offlineNotification.js');
      await initOfflineNotification();
    }

    // Offline Forms
    if (settings?.offlineUsage?.capabilities?.forms?.feature === 'on') {
      const { initOfflineForms } = await import('./modules/offlineForms.js');
      await initOfflineForms();
    }
  }

  // Navigation Tab Bar
  if (settings?.uiComponents?.navigationTabBar?.feature === 'on' && settings?.uiComponents?.navigationTabBar?.navigationItems.some((item) => item.icon && item.label && item.page) && settings?.uiComponents?.navigationTabBar?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet))) {
    const { initNavigationTabBar } = await import('./modules/navigationTabBar.js');
    await initNavigationTabBar();
  }

  // Scroll Progress Bar
  if (settings?.uiComponents?.scrollProgressBar?.feature === 'on' && settings?.uiComponents?.scrollProgressBar?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet) || (supported === 'desktop' && userData?.device?.isDesktop))) {
    const { initScrollProgressBar } = await import('./modules/scrollProgressBar.js');
    await initScrollProgressBar();
  }

  // Dark Mode
  if (settings?.uiComponents?.darkMode?.feature === 'on' && settings?.uiComponents?.darkMode?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet) || (supported === 'desktop' && userData?.device?.isDesktop))) {
    const { initDarkMode } = await import('./modules/darkMode.js');
    await initDarkMode();
  }

  // Share Button
  if (settings?.uiComponents?.shareButton?.feature === 'on' && navigator.share && settings?.uiComponents?.shareButton?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet) || (supported === 'desktop' && userData?.device?.isDesktop))) {
    const { initShareButton } = await import('./modules/shareButton.js');
    await initShareButton();
  }

  // Pull Down Refresh
  if (settings?.uiComponents?.pullDownRefresh?.feature === 'on' && settings?.uiComponents?.pullDownRefresh?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet))) {
    const { initPullDownRefresh } = await import('./modules/pullDownRefresh.js');
    await initPullDownRefresh();
  }

  // Shake Refresh
  if (settings?.uiComponents?.shakeRefresh?.feature === 'on' && 'DeviceMotionEvent' in window && settings?.uiComponents?.shakeRefresh?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet))) {
    const { initShakeRefresh } = await import('./modules/shakeRefresh.js');
    await initShakeRefresh();
  }

  // Inactive Blur
  if (settings?.uiComponents?.inactiveBlur?.feature === 'on' && settings?.uiComponents?.inactiveBlur?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet))) {
    const { initInactiveBlur } = await import('./modules/inactiveBlur.js');
    await initInactiveBlur();
  }

  // Smooth Page Transitions
  if (settings?.appCapabilities?.smoothPageTransitions?.feature === 'on' && settings?.appCapabilities?.smoothPageTransitions?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet) || (supported === 'desktop' && userData?.device?.isDesktop))) {
    const { initSmoothPageTransitions } = await import('./modules/smoothPageTransitions.js');
    await initSmoothPageTransitions();
  }

  // Vibrations
  if (settings?.appCapabilities?.vibrations?.feature === 'on' && navigator.vibrate && settings?.appCapabilities?.vibrations?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet))) {
    const { initVibrations } = await import('./modules/vibrations.js');
    await initVibrations();
  }

  // Idle Detection
  if (settings?.appCapabilities?.idleDetection?.feature === 'on' && 'IdleDetector' in window && settings?.appCapabilities?.idleDetection?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet) || (supported === 'desktop' && userData?.device?.isDesktop))) {
    const { initIdleDetection } = await import('./modules/idleDetection.js');
    await initIdleDetection();
  }

  // Screen Wake Lock
  if (settings?.appCapabilities?.screenWakeLock?.feature === 'on' && navigator.wakeLock && settings?.appCapabilities?.screenWakeLock?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet) || (supported === 'desktop' && userData?.device?.isDesktop))) {
    const { initScreenWakeLock } = await import('./modules/screenWakeLock.js');
    await initScreenWakeLock();
  }

  // Push Notifications Prompt
  if (settings?.pushNotifications?.prompt?.feature === 'on' && 'serviceWorker' in navigator && 'PushManager' in window && 'Notification' in window && !['subscribed', 'blocked'].includes(await PushNotificationsSubscription.getSubscriptionState()) && !getCookie('pwa_push_notifications_prompt_shown') && (settings?.pushNotifications?.prompt?.skipFirstVisit !== 'on' || isReturningVisitor())) {
    const { initPushNotificationsPrompt } = await import('./modules/pushNotificationsPrompt.js');
    await initPushNotificationsPrompt();
    setCookie('pwa_push_notifications_prompt_shown', 'true', settings?.pushNotifications?.prompt?.timeout ?? 1);
  }

  // Push Notifications Button
  if (settings?.pushNotifications?.button?.feature === 'on' && 'serviceWorker' in navigator && 'PushManager' in window && 'Notification' in window && (await PushNotificationsSubscription.getSubscriptionState()) !== 'blocked' && ((await PushNotificationsSubscription.getSubscriptionState()) !== 'subscribed' || settings?.pushNotifications?.button?.behavior === 'shown')) {
    const { initPushNotificationsButton } = await import('./modules/pushNotificationsButton.js');
    await initPushNotificationsButton();
  }
};

const setupDelayedLoading = () => {
  // Set up event listeners for user interaction
  document.addEventListener('mousemove', loadDelayedModules, { once: true, passive: true });
  document.addEventListener('scroll', loadDelayedModules, { once: true, passive: true });
  document.addEventListener('touchstart', loadDelayedModules, { once: true, passive: true });
  document.addEventListener('keydown', loadDelayedModules, { once: true, passive: true });

  // Set up timeout for 1.5 seconds
  setTimeout(() => {
    loadDelayedModules();
  }, 1000);
};

// Load modules
document.addEventListener('DOMContentLoaded', async function () {
  // PWA Tracker (immediate)
  if (isPwa()) {
    const { initPwaTracker } = await import('./modules/pwaTracker.js');
    await initPwaTracker();
  }

  // Custom CSS and JS (immediate)
  if (isPwa() && settings?.uiComponents?.pwaCustomCssAndJs?.feature === 'on') {
    const { initPwaCustomCssAndJs } = await import('./modules/pwaCustomCssAndJs.js');
    await initPwaCustomCssAndJs();
  }

  // Page Loader (immediate)
  if (settings?.appCapabilities?.smoothPageTransitions?.feature === 'off' && settings?.uiComponents?.pageLoader?.feature === 'on' && settings?.uiComponents?.pageLoader?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet) || (supported === 'desktop' && userData?.device?.isDesktop))) {
    const { initPageLoader } = await import('./modules/pageLoader.js');
    await initPageLoader();
  }

  // Orientation Lock (immediate)
  if (settings?.webAppManifest?.displaySettings?.orientationLock === 'on') {
    const { initOrientationLock } = await import('./modules/orientationLock.js');
    await initOrientationLock();
  }

  // Installation related modules (immediate)
  if (settings?.installation?.prompts?.feature === 'on' && !isPwa()) {
    // Install Url (immediate)
    const { initInstallUrl } = await import('./modules/installUrl.js');
    await initInstallUrl();

    // Installation Button (immediate)
    const { initInstallButton } = await import('./modules/installButton.js');
    await initInstallButton();
  }

  // Toast Messages (immediate - important for user feedback)
  if (settings?.uiComponents?.toastMessages?.feature === 'on' && settings?.uiComponents?.toastMessages?.supportedDevices.some((supported) => (supported === 'smartphone' && userData?.device?.isSmartphone) || (supported === 'tablet' && userData?.device?.isTablet))) {
    const { initToastMessages } = await import('./modules/toastMessages.js');
    await initToastMessages();
  }

  // Setup delayed loading for non-critical modules
  setupDelayedLoading();
});
