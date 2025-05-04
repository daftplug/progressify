import { config } from '../frontend.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';
import { __ } from '../components/i18n.js';

class PwaInstallOverlayBlogPopup extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();
    this.handleRemove();
    this.handlePerformInstallation();
  }

  static show() {
    let popup = document.querySelector('pwa-install-overlay-blog-popup');

    if (!popup) {
      popup = document.createElement('pwa-install-overlay-blog-popup');
      document.body.appendChild(popup);

      requestAnimationFrame(() => {
        const blogPopup = popup.shadowRoot.querySelector('.blog-popup-overlay');
        document.documentElement.style.paddingRight = `${window.innerWidth - document.documentElement.offsetWidth}px`;
        document.documentElement.style.overflow = 'hidden';
        blogPopup.classList.add('visible');
      });
    }

    return popup;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handleRemove() {
    const continueButton = this.shadowRoot.querySelector('.blog-popup-overlay-button.-continue');
    const backdrop = this.shadowRoot.querySelector('.blog-popup-overlay');

    const handleClose = () => {
      backdrop.classList.remove('visible');
      backdrop.addEventListener(
        'transitionend',
        () => {
          document.documentElement.style.removeProperty('overflow');
          document.documentElement.style.paddingRight = '';
          this.remove();
        },
        { once: true }
      );
    };

    continueButton.addEventListener('click', handleClose);
    backdrop.addEventListener('click', (e) => {
      if (e.target === backdrop) handleClose();
    });
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.blog-popup-overlay-button.-install');
    installButton.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const { device, os, browser } = config.jsVars.userData;
    const appName = config.jsVars.settings.webAppManifest.appIdentity.appName ?? '';
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(themeColor);
    const popupTitle = config.jsVars.settings.installation?.prompts?.types?.blogPopup?.title ?? __('Read this article in our web app', config.jsVars.slug);
    const popupButtonText = config.jsVars.settings.installation?.prompts?.types?.blogPopup?.buttonText ?? __('Open', config.jsVars.slug);
    const popupButtonTextContinue = config.jsVars.settings.installation?.prompts?.types?.blogPopup?.buttonTextContinue ?? __('Continue', config.jsVars.slug);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="blog-popup-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"></img>` : '';
    let browserTitle;
    let browserIcon;

    switch (true) {
      case browser.isChrome:
        browserTitle = 'Chrome';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/chrome.png';
        break;
      case browser.isSafari:
        browserTitle = 'Safari';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/safari.png';
        break;
      case browser.isFirefox:
        browserTitle = 'Firefox';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/firefox.png';
        break;
      case browser.isOpera:
        browserTitle = 'Opera';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/opera.png';
        break;
      case browser.isEdge:
        browserTitle = 'Edge';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/edge.png';
        break;
      case browser.isSamsung:
        browserTitle = 'Samsung Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/samsung.png';
        break;
      case browser.isYandex:
        browserTitle = 'Yandex Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/yandex.png';
        break;
      case browser.isDuckduckgo:
        browserTitle = 'DuckDuckGo';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/duckduckgo.png';
        break;
      case browser.isBrave:
        browserTitle = 'Brave';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/brave.png';
        break;
      case browser.isQq:
        browserTitle = 'QQ Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/qq.png';
        break;
      case browser.isUc:
        browserTitle = 'UC Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/uc.png';
        break;
      default:
        browserTitle = 'Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/unknown.png';
        break;
    }

    this.injectStyles(`
      .blog-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999999999;
        background: rgba(0, 0, 0, 0);
        -webkit-backdrop-filter: blur(0px);
                backdrop-filter: blur(0px);
        -webkit-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
        opacity: 0;
        visibility: hidden;
      }

      .blog-popup-overlay.visible {
        background: rgba(0, 0, 0, 0.7);
        -webkit-backdrop-filter: blur(5px);
                backdrop-filter: blur(5px);
        opacity: 1;
        visibility: visible;
      }

      .blog-popup-overlay-container {
        position: fixed;
        width: 100%;
        bottom: 0;
        left: 0;
        background-color: #fff;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        -webkit-transition: all 0.15s ease-out;
             -o-transition: all 0.15s ease-out;
                transition: all 0.15s ease-out;
        z-index: 9999999999;
        -webkit-transform: translateY(100%);
            -ms-transform: translateY(100%);
                transform: translateY(100%);
      }

      .blog-popup-overlay.visible .blog-popup-overlay-container {
        -webkit-transform: translateY(0);
            -ms-transform: translateY(0);
                transform: translateY(0);
      }

      .blog-popup-overlay-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding: 0.75rem 1rem;
        gap: 1.5rem;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        border-bottom: 1px solid #e5e7eb;
      }

      .blog-popup-overlay-header_title {
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 500;
        color: #1f2937;
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .blog-popup-overlay-body {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
        gap: 1.25rem;
        padding: 1.5rem;
        overflow-y: auto;
      }

      .blog-popup-overlay-body::-webkit-scrollbar {
        width: .5rem;
      }

      .blog-popup-overlay-body::-webkit-scrollbar-thumb {
        background-color: rgb(209 213 219 / 1);
        border-radius: 9999px;
      }

      .blog-popup-overlay-body::-webkit-scrollbar-track {
        background-color: rgb(243 244 246 / 1);
      }

      .blog-popup-overlay-appinfo,
      .blog-popup-overlay-browserinfo {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
            -ms-flex-pack: justify;
                justify-content: space-between;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        gap: 1rem;        
      }

      .blog-popup-overlay-appinfo_media,
      .blog-popup-overlay-browserinfo_media {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        gap: 0.5rem;
      }

      .blog-popup-overlay-appinfo_icon,
      .blog-popup-overlay-browserinfo_icon {
        border-radius: 9999px;
        -ms-flex-negative: 0;
            flex-shrink: 0;
        height: 48px;
        width: 48px;
        display: inline-block;
      }

      .blog-popup-overlay-appinfo_appname,
      .blog-popup-overlay-browserinfo_title {
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 500;
        color: #1f2937;
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .blog-popup-overlay-button {
        border-radius: 9999px;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 700;
        height: 2.5rem;
        border: none;
        outline: none;
        padding: 0;
        text-align: center;
        text-transform: capitalize;
        width: 6rem;
      }

      .blog-popup-overlay-button.-install {
        background-color: ${themeColor};
        color: ${textColor};
      }

      .blog-popup-overlay-button.-continue {
        background-color: #d9dee2;
        color: #787c7e;
        border: 1px solid #d3d6da;
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="blog-popup-overlay">
        <div class="blog-popup-overlay-container">
          <div class="blog-popup-overlay-header">
            <div class="blog-popup-overlay-header_title">${popupTitle}</div>
          </div>
          <div class="blog-popup-overlay-body">
            <div class="blog-popup-overlay-appinfo">
              <div class="blog-popup-overlay-appinfo_media">
                ${appIconHtml}
                <div class="blog-popup-overlay-appinfo_appname">${appName}</div>
              </div>
              <button type="button" class="blog-popup-overlay-button -install">
                ${popupButtonText}
              </button>
            </div>
            <div class="blog-popup-overlay-browserinfo">
              <div class="blog-popup-overlay-browserinfo_media">
                <img class="blog-popup-overlay-browserinfo_icon" src="${browserIcon}" alt="${browserTitle}" onerror="this.style.display='none'"></img>
                <div class="blog-popup-overlay-browserinfo_title">${browserTitle}</div>
              </div>
              <button type="button" class="blog-popup-overlay-button -continue">
                ${popupButtonTextContinue}
              </button>
            </div>     
          </div>
        </div>
      </div>
    `;
  }
}

export async function initInstallOverlayBlogPopup() {
  let hasTriggered = false;
  const scrollPercentTrigger = 10;

  if (!customElements.get('pwa-install-overlay-blog-popup')) {
    customElements.define('pwa-install-overlay-blog-popup', PwaInstallOverlayBlogPopup);
  }

  window.addEventListener('scroll', () => {
    if (hasTriggered) return;
    const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    if (scrollPercent >= scrollPercentTrigger) {
      PwaInstallOverlayBlogPopup.show();
      hasTriggered = true;
    }
  });
}
