import { config } from '../main.js';

export async function initScreenWakeLock() {
  const { device } = config.jsVars.userData;
  const supportedDevices = config.jsVars.settings.appCapabilities.screenWakeLock.supportedDevices;
  const isDeviceSupported = supportedDevices.some((supported) => (supported === 'smartphone' && device.isSmartphone) || (supported === 'tablet' && device.isTablet) || (supported === 'desktop' && device.isDesktop));

  if (!navigator.wakeLock || !isDeviceSupported) {
    console.log('Screen wake lock not supported on this device or browser');
    return;
  }

  let wakeLock = null;

  const requestWakeLock = async () => {
    try {
      wakeLock = await navigator.wakeLock.request('screen');
      wakeLock.addEventListener('release', () => {
        wakeLock = null;
      });
    } catch (error) {
      console.error('Error requesting screen wake lock:', error);
    }
  };

  const handleVisibilityChange = async () => {
    if (document.visibilityState === 'visible') {
      await requestWakeLock();
    }
  };

  await requestWakeLock();

  document.addEventListener('visibilitychange', handleVisibilityChange);
  document.addEventListener('fullscreenchange', handleVisibilityChange);
}
