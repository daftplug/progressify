import { config } from '../main.js';
import { isSingleBlogPost, isReturningVisitor, getCookie, setCookie } from '../components/utils.js';

// Helper to check if overlay was recently shown
function wasOverlayRecentlyShown(overlayType) {
  return getCookie(`pwa_${overlayType}_shown`) === 'true';
}

// Helper to mark overlay as shown
function markOverlayAsShown(overlayType) {
  const timeout = config.jsVars.settings.installation?.prompts?.timeout ?? 1;
  setCookie(`pwa_${overlayType}_shown`, 'true', timeout);
}

export async function initInstallOverlays() {
  const { device, os, browser } = config.jsVars.userData;
  const isMobileDevice = device.isSmartphone || device.isTablet;

  if (config.jsVars.settings.installation?.prompts?.skipFirstVisit === 'on' && !isReturningVisitor()) {
    console.log('Not showing overlays to first-time visitor');
    return;
  }

  // Header Banner
  if (config.jsVars.settings.installation?.prompts?.types?.headerBanner === 'on' && !wasOverlayRecentlyShown('headerBanner')) {
    const { initInstallOverlayHeaderBanner } = await import('./installOverlayHeaderBanner.js');
    markOverlayAsShown('headerBanner');
    initInstallOverlayHeaderBanner();
  }

  if (isMobileDevice) {
    // Snackbar
    if (config.jsVars.settings.installation?.prompts?.types?.snackbar === 'on' && !wasOverlayRecentlyShown('snackbar')) {
      const { initInstallOverlaySnackbar } = await import('./installOverlaySnackbar.js');
      markOverlayAsShown('snackbar');
      initInstallOverlaySnackbar();
    }

    // Blog Popup
    if (config.jsVars.settings.installation?.prompts?.types?.blogPopup === 'on' && isSingleBlogPost() && !wasOverlayRecentlyShown('blogPopup')) {
      const { initInstallOverlayBlogPopup } = await import('./installOverlayBlogPopup.js');
      markOverlayAsShown('blogPopup');
      initInstallOverlayBlogPopup();
    }

    // Navigation Menu (always show)
    if (config.jsVars.settings.installation?.prompts?.types?.navigationMenu === 'on') {
      const { initInstallOverlayNavigationMenu } = await import('./installOverlayNavigationMenu.js');
      initInstallOverlayNavigationMenu();
    }

    // In Feed (always show)
    if (config.jsVars.settings.installation?.prompts?.types?.inFeed === 'on') {
      const { initInstallOverlayInFeed } = await import('./installOverlayInFeed.js');
      initInstallOverlayInFeed();
    }

    // Woocommerce Checkout (always show)
    if (config.jsVars.settings.installation?.prompts?.types?.woocommerceCheckout === 'on' && config.jsVars.pluginsData.isActive?.woocommerce && document.body.classList.contains('woocommerce-checkout')) {
      const { initInstallOverlayWoocommerceCheckout } = await import('./installOverlayWoocommerceCheckout.js');
      initInstallOverlayWoocommerceCheckout();
    }
  }
}
