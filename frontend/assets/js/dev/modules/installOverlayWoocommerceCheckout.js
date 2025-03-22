import { config } from '../frontend.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';
import { __ } from '../components/i18n.js';

class PwaInstallOverlayWoocommerceCheckout extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();
    this.handlePerformInstallation();
  }

  static findCheckoutForm() {
    const checkoutFormSelectors = ['form.wc-block-checkout__form', 'form.woocommerce-checkout'];

    for (const selector of checkoutFormSelectors) {
      const form = document.querySelector(selector);
      if (form) {
        return form;
      }
    }

    return null;
  }

  static show() {
    let overlay = document.querySelector('pwa-install-overlay-woocommerce-checkout');

    if (!overlay) {
      const checkoutForm = this.findCheckoutForm();

      if (checkoutForm) {
        overlay = document.createElement('pwa-install-overlay-woocommerce-checkout');
        checkoutForm.parentNode.insertBefore(overlay, checkoutForm.nextSibling);
      }
    }

    return overlay;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.woocommerce-checkout-overlay-button_install');
    installButton?.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const appName = config.jsVars.settings.webAppManifest.appIdentity.appName ?? '';
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(themeColor);
    const bannerTitle = config.jsVars.settings.installation?.prompts?.text ?? __('Install Web App', config.jsVars.slug);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="woocommerce-checkout-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .woocommerce-checkout-overlay {
        position: relative;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-top: 2rem;
        background-color: ${themeColor};
        color: ${textColor};
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        -webkit-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
        overflow: hidden;
        text-transform: none;
      }

      .woocommerce-checkout-overlay-appinfo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
      }

      .woocommerce-checkout-overlay-appinfo_icon {
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        flex-shrink: 0;
        height: 50px;
        width: 50px;
        display: inline-block;
      }

      .woocommerce-checkout-overlay-appinfo_texts {
        flex: 1;
        min-width: 0;
      }

      .woocommerce-checkout-overlay-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .woocommerce-checkout-overlay-appinfo_description {
        font-size: 0.75rem;
        line-height: 1rem;
        font-weight: 400;
        color: ${textColor}cc;
        margin-top: 0.12rem;
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
      }

      .woocommerce-checkout-overlay-button_install {
        display: block;
        background-color: ${textColor};
        color: ${themeColor};
        vertical-align: middle;
        text-decoration: none;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 600;
        padding: 0.375rem 0.875rem;
        margin-left: auto;
        margin-top: 1rem;
        border: none;
        outline: none;
        border-radius: 9999px;
        cursor: pointer;
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="woocommerce-checkout-overlay">
        <div class="woocommerce-checkout-overlay-appinfo">
          ${appIconHtml}
          <div class="woocommerce-checkout-overlay-appinfo_texts">
            <div class="woocommerce-checkout-overlay-appinfo_title">${bannerTitle}</div>
            <div class="woocommerce-checkout-overlay-appinfo_description">${__('Keep track of your orders. Our web app is fast, small and works offline.', config.jsVars.slug)}</div>
          </div>
        </div>
        <button type="button" class="woocommerce-checkout-overlay-button_install">
          ${__('Install Now', config.jsVars.slug)}
        </button>
      </div>
    `;
  }
}

export async function initInstallOverlayWoocommerceCheckout() {
  if (!customElements.get('pwa-install-overlay-woocommerce-checkout')) {
    customElements.define('pwa-install-overlay-woocommerce-checkout', PwaInstallOverlayWoocommerceCheckout);
  }

  // Try initial insertion
  PwaInstallOverlayWoocommerceCheckout.show();

  // Try again after a delay for dynamically loaded feeds
  setTimeout(() => {
    PwaInstallOverlayWoocommerceCheckout.show();
  }, 1000);
}
