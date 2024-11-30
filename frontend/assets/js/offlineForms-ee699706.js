import { config as n } from './frontend.js';
import { g as e } from './utils-ae07b67a.js';
const { __: t } = wp.i18n;
class o extends HTMLElement {
  constructor() {
    super(), this.attachShadow({ mode: 'open' }), (this.styles = new Set()), (this.formData = null);
  }
  connectedCallback() {
    this.render(), this.setupEventHandlers();
  }
  injectStyles(n) {
    this.styles.add(n);
  }
  static show(e) {
    let t = document.querySelector('pwa-offline-form-handler');
    return (
      t ||
        ((t = document.createElement('pwa-offline-form-handler')),
        (t.formData = e),
        n.daftplugFrontend.appendChild(t),
        requestAnimationFrame(() => {
          const n = t.shadowRoot.querySelector('.offline-form-handler');
          (document.documentElement.style.paddingRight = window.innerWidth - document.documentElement.offsetWidth + 'px'), (document.documentElement.style.overflow = 'hidden'), n.classList.add('visible');
        })),
      t
    );
  }
  setupEventHandlers() {
    var n = this;
    const e = this.shadowRoot.querySelector('.offline-form-handler-footer-button.-cancel'),
      t = this.shadowRoot.querySelector('.offline-form-handler-footer-button.-proceed'),
      o = this.shadowRoot.querySelector('.offline-form-handler-container'),
      r = this.shadowRoot.querySelector('.offline-form-handler'),
      i = () => {
        r.classList.remove('visible'),
          r.addEventListener(
            'transitionend',
            () => {
              document.documentElement.style.removeProperty('overflow'), (document.documentElement.style.paddingRight = ''), this.remove();
            },
            { once: !0 }
          );
      };
    e.addEventListener('click', i),
      t.addEventListener('click', async function () {
        o.classList.add('-proceeding'), await n.storeFormSubmission(n.formData), i();
      }),
      r.addEventListener('click', (n) => {
        n.target === r && i();
      });
  }
  async storeFormSubmission(n) {
    try {
      const e = JSON.parse(localStorage.getItem('pwaOfflineForms')) || {};
      return (e[n.submitId] = n), localStorage.setItem('pwaOfflineForms', JSON.stringify(e)), !0;
    } catch (n) {
      return console.error('Failed to store form data:', n), !1;
    }
  }
  static async submitStoredForms() {
    const n = 'pwaOfflineFormsProcessing',
      e = localStorage.getItem(n);
    if ((e && Date.now() - parseInt(e) > 6e4 && localStorage.removeItem(n), !localStorage.getItem(n)))
      try {
        localStorage.setItem(n, Date.now().toString());
        let e = JSON.parse(localStorage.getItem('pwaOfflineForms')) || {};
        for (const n in e) {
          const t = e[n];
          if (Date.now() - t.timestamp > 864e5) delete e[n];
          else {
            try {
              await this.submitForm(t), delete e[n];
            } catch (t) {
              console.error('Failed to submit stored form:', t), t.message.includes('Failed to fetch') || t.message.includes('NetworkError') || delete e[n];
            }
            localStorage.setItem('pwaOfflineForms', JSON.stringify(e));
          }
        }
      } catch (n) {
        console.error('Error processing offline forms:', n);
      } finally {
        localStorage.removeItem(n);
      }
  }
  static async submitForm(n) {
    const { url: e, method: t, data: o, contentType: r } = n,
      i = 'GET' === t.toUpperCase();
    let a,
      l = e;
    const s = new Headers({ 'X-Requested-With': 'XMLHttpRequest' });
    if (('undefined' != typeof wpApiSettings && wpApiSettings.nonce && s.append('X-WP-Nonce', wpApiSettings.nonce), i)) {
      const n = new URLSearchParams();
      Object.entries(o).forEach(([e, t]) => {
        Array.isArray(t) ? t.forEach((t) => n.append(`${e}[]`, t)) : n.append(e, t);
      }),
        (l = `${e}${e.includes('?') ? '&' : '?'}${n.toString()}`);
    } else if (r.includes('multipart/form-data'))
      (a = new FormData()),
        Object.entries(o).forEach(([n, e]) => {
          Array.isArray(e) ? e.forEach((e) => a.append(`${n}[]`, e)) : a.append(n, e);
        });
    else if ((s.append('Content-Type', r), r.includes('json'))) a = JSON.stringify(o);
    else {
      const n = new URLSearchParams();
      Object.entries(o).forEach(([e, t]) => {
        Array.isArray(t) ? t.forEach((t) => n.append(`${e}[]`, t)) : n.append(e, t);
      }),
        (a = n.toString());
    }
    const d = { method: t, headers: s, credentials: 'same-origin' };
    i || (d.body = a);
    const f = await fetch(l, d);
    if (!f.ok) throw new Error(`Server returned ${f.status}: ${f.statusText}`);
    return f;
  }
  render() {
    var o, r;
    const i = null != (o = null == (r = n.jsVars.settings.webAppManifest) || null == (r = r.appearance) ? void 0 : r.themeColor) ? o : '#000000',
      a = e(i),
      l = e(a);
    this.injectStyles(
      `\n      .offline-form-handler {\n        position: fixed;\n        top: 0;\n        left: 0;\n        right: 0;\n        bottom: 0;\n        z-index: 9999999;\n        background: rgba(0, 0, 0, 0);\n        -webkit-backdrop-filter: blur(0px);\n                backdrop-filter: blur(0px);\n        -webkit-transition: all 0.2s ease-out;\n        -o-transition: all 0.2s ease-out;\n        transition: all 0.2s ease-out;\n        opacity: 0;\n        visibility: hidden;\n      }\n\n      .offline-form-handler.visible {      \n        background: rgba(0, 0, 0, 0.7);\n        -webkit-backdrop-filter: blur(5px);\n                backdrop-filter: blur(5px);\n        opacity: 1;\n        visibility: visible;\n      }\n\n      .offline-form-handler-container {\n        position: fixed;\n        top: 50%;\n        left: 50%;\n        -webkit-transform: translate(-50%, calc(-50% + 20px));\n            -ms-transform: translate(-50%, calc(-50% + 20px));\n                transform: translate(-50%, calc(-50% + 20px));\n        background: ${a};\n        border-radius: 10px;\n        -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);\n                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);\n        max-width: 29rem;\n        width: 95%;\n        padding: 0.75rem 1rem;\n        overflow: hidden;\n        opacity: 0;\n        -webkit-transition: all 0.15s ease-out;\n        -o-transition: all 0.15s ease-out;\n        transition: all 0.15s ease-out;\n        z-index: 999999999999999999999;\n      }\n\n      .offline-form-handler.visible .offline-form-handler-container {\n        -webkit-transform: translate(-50%, -50%);\n            -ms-transform: translate(-50%, -50%);\n                transform: translate(-50%, -50%);\n        opacity: 1;\n      }\n\n      .offline-form-handler.visible:has(.offline-form-handler-container.-proceeding) {\n        pointer-events: none;\n      }\n\n      .offline-form-handler.visible .offline-form-handler-container.-proceeding {\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-orient: vertical;\n        -webkit-box-direction: normal;\n            -ms-flex-direction: column;\n                flex-direction: column;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n      }\n\n      .offline-form-handler.visible .offline-form-handler-container.-proceeding::before {\n        content: '';\n        position: absolute;\n        background: rgb(255 255 255 / 0.5);\n        z-index: 2;\n        width: 100%;\n        height: 100%;\n        top: 0;\n        left: 0;\n      }\n\n      .offline-form-handler.visible .offline-form-handler-container.-proceeding::after {\n        content: '';\n        position: absolute;\n        display: inline-block;\n        border: 3px solid ${i};\n        border-top-color: transparent;\n        border-radius: 9999px;\n        width: 1.5rem;\n        height: 1.5rem;\n        z-index: 5;\n        -webkit-animation: spin 1s linear infinite;\n                animation: spin 1s linear infinite;\n      }\n\n      .offline-form-handler-header {\n        width: 100%;\n      }\n\n      .offline-form-handler-header-texts {\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        gap: 0.5rem;\n      }\n\n      .offline-form-handler-header-texts_icon {\n        width: 1.5rem;\n        height: 1.5rem;\n        color: ${l}b3;\n      }\n\n      .offline-form-handler-header-texts_title {\n        font-size: 1.125rem;\n        line-height: 1.75rem;\n        font-weight: 500;\n        color: ${l};\n        display: -webkit-box;\n        overflow: hidden;\n        -webkit-box-orient: vertical;\n        -webkit-line-clamp: 1;\n      }\n\n      .offline-form-handler-body {\n        margin-top: 0.75rem;\n        overflow-y: auto;\n        max-height: 34rem;\n      }\n\n      .offline-form-handler-body_message {\n        font-size: 0.875rem;\n        line-height: 1.25rem;\n        color: ${l}b3;\n      }\n\n      .offline-form-handler-footer {\n        margin-top: 0.75rem;\n        width: 100%;\n      }\n\n      .offline-form-handler-footer-buttons {\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-pack: end;\n            -ms-flex-pack: end;\n                justify-content: flex-end;\n        gap: 0.5rem;\n        margin-top: 1rem;\n      }\n\n      .offline-form-handler-footer-button {\n        display: -webkit-inline-box;\n        display: -ms-inline-flexbox;\n        display: inline-flex;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        padding: 0.5rem 0.75rem;\n        font-weight: 500;\n        font-size: 0.75rem;\n        line-height: 1rem;\n        border-radius: 0.5rem;\n        -webkit-transition: all 0.1s ease;\n        -o-transition: all 0.1s ease;\n        transition: all 0.1s ease;\n        cursor: pointer;\n        outline: none;\n        border: none;\n      }\n\n      .offline-form-handler-footer-button:hover {\n        opacity: 0.8;\n      }\n\n      .offline-form-handler-footer-button:focus {\n        outline: none;\n        border: none;\n      }\n\n      .offline-form-handler-footer-button.-cancel {\n        -webkit-box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n        color: ${l};\n        background: ${a};\n        border: 1px solid ${l}1a;\n      }\n\n      .offline-form-handler-footer-button.-proceed {\n        color: ${a};\n        background: ${i};\n      }\n\n      @media (max-width: 700px) {\n        .offline-form-handler-container {\n          max-width: 100%;\n          top: unset;\n          bottom: 0;\n          left: 0;\n          border-top-left-radius: 1rem;\n          border-top-right-radius: 1rem;\n          border-bottom-left-radius: 0;\n          border-bottom-right-radius: 0;\n          -webkit-box-shadow: none;\n                  box-shadow: none;\n          opacity: 1;\n          -webkit-transform: translateY(100%);\n              -ms-transform: translateY(100%);\n                  transform: translateY(100%);\n        } \n\n        .offline-form-handler.visible .offline-form-handler-container {\n          -webkit-transform: translateY(0);\n              -ms-transform: translateY(0);\n                  transform: translateY(0);\n        }\n\n        .offline-form-handler-footer-buttons {\n          -webkit-box-orient: vertical;\n          -webkit-box-direction: reverse;\n              -ms-flex-direction: column-reverse;\n                  flex-direction: column-reverse;\n        }\n\n        .offline-form-handler-footer-button {\n          padding: 0.75rem;\n        }\n      }\n\n      @-webkit-keyframes spin {\n        to {\n          -webkit-transform: rotate(360deg);\n                  transform: rotate(360deg);\n        }\n      }\n\n      @keyframes spin {\n        to {\n          -webkit-transform: rotate(360deg);\n                  transform: rotate(360deg);\n        }\n      }\n    `
    );
    const s = Array.from(this.styles).join('\n');
    this.shadowRoot.innerHTML = `\n      <style>${s}</style>\n      <div class="offline-form-handler">\n        <div class="offline-form-handler-container">\n          <div class="offline-form-handler-header">\n            <div class="offline-form-handler-header-texts">\n              <svg class="offline-form-handler-header-texts_icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi-off"><path d="M12 20h.01"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/><path d="M5 12.859a10 10 0 0 1 5.17-2.69"/><path d="M19 12.859a10 10 0 0 0-2.007-1.523"/><path d="M2 8.82a15 15 0 0 1 4.177-2.643"/><path d="M22 8.82a15 15 0 0 0-11.288-3.764"/><path d="m2 2 20 20"/></svg>\n              <div class="offline-form-handler-header-texts_title">${t('No Internet Connection', n.slug)}</div>\n            </div>\n          </div>\n          <div class="offline-form-handler-body">\n            <div class="offline-form-handler-body_message">${t('You’re currently offline. Your form submission data will be saved and be automatically processed in the background when you’re back online within 24 hours. Would you like to proceed?', n.slug)}</div>\n          </div>\n          <div class="offline-form-handler-footer">\n            <div class="offline-form-handler-footer-buttons">\n              <button type="button" class="offline-form-handler-footer-button -cancel">\n                Cancel\n              </button>\n              <button type="button" class="offline-form-handler-footer-button -proceed">\n                Yes, Please\n              </button>\n            </div>\n          </div>\n        </div>\n      </div>\n    `;
  }
}
function r(n) {
  if (!navigator.onLine) {
    n.preventDefault(), n.stopPropagation();
    const e = n.target,
      t = new FormData(e),
      r = { formId: e.id || `pwa-form-${Math.random().toString(36).slice(2, 9)}`, submitId: `${e.id}-${Date.now()}`, url: e.action || window.location.href, method: (e.method || 'POST').toUpperCase(), timestamp: Date.now(), data: Object.fromEntries(t), contentType: e.enctype || 'application/x-www-form-urlencoded' };
    o.show(r);
  }
}
async function i() {
  customElements.get('pwa-offline-form-handler') || customElements.define('pwa-offline-form-handler', o),
    document.querySelectorAll('form:not([data-no-offline])').forEach((n) => {
      n.addEventListener('submit', r, !0);
    }),
    navigator.onLine && o.submitStoredForms(),
    window.addEventListener('online', () => {
      o.submitStoredForms();
    });
}
export { i as initOfflineForms };
