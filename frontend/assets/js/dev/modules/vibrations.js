import { config } from '../main.js';

export async function initVibrations() {
  const { device } = config.jsVars.userData;
  const supportedDevices = config.jsVars.settings.appCapabilities.vibrations.supportedDevices;
  const isDeviceSupported = supportedDevices.some((supported) => (supported === 'smartphone' && device.isSmartphone) || (supported === 'tablet' && device.isTablet));

  if (!navigator.vibrate || !isDeviceSupported) {
    return;
  }

  document.addEventListener(
    'touchstart',
    function (event) {
      if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA' || event.target.isContentEditable) {
        return;
      }

      try {
        navigator.vibrate(50);
      } catch (error) {
        console.error('Error triggering vibration:', error);
      }
    },
    { passive: true }
  );
}
