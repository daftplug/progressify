import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';

const { __ } = wp.i18n;

class PwaInstallOverlayNavigationMenu extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.findAndAttachToMenu();
    this.render();
    this.handlePerformInstallation();
  }

  findAndAttachToMenu() {
    const mobileMenuSelectors = [
      // Common mobile menu containers
      '.wp-block-navigation',
      '#ast-mobile-header',
      '#mobile-menu',
      '.mobile-menu',
      '.mobile-navigation',
      '[class*="mobile-header"]',
      '[id*="mobile-header"]',
      '[class*="mobile-menu"]',
      '[id*="mobile-menu"]',
      'nav',
      'header',
    ];

    let mobileContainer = null;

    // Find the mobile menu container
    for (const selector of mobileMenuSelectors) {
      const elements = document.querySelectorAll(selector);
      for (const element of elements) {
        // Check if the element is visible
        if (window.getComputedStyle(element).display !== 'none') {
          mobileContainer = element;
          break;
        }
      }
      if (mobileContainer) {
        break;
      }
    }

    if (!mobileContainer) {
      console.log('No mobile menu found');
      return;
    }

    // Recursive function to find a visible 'ul' element with 'li' children
    function findVisibleMenuElement(element) {
      if (element.tagName.toLowerCase() === 'ul' && window.getComputedStyle(element).display !== 'none' && element.querySelector('li')) {
        return element;
      }
      for (const child of element.children) {
        const found = findVisibleMenuElement(child);
        if (found) {
          return found;
        }
      }
      return null;
    }

    const menuElement = findVisibleMenuElement(mobileContainer);

    if (menuElement) {
      // Remove existing instances if any, but not 'this'
      const existingInstances = document.querySelectorAll('pwa-install-overlay-navigation-menu');
      existingInstances.forEach((el) => {
        if (el !== this) {
          el.remove();
        }
      });

      // Check if 'this' is already in the menu to prevent re-attachment
      if (!menuElement.contains(this)) {
        // Create new menu item
        const menuItem = document.createElement('li');
        menuItem.className = 'menu-item pwa-install-menu-item';

        // Copy classes from existing menu items for consistency
        const existingMenuItem = menuElement.querySelector('li');
        if (existingMenuItem) {
          const classesToCopy = Array.from(existingMenuItem.classList).filter((cls) => !cls.includes('current') && !cls.includes('active'));
          menuItem.classList.add(...classesToCopy);
        }

        menuItem.appendChild(this);
        menuElement.appendChild(menuItem);

        console.log('PWA install prompt added to mobile menu:', menuElement);
      }
    } else {
      console.log('No menu element found within the mobile container');
    }
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.navigation-menu-button_install');
    installButton?.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const appName = config.settings.webAppManifest.appIdentity.appName ?? '';
    const backgroundColor = config.settings.installation?.prompts?.backgroundColor ?? '#000000';
    const textColor = config.settings.installation?.prompts?.textColor ?? '#ffffff';
    const bannerTitle = config.settings.installation?.prompts?.text ?? __('Install Web App', config.slug);
    const appIconHtml = config.iconUrl ? `<img class="navigation-menu-appinfo_icon" src="${config.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .navigation-menu {
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

      .navigation-menu-appinfo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
      }

      .navigation-menu-appinfo_icon {
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        flex-shrink: 0;
        height: 50px;
        width: 50px;
        display: inline-block;
      }

      .navigation-menu-appinfo_texts {
        flex: 1;
        min-width: 0;
      }

      .navigation-menu-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .navigation-menu-appinfo_description {
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

      .navigation-menu-button_install {
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
      <div class="navigation-menu">
        <div class="navigation-menu-appinfo">
          ${appIconHtml}
          <div class="navigation-menu-appinfo_texts">
            <div class="navigation-menu-appinfo_title">${bannerTitle}</div>
            <div class="navigation-menu-appinfo_description">${__('Find what you need faster by installing our web app!', config.slug)}</div>
          </div>
        </div>
        <button type="button" class="navigation-menu-button_install">
          ${__('Install Now', config.slug)}
        </button>
      </div>
    `;
  }
}

export async function initInstallOverlayNavigationMenu() {
  if (!customElements.get('pwa-install-overlay-navigation-menu')) {
    customElements.define('pwa-install-overlay-navigation-menu', PwaInstallOverlayNavigationMenu);
  }

  // Create instance
  const navigationMenuInstance = document.createElement('pwa-install-overlay-navigation-menu');
  navigationMenuInstance.findAndAttachToMenu();

  // Try again after a delay for dynamically loaded menus
  setTimeout(() => {
    const existingInstance = document.querySelector('pwa-install-overlay-navigation-menu');
    existingInstance?.findAndAttachToMenu();
  }, 1000);
}
