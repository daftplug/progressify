import { config } from '../frontend.js';
import PushNotificationsSubscription from '../components/pushNotificationsSubscription.js';
import { getContrastTextColor } from '../components/utils.js';
import { __ } from '../components/i18n.js';

class PwaPushNotificationsPrompt extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
  }

  async connectedCallback() {
    this.render();
    this.unsubscribe = PushNotificationsSubscription.subscribe(this.handleStateChange.bind(this));
    this.handleSubscription();
    this.handleDismiss();
  }

  handleStateChange(state) {
    if (['subscribed', 'blocked', 'loading'].includes(state)) {
      this.hide();
    } else if (state === 'unsubscribed') {
      PwaPushNotificationsPrompt.show();
    }
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  static show() {
    let pushNotificationsPrompt = document.querySelector('pwa-push-notifications-prompt');

    if (!pushNotificationsPrompt) {
      pushNotificationsPrompt = document.createElement('pwa-push-notifications-prompt');
      document.body.appendChild(pushNotificationsPrompt);
    }

    requestAnimationFrame(() => {
      const prompt = pushNotificationsPrompt.shadowRoot.querySelector('.push-notifications-prompt');
      setTimeout(() => {
        prompt.classList.add('visible');
      }, 300);
    });

    return pushNotificationsPrompt;
  }

  hide() {
    const prompt = this.shadowRoot.querySelector('.push-notifications-prompt');
    prompt.classList.remove('visible');
    prompt.addEventListener(
      'transitionend',
      () => {
        this.remove();
      },
      { once: true }
    );
  }

  handleSubscription() {
    const allowButton = this.shadowRoot.querySelector('.push-notifications-prompt-button_allow');
    allowButton.addEventListener('click', async () => {
      try {
        await PushNotificationsSubscription.addSubscription();
      } catch (error) {
        console.error(error);
      }
    });
  }

  handleDismiss() {
    const dismissButton = this.shadowRoot.querySelector('.push-notifications-prompt-button_dismiss');
    dismissButton.addEventListener('click', async () => {
      this.hide();
    });
  }

  render() {
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const backgroundColor = getContrastTextColor(themeColor);
    const textColor = getContrastTextColor(backgroundColor);
    const promptMessage = config.jsVars.settings.pushNotifications?.prompt?.message ?? __('We would like to show you notifications for the latest news and updates.', config.jsVars.slug);
    const appName = config.jsVars.settings.webAppManifest.appIdentity.appName ?? '';
    const appIconHtml = config.jsVars.iconUrl ? `<img class="push-notifications-prompt-media_icon" src="${config.jsVars.iconUrl}" alt="${appName}" onerror="this.style.display='none'"/>` : '';

    this.injectStyles(`
      .push-notifications-prompt {
        position: fixed;
        top: 0;
        left: 50%;
        -webkit-transform: translateX(-50%) translateY(-100%);
            -ms-transform: translateX(-50%) translateY(-100%);
                transform: translateX(-50%) translateY(-100%);
        padding: 1rem;
        width: 25rem;
        max-width: 85%;
        background-color: ${backgroundColor};
        color: ${textColor};
        border: 1px solid ${textColor}15;
        border-radius: 0.75rem;
        -webkit-box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        z-index: 9999999999999999;
        -webkit-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        -o-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        visibility: hidden;
      }

      .push-notifications-prompt.visible {
        opacity: 1;
        visibility: visible;
        -webkit-transform: translateX(-50%) translateY(1rem);
            -ms-transform: translateX(-50%) translateY(1rem);
                transform: translateX(-50%) translateY(1rem);
      }

      .push-notifications-prompt-media {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
      }

      .push-notifications-prompt-media_icon {
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        flex-shrink: 0;
        height: 50px;
        width: 50px;
        display: inline-block;
      }

      .push-notifications-prompt-media_texts {
        flex: 1;
        min-width: 0;
      }

      .push-notifications-prompt-media_title {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .push-notifications-prompt-media_message {
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

      .push-notifications-prompt-buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1.25rem;
      }

      .push-notifications-prompt-button_dismiss {
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: ${textColor}59;
        background: none;
        font-weight: 600;
        border: none;
        outline: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
      }

      .push-notifications-prompt-button_allow {
        display: block;
        background-color: ${themeColor};
        color: ${backgroundColor};
        vertical-align: middle;
        text-decoration: none;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 600;
        padding: 0.375rem 0.875rem;
        border: none;
        outline: none;
        border-radius: 9999px;
        cursor: pointer;
      }

      .push-notifications-prompt-button_allow:hover {
        opacity: 0.8;
      }
    `);

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>${combinedStyles}</style>
      <div class="push-notifications-prompt">
        <div class="push-notifications-prompt-media">
          ${appIconHtml}
          <div class="push-notifications-prompt-media_texts">
            <div class="push-notifications-prompt-media_title">${__('Push Notifications', config.jsVars.slug)}</div>
            <div class="push-notifications-prompt-media_message">${promptMessage}</div>
          </div>
        </div>
        <div class="push-notifications-prompt-buttons">
          <button type="button" class="push-notifications-prompt-button_dismiss">
            ${__('Dismiss', config.jsVars.slug)}
          </button>
          <button type="button" class="push-notifications-prompt-button_allow">
            ${__('Allow Notifications', config.jsVars.slug)}
          </button>
        </div>
      </div>
    `;
  }
}

export async function initPushNotificationsPrompt() {
  if (!customElements.get('pwa-push-notifications-prompt')) {
    customElements.define('pwa-push-notifications-prompt', PwaPushNotificationsPrompt);
  }

  PwaPushNotificationsPrompt.show();
}
