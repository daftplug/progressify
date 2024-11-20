import { config } from '../main.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaOfflineNotification extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  static showReconnecting() {
    let offlineNotification = document.querySelector('pwa-offline-notification');

    if (!offlineNotification) {
      offlineNotification = document.createElement('pwa-offline-notification');
      config.daftplugFrontend.appendChild(offlineNotification);
    }

    requestAnimationFrame(() => {
      const notification = offlineNotification.shadowRoot.querySelector('.offline-notification');
      const icon = notification.querySelector('.offline-notification_icon');
      const text = notification.querySelector('.offline-notification_text');

      // Reset to reconnecting state
      notification.classList.remove('reconnected');
      icon.classList.add('spinner');
      icon.classList.remove('success');
      text.textContent = __('Connection lost. Attempting to reconnect...', config.slug);
      notification.classList.add('visible');
    });

    return offlineNotification;
  }

  static showReconnected() {
    const offlineNotification = document.querySelector('pwa-offline-notification');
    if (!offlineNotification) return;

    const notification = offlineNotification.shadowRoot.querySelector('.offline-notification');
    const icon = notification.querySelector('.offline-notification_icon');
    const text = notification.querySelector('.offline-notification_text');

    notification.classList.add('reconnected');
    icon.classList.remove('spinner');
    icon.classList.add('success');
    text.textContent = __('Successfully reconnected to the internet!', config.slug);

    // Clear any existing removal timeout
    if (offlineNotification._removeTimeout) {
      clearTimeout(offlineNotification._removeTimeout);
    }

    offlineNotification._removeTimeout = setTimeout(() => {
      notification.classList.remove('visible');
      notification.addEventListener(
        'transitionend',
        () => {
          offlineNotification.remove();
        },
        { once: true }
      );
    }, 2000);
  }

  render() {
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const backgroundColor = getContrastTextColor(themeColor);
    const textColor = getContrastTextColor(backgroundColor);

    this.injectStyles(`
      .offline-notification {
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

      .offline-notification.visible {
        opacity: 1;
        transform: translateX(-50%) translateY(1rem);
      }

      .offline-notification_icon {
        display: inline-block;
        flex-shrink: 0;
        width: 12px;
        height: 12px;
        border-radius: 9999px;
      }

      .offline-notification_icon.spinner {
        animation: spin 1s linear infinite;
        border: 3px solid ${themeColor};
        border-top-color: transparent;
      }

      .offline-notification_icon.success {
        background-color: #22c55e;
        border-radius: 9999px;
      }

      .offline-notification_text {
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
      <div class="offline-notification" role="alert" tabindex="-1">
        <div class="offline-notification_icon spinner" role="status" aria-label="loading"></div>
        <span class="offline-notification_text">
          ${__('Connection lost. Attempting to reconnect...', config.slug)}
        </span>
      </div>
    `;
  }
}

export function initOfflineNotification() {
  if (!customElements.get('pwa-offline-notification')) {
    customElements.define('pwa-offline-notification', PwaOfflineNotification);
  }

  window.addEventListener('offline', () => {
    PwaOfflineNotification.showReconnecting();
  });

  window.addEventListener('online', () => {
    PwaOfflineNotification.showReconnected();
  });

  // Check initial state
  if (!navigator.onLine) {
    PwaOfflineNotification.showReconnecting();
  }
}
