export const config = (() => {
  const daftplugFrontend = document.getElementById('daftplugFrontend');
  const optionName = daftplugFrontend.getAttribute('data-option-name');
  const slug = daftplugFrontend.getAttribute('data-slug');
  const jsVars = window[optionName + '_frontend_js_vars'] || {};

  return {
    daftplugFrontend,
    optionName,
    slug,
    jsVars,
  };
})();

async function initModules() {
  if (config.jsVars.userData.platform.isBrowser) {
    // Installation Overlays and Button
    if (config.jsVars.settings.installation?.prompts?.feature === 'on') {
      // Install Url
      const { initInstallUrl } = await import('./modules/installUrl.js');
      initInstallUrl();
      // Installation Button
      const { initInstallButton } = await import('./modules/installButton.js');
      initInstallButton();
      // Installation Overlay - Header Banner
      if (config.jsVars.settings.installation?.prompts?.types?.headerBanner === 'on') {
        const { initInstallOverlayHeaderBanner } = await import('./modules/installOverlayHeaderBanner.js');
        initInstallOverlayHeaderBanner();
      }
      // Installation Overlay - Snackbar
      if (config.jsVars.settings.installation?.prompts?.types?.snackbar === 'on') {
        const { initInstallOverlaySnackbar } = await import('./modules/installOverlaySnackbar.js');
        initInstallOverlaySnackbar();
      }
      // Installation Overlay - Blog Popup
      if (config.jsVars.settings.installation?.prompts?.types?.blogPopup === 'on') {
        const { initInstallOverlayBlogPopup } = await import('./modules/installOverlayBlogPopup.js');
        initInstallOverlayBlogPopup();
      }
      // Installation Overlay - Navigation Menu
      if (config.jsVars.settings.installation?.prompts?.types?.navigationMenu === 'on') {
        const { initInstallOverlayNavigationMenu } = await import('./modules/installOverlayNavigationMenu.js');
        initInstallOverlayNavigationMenu();
      }
      // Installation Overlay - In Feed
      if (config.jsVars.settings.installation?.prompts?.types?.inFeed === 'on') {
        const { initInstallOverlayInFeed } = await import('./modules/installOverlayInFeed.js');
        initInstallOverlayInFeed();
      }
      // Installation Overlay - Woocommerce Checkout
      if (config.jsVars.settings.installation?.prompts?.types?.woocommerceCheckout === 'on') {
        const { initInstallOverlayWoocommerceCheckout } = await import('./modules/installOverlayWoocommerceCheckout.js');
        initInstallOverlayWoocommerceCheckout();
      }
    }
  }

  // Offline Notification
  if (config.jsVars.settings.offlineUsage?.capabilities?.notification === 'on') {
    const { initOfflineNotification } = await import('./modules/offlineNotification.js');
    initOfflineNotification();
  }
}

document.addEventListener('DOMContentLoaded', initModules);
