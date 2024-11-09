import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';

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
    const backgroundColor = config.settings.installation?.prompts?.backgroundColor ?? '#000000';
    const textColor = config.settings.installation?.prompts?.textColor ?? '#ffffff';
    const buttonText = config.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);

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
          font-size: 15px;
          font-weight: 500;
          line-height: 35px;
          padding: 0 17px;
          height: 35px;
          border: none;
          outline: none;
          border-radius: 30px;
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
