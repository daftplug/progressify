import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';

const { __ } = wp.i18n;

class PwaInstallOverlayInFeed extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.findAndAttachToFeed();
    this.render();
    this.handlePerformInstallation();
  }

  findAndAttachToFeed() {
    // Define selectors for feed containers
    const feedSelectors = ['.post-list', '.posts', '.post-loop', '.blog-posts', '.content-area', '.site-main', '#main', '#content', 'main'];

    let feedContainer = null;

    // Find the feed container
    for (const selector of feedSelectors) {
      const element = document.querySelector(selector);
      if (element) {
        feedContainer = element;
        break;
      }
    }

    if (!feedContainer) {
      console.log('No feed container found');
      return;
    }

    // Define selectors for feed items
    const feedItemSelectors = ['.post', '.entry', '.article', '.blog-post', '.hentry', 'article'];

    // Function to find feed items within the container
    const findFeedItems = () => {
      for (const selector of feedItemSelectors) {
        const items = feedContainer.querySelectorAll(selector);
        if (items.length > 0) {
          return items;
        }
      }
      return [];
    };

    const insertOverlay = () => {
      const feedItems = findFeedItems();
      if (feedItems.length === 0) {
        console.log('No feed items found');
        return;
      }

      const insertAfterNthItem = 4; // Change this to insert after a different item
      if (feedItems.length >= insertAfterNthItem) {
        const targetItem = feedItems[insertAfterNthItem - 1];

        // Check if overlay is already inserted
        if (!feedContainer.querySelector('pwa-install-overlay-in-feed')) {
          const overlayWrapper = document.createElement('div');
          overlayWrapper.className = 'pwa-install-overlay-wrapper';

          // Append the overlay element to the wrapper
          overlayWrapper.appendChild(this);

          // Insert the wrapper after the target item
          targetItem.parentNode.insertBefore(overlayWrapper, targetItem.nextSibling);

          console.log(`PWA install prompt added to feed after item ${insertAfterNthItem}`);
        }
      } else {
        console.log('Not enough feed items to insert overlay');
      }
    };

    // Run initially
    insertOverlay();

    // Observe mutations to feed container for dynamically loaded content
    const observer = new MutationObserver((mutationsList) => {
      for (const mutation of mutationsList) {
        if (mutation.addedNodes.length > 0) {
          insertOverlay();
          break;
        }
      }
    });

    observer.observe(feedContainer, { childList: true, subtree: true });
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.in-feed-button_install');
    installButton?.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const appName = config.settings.webAppManifest.appIdentity.appName ?? '';
    const backgroundColor = config.settings.installation?.prompts?.backgroundColor ?? '#000000';
    const textColor = config.settings.installation?.prompts?.textColor ?? '#ffffff';
    const bannerTitle = config.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);
    const appIconHtml = config.iconUrl ? `<img class="in-feed-appinfo_icon" src="${config.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .in-feed {
        position: relative;
        border-radius: 0.5rem;
        padding: 1rem;
        background-color: ${backgroundColor};
        color: ${textColor};
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        -webkit-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
        overflow: hidden;
        text-transform: none;
      }

      .in-feed-appinfo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
      }

      .in-feed-appinfo_icon {
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        flex-shrink: 0;
        height: 50px;
        width: 50px;
        display: inline-block;
      }

      .in-feed-appinfo_texts {
        flex: 1;
        min-width: 0;
      }

      .in-feed-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .in-feed-appinfo_description {
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

      .in-feed-button_install {
        display: block;
        background-color: ${textColor};
        color: ${backgroundColor};
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
      <div class="in-feed">
        <div class="in-feed-appinfo">
          ${appIconHtml}
          <div class="in-feed-appinfo_texts">
            <div class="in-feed-appinfo_title">${bannerTitle}</div>
            <div class="in-feed-appinfo_description">${__("Keep reading, even when you're on the train!", config.slug)}</div>
          </div>
        </div>
        <button type="button" class="in-feed-button_install">
          ${__('Install Now', config.slug)}
        </button>
      </div>
    `;
  }
}

export async function initInstallOverlayInFeed() {
  if (!customElements.get('pwa-install-overlay-in-feed')) {
    customElements.define('pwa-install-overlay-in-feed', PwaInstallOverlayInFeed);
  }

  // Create instance
  const inFeedInstance = document.createElement('pwa-install-overlay-in-feed');
  inFeedInstance.findAndAttachToFeed();

  // Try again after a delay for dynamically loaded feeds
  setTimeout(() => {
    const existingInstance = document.querySelector('pwa-install-overlay-in-feed');
    existingInstance?.findAndAttachToFeed();
  }, 1000);
}
