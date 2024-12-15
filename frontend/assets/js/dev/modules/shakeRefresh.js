import { config } from '../main.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaShakeRefresh extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();

    // Shake detection configuration
    this.options = {
      threshold: 15,
      timeout: 1000,
    };

    // Shake detection state
    this.lastTime = new Date();
    this.lastX = null;
    this.lastY = null;
    this.lastZ = null;

    // Bind methods
    this.handleDeviceMotion = this.handleDeviceMotion.bind(this);
  }

  connectedCallback() {
    this.render();
    this.startShakeDetection();
  }

  disconnectedCallback() {
    this.stopShakeDetection();
  }

  static show() {
    let shakeRefresh = document.querySelector('pwa-shake-refresh');

    if (!shakeRefresh) {
      shakeRefresh = document.createElement('pwa-shake-refresh');
      config.daftplugFrontend.appendChild(shakeRefresh);
    }

    return shakeRefresh;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  startShakeDetection() {
    if ('ondevicemotion' in window) {
      window.addEventListener('devicemotion', this.handleDeviceMotion, false);
    }
  }

  stopShakeDetection() {
    window.removeEventListener('devicemotion', this.handleDeviceMotion, false);
  }

  handleDeviceMotion(e) {
    const current = e.accelerationIncludingGravity;

    if (this.lastX === null && this.lastY === null && this.lastZ === null) {
      this.lastX = current.x;
      this.lastY = current.y;
      this.lastZ = current.z;
      return;
    }

    const deltaX = Math.abs(this.lastX - current.x);
    const deltaY = Math.abs(this.lastY - current.y);
    const deltaZ = Math.abs(this.lastZ - current.z);

    if ((deltaX > this.options.threshold && deltaY > this.options.threshold) || (deltaX > this.options.threshold && deltaZ > this.options.threshold) || (deltaY > this.options.threshold && deltaZ > this.options.threshold)) {
      const currentTime = new Date();
      const timeDifference = currentTime.getTime() - this.lastTime.getTime();

      if (timeDifference > this.options.timeout) {
        this.showRefreshingState();
        setTimeout(() => location.reload(), 500); // Small delay to show the indicator
        this.lastTime = new Date();
      }
    }

    this.lastX = current.x;
    this.lastY = current.y;
    this.lastZ = current.z;
  }

  showRefreshingState() {
    const notification = this.shadowRoot.querySelector('.shake-notification');
    const spinner = this.shadowRoot.querySelector('.shake-notification_spinner');

    notification.classList.add('visible');
    spinner.style.display = 'block';
  }

  render() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.backgroundColor ?? '#ffffff';
    const textColor = getContrastTextColor(backgroundColor);

    this.injectStyles(`
      .shake-notification {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%) translateY(-100%);
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        gap: 0.75rem;
        width: 30rem;
        max-width: 85%;
        background-color: ${backgroundColor};
        color: ${textColor};
        border: 1px solid ${textColor}15;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        z-index: 9999999999999999;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
      }

      .shake-notification.visible {
        opacity: 1;
        transform: translateX(-50%) translateY(1rem);
      }

      .shake-notification_spinner {
        display: none;
        width: 1rem;
        height: 1rem;
        border: 0.1875rem solid ${textColor};
        border-top-color: transparent;
        border-radius: 9999px;
        animation: spin 1s linear infinite;
      }

      .shake-notification_text {
        font-size: 0.875rem;
        line-height: 1.25rem;
      }

      @keyframes spin {
        to {
          transform: rotate(360deg);
        }
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="shake-notification" role="alert">
        <div class="shake-notification_spinner" role="status" aria-label="loading"></div>
        <span class="shake-notification_text">
          ${__('Refreshing...', config.slug)}
        </span>
      </div>
    `;
  }
}

export async function initShakeRefresh() {
  const { device } = config.jsVars.userData;
  const supportedDevices = config.jsVars.settings.uiComponents.shakeRefresh.supportedDevices;
  const isDeviceSupported = supportedDevices.some((supported) => (supported === 'smartphone' && device.isSmartphone) || (supported === 'tablet' && device.isTablet));

  if (!isDeviceSupported || !('ondevicemotion' in window)) {
    return;
  }

  if (!customElements.get('pwa-shake-refresh')) {
    customElements.define('pwa-shake-refresh', PwaShakeRefresh);
  }

  PwaShakeRefresh.show();
}
