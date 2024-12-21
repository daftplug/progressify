import { config } from '../main.js';
import { getContrastTextColor, isHomepage, is404, isSearchResults, isSingleBlogPost, isWoocommerceShop, isWoocommerceProduct } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaToastMessages extends HTMLElement {
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

  static show() {
    let toastMessages = document.querySelector('pwa-toast-messages');

    if (!toastMessages) {
      toastMessages = document.createElement('pwa-toast-messages');
      config.daftplugFrontend.appendChild(toastMessages);
    }

    requestAnimationFrame(() => {
      const toastMessage = toastMessages.shadowRoot.querySelector('.toast-message');

      setTimeout(() => {
        toastMessage.classList.add('visible');
      }, 300);

      setTimeout(() => {
        toastMessage.classList.remove('visible');
        toastMessage.addEventListener(
          'transitionend',
          () => {
            toastMessages.remove();
          },
          { once: true }
        );
      }, 2800);
    });

    return toastMessages;
  }

  render() {
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const backgroundColor = getContrastTextColor(themeColor);
    const textColor = getContrastTextColor(backgroundColor);

    this.injectStyles(`
      .toast-message {
        position: fixed;
        bottom: 0;
        left: 50%;
        -webkit-transform: translateX(-50%) translateY(100%);
            -ms-transform: translateX(-50%) translateY(100%);
                transform: translateX(-50%) translateY(100%);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        padding: 0.75rem 1rem;
        gap: 0.75rem;
        width: auto;
        max-width: 85%;
        background-color: ${backgroundColor};
        color: ${textColor};
        border: 1px solid ${textColor}15;
        border-radius: 0.75rem;
        -webkit-box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        z-index: 99999999999999999999999999;
        -webkit-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        -o-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
      }

      .toast-message.visible {
        opacity: 1;
        -webkit-transform: translateX(-50%) translateY(-1rem);
            -ms-transform: translateX(-50%) translateY(-1rem);
                transform: translateX(-50%) translateY(-1rem);
      }

      .toast-message_text {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
      }
    `);

    let message;

    switch (true) {
      case isHomepage():
        message = __('Homepage Opened', config.slug);
        break;
      case is404():
        message = __('Page Not Found', config.slug);
        break;
      case isSearchResults():
        message = __('Search Results', config.slug);
        break;
      case isSingleBlogPost():
        message = __('Article Opened', config.slug);
        break;
      case isWoocommerceShop():
        message = __('Shop Opened', config.slug);
        break;
      case isWoocommerceProduct():
        message = __('Product Opened', config.slug);
        break;
      default:
        message = __('Page Opened', config.slug);
        break;
    }

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="toast-message" role="alert" tabindex="-1">
        <span class="toast-message_text">
          ${message}
        </span>
      </div>
    `;
  }
}

export async function initToastMessages() {
  const { device } = config.jsVars.userData;
  const supportedDevices = config.jsVars.settings.uiComponents.toastMessages.supportedDevices;
  const isDeviceSupported = supportedDevices.some((supported) => (supported === 'smartphone' && device.isSmartphone) || (supported === 'tablet' && device.isTablet));

  if (!isDeviceSupported) {
    return;
  }

  if (!customElements.get('pwa-toast-messages')) {
    customElements.define('pwa-toast-messages', PwaToastMessages);
  }

  PwaToastMessages.show();
}