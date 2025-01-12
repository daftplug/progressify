import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaInstallOverlayNavigationMenu extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();
    this.handlePerformInstallation();
  }

  static findVisibleMenuElement(element) {
    if (element.tagName.toLowerCase() === 'ul' && window.getComputedStyle(element).display !== 'none' && element.querySelector('li')) {
      return element;
    }
    for (const child of element.children) {
      const found = this.findVisibleMenuElement(child);
      if (found) {
        return found;
      }
    }
    return null;
  }

  static findMobileMenu() {
    const mobileMenuSelectors = ['.wp-block-navigation', '#ast-mobile-header', '#mobile-menu', '.mobile-menu', '.mobile-navigation', '[class*="mobile-header"]', '[id*="mobile-header"]', '[class*="mobile-menu"]', '[id*="mobile-menu"]', 'nav', 'header'];

    // Find visible mobile container
    for (const selector of mobileMenuSelectors) {
      const elements = document.querySelectorAll(selector);
      for (const element of elements) {
        if (window.getComputedStyle(element).display !== 'none') {
          const menuElement = this.findVisibleMenuElement(element);
          if (menuElement) {
            return { container: element, menu: menuElement };
          }
        }
      }
    }

    return null;
  }

  static show() {
    let overlay = document.querySelector('pwa-install-overlay-navigation-menu');

    if (!overlay) {
      const menuData = this.findMobileMenu();

      if (menuData?.menu) {
        overlay = document.createElement('pwa-install-overlay-navigation-menu');

        // Create menu item
        const menuItem = document.createElement('li');
        menuItem.className = 'menu-item pwa-install-menu-item';

        // Copy classes from existing menu items for consistency
        const existingMenuItem = menuData.menu.querySelector('li');
        if (existingMenuItem) {
          const classesToCopy = Array.from(existingMenuItem.classList).filter((cls) => !cls.includes('current') && !cls.includes('active'));
          menuItem.classList.add(...classesToCopy);
        }

        menuItem.appendChild(overlay);
        menuData.menu.appendChild(menuItem);
      }
    }

    return overlay;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  handlePerformInstallation() {
    const installButton = this.shadowRoot.querySelector('.navigation-menu-overlay-button_install');
    installButton?.addEventListener('click', () => {
      performInstallation();
    });
  }

  render() {
    const appName = config.jsVars.settings.webAppManifest.appIdentity.appName ?? '';
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(themeColor);
    const bannerTitle = config.jsVars.settings.installation?.prompts?.text ?? __('Install Web App', config.jsVars.slug);
    const appIconHtml = config.jsVars.iconUrl ? `<img class="navigation-menu-overlay-appinfo_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .navigation-menu-overlay {
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

      .navigation-menu-overlay-appinfo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
      }

      .navigation-menu-overlay-appinfo_icon {
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        flex-shrink: 0;
        height: 50px;
        width: 50px;
        display: inline-block;
      }

      .navigation-menu-overlay-appinfo_texts {
        flex: 1;
        min-width: 0;
      }

      .navigation-menu-overlay-appinfo_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .navigation-menu-overlay-appinfo_description {
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

      .navigation-menu-overlay-button_install {
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
      <div class="navigation-menu-overlay">
        <div class="navigation-menu-overlay-appinfo">
          ${appIconHtml}
          <div class="navigation-menu-overlay-appinfo_texts">
            <div class="navigation-menu-overlay-appinfo_title">${bannerTitle}</div>
            <div class="navigation-menu-overlay-appinfo_description">${__('Find what you need faster by installing our web app!', config.jsVars.slug)}</div>
          </div>
        </div>
        <button type="button" class="navigation-menu-overlay-button_install">
          ${__('Install Now', config.jsVars.slug)}
        </button>
      </div>
    `;
  }
}

export async function initInstallOverlayNavigationMenu() {
  if (!customElements.get('pwa-install-overlay-navigation-menu')) {
    customElements.define('pwa-install-overlay-navigation-menu', PwaInstallOverlayNavigationMenu);
  }

  // Try initial insertion
  PwaInstallOverlayNavigationMenu.show();

  // Try again after a delay for dynamically loaded menus
  setTimeout(() => {
    PwaInstallOverlayNavigationMenu.show();
  }, 1000);
}
