import { config } from '../main.js';

const { device, os, browser } = config.userData;

export async function initInstallOverlays() {
  // Header Banner
  if (config.settings.installation?.prompts?.types?.headerBanner === 'on') {
    const { initInstallOverlayHeaderBanner } = await import('./installOverlayHeaderBanner.js');
    initInstallOverlayHeaderBanner();
  }

  // Snackbar
  if (config.settings.installation?.prompts?.types?.snackbar === 'on' && (device.isSmartphone || device.isTablet)) {
    const { initInstallOverlaySnackbar } = await import('./installOverlaySnackbar.js');
    initInstallOverlaySnackbar();
  }

  // Navigation Menu
  if (config.settings.installation?.prompts?.types?.navigationMenu === 'on' && (device.isSmartphone || device.isTablet)) {
    const { initInstallOverlayNavigationMenu } = await import('./installOverlayNavigationMenu.js');
    initInstallOverlayNavigationMenu();
  }

  // In Feed
  if (config.settings.installation?.prompts?.types?.inFeed === 'on' && (device.isSmartphone || device.isTablet)) {
    const { initInstallOverlayInFeed } = await import('./installOverlayInFeed.js');
    initInstallOverlayInFeed();
  }
}
