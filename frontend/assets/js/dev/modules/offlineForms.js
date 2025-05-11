import { config } from '../frontend.js';
import { getContrastTextColor } from '../components/utils.js';

const { __ } = wp.i18n;

class PwaOfflineFormHandler extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();
    this.formData = null;
  }

  connectedCallback() {
    this.render();
    this.setupEventHandlers();
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  static show(formData) {
    let handler = document.querySelector('pwa-offline-form-handler');
    if (!handler) {
      handler = document.createElement('pwa-offline-form-handler');
      handler.formData = formData;
      document.body.appendChild(handler);

      requestAnimationFrame(() => {
        const backdrop = handler.shadowRoot.querySelector('.offline-form-handler');
        document.documentElement.style.paddingRight = `${window.innerWidth - document.documentElement.offsetWidth}px`;
        document.documentElement.style.overflow = 'hidden';
        backdrop.classList.add('visible');
      });
    }
    return handler;
  }

  setupEventHandlers() {
    const cancelButton = this.shadowRoot.querySelector('.offline-form-handler-footer-button.-cancel');
    const proceedButton = this.shadowRoot.querySelector('.offline-form-handler-footer-button.-proceed');
    const container = this.shadowRoot.querySelector('.offline-form-handler-container');
    const backdrop = this.shadowRoot.querySelector('.offline-form-handler');

    const handleClose = () => {
      backdrop.classList.remove('visible');
      backdrop.addEventListener(
        'transitionend',
        () => {
          document.documentElement.style.removeProperty('overflow');
          document.documentElement.style.paddingRight = '';
          this.remove();
        },
        { once: true }
      );
    };

    const handleProceed = async () => {
      container.classList.add('-proceeding');
      await this.storeFormSubmission(this.formData);
      handleClose();
    };

    cancelButton.addEventListener('click', handleClose);
    proceedButton.addEventListener('click', handleProceed);
    backdrop.addEventListener('click', (e) => {
      if (e.target === backdrop) handleClose();
    });
  }

  async storeFormSubmission(data) {
    try {
      const storedForms = JSON.parse(localStorage.getItem('pwaOfflineForms')) || {};
      storedForms[data.submitId] = data;
      localStorage.setItem('pwaOfflineForms', JSON.stringify(storedForms));
      return true;
    } catch (error) {
      console.error('Failed to store form data:', error);
      return false;
    }
  }

  static async submitStoredForms() {
    const processingKey = 'pwaOfflineFormsProcessing';

    const processingStart = localStorage.getItem(processingKey);
    if (processingStart && Date.now() - parseInt(processingStart) > 60 * 1000) {
      localStorage.removeItem(processingKey);
    }

    if (localStorage.getItem(processingKey)) return;

    try {
      localStorage.setItem(processingKey, Date.now().toString());
      let storedForms = JSON.parse(localStorage.getItem('pwaOfflineForms')) || {};

      for (const submitId in storedForms) {
        const storedForm = storedForms[submitId];

        if (Date.now() - storedForm.timestamp > 24 * 60 * 60 * 1000) {
          delete storedForms[submitId];
          continue;
        }

        try {
          await this.submitForm(storedForm);
          delete storedForms[submitId];
        } catch (error) {
          console.error('Failed to submit stored form:', error);
          if (!error.message.includes('Failed to fetch') && !error.message.includes('NetworkError')) {
            delete storedForms[submitId];
          }
        }

        localStorage.setItem('pwaOfflineForms', JSON.stringify(storedForms));
      }
    } catch (error) {
      console.error('Error processing offline forms:', error);
    } finally {
      localStorage.removeItem(processingKey);
    }
  }

  static async submitForm(storedForm) {
    const { url, method, data, contentType } = storedForm;
    const isGet = method.toUpperCase() === 'GET';

    let finalUrl = url;
    let body;
    const headers = new Headers({
      'X-Requested-With': 'XMLHttpRequest',
    });

    if (typeof wpApiSettings !== 'undefined' && wpApiSettings.nonce) {
      headers.append('X-WP-Nonce', wpApiSettings.nonce);
    }

    // Handle GET requests by appending data to URL
    if (isGet) {
      const params = new URLSearchParams();
      Object.entries(data).forEach(([key, value]) => {
        if (Array.isArray(value)) {
          value.forEach((item) => params.append(`${key}[]`, item));
        } else {
          params.append(key, value);
        }
      });
      finalUrl = `${url}${url.includes('?') ? '&' : '?'}${params.toString()}`;
    } else {
      // Handle POST requests with body
      if (contentType.includes('multipart/form-data')) {
        body = new FormData();
        Object.entries(data).forEach(([key, value]) => {
          if (Array.isArray(value)) {
            value.forEach((item) => body.append(`${key}[]`, item));
          } else {
            body.append(key, value);
          }
        });
      } else {
        headers.append('Content-Type', contentType);
        if (contentType.includes('json')) {
          body = JSON.stringify(data);
        } else {
          const params = new URLSearchParams();
          Object.entries(data).forEach(([key, value]) => {
            if (Array.isArray(value)) {
              value.forEach((item) => params.append(`${key}[]`, item));
            } else {
              params.append(key, value);
            }
          });
          body = params.toString();
        }
      }
    }

    const fetchOptions = {
      method,
      headers,
      credentials: 'same-origin',
    };

    if (!isGet) {
      fetchOptions.body = body;
    }

    const response = await fetch(finalUrl, fetchOptions);

    if (!response.ok) {
      throw new Error(`Server returned ${response.status}: ${response.statusText}`);
    }

    return response;
  }

  render() {
    const themeColor = config.jsVars.settings.webAppManifest?.appearance?.themeColor ?? '#000000';
    const backgroundColor = getContrastTextColor(themeColor);
    const textColor = getContrastTextColor(backgroundColor);

    this.injectStyles(`
      .offline-form-handler {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999999;
        background: rgba(0, 0, 0, 0);
        -webkit-backdrop-filter: blur(0px);
                backdrop-filter: blur(0px);
        -webkit-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
        opacity: 0;
        visibility: hidden;
      }

      .offline-form-handler.visible {      
        background: rgba(0, 0, 0, 0.7);
        -webkit-backdrop-filter: blur(5px);
                backdrop-filter: blur(5px);
        opacity: 1;
        visibility: visible;
      }

      .offline-form-handler-container {
        position: fixed;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, calc(-50% + 20px));
            -ms-transform: translate(-50%, calc(-50% + 20px));
                transform: translate(-50%, calc(-50% + 20px));
        background: ${backgroundColor};
        border-radius: 10px;
        -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 29rem;
        width: 95%;
        padding: 0.75rem 1rem;
        overflow: hidden;
        opacity: 0;
        -webkit-transition: all 0.15s ease-out;
        -o-transition: all 0.15s ease-out;
        transition: all 0.15s ease-out;
        z-index: 999999999999999999999;
      }

      .offline-form-handler.visible .offline-form-handler-container {
        -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
        opacity: 1;
      }

      .offline-form-handler.visible:has(.offline-form-handler-container.-proceeding) {
        pointer-events: none;
      }

      .offline-form-handler.visible .offline-form-handler-container.-proceeding {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
      }

      .offline-form-handler.visible .offline-form-handler-container.-proceeding::before {
        content: '';
        position: absolute;
        background: rgb(255 255 255 / 0.5);
        z-index: 2;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
      }

      .offline-form-handler.visible .offline-form-handler-container.-proceeding::after {
        content: '';
        position: absolute;
        display: inline-block;
        border: 3px solid ${themeColor};
        border-top-color: transparent;
        border-radius: 9999px;
        width: 1.5rem;
        height: 1.5rem;
        z-index: 5;
        -webkit-animation: spin 1s linear infinite;
                animation: spin 1s linear infinite;
      }

      .offline-form-handler-header {
        width: 100%;
      }

      .offline-form-handler-header-texts {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        gap: 0.5rem;
      }

      .offline-form-handler-header-texts_icon {
        width: 1.5rem;
        height: 1.5rem;
        color: ${textColor}b3;
      }

      .offline-form-handler-header-texts_title {
        font-size: 1.125rem;
        line-height: 1.75rem;
        font-weight: 500;
        color: ${textColor};
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
      }

      .offline-form-handler-body {
        margin-top: 0.75rem;
        overflow-y: auto;
        max-height: 34rem;
      }

      .offline-form-handler-body_message {
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: ${textColor}b3;
      }

      .offline-form-handler-footer {
        margin-top: 0.75rem;
        width: 100%;
      }

      .offline-form-handler-footer-buttons {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: end;
            -ms-flex-pack: end;
                justify-content: flex-end;
        gap: 0.5rem;
        margin-top: 1rem;
      }

      .offline-form-handler-footer-button {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        padding: 0.5rem 0.75rem;
        font-weight: 500;
        font-size: 0.75rem;
        line-height: 1rem;
        border-radius: 0.5rem;
        -webkit-transition: all 0.1s ease;
        -o-transition: all 0.1s ease;
        transition: all 0.1s ease;
        cursor: pointer;
        outline: none;
        border: none;
      }

      .offline-form-handler-footer-button:hover {
        opacity: 0.8;
      }

      .offline-form-handler-footer-button:focus {
        outline: none;
        border: none;
      }

      .offline-form-handler-footer-button.-cancel {
        -webkit-box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        color: ${textColor};
        background: ${backgroundColor};
        border: 1px solid ${textColor}1a;
      }

      .offline-form-handler-footer-button.-proceed {
        color: ${backgroundColor};
        background: ${themeColor};
      }

      @media (max-width: 700px) {
        .offline-form-handler-container {
          max-width: 100%;
          top: unset;
          bottom: 0;
          left: 0;
          border-top-left-radius: 1rem;
          border-top-right-radius: 1rem;
          border-bottom-left-radius: 0;
          border-bottom-right-radius: 0;
          -webkit-box-shadow: none;
                  box-shadow: none;
          opacity: 1;
          -webkit-transform: translateY(100%);
              -ms-transform: translateY(100%);
                  transform: translateY(100%);
        } 

        .offline-form-handler.visible .offline-form-handler-container {
          -webkit-transform: translateY(0);
              -ms-transform: translateY(0);
                  transform: translateY(0);
        }

        .offline-form-handler-footer-buttons {
          -webkit-box-orient: vertical;
          -webkit-box-direction: reverse;
              -ms-flex-direction: column-reverse;
                  flex-direction: column-reverse;
        }

        .offline-form-handler-footer-button {
          padding: 0.75rem;
        }
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
      <div class="offline-form-handler">
        <div class="offline-form-handler-container">
          <div class="offline-form-handler-header">
            <div class="offline-form-handler-header-texts">
              <svg class="offline-form-handler-header-texts_icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi-off"><path d="M12 20h.01"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/><path d="M5 12.859a10 10 0 0 1 5.17-2.69"/><path d="M19 12.859a10 10 0 0 0-2.007-1.523"/><path d="M2 8.82a15 15 0 0 1 4.177-2.643"/><path d="M22 8.82a15 15 0 0 0-11.288-3.764"/><path d="m2 2 20 20"/></svg>
              <div class="offline-form-handler-header-texts_title">${__('No Internet Connection', config.jsVars.slug)}</div>
            </div>
          </div>
          <div class="offline-form-handler-body">
            <div class="offline-form-handler-body_message">${__('You’re currently offline. Your form submission data will be saved and be automatically processed in the background when you’re back online within 24 hours. Would you like to proceed?', config.jsVars.slug)}</div>
          </div>
          <div class="offline-form-handler-footer">
            <div class="offline-form-handler-footer-buttons">
              <button type="button" class="offline-form-handler-footer-button -cancel">
                Cancel
              </button>
              <button type="button" class="offline-form-handler-footer-button -proceed">
                Yes, Please
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
  }
}

function handleFormSubmit(e) {
  if (!navigator.onLine) {
    e.preventDefault();
    e.stopPropagation();

    const form = e.target;
    const formData = new FormData(form);
    const submitData = {
      formId: form.id || `pwa-form-${Math.random().toString(36).slice(2, 9)}`,
      submitId: `${form.id}-${Date.now()}`,
      url: form.action || window.location.href,
      method: (form.method || 'POST').toUpperCase(),
      timestamp: Date.now(),
      data: Object.fromEntries(formData),
      contentType: form.enctype || 'application/x-www-form-urlencoded',
    };

    PwaOfflineFormHandler.show(submitData);
  }
}

export async function initOfflineForms() {
  if (!customElements.get('pwa-offline-form-handler')) {
    customElements.define('pwa-offline-form-handler', PwaOfflineFormHandler);
  }

  // Monitor forms
  const forms = document.querySelectorAll('form:not([data-no-offline])');
  forms.forEach((form) => {
    form.addEventListener('submit', handleFormSubmit, true);
  });

  // Check for stored forms on page load and when coming online
  if (navigator.onLine) {
    PwaOfflineFormHandler.submitStoredForms();
  }

  window.addEventListener('online', () => {
    PwaOfflineFormHandler.submitStoredForms();
  });
}
