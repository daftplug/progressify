import { config } from '../frontend.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';
import { __ } from '../components/i18n.js';

class PwaInstallOverlaySnackbar extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
    this.displayDuration = 7000;
  }

  connectedCallback() {
    this.render();
    this.setupInstallHandler();
  }

  static show() {
    let snackbar = document.querySelector('pwa-install-overlay-snackbar');

    if (!snackbar) {
      snackbar = document.createElement('pwa-install-overlay-snackbar');
      document.body.appendChild(snackbar);

      requestAnimationFrame(() => {
        const snackbarElement = snackbar.shadowRoot.querySelector('.snackbar-overlay');
        snackbarElement.classList.add('visible');
        snackbar.startProgressBar();
        snackbar.setupAutoHide();
      });
    }

    return snackbar;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  startProgressBar() {
    const progressBar = this.shadowRoot.querySelector('.snackbar-overlay-progressbar_inner');
    progressBar.style.width = '100%';
    progressBar.offsetHeight; // Force reflow
    requestAnimationFrame(() => {
      progressBar.style.width = '0%';
    });
  }

  setupAutoHide() {
    if (this._hideTimeout) {
      clearTimeout(this._hideTimeout);
    }

    this._hideTimeout = setTimeout(() => {
      const snackbar = this.shadowRoot.querySelector('.snackbar-overlay');
      snackbar.classList.remove('visible');
      snackbar.addEventListener(
        'transitionend',
        () => {
          this.remove();
        },
        { once: true }
      );
    }, this.displayDuration);
  }

  setupInstallHandler() {
    const installButton = this.shadowRoot.querySelector('.snackbar-overlay-button_install');
    installButton.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(themeColor);
    const snackbarTitle = config.jsVars.settings.installation?.prompts?.types?.snackbar?.title ?? __('Install Web App', config.jsVars.slug);
    const snackbarMessage = config.jsVars.settings.installation?.prompts?.types?.snackbar?.message ?? __('Installing uses no storage and offers a quick way back to our web app.', config.jsVars.slug);
    const snackbarButtonText = config.jsVars.settings.installation?.prompts?.types?.snackbar?.buttonText ?? __('Install Now', config.jsVars.slug);

    this.injectStyles(`
      .snackbar-overlay {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: fixed;
        right: 1rem;
        left: 1rem;
        bottom: 1rem;
        border-radius: 0.5rem;
        z-index: 9999999999;
        padding: 1rem;
        background-color: ${themeColor};
        color: ${textColor};
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        transition: all 0.2s ease-out;
        opacity: 0;
        visibility: hidden;
        overflow: hidden;
      }

      .snackbar-overlay.visible {
        opacity: 1;
        visibility: visible;
      }

      .snackbar-overlay-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .snackbar-overlay-appinfo_description {
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

      .snackbar-overlay-button_install {
        display: inline-block;
        flex-shrink: 0;
        background-color: ${textColor};
        color: ${themeColor};
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

      .snackbar-overlay-progressbar {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0.25rem;
        background-color: ${themeColor};
        overflow: hidden;
      }

      .snackbar-overlay-progressbar_inner {
        width: 100%;
        height: 100%;
        background-color: ${textColor}80;
        transition: width ${this.displayDuration}ms linear;
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="snackbar-overlay">
        <div class="snackbar-overlay-appinfo">
          <div class="snackbar-overlay-appinfo_title">${snackbarTitle}</div>
          <div class="snackbar-overlay-appinfo_description">${snackbarMessage}</div>
        </div>
        <button type="button" class="snackbar-overlay-button_install">
          ${snackbarButtonText}
        </button>
        <div class="snackbar-overlay-progressbar">
          <div class="snackbar-overlay-progressbar_inner"></div>
        </div>
      </div>
    `;
  }
}

export async function initInstallOverlaySnackbar() {
  let hasTriggered = false;
  const scrollPercentTrigger = 30;

  if (!customElements.get('pwa-install-overlay-snackbar')) {
    customElements.define('pwa-install-overlay-snackbar', PwaInstallOverlaySnackbar);
  }

  window.addEventListener('scroll', () => {
    if (hasTriggered) return;
    const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    if (scrollPercent >= scrollPercentTrigger) {
      PwaInstallOverlaySnackbar.show();
      hasTriggered = true;
    }
  });
}
