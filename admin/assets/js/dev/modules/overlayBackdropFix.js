const daftplugAdmin = document.querySelector('#daftplugAdmin');

export function initOverlayBackdropFix() {
  document.addEventListener('open.hs.overlay', handleOverlayOpen);
}

function handleOverlayOpen() {
  setTimeout(() => {
    const backdropElement = document.querySelector('[data-hs-overlay-backdrop-template]');
    if (backdropElement && backdropElement.parentElement !== daftplugAdmin) {
      backdropElement.style.zIndex = '999999';
      daftplugAdmin.appendChild(backdropElement);
    }
  }, 0);
}
