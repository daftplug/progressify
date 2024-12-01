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
    this.colorScheme = {
      dark: {
        background: '#1a1a1a',
        surface: '#2d2d2d',
        surfaceLighter: '#404040',
        text: '#ffffff',
        textSecondary: '#e0e0e0',
        border: '#404040',
        link: '#66b3ff',
        linkVisited: '#b366ff',
        input: '#2d2d2d',
      },
      light: {
        background: '#ffffff',
        surface: '#f5f5f5',
        surfaceLighter: '#e0e0e0',
        text: '#333333',
        textSecondary: '#666666',
        border: '#dddddd',
        link: '#0066cc',
        linkVisited: '#551a8b',
        input: '#ffffff',
      },
    };
  }

  connectedCallback() {
    this.injectGlobalStyles();
    this.render();
    this.handleModeChange();
    this.checkSystemPreference();
    this.checkBatteryLevel();
  }

  injectGlobalStyles() {
    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
      /* Dark mode CSS variables */
      :root {
        --dm-transition-time: 0.2s;
        ${Object.entries(this.colorScheme.light)
          .map(([key, value]) => `--dm-${key}: ${value};`)
          .join('\n')}
      }

      :root.dark {
        ${Object.entries(this.colorScheme.dark)
          .map(([key, value]) => `--dm-${key}: ${value};`)
          .join('\n')}
      }

      :root.dark body {
        background-color: var(--dm-background);
        color: var(--dm-text);
      }

      /* Element specific styles */
      :root.dark * {
        transition: background-color var(--dm-transition-time) ease,
                   color var(--dm-transition-time) ease,
                   border-color var(--dm-transition-time) ease,
                   box-shadow var(--dm-transition-time) ease;
      }

      :root.dark img:not([src*=".svg"]),
      :root.dark video,
      :root.dark iframe {
        opacity: 0.8;
        filter: brightness(0.9);
      }

      :root.dark img[src*=".svg"] {
        filter: brightness(0.9) invert(1);
      }

      :root.dark input,
      :root.dark textarea,
      :root.dark select {
        background-color: var(--dm-input);
        color: var(--dm-text);
        border-color: var(--dm-border);
      }

      :root.dark a:not([class]) {
        color: var(--dm-link);
      }

      :root.dark a:not([class]):visited {
        color: var(--dm-linkVisited);
      }

      :root.dark [class*="shadow"],
      :root.dark [class*="Shadow"] {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3) !important;
      }

      :root.dark pre,
      :root.dark code {
        background-color: var(--dm-surfaceLighter);
      }

      :root.dark table,
      :root.dark th,
      :root.dark td {
        border-color: var(--dm-border);
      }

      :root.dark th {
        background-color: var(--dm-surface);
      }

      :root.dark tr:nth-child(even) {
        background-color: var(--dm-surfaceLighter);
      }

      :root.dark blockquote {
        background-color: var(--dm-surface);
        border-left-color: var(--dm-border);
      }

      /* Handle common components and frameworks */
      :root.dark [class*="header"],
      :root.dark [class*="nav"],
      :root.dark [class*="footer"] {
        background-color: var(--dm-surface);
      }

      :root.dark [class*="card"],
      :root.dark [class*="panel"],
      :root.dark [class*="box"] {
        background-color: var(--dm-surface);
        border-color: var(--dm-border);
      }

      /* Handle WordPress specific elements */
      :root.dark .wp-block-button__link {
        background-color: var(--dm-surface);
        color: var(--dm-text);
      }

      :root.dark .wp-block-quote {
        border-color: var(--dm-border);
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
        document.body.appendChild(darkModeSwitch);
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
    const button = this.shadowRoot.querySelector('.dark-mode-floating-button, .dark-mode-menu-button');
    if (button) {
      button.addEventListener('click', () => {
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

  injectStyles(css) {
    this.styles.add(css);
  }

  renderFloatingButton() {
    this.injectStyles(`
      .dark-mode-floating {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
      }
  
      .dark-mode-floating-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        padding: 12px;
        background: var(--theme-color, #000000);
        color: var(--text-color, #ffffff);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: opacity 0.3s, transform 0.2s;
      }
  
      .dark-mode-floating-button:hover {
        opacity: 0.8;
        transform: scale(1.05);
      }
  
      .dark-mode-floating-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
      }
    `);

    return `
      <div class="dark-mode-floating">
        <button class="dark-mode-floating-button" aria-label="${__('Toggle dark mode')}">
          <span class="dark-mode-floating-icon">
            ${this.darkMode ? this.icons.dark : this.icons.light}
          </span>
        </button>
      </div>
    `;
  }

  renderMenuSwitch() {
    this.injectStyles(`
      .dark-mode-menu {
        display: flex;
        align-items: center;
      }
  
      .dark-mode-menu-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px;
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        transition: opacity 0.3s;
        font-family: inherit;
      }
  
      .dark-mode-menu-button:hover {
        opacity: 0.8;
      }
  
      .dark-mode-menu-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
      }
  
      .dark-mode-menu-label {
        font-size: 14px;
        font-weight: inherit;
        white-space: nowrap;
      }
    `);

    return `
      <div class="dark-mode-menu">
        <button class="dark-mode-menu-button" aria-label="${__('Toggle dark mode')}">
          <span class="dark-mode-menu-icon">
            ${this.darkMode ? this.icons.dark : this.icons.light}
          </span>
          <span class="dark-mode-menu-label">${__('Dark Mode')}</span>
        </button>
      </div>
    `;
  }

  render() {
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(themeColor);

    this.shadowRoot.innerHTML = `
      <style>
        :host {
          --theme-color: ${themeColor};
          --text-color: ${textColor};
        }
        ${Array.from(this.styles).join('\n')}
      </style>
      ${this.type === 'floating-button' ? this.renderFloatingButton() : this.renderMenuSwitch()}
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
