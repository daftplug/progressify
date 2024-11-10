import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';

const { __ } = wp.i18n;

class PwaInstallOverlaySnackbar extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
    this.hasShown = false;
    this.displayDuration = 7000;
    this.scrollPercentTrigger = 30;
  }

  connectedCallback() {
    this.render();
    this.setupScrollListener();
    this.handlePerformInstallation();
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  setupScrollListener() {
    window.addEventListener('scroll', () => {
      if (this.hasShown) return;

      const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
      if (scrollPercent >= this.scrollPercentTrigger) {
        this.showSnackbar();
        this.hasShown = true;
      }
    });
  }

  showSnackbar() {
    requestAnimationFrame(() => {
      const snackbar = this.shadowRoot.querySelector('.snackbar');
      snackbar.classList.add('visible');
      this.startProgressBar();
      this.setupAutoHide();
    });
  }

  startProgressBar() {
    const progressBar = this.shadowRoot.querySelector('.snackbar-progressbar_inner');
    progressBar.style.width = '100%';
    progressBar.offsetHeight;
    requestAnimationFrame(() => {
      progressBar.style.width = '0%';
    });
  }

  setupAutoHide() {
    setTimeout(() => {
      const snackbar = this.shadowRoot.querySelector('.snackbar');
      snackbar.classList.remove('visible');
      setTimeout(() => this.remove(), 300);
    }, this.displayDuration);
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.snackbar-button_install');
    installButton.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const backgroundColor = config.settings.installation?.prompts?.backgroundColor ?? '#000000';
    const textColor = config.settings.installation?.prompts?.textColor ?? '#ffffff';
    const snackbarTitle = config.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);

    this.injectStyles(`
      .snackbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: fixed;
        right: 1rem;
        left: 1rem;
        bottom: 1rem;
        border-radius: 0.5rem;
        z-index: 99999;
        padding: 1rem;
        background-color: ${backgroundColor};
        color: ${textColor};
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        -webkit-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
        opacity: 0;
        visibility: hidden;
        overflow: hidden;
      }

      .snackbar.visible {
        opacity: 1;
        visibility: visible;
      }

      .snackbar-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .snackbar-appinfo_description {
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

      .snackbar-button_install {
        display: inline-block;
        flex-shrink: 0;
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

      .snackbar-progressbar {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: ${backgroundColor};
        overflow: hidden;
      }

      .snackbar-progressbar_inner {
        width: 100%;
        height: 100%;
        background-color: ${textColor}80;
        transition: width ${this.displayDuration}ms linear;
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="snackbar">
        <div class="snackbar-appinfo">
          <div class="snackbar-appinfo_title">${snackbarTitle}</div>
          <div class="snackbar-appinfo_description">${__('Installing uses no storage and offers a quick way back to our web app.', config.slug)}</div>
        </div>
        <button type="button" class="snackbar-button_install">
          Install Now
        </button>
        <div class="snackbar-progressbar">
          <div class="snackbar-progressbar_inner"></div>
        </div>
      </div>
    `;
  }
}

export async function initInstallOverlaySnackbar() {
  if (!customElements.get('pwa-install-overlay-snackbar')) {
    customElements.define('pwa-install-overlay-snackbar', PwaInstallOverlaySnackbar);
  }

  const snackbarInstance = document.createElement('pwa-install-overlay-snackbar');
  config.daftplugFrontend.appendChild(snackbarInstance);
}
