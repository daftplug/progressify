import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaInstallOverlayBlogPopup extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
    this.hasShown = false;
    this.scrollPercentTrigger = 10;
  }

  connectedCallback() {
    this.render();
    this.handleShowOnScroll();
    this.handleRemove();
    this.handlePerformInstallation();
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handleShowOnScroll() {
    window.addEventListener('scroll', () => {
      if (this.hasShown) return;

      const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
      if (scrollPercent >= this.scrollPercentTrigger) {
        requestAnimationFrame(() => {
          const blogPopup = this.shadowRoot.querySelector('.blog-popup-overlay');
          blogPopup.classList.add('visible');
        });

        this.hasShown = true;
      }
    });
  }

  handleRemove() {
    const continueButton = this.shadowRoot.querySelector('.blog-popup-overlay-button.-continue');
    const backdrop = this.shadowRoot.querySelector('.blog-popup-overlay');

    const handleClose = () => {
      backdrop.classList.remove('visible');
      setTimeout(() => this.remove(), 300);
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
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(backgroundColor);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="blog-popup-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"></img>` : '';
    let browserTitle;
    let browserIcon;

    switch (true) {
      case browser.isChrome:
        browserTitle = 'Chrome';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-chrome.png';
        break;
      case browser.isSafari:
        browserTitle = 'Safari';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-safari.png';
        break;
      case browser.isFirefox:
        browserTitle = 'Firefox';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-firefox.png';
        break;
      case browser.isOpera:
        browserTitle = 'Opera';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-opera.png';
        break;
      case browser.isEdge:
        browserTitle = 'Edge';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-edge.png';
        break;
      case browser.isSamsung:
        browserTitle = 'Samsung Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-samsung.png';
        break;
      case browser.isDuckduckgo:
        browserTitle = 'DuckDuckGo';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-duckduckgo.png';
        break;
      case browser.isBrave:
        browserTitle = 'Brave';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-brave.png';
        break;
      case browser.isQq:
        browserTitle = 'QQ Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-qq.png';
        break;
      case browser.isUc:
        browserTitle = 'UC Browser';
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-uc.png';
        break;
      default:
        browserIcon = config.jsVars.pluginsData.dirUrl + '/frontend/assets/media/icons/browsers/icon-browser.png';
        break;
    }

    this.injectStyles(`
      .blog-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999999;
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
        -webkit-transition: all 0.15s ease-out;
             -o-transition: all 0.15s ease-out;
                transition: all 0.15s ease-out;
        z-index: 999999999999999999999;
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
        border: 1px solid #e5e7eb;
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
        background-color: ${backgroundColor};
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
            <div class="blog-popup-overlay-header_title">${__('Read this article in our web app', config.slug)}</div>
          </div>
          <div class="blog-popup-overlay-body">
            <div class="blog-popup-overlay-appinfo">
              <div class="blog-popup-overlay-appinfo_media">
                ${appIconHtml}
                <div class="blog-popup-overlay-appinfo_appname">${appName}</div>
              </div>
              <button type="button" class="blog-popup-overlay-button -install">
                Open
              </button>
            </div>
            <div class="blog-popup-overlay-browserinfo">
              <div class="blog-popup-overlay-browserinfo_media">
                <img class="blog-popup-overlay-browserinfo_icon" src="${browserIcon}" alt="${browserTitle}" onerror="this.style.display='none'"></img>
                <div class="blog-popup-overlay-browserinfo_title">${browserTitle}</div>
              </div>
              <button type="button" class="blog-popup-overlay-button -continue">
                Continue
              </button>
            </div>     
          </div>
        </div>
      </div>
    `;
  }
}

export async function initInstallOverlayBlogPopup() {
  if (!customElements.get('pwa-install-overlay-blog-popup')) {
    customElements.define('pwa-install-overlay-blog-popup', PwaInstallOverlayBlogPopup);
  }

  const blogPopupInstance = document.createElement('pwa-install-overlay-blog-popup');
  config.daftplugFrontend.appendChild(blogPopupInstance);
}
