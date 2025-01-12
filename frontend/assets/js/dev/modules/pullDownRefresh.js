import { config } from '../main.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaPullDownRefresh extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();

    // Component state
    this.tracking = false;
    this.refreshing = false;
    this.startY = 0;
    this.currentY = 0;
    this.dragResistance = 0.4;
    this.threshold = 70;
  }

  connectedCallback() {
    this.render();
    this.setupEventListeners();
  }

  static show() {
    let pullDownRefresh = document.querySelector('pwa-pull-down-refresh');

    if (!pullDownRefresh) {
      pullDownRefresh = document.createElement('pwa-pull-down-refresh');
      document.body.insertAdjacentElement('afterbegin', pullDownRefresh);
    }

    return pullDownRefresh;
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  setupEventListeners() {
    document.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: false });
    document.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
    document.addEventListener('touchend', this.handleTouchEnd.bind(this));
  }

  handleTouchStart(e) {
    if (window.scrollY !== 0) return;

    // Check if the user is actually trying to scroll down
    const touchY = e.touches[0].pageY;

    // Store the touch start position for later comparison
    this._touchStartY = touchY;

    const refreshContainer = this.shadowRoot.querySelector('.pull-down-refresh');

    // Remove any ongoing transitions
    refreshContainer.style.transition = 'none';

    // Get the current height in case we're interrupting an animation
    const currentHeight = refreshContainer.offsetHeight;
    if (currentHeight > 0) {
      // If we're catching mid-animation, set the height explicitly
      refreshContainer.style.height = `${currentHeight}px`;
      // Recalculate the start position based on current height
      this.startY = touchY - currentHeight;
    } else {
      this.startY = touchY;
    }

    this.currentY = this.startY;
    this.tracking = true;
    refreshContainer.style.visibility = 'visible';

    // Force a reflow to ensure the transition removal takes effect
    refreshContainer.offsetHeight;
  }

  handleTouchMove(e) {
    if (!this.tracking) return;

    this.currentY = e.touches[0].pageY;
    const pullDistance = (this.currentY - this.startY) * this.dragResistance;

    if (pullDistance >= 0) {
      // Only prevent default if we're actually pulling down to refresh
      // This allows normal downward scrolling when not pulling to refresh
      const deltaY = this.currentY - this.startY;
      if (deltaY > 10) {
        // Small threshold to determine pull intention
        e.preventDefault();
      }

      const refreshContainer = this.shadowRoot.querySelector('.pull-down-refresh');
      const statusText = this.shadowRoot.querySelector('.pull-down-refresh_text');

      // Ensure no transition during drag
      refreshContainer.style.transition = 'none';
      refreshContainer.style.height = `${pullDistance}px`;

      if (pullDistance > this.threshold) {
        statusText.textContent = __('Release to refresh', config.jsVars.slug);
      } else {
        statusText.textContent = __('Pull down to refresh', config.jsVars.slug);
      }
    }
  }

  async handleTouchEnd() {
    if (!this.tracking) return;

    this.tracking = false;
    const pullDistance = (this.currentY - this.startY) * this.dragResistance;
    const refreshContainer = this.shadowRoot.querySelector('.pull-down-refresh');
    const statusText = this.shadowRoot.querySelector('.pull-down-refresh_text');
    const spinner = this.shadowRoot.querySelector('.pull-down-refresh_spinner');

    // Reset the transition for the release animation
    refreshContainer.style.transition = 'height 0.3s cubic-bezier(0.4, 0, 0.2, 1)';

    if (pullDistance > this.threshold) {
      this.refreshing = true;
      refreshContainer.style.height = '60px';
      statusText.textContent = __('Refreshing...', config.jsVars.slug);
      spinner.style.display = 'block';
      location.reload();
    } else {
      this.resetPosition();
    }
  }

  resetPosition() {
    const refreshContainer = this.shadowRoot.querySelector('.pull-down-refresh');
    refreshContainer.style.transition = 'height 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    refreshContainer.style.height = '0';

    refreshContainer.addEventListener(
      'transitionend',
      () => {
        refreshContainer.style.transition = '';
        refreshContainer.style.visibility = 'hidden';
        // Reset any ongoing state
        this.tracking = false;
        this.refreshing = false;
      },
      { once: true }
    );
  }

  render() {
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const textColor = getContrastTextColor(themeColor);

    this.injectStyles(`
      :host {
        display: block;
        width: 100%;
        overflow: hidden;
      }

      .pull-down-refresh {
        height: 0;
        visibility: hidden;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        background-color: ${themeColor};
        color: ${textColor};
        gap: 0.5rem;
        overflow: hidden;
        will-change: height;
      }

      .pull-down-refresh_content {
        padding: 1rem;
       display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        gap: 0.75rem;
        min-height: 60px;
      }

      .pull-down-refresh_spinner {
        display: none;
        width: 0.75rem;
        height: 0.75rem;
        border: 0.1875rem solid ${textColor};
        border-top-color: transparent;
        border-radius: 9999px;
        -webkit-animation: spin 1s linear infinite;
                animation: spin 1s linear infinite;
      }

      .pull-down-refresh_text {
        font-size: 0.875rem;
        line-height: 1.25rem;
      }

      @-webkit-keyframes spin {
        to {
          -webkit-transform: rotate(360deg);
                  transform: rotate(360deg);
        }
      }

      @keyframes spin {
        to {
          -webkit-transform: rotate(360deg);
                  transform: rotate(360deg);
        }
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="pull-down-refresh" role="alert">
        <div class="pull-down-refresh_content">
          <div class="pull-down-refresh_spinner" role="status" aria-label="loading"></div>
          <span class="pull-down-refresh_text">
            ${__('Pull down to refresh', config.jsVars.slug)}
          </span>
        </div>
      </div>
    `;
  }
}

export async function initPullDownRefresh() {
  document.body.style.overscrollBehaviorY = 'contain';

  if (!customElements.get('pwa-pull-down-refresh')) {
    customElements.define('pwa-pull-down-refresh', PwaPullDownRefresh);
  }

  PwaPullDownRefresh.show();
}
