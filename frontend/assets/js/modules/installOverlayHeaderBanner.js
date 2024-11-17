import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaInstallOverlayHeaderBanner extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();

    requestAnimationFrame(() => {
      const headerBanner = this.shadowRoot.querySelector('.header-banner-overlay');
      headerBanner.classList.add('visible');
    });

    this.handleRemove();
    this.handlePerformInstallation();
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handleRemove() {
    const headerBanner = this.shadowRoot.querySelector('.header-banner-overlay');
    const closeButton = this.shadowRoot.querySelector('.header-banner-overlay-button_close');

    const handleClose = () => {
      headerBanner.classList.remove('visible');
      setTimeout(() => this.remove(), 300);
    };

    closeButton.addEventListener('click', handleClose);
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.header-banner-overlay-button_install');
    installButton.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const appName = config.jsVars.settings.webAppManifest.appIdentity.appName ?? '';
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(backgroundColor);
    const bannerTitle = config.jsVars.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="header-banner-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"></img>` : '';

    this.injectStyles(`
      .header-banner-overlay {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        z-index: 99999;
        padding: 0.75rem;
        background-color: ${backgroundColor};
        color: ${textColor};
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        -webkit-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
        opacity: 0;
        visibility: hidden;
      }

      .header-banner-overlay.visible {
        opacity: 1;
        visibility: visible;
      }

      .header-banner-overlay-appinfo {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        gap: 0.75rem;
      }

      .header-banner-overlay-appinfo_icon {
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        -ms-flex-negative: 0;
            flex-shrink: 0;
        height: 50px;
        width: 50px;
        display: inline-block;
      }

      .header-banner-overlay-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .header-banner-overlay-appinfo_description {
        font-size: 0.75rem;
        line-height: 1rem;
        font-weight: 400;
        color: ${textColor}cc;
        margin-top: 0.12rem;
        text-wrap: balance;
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
      }

      .header-banner-overlay-buttons {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
      }

      .header-banner-overlay-button_install {
        display: inline-block;
        background-color: ${textColor};
        color: ${backgroundColor};
        vertical-align: middle;
        text-decoration: none;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 600;
        padding: 0.375rem 0.875rem;
        border: none;
        outline: none;
        border-radius: 9999px;
        cursor: pointer;
      }

      .header-banner-overlay-button_install:hover {
        opacity: 0.8;
      }

      .header-banner-overlay-button_close {
        display: inline-flex;
        background-color: transparent;
        color: ${textColor}cc;
        padding: 0;
        border-radius: 0.5rem;
        cursor: pointer;
        outline: none;
        border: none;
      }

      .header-banner-overlay-button_close:hover {
        background-color: ${textColor}1a;
      }

      .header-banner-overlay-button_close svg {
        width: 1rem;
        height: 1rem;
      }

      @media (min-width: 400px) {
        .header-banner-overlay-appinfo_icon {
          height: 45px;
          width: 45px;
        }
      }

      @media (min-width: 1200px) {
        .header-banner-overlay {
          justify-content: center;
          gap: 5rem;
        }

        .header-banner-overlay-button_close {
          padding: 0.375rem;
        }
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="header-banner-overlay">
        <div class="header-banner-overlay-appinfo">
          ${appIconHtml}
          <div class="header-banner-overlay-appinfo_texts">
            <div class="header-banner-overlay-appinfo_title">${bannerTitle}</div>
            <div class="header-banner-overlay-appinfo_description">${__("Get our web app. It won't take up space on your device.", config.slug)}</div>
          </div>
        </div>
        <div class="header-banner-overlay-buttons">
          <button type="button" class="header-banner-overlay-button_install">
            Install Now
          </button>
          <button type="button" class="header-banner-overlay-button_close" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
          </button>
        </div>
      </div>
    `;
  }
}

export async function initInstallOverlayHeaderBanner() {
  if (!customElements.get('pwa-install-overlay-header-banner')) {
    customElements.define('pwa-install-overlay-header-banner', PwaInstallOverlayHeaderBanner);
  }

  const headerBannerInstance = document.createElement('pwa-install-overlay-header-banner');
  config.daftplugFrontend.appendChild(headerBannerInstance);
}
