import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaInstallOverlayWoocommerceCheckout extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.findAndAttachToCheckout();
    this.render();
    this.handlePerformInstallation();
  }

  findAndAttachToCheckout() {
    // Define selectors for checkout forms
    const checkoutFormSelectors = ['form.wc-block-checkout__form', 'form.woocommerce-checkout'];

    let checkoutForm = null;

    // Find the checkout form
    for (const selector of checkoutFormSelectors) {
      const element = document.querySelector(selector);
      if (element) {
        checkoutForm = element;
        break;
      }
    }

    const insertOverlay = (observer) => {
      // Check if overlay is already inserted
      if (!document.querySelector('pwa-install-overlay-woocommerce-checkout')) {
        // Insert the wrapper after the checkout form
        checkoutForm.parentNode.insertBefore(this, checkoutForm.nextSibling);

        console.log('PWA install prompt added after checkout form');

        // Disconnect observer after successful insertion
        if (observer) {
          observer.disconnect();
          console.log('Mutation observer disconnected');
          return true;
        }
      }
      return false;
    };

    if (checkoutForm) {
      // If form exists, insert immediately and don't set up observer
      insertOverlay();
    } else {
      console.log('No checkout form found, setting up observer');

      // Only set up observer if no form is found initially
      let attemptCount = 0;
      const maxAttempts = 10;

      const observer = new MutationObserver((mutations) => {
        // Increment attempt counter
        attemptCount++;

        for (const mutation of mutations) {
          if (mutation.addedNodes.length > 0) {
            // Check if a new checkout form was added
            const newForm = document.querySelector('form.wc-block-checkout__form') || document.querySelector('form.woocommerce-checkout');

            if (newForm) {
              checkoutForm = newForm;
              insertOverlay(observer);
              break;
            }
          }
        }

        // Disconnect after max attempts
        if (attemptCount >= maxAttempts) {
          observer.disconnect();
          console.log('Checkout observer disconnected after max attempts');
        }
      });

      // Start observing with more specific config
      observer.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: false, // Don't watch attributes
        characterData: false, // Don't watch text content
      });

      // Backup timeout to ensure observer doesn't run indefinitely
      setTimeout(() => {
        if (observer) {
          observer.disconnect();
          console.log('Checkout observer disconnected after timeout');
        }
      }, 30000); // 30 second timeout
    }
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
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(backgroundColor);
    const bannerTitle = config.jsVars.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="woocommerce-checkout-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .woocommerce-checkout-overlay {
        position: relative;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-top: 2rem;
        background-color: ${backgroundColor};
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
        color: ${backgroundColor};
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
            <div class="woocommerce-checkout-overlay-appinfo_description">${__('Keep track of your orders. Our web app is fast, small and works offline.', config.slug)}</div>
          </div>
        </div>
        <button type="button" class="woocommerce-checkout-overlay-button_install">
          ${__('Install Now', config.slug)}
        </button>
      </div>
    `;
  }
}

export async function initInstallOverlayWoocommerceCheckout() {
  if (!customElements.get('pwa-install-overlay-woocommerce-checkout')) {
    customElements.define('pwa-install-overlay-woocommerce-checkout', PwaInstallOverlayWoocommerceCheckout);
  }

  // Create instance
  const woocommerceCheckoutInstance = document.createElement('pwa-install-overlay-woocommerce-checkout');
  woocommerceCheckoutInstance.findAndAttachToCheckout();

  // Try again after a delay for dynamically loaded checkouts
  setTimeout(() => {
    const existingInstance = document.querySelector('pwa-install-overlay-woocommerce-checkout');
    existingInstance?.findAndAttachToCheckout();
  }, 1000);
}
