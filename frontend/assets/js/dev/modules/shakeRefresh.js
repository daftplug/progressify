import { config } from '../frontend.js';
import { getContrastTextColor } from '../components/utils.js';
import { __ } from '../components/i18n.js';

class PwaShakeRefresh extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();
    this.handleDetectShake();
  }

  static show() {
    let shakeRefresh = document.querySelector('pwa-shake-refresh');

    if (!shakeRefresh) {
      shakeRefresh = document.createElement('pwa-shake-refresh');
      document.body.appendChild(shakeRefresh);
    }

    return shakeRefresh;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handleDetectShake() {
    // Shake sensitivity (a lower number is more)
    const sensitivity = 16;

    // Position variables
    let x1 = 0,
      y1 = 0,
      z1 = 0,
      x2 = 0,
      y2 = 0,
      z2 = 0;

    // Listen to motion events and update the position
    window.addEventListener(
      'devicemotion',
      (e) => {
        // Changed to arrow function to preserve this binding
        x1 = e.accelerationIncludingGravity.x;
        y1 = e.accelerationIncludingGravity.y;
        z1 = e.accelerationIncludingGravity.z;
      },
      false
    );

    // Store reference to this for use in interval
    const component = this;

    // Periodically check the position and fire
    // if the change is greater than the sensitivity
    setInterval(() => {
      // Changed to arrow function to preserve this binding
      const change = Math.abs(x1 - x2 + y1 - y2 + z1 - z2);

      if (change > sensitivity) {
        const notification = component.shadowRoot.querySelector('.shake-notification');
        notification.classList.add('visible');
        setTimeout(() => location.reload(), 500);
      }

      // Update new position
      x2 = x1;
      y2 = y1;
      z2 = z1;
    }, 200);
  }

  render() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.backgroundColor ?? '#ffffff';
    const textColor = getContrastTextColor(backgroundColor);

    this.injectStyles(`
      .shake-notification {
        position: fixed;
        top: 0;
        left: 50%;
        -webkit-transform: translateX(-50%) translateY(-100%);
            -ms-transform: translateX(-50%) translateY(-100%);
                transform: translateX(-50%) translateY(-100%);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        padding: 0.75rem 1rem;
        gap: 0.5rem;
        width: 30rem;
        max-width: 85%;
        background-color: ${backgroundColor};
        color: ${textColor};
        border: 1px solid ${textColor}15;
        border-radius: 0.75rem;
        -webkit-box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        z-index: 9999999999999999;
        -webkit-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        -o-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
      }

      .shake-notification.visible {
        opacity: 1;
        -webkit-transform: translateX(-50%) translateY(1rem);
            -ms-transform: translateX(-50%) translateY(1rem);
                transform: translateX(-50%) translateY(1rem);
      }

      .shake-notification_spinner {
        width: 0.75rem;
        height: 0.75rem;
        border: 0.1875rem solid ${textColor};
        border-top-color: transparent;
        border-radius: 9999px;
        -webkit-animation: spin 1s linear infinite;
                animation: spin 1s linear infinite;
      }

      .shake-notification_text {
        font-size: 0.875rem;
        line-height: 1.25rem;
      }

      @-webkit-keyframes spin {
        to {
          -webkit-transform: rotate(360deg);
                  transform: rotate(360deg);
        }
      }

      @keyframes spin {
        to {
          -webkit-transform: rotate(360deg);
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
          ${__('Shake detected! Refreshing the page...', config.jsVars.slug)}
        </span>
      </div>
    `;
  }
}

export async function initShakeRefresh() {
  if (!customElements.get('pwa-shake-refresh')) {
    customElements.define('pwa-shake-refresh', PwaShakeRefresh);
  }

  PwaShakeRefresh.show();
}
