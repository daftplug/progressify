import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';

class PwaInstallButton extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  connectedCallback() {
    this.render();
    this.handleClick();
  }

  handleClick() {
    const button = this.shadowRoot.querySelector('.pwa-install-button');

    button.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(backgroundColor);
    const buttonText = config.jsVars.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);

    this.shadowRoot.innerHTML = `
      <style>
        :host(:active),
        :host(:focus) {
          outline: transparent;
          border: none;
        }
        .pwa-install-button {
          display: inline-block;
          background-color: ${backgroundColor};
          color: ${textColor};
          vertical-align: middle;
          text-decoration: none;
          font-size: 0.875rem;
          line-height: 1.25rem;
          font-weight: 500;
          padding: 0.5rem 1rem;
          border: none;
          outline: none;
          border-radius: 9999px;
          cursor: pointer;
        }
        .pwa-install-button:hover {
          opacity: 0.8;
        }
      </style>
      <button class="pwa-install-button">${buttonText}</button>
    `;
  }
}

export function initInstallButton() {
  if (!customElements.get('pwa-install-button')) {
    customElements.define('pwa-install-button', PwaInstallButton);
  }
}
