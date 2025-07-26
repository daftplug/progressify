import { config } from '../frontend.js';
import { getContrastTextColor } from '../components/utils.js';

class PwaNavigationTabBar extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  connectedCallback() {
    this.render();
  }

  static show() {
    let navigationTabBar = document.querySelector('pwa-navigation-tab-bar');
    if (!navigationTabBar) {
      navigationTabBar = document.createElement('pwa-navigation-tab-bar');
      document.body.appendChild(navigationTabBar);
    }
    return navigationTabBar;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  async renderTabBarItems() {
    const navigationItems = config.jsVars.settings.uiComponents.navigationTabBar.navigationItems || [];
    const currentUrl = new URL(window.location.href);
    const cleanCurrentUrl = currentUrl.origin + currentUrl.pathname;

    const listItems = await Promise.all(
      navigationItems.map(async (item) => {
        const { icon, label, page } = item;

        // Fetch and process SVG
        let svgContent = '';
        try {
          const res = await fetch(icon);
          svgContent = await res.text();
        } catch (e) {
          console.error(`Failed to load SVG from ${icon}`, e);
        }

        return `
          <li class="navigation-tab-bar_item ${cleanCurrentUrl === page ? '-active' : ''}">
            <a class="navigation-tab-bar_link" href="${page}">
              <span class="navigation-tab-bar_icon">
                ${svgContent}
              </span>
              <span class="navigation-tab-bar_label">${label}</span>
            </a>
          </li>
        `;
      })
    );

    return listItems.join('');
  }

  async render() {
    // Compute colors, inject styles, etc.
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const backgroundColor = getContrastTextColor(themeColor);
    const textColor = getContrastTextColor(backgroundColor);
    const borderColor = backgroundColor === '#ffffff' ? '#e5e7eb' : '#404040';

    this.injectStyles(`
      .navigation-tab-bar {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0;
        padding: 0;
        padding-bottom: env(safe-area-inset-bottom);
        transition: padding-bottom 250ms cubic-bezier(0.42, 0, 0.58, 1);
        touch-action: none;
        user-select: none;
        width: 100%;
        z-index: 999999999;
        height: 3.5rem;
        background-color: ${backgroundColor};
        border-top: 1px solid ${borderColor};
      }

      .navigation-tab-bar_list {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-around;
        list-style: none;
        width: 95%;
        height: 100%;
        margin: 0;
        padding: 0;
      }

      .navigation-tab-bar_item {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        flex: 1 1 0;
        width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .navigation-tab-bar_link {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 0.5rem;
        text-decoration: none;
        transition: all 0.2s ease;
      }

      .navigation-tab-bar_icon {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.125rem;
      }

      .navigation-tab-bar_icon svg {
        width: 1.25rem;
        height: 1.25rem;
        color: ${textColor}99;
      }

      .navigation-tab-bar_label {
        display: block;
        font-size: 0.75rem;
        line-height: 1rem;
        font-weight: 500;
        text-align: center;
        color: ${textColor}99;
      }

      .navigation-tab-bar_item.-active .navigation-tab-bar_icon svg {
        color: ${themeColor};
        stroke-width: 2.25;
      }

      .navigation-tab-bar_item.-active .navigation-tab-bar_label {
        font-weight: 700;
        color: ${themeColor};
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');
    const itemsHtml = await this.renderTabBarItems();

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <nav class="navigation-tab-bar">
        <ul class="navigation-tab-bar_list">
          ${itemsHtml}
        </ul>
      </nav>
    `;
  }
}

export async function initNavigationTabBar() {
  if (!customElements.get('pwa-navigation-tab-bar')) {
    customElements.define('pwa-navigation-tab-bar', PwaNavigationTabBar);
  }
  PwaNavigationTabBar.show();
}
