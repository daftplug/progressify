import { config } from '../frontend.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaInstallOverlayInFeed extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();
    this.handlePerformInstallation();
  }

  static async findFeedContainer() {
    const feedSelectors = ['.post-list', '.posts', '.post-loop', '.blog-posts', '.content-area', '.site-main', '#main', '#content', 'main', '.entry-content'];
    const feedItemSelectors = ['.post', '.entry', '.article', '.blog-post', '.hentry', 'article'];

    // Find container
    let feedContainer = null;
    for (const selector of feedSelectors) {
      const element = document.querySelector(selector);
      if (element) {
        feedContainer = element;
        break;
      }
    }

    if (!feedContainer) return null;

    // Find feed items
    let feedItems = null;
    for (const selector of feedItemSelectors) {
      const items = feedContainer.querySelectorAll(selector);
      if (items.length > 0) {
        feedItems = items;
        break;
      }
    }

    return { feedContainer, feedItems };
  }

  static async show() {
    let overlay = document.querySelector('pwa-install-overlay-in-feed');

    if (!overlay) {
      overlay = document.createElement('pwa-install-overlay-in-feed');

      // Try to find and insert into feed
      const feed = await this.findFeedContainer();
      if (feed && feed.feedItems?.length >= 4) {
        const targetItem = feed.feedItems[3]; // Insert after 4th item
        const overlayWrapper = document.createElement('div');
        overlayWrapper.className = 'pwa-install-overlay-wrapper';
        overlayWrapper.appendChild(overlay);
        targetItem.parentNode.insertBefore(overlayWrapper, targetItem.nextSibling);
      }
    }

    return overlay;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.in-feed-overlay-button_install');
    installButton?.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const appName = config.jsVars.settings.webAppManifest.appIdentity.appName ?? '';
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(themeColor);
    const title = config.jsVars.settings.installation?.prompts?.text ?? __('Install Web App', config.jsVars.slug);
    const message = config.jsVars.settings.installation?.prompts?.types?.inFeed?.message ?? __("Keep reading, even when you're on the train!", config.jsVars.slug);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="in-feed-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .in-feed-overlay {
        position: relative;
        border-radius: 0.5rem;
        padding: 1rem;
        background-color: ${themeColor};
        color: ${textColor};
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        -webkit-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
        overflow: hidden;
        text-transform: none;
      }

      .in-feed-overlay-appinfo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
      }

      .in-feed-overlay-appinfo_icon {
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        flex-shrink: 0;
        height: 50px;
        width: 50px;
        display: inline-block;
      }

      .in-feed-overlay-appinfo_texts {
        flex: 1;
        min-width: 0;
      }

      .in-feed-overlay-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .in-feed-overlay-appinfo_description {
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

      .in-feed-overlay-button_install {
        display: block;
        background-color: ${textColor};
        color: ${themeColor};
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
      <div class="in-feed-overlay">
        <div class="in-feed-overlay-appinfo">
          ${appIconHtml}
          <div class="in-feed-overlay-appinfo_texts">
            <div class="in-feed-overlay-appinfo_title">${title}</div>
            <div class="in-feed-overlay-appinfo_description">${message}</div>
          </div>
        </div>
        <button type="button" class="in-feed-overlay-button_install">
          ${__('Install Now', config.jsVars.slug)}
        </button>
      </div>
    `;
  }
}

export async function initInstallOverlayInFeed() {
  if (!customElements.get('pwa-install-overlay-in-feed')) {
    customElements.define('pwa-install-overlay-in-feed', PwaInstallOverlayInFeed);
  }

  // Try initial insertion
  PwaInstallOverlayInFeed.show();

  // Try again after a delay for dynamically loaded feeds
  setTimeout(() => {
    PwaInstallOverlayInFeed.show();
  }, 1000);
}
