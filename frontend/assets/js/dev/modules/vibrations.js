export async function initVibrations() {
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
