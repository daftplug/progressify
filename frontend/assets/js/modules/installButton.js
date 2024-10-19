class PwaInstallButton extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  connectedCallback() {
    this.render();
    this.addEventListeners();
  }

  render() {
    const backgroundColor = this.getAttribute('background-color') || '#000000';
    const textColor = this.getAttribute('text-color') || '#ffffff';
    const buttonText = this.getAttribute('button-text') || 'Install App';

    this.shadowRoot.innerHTML = `
      <style>
        .pwa-install-button {
            background-color: ${backgroundColor};
            color: ${textColor};
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: opacity 0.3s;
        }
        .pwa-install-button:hover {
            opacity: 0.8;
        }
      </style>
      <button class="pwa-install-button">${buttonText}</button>
    `;
  }

  addEventListeners() {
    const button = this.shadowRoot.querySelector('.pwa-install-button');
    button.addEventListener('click', () => {
      this.dispatchEvent(
        new CustomEvent('pwa-install-button-clicked', {
          bubbles: true,
          composed: true,
        })
      );
    });
  }
}

function initInstallButton() {
  if (!customElements.get('pwa-install-button')) {
    customElements.define('pwa-install-button', PwaInstallButton);
  }

  // Get the settings
  const daftplugFrontend = document.getElementById('daftplugFrontend');
  const optionName = daftplugFrontend.getAttribute('data-option-name');
  const settings = window[optionName + '_frontend_js_vars'].settings || { settings: {} };

  // Create and add the button to the DOM

  // Add event listener for install button click
  installButton.addEventListener('pwa-install-clicked', () => {
    // Add your PWA installation logic here
    console.log('PWA installation requested');
  });
}

export { initInstallButton };
