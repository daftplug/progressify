import { config } from '../main.js';
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
    this.findAndAttachToFeed();
    this.render();
    this.handlePerformInstallation();
  }

  findAndAttachToFeed() {
    // Define selectors for feed containers
    const feedSelectors = ['.post-list', '.posts', '.post-loop', '.blog-posts', '.content-area', '.site-main', '#main', '#content', 'main', '.entry-content'];

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

    const insertOverlay = (observer) => {
      const feedItems = findFeedItems();
      if (feedItems.length === 0) {
        return false; // Return false to indicate insertion wasn't possible
      }

      const insertAfterNthItem = 4;
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

          // Disconnect observer after successful insertion
          if (observer) {
            observer.disconnect();
            console.log('Feed mutation observer disconnected');
          }

          return true; // Return true to indicate successful insertion
        }
      }

      return false;
    };

    // Try initial insertion
    if (insertOverlay()) {
      return; // Exit if initial insertion was successful
    }

    // Set up observer only if initial insertion failed
    let attemptCount = 0;
    const maxAttempts = 10; // Limit number of attempts
    let observer = new MutationObserver((mutationsList) => {
      // Increment attempt counter
      attemptCount++;

      // Try to insert the overlay
      if (insertOverlay(observer)) {
        return; // Observer will be disconnected by insertOverlay
      }

      // Disconnect after max attempts
      if (attemptCount >= maxAttempts) {
        observer.disconnect();
        console.log(`Feed mutation observer disconnected after ${maxAttempts} attempts`);
      }
    });

    // Use a more specific observation configuration
    observer.observe(feedContainer, {
      childList: true, // Watch for direct children changes
      subtree: false, // Don't watch deep tree changes
      attributes: false, // Don't watch attributes
      characterData: false, // Don't watch text content
    });

    // Set a timeout to disconnect observer after a reasonable time
    setTimeout(() => {
      if (observer) {
        observer.disconnect();
        console.log('Feed mutation observer disconnected after timeout');
      }
    }, 30000); // 30 seconds timeout
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
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(backgroundColor);
    const bannerTitle = config.jsVars.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="in-feed-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .in-feed-overlay {
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
      <div class="in-feed-overlay">
        <div class="in-feed-overlay-appinfo">
          ${appIconHtml}
          <div class="in-feed-overlay-appinfo_texts">
            <div class="in-feed-overlay-appinfo_title">${bannerTitle}</div>
            <div class="in-feed-overlay-appinfo_description">${__("Keep reading, even when you're on the train!", config.slug)}</div>
          </div>
        </div>
        <button type="button" class="in-feed-overlay-button_install">
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
