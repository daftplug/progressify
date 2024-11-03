import { config } from '../main.js';

const { __ } = wp.i18n;

// Native installation handler
let deferredInstallPrompt = null;

window.addEventListener('beforeinstallprompt', (e) => {
  e.preventDefault();
  deferredInstallPrompt = e;
});

window.addEventListener('appinstalled', () => {
  deferredInstallPrompt = null;
});

class PwaInstallPrompt extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  async connectedCallback() {
    this.render();
    this.handleRemove();
  }

  hasAppIcon() {
    const iconUrl = config.iconUrl;
    return iconUrl && iconUrl !== '' && iconUrl !== '0';
  }

  handleRemove() {
    const closeButton = this.shadowRoot.querySelector('.install-prompt-close');
    const backdrop = this.shadowRoot.querySelector('.install-prompt');

    closeButton.addEventListener('click', () => this.remove());
    backdrop.addEventListener('click', (e) => {
      if (e.target === backdrop) {
        this.remove();
      }
    });
  }

  renderAppIcon() {
    const appName = config.settings.webAppManifest.appIdentity.appName;

    if (!config.iconUrl) {
      return '';
    }

    return `
      <img 
        class="install-prompt-body-appinfo_icon" 
        src="${config.iconUrl}" 
        alt="${appName}"
        onerror="this.style.display='none'"
      >
    `;
  }

  renderAppName() {
    const appName = config.settings.webAppManifest.appIdentity.appName;

    if (!appName) {
      return '';
    }

    return `
      <div class="install-prompt-body-appinfo_appname">${appName}</div>
    `;
  }

  renderDescription() {
    const description = config.settings.webAppManifest.appIdentity.description;

    if (!description) {
      return '';
    }

    return `
      <div class="install-prompt-body-appinfo_description">${description}</div>
    `;
  }

  renderInstructions() {
    const { browser, os, device } = config.userData;

    let instructions = '';

    if (device.isMobile || device.isTablet) {
      if (os.isAndroid) {
        if (browser.isChrome) {
    
        } else if (browser.isFirefox) {
      
        } else if (browser.isOpera) {
      
        } else if (browser.isEdge) {
      
        }
      } else if (os.isIos) {
        if (browser.isSafari) {
          instructions = `
          <div class="step"><span class="step-number">1.</span>Tap the Share button (the square with an up arrow)</div>
          <div class="step"><span class="step-number">2.</span>Scroll down and tap "Add to Home Screen"</div>
          <div class="step"><span class="step-number">3.</span>Tap "Add" in the upper-right corner</div>
        `;
        } else if (browser.isChrome) {
      
        } else if (browser.isOpera) {
      
        } else if (browser.isEdge) {
      
        }
      }
    } else if (device.isDesktop) {
      if (os.isWindows) {
    
      } else if (os.isMacos) {
    
      }
    }

    return instructions;
  }

  render() {
    this.shadowRoot.innerHTML = `
      <style>
        .install-prompt {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 9999;
          background: rgba(0, 0, 0, 0.7);
          backdrop-filter: blur(5px);
          z-index: 9999999;
          transition: all 0.15s ease;
        }
        
        .install-prompt-container {
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background: white;
          border-radius: 10px;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          max-width: 32rem;
          width: 95%;
        }
        
        .install-prompt-header {
          display: flex;
          padding: 0.75rem 1rem;
          gap: 1.5rem;
          justify-content: space-between;
          align-items: center;
          border-bottom: 1px solid #e5e7eb;
        }

        .install-prompt-header-texts_title,
        .install-prompt-body-appinfo_appname {
          font-size: 1rem;
          line-height: 1.5rem;
          font-weight: 500;
          color: #1f2937;
          display: -webkit-box;
          overflow: hidden;
          -webkit-box-orient: vertical;
          -webkit-line-clamp: 1;
        }

        .install-prompt-close {
          display: inline-flex;
          justify-content: center;
          align-items: center;
          width: 2rem;
          height: 2rem;
          color: #1f2937;
          background: #f3f4f6;
          border-radius: 9999px;
          outline: none;
          border: none;
          cursor: pointer;
          transition: all 0.1s ease;
          flex-shrink: 0;
        }

        .install-prompt-close:hover {
          background: #e5e7eb;
        }

        .install-prompt-close-icon {
          display: block;
          width: 1rem;
          height: 1rem;
          flex-shrink: 0;
          vertical-align: middle;
        }

        .install-prompt-body {
          padding: 1rem;
          overflow-y: auto;
          max-height: 24rem;
        }
        
        .install-prompt-body-appinfo {
          display: flex;
          align-items: center;
          gap: 0.5rem;
          background: #f3f4f6;
          padding: 0.7rem;
          border-radius: 0.5rem;
          border: 1px solid #e5e7eb;
        }

        .install-prompt-body-appinfo_icon {
          border-radius: 9999px;
          border: 1px solid #e5e7eb;
          flex-shrink: 0;
          height: 55px;
          width: 55px;
          display: inline-block;
        }

        .install-prompt-body-appinfo_description {
          font-size: 0.75rem;
          line-height: 1rem;
          font-weight: 400;
          color: #6b7280;
          margin-top: 0.12rem;
          display: -webkit-box;
          overflow: hidden;
          -webkit-box-orient: vertical;
          -webkit-line-clamp: 1;
        }
      </style>
      
      <div class="install-prompt">
        <div class="install-prompt-container">
          <div class="install-prompt-header">
            <div class="install-prompt-header-texts">
              <div class="install-prompt-header-texts_title">${__('Install Web App', config.slug)}</div>
            </div>
            <button type="button" class="install-prompt-close" aria-label="Close">
              <svg class="install-prompt-close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            </button>
          </div>
          <div class="install-prompt-body">
            <div class="install-prompt-body-appinfo">
              ${this.renderAppIcon()}
              <div class="install-prompt-body-appinfo_texts">
                ${this.renderAppName()}
                ${this.renderDescription()}
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
  }
}

function isNativeInstallAvailable() {
  return !!deferredInstallPrompt;
}

function isManualInstallAvailable() {
  const { browser, os, device } = config.userData;

  if (device.isMobile || device.isTablet || device.isDesktop) {


    if (os.isAndroid || os.isIos || ) {

  }

  return !!deferredInstallPrompt;
}

async function performNativeInstallation() {
  try {
    await deferredInstallPrompt.prompt();
    deferredInstallPrompt = null;
    return true;
  } catch (error) {
    console.error('Native installation failed:', error);
    return false;
  }
}

function performManualInstallation() {
  // Remove any existing prompt first
  const existingPrompt = document.querySelector('pwa-install-prompt');
  if (existingPrompt) {
    existingPrompt.remove();
  }

  // Create and add new prompt
  if (!customElements.get('pwa-install-prompt')) {
    customElements.define('pwa-install-prompt', PwaInstallPrompt);
  }
  const promptInstance = document.createElement('pwa-install-prompt');
  config.daftplugFrontend.appendChild(promptInstance);

  return false;
}

export async function performInstallation() {
  // if (isNativeInstallAvailable()) {
  //   const result = await performNativeInstallation();
  //   if (!result) {
  //     return performManualInstallation();
  //   }
  //   return true;
  // }
  return performManualInstallation();
}
