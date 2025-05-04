/**
 * Apply CSS-based orientation lock as fallback
 * @param {string} targetOrientation - The desired orientation to lock to
 */
function applyCssOrientationLock(targetOrientation) {
  // Remove any existing orientation style element
  const existingStyle = document.getElementById('orientation-lock-style');
  if (existingStyle) {
    existingStyle.remove();
  }

  // Only apply CSS lock if we need to force portrait or landscape
  if (targetOrientation === 'portrait' || targetOrientation === 'landscape') {
    const oppositeOrientation = targetOrientation === 'portrait' ? 'landscape' : 'portrait';

    // Create style element
    const style = document.createElement('style');
    style.id = 'orientation-lock-style';

    if (targetOrientation === 'portrait') {
      // Force portrait mode when device is in landscape
      style.textContent = `
        @media screen and (min-width: 320px) and (max-width: 767px) and (orientation: ${oppositeOrientation}) {
          html {
            transform: rotate(-90deg);
            transform-origin: left top;
            width: 100vh;
            overflow-x: hidden;
            position: absolute;
            top: 100%;
            left: 0;
          }
        }
      `;
    } else {
      // Force landscape mode when device is in portrait
      style.textContent = `
        @media screen and (min-width: 320px) and (max-width: 767px) and (orientation: ${oppositeOrientation}) {
          html {
            transform: rotate(90deg);
            transform-origin: right top;
            width: 100vh;
            overflow-x: hidden;
            position: absolute;
            top: 0;
            right: 0;
          }
        }
      `;
    }

    // Add style to document
    document.head.appendChild(style);
  }
}

export async function initOrientationLock() {
  const orientation = config.jsVars.settings.webAppManifest.displaySettings.orientation;
  if (orientation !== 'any') {
    try {
      // Check if screen.orientation API is supported
      if (window.screen && window.screen.orientation && window.screen.orientation.lock) {
        await window.screen.orientation.lock(orientation);
      } else {
        // Fallback to CSS-based orientation lock for unsupported browsers
        applyCssOrientationLock(orientation);
      }
    } catch (error) {
      console.warn('Orientation lock failed:', error.message);
      // Apply CSS fallback if native locking fails
      applyCssOrientationLock(orientation);
    }
  }
}
