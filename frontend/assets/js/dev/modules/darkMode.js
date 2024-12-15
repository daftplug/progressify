import { config } from '../main.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaDarkMode extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
    this.darkMode = localStorage.getItem('darkMode') === 'enabled';
    this.type = config.jsVars.settings.uiComponents.darkMode.type;
    this.icons = {
      light: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>',
      dark: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>',
    };
    this.darkColorScheme = {
      background: '#1c1c1c',
      surface: '#2d2d2d',
      surfaceLighter: '#404040',
      text: '#ffffff',
      textSecondary: '#e0e0e0',
      border: '#404040',
      link: '#66b3ff',
      linkVisited: '#b366ff',
      input: '#2d2d2d',
    };
  }

  connectedCallback() {
    this.injectGlobalStyles();
    this.render();
    this.handleModeChange();
    this.checkSystemPreference();
    this.checkBatteryLevel();
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  injectGlobalStyles() {
    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
      /* Dark mode CSS variables */
      :root.dark {
        ${Object.entries(this.darkColorScheme)
          .map(([key, value]) => `--dm-${key}: ${value};`)
          .join('\n')}
      }

      :root.dark * {
        background-color: var(--dm-background) !important;
        color: var(--dm-text) !important;
      }

      /* Element specific styles */
      :root.dark img:not([src*=".svg"]),
      :root.dark video,
      :root.dark iframe {
        opacity: 0.8 !important;
        -webkit-filter: brightness(0.9) !important;
                filter: brightness(0.9) !important;
      }

      :root.dark img[src*=".svg"] {
        -webkit-filter: brightness(0.9) invert(1) !important;
                filter: brightness(0.9) invert(1) !important;
      }

      :root.dark input,
      :root.dark textarea,
      :root.dark select {
        background-color: var(--dm-input) !important;
        color: var(--dm-text) !important;
        border-color: var(--dm-border) !important;
      }

      :root.dark a:not([class]) {
        color: var(--dm-link) !important;
      }

      :root.dark a:not([class]):visited {
        color: var(--dm-linkVisited) !important;
      }

      :root.dark [class*="shadow"],
      :root.dark [class*="Shadow"] {
        -webkit-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3) !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3) !important;
      }

      :root.dark pre,
      :root.dark code {
        background-color: var(--dm-surfaceLighter) !important;
      }

      :root.dark table,
      :root.dark th,
      :root.dark td {
        border-color: var(--dm-border) !important;
      }

      :root.dark th {
        background-color: var(--dm-surface) !important;
      }

      :root.dark tr:nth-child(even) {
        background-color: var(--dm-surfaceLighter) !important;
      }

      :root.dark blockquote {
        background-color: var(--dm-surface) !important;
        border-left-color: var(--dm-border) !important;
      }

      /* Handle common components and frameworks */
      :root.dark header,
      :root.dark nav,
      :root.dark footer {
        background-color: var(--dm-surface) !important;
      }

      :root.dark [class*="card"],
      :root.dark [class*="panel"],
      :root.dark [class*="box"] {
        background-color: var(--dm-surface) !important;
        border-color: var(--dm-border) !important;
      }

      /* Handle WordPress specific elements */
      :root.dark .wp-block-button__link {
        background-color: var(--dm-surface) !important;
        color: var(--dm-text) !important;
      }

      :root.dark .wp-block-quote {
        border-color: var(--dm-border) !important;
      }
    `;

    document.head.appendChild(styleSheet);
  }

  static findMenuElement(element) {
    // Check for visible menu elements
    const menuSelectors = ['ul.menu', 'ul.nav-menu', '.wp-block-navigation__container', '.main-navigation ul', '.primary-menu', '.menu-primary'];

    for (const selector of menuSelectors) {
      const menu = element.querySelector(selector);
      if (menu && window.getComputedStyle(menu).display !== 'none' && menu.querySelector('li')) {
        return menu;
      }
    }

    // Recursively search through children
    for (const child of element.children) {
      if (child.tagName.toLowerCase() === 'ul' && window.getComputedStyle(child).display !== 'none' && child.querySelector('li')) {
        return child;
      }
      const found = this.findMenuElement(child);
      if (found) return found;
    }

    return null;
  }

  static findHeader() {
    const headerSelectors = [
      // Desktop selectors
      'header.site-header',
      '#masthead',
      '.main-header',
      '#site-header',
      // Mobile selectors
      '#ast-mobile-header',
      '#mobile-menu',
      '.mobile-menu',
      '.mobile-navigation',
      // Generic selectors
      '[class*="header"]',
      '[id*="header"]',
      'header',
      'nav',
    ];

    for (const selector of headerSelectors) {
      const elements = document.querySelectorAll(selector);
      for (const element of elements) {
        if (window.getComputedStyle(element).display !== 'none') {
          const menuElement = this.findMenuElement(element);
          if (menuElement) {
            return { container: element, menu: menuElement };
          }
        }
      }
    }

    return null;
  }

  static show() {
    const type = config.jsVars.settings.uiComponents.darkMode.type;
    let darkModeSwitch = document.querySelector('pwa-dark-mode');

    if (!darkModeSwitch) {
      darkModeSwitch = document.createElement('pwa-dark-mode');

      if (type === 'menu-switch') {
        const headerData = this.findHeader();
        if (headerData?.menu) {
          const menuItem = document.createElement('li');
          menuItem.className = 'menu-item pwa-dark-mode-item';

          // Copy existing menu item classes for consistency
          const existingMenuItem = headerData.menu.querySelector('li');
          if (existingMenuItem) {
            const classesToCopy = Array.from(existingMenuItem.classList).filter((cls) => !cls.includes('current') && !cls.includes('active'));
            menuItem.classList.add(...classesToCopy);
          }

          menuItem.appendChild(darkModeSwitch);
          headerData.menu.appendChild(menuItem);
        }
      } else {
        // Floating button
        config.daftplugFrontend.appendChild(darkModeSwitch);
      }
    }

    return darkModeSwitch;
  }

  async checkBatteryLevel() {
    if (config.jsVars.settings.uiComponents.darkMode.batteryLow === 'on' && 'getBattery' in navigator) {
      try {
        const battery = await navigator.getBattery();
        if (battery.level < 0.1) {
          this.enableDarkMode();
        }
        // Listen for battery level changes
        battery.addEventListener('levelchange', () => {
          if (battery.level < 0.1) {
            this.enableDarkMode();
          }
        });
      } catch (error) {
        console.warn('Battery status check failed:', error);
      }
    }
  }

  checkSystemPreference() {
    if (config.jsVars.settings.uiComponents.darkMode.osAware === 'on') {
      // Check initial preference
      if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        this.enableDarkMode();
      }

      // Listen for preference changes
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (e.matches) {
          this.enableDarkMode();
        } else {
          this.disableDarkMode();
        }
      });
    }
  }

  enableDarkMode() {
    document.documentElement.classList.add('dark');
    localStorage.setItem('darkMode', 'enabled');
    this.shadowRoot.querySelector('.dark-mode-floating, .dark-mode-menu').classList.add('-dark');
    this.darkMode = true;
    this.updateIcon();
    this.dispatchEvent(
      new CustomEvent('darkModeChange', {
        detail: { enabled: true },
        bubbles: true,
      })
    );
  }

  disableDarkMode() {
    document.documentElement.classList.remove('dark');
    localStorage.setItem('darkMode', 'disabled');
    this.shadowRoot.querySelector('.dark-mode-floating, .dark-mode-menu').classList.remove('-dark');
    this.darkMode = false;
    this.updateIcon();
    this.dispatchEvent(
      new CustomEvent('darkModeChange', {
        detail: { enabled: false },
        bubbles: true,
      })
    );
  }

  updateIcon() {
    const iconElement = this.shadowRoot.querySelector('.dark-mode-floating-icon, .dark-mode-menu-icon');
    if (iconElement) {
      iconElement.innerHTML = this.darkMode ? this.icons.dark : this.icons.light;
    }
  }

  handleModeChange() {
    const button = this.shadowRoot.querySelector('.dark-mode-floating, .dark-mode-menu');
    if (button) {
      button.addEventListener('click', (e) => {
        if (this.darkMode) {
          this.disableDarkMode();
        } else {
          this.enableDarkMode();
        }
      });
    }

    // Initialize mode from localStorage or system preference
    if (localStorage.getItem('darkMode') === 'enabled') {
      this.enableDarkMode();
    }
  }

  renderMenuSwitch() {
    this.injectStyles(`
      .dark-mode-menu {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        position: relative;
        border-radius: 9999px;
        width: 40px;
        height: 22px;
        -ms-flex-negative: 0;
            flex-shrink: 0;
        border: 1px solid #c2c2c4;
        background-color: #eff0f3;
        outline: none;
        cursor: pointer;
      }

      .dark-mode-menu.-dark {
        border: 1px solid #3c3f44;
        background-color: #272a2f;
      }
  
      .dark-mode-menu-icon {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        position: absolute;
        left: 1px;
        width: 12px;
        height: 12px;
        padding: 4px;
        border-radius: 50%;
        color: #48484e;
        background-color: #ffffff;
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .04), 0 1px 2px rgba(0, 0, 0, .06);
                box-shadow: 0 1px 2px rgba(0, 0, 0, .04), 0 1px 2px rgba(0, 0, 0, .06);
        -webkit-transition: -webkit-transform .25s !important;
        transition: -webkit-transform .25s !important;
        -o-transition: transform .25s !important;
        transition: transform .25s !important;
        transition: transform .25s, -webkit-transform .25s !important;
      }

      .dark-mode-menu.-dark .dark-mode-menu-icon {
        background-color: #000000;
        color: #ffffff;
        -webkit-transform: translate(18px);
            -ms-transform: translate(18px);
                transform: translate(18px);
      }
    `);

    return `
      <div class="dark-mode-menu ${this.darkMode ? '-dark' : ''}" aria-label="${__('Toggle dark mode')}">
        <span class="dark-mode-menu-icon">
          ${this.darkMode ? this.icons.dark : this.icons.light}
        </span>
      </div>
    `;
  }

  renderFloatingButton() {
    this.injectStyles(`
      .dark-mode-floating {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        width: 50px;
        height: 50px;
        background: #eff0f3;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        -webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      }

      .dark-mode-floating.-dark {
        background: #000000;
      }
  
      .dark-mode-floating-icon {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        width: 18px;
        height: 18px;
        color: #48484e;
      }

      .dark-mode-floating.-dark .dark-mode-floating-icon {
        color: #ffffff;
      }
    `);

    return `
      <div class="dark-mode-floating" aria-label="${__('Toggle dark mode')}">
        <span class="dark-mode-floating-icon">
          ${this.darkMode ? this.icons.dark : this.icons.light}
        </span>
      </div>
    `;
  }

  render() {
    const menuSwitch = this.renderMenuSwitch();
    const floatingButton = this.renderFloatingButton();
    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>
        ${combinedStyles}
      </style>
      ${this.type === 'menu-switch' ? menuSwitch : floatingButton}
    `;
  }
}

export async function initDarkMode() {
  const { device } = config.jsVars.userData;
  const supportedDevices = config.jsVars.settings.uiComponents.darkMode.supportedDevices;
  const isDeviceSupported = supportedDevices.some((supported) => (supported === 'smartphone' && device.isSmartphone) || (supported === 'tablet' && device.isTablet) || (supported === 'desktop' && device.isDesktop));

  if (!isDeviceSupported) {
    return;
  }

  if (!customElements.get('pwa-dark-mode')) {
    customElements.define('pwa-dark-mode', PwaDarkMode);
  }

  // Initial insertion
  PwaDarkMode.show();

  // Try again after delay for dynamic menus
  setTimeout(() => {
    PwaDarkMode.show();
  }, 1000);
}
