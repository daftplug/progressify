import { config as n } from './frontend.js';
import { g as t } from './utils-ae07b67a.js';
const { __: e } = wp.i18n;
let o = null;
window.addEventListener('beforeinstallprompt', (n) => {
  n.preventDefault(), (o = n);
}),
  window.addEventListener('appinstalled', () => {
    o = null;
  });
const s = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>',
  i = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-40q-33 0-56.5-23.5T160-120v-440q0-33 23.5-56.5T240-640h80q17 0 28.5 11.5T360-600q0 17-11.5 28.5T320-560h-80v440h480v-440h-80q-17 0-28.5-11.5T600-600q0-17 11.5-28.5T640-640h80q33 0 56.5 23.5T800-560v440q0 33-23.5 56.5T720-40H240Zm200-727-36 36q-12 12-28 11.5T348-732q-11-12-11.5-28t11.5-28l104-104q12-12 28-12t28 12l104 104q11 11 11 27.5T612-732q-12 12-28.5 12T555-732l-35-35v407q0 17-11.5 28.5T480-320q-17 0-28.5-11.5T440-360v-407Z"/></svg>',
  l = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440v120q0 17 11.5 28.5T480-280q17 0 28.5-11.5T520-320v-120h120q17 0 28.5-11.5T680-480q0-17-11.5-28.5T640-520H520v-120q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640v120H320q-17 0-28.5 11.5T280-480q0 17 11.5 28.5T320-440h120ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/></svg>',
  r = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M419-80q-28 0-52.5-12T325-126L124-381q-8-9-7-21.5t9-20.5q20-21 48-25t52 11l74 45v-328q0-17 11.5-28.5T340-760q17 0 29 11.5t12 28.5v400q0 23-20.5 34.5T320-286l-36-22 104 133q6 7 14 11t17 4h221q33 0 56.5-23.5T720-240v-160q0-17-11.5-28.5T680-440H501q-17 0-28.5-11.5T461-480q0-17 11.5-28.5T501-520h179q50 0 85 35t35 85v160q0 66-47 113T640-80H419Zm83-260Zm-23-260q-17 0-28.5-11.5T439-640q0-2 5-20 8-14 12-28.5t4-31.5q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 17 4 31.5t12 28.5q3 5 4 10t1 10q0 17-11 28.5T202-600q-11 0-20.5-6T167-621q-13-22-20-47t-7-52q0-83 58.5-141.5T340-920q83 0 141.5 58.5T540-720q0 27-7 52t-20 47q-5 9-14 15t-20 6Z"/></svg>',
  a = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-240q-17 0-28.5-11.5T120-280q0-17 11.5-28.5T160-320h640q17 0 28.5 11.5T840-280q0 17-11.5 28.5T800-240H160Zm0-200q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h640q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H160Zm0-200q-17 0-28.5-11.5T120-680q0-17 11.5-28.5T160-720h640q17 0 28.5 11.5T840-680q0 17-11.5 28.5T800-640H160Z"/></svg>',
  p = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-160q-33 0-56.5-23.5T160-240v-80q0-17 11.5-28.5T200-360q17 0 28.5 11.5T240-320v80h480v-80q0-17 11.5-28.5T760-360q17 0 28.5 11.5T800-320v80q0 33-23.5 56.5T720-160H240Zm200-486-75 75q-12 12-28.5 11.5T308-572q-11-12-11.5-28t11.5-28l144-144q6-6 13-8.5t15-2.5q8 0 15 2.5t13 8.5l144 144q12 12 11.5 28T652-572q-12 12-28.5 12.5T595-571l-75-75v286q0 17-11.5 28.5T480-320q-17 0-28.5-11.5T440-360v-286Z"/></svg>',
  d =
    '<svg style="width:1.5rem;height:1.5rem;" xmlns="http://www.w3.org/2000/svg" viewBox="-10 -10 276 276"><linearGradient id="a" x1="145" x2="34" y1="253" y2="61" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1e8e3e"/><stop offset="1" stop-color="#34a853"/></linearGradient><linearGradient id="b" x1="111" x2="222" y1="254" y2="62" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fcc934"/><stop offset="1" stop-color="#fbbc04"/></linearGradient><linearGradient id="c" x1="17" x2="239" y1="80" y2="80" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#d93025"/><stop offset="1" stop-color="#ea4335"/></linearGradient><circle cx="128" cy="128" r="64" fill="#fff"/><path fill="url(#a)" d="M96 183.4A63.7 63.7 0 0 1 72.6 160L17.2 64A128 128 0 0 0 128 256l55.4-96A64 64 0 0 1 96 183.4Z"/><path fill="url(#b)" d="M192 128a63.7 63.7 0 0 1-8.6 32L128 256A128 128 0 0 0 238.9 64h-111a64 64 0 0 1 64 64Z"/><circle cx="128" cy="128" r="52" fill="#1a73e8"/><path fill="url(#c)" d="M96 72.6a63.7 63.7 0 0 1 32-8.6h110.8a128 128 0 0 0-221.7 0l55.5 96A64 64 0 0 1 96 72.6Z"/></svg>',
  c = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-240q-33 0-56.5-23.5T280-320v-480q0-33 23.5-56.5T360-880h360q33 0 56.5 23.5T800-800v480q0 33-23.5 56.5T720-240H360Zm0-80h360v-480H360v480ZM200-80q-33 0-56.5-23.5T120-160v-520q0-17 11.5-28.5T160-720q17 0 28.5 11.5T200-680v520h400q17 0 28.5 11.5T640-120q0 17-11.5 28.5T600-80H200Zm160-240v-480 480Z"/></svg>',
  m = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M727-240H520q-17 0-28.5-11.5T480-280q0-17 11.5-28.5T520-320h207l-36-36q-11-11-11-27.5t12-28.5q11-11 28-11t28 11l104 104q12 12 12 28t-12 28L748-148q-12 12-28 11.5T692-149q-11-12-11.5-28t11.5-28l35-35ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v200q0 17-11.5 28.5T800-520q-17 0-28.5-11.5T760-560v-200h-80v80q0 17-11.5 28.5T640-640H320q-17 0-28.5-11.5T280-680v-80h-80v560h160q17 0 28.5 11.5T400-160q0 17-11.5 28.5T360-120H200Zm280-640q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/></svg>',
  h = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-160v-40H160q-33 0-56.5-23.5T80-280v-480q0-33 23.5-56.5T160-840h280q17 0 28.5 11.5T480-800q0 17-11.5 28.5T440-760H160v480h640v-80q0-17 11.5-28.5T840-400q17 0 28.5 11.5T880-360v80q0 33-23.5 56.5T800-200H640v40q0 17-11.5 28.5T600-120H360q-17 0-28.5-11.5T320-160Zm320-393v-247q0-17 11.5-28.5T680-840q17 0 28.5 11.5T720-800v247l76-75q11-11 27.5-11.5T852-628q11 11 11 28t-11 28L708-428q-12 12-28 12t-28-12L508-572q-11-11-11.5-27.5T508-628q11-11 28-11t28 11l76 75Z"/></svg>',
  u = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M280-40q-33 0-56.5-23.5T200-120v-720q0-33 23.5-56.5T280-920h240q17 0 28.5 11.5T560-880q0 17-11.5 28.5T520-840H280v40h240q17 0 28.5 11.5T560-760q0 17-11.5 28.5T520-720H280v480h400v-40q0-17 11.5-28.5T720-320q17 0 28.5 11.5T760-280v160q0 33-23.5 56.5T680-40H280Zm0-120v40h400v-40H280Zm400-392v-248q0-17 11.5-28.5T720-840q17 0 28.5 11.5T760-800v248l76-76q11-11 28-11t28 11q11 11 11 28t-11 28L748-428q-12 12-28 12t-28-12L548-572q-11-11-11-28t11-28q11-11 28-11t28 11l76 76ZM280-800v-40 40Zm0 640v40-40Z"/></svg>',
  g = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M120-560h40q17 0 28.5 11.5T200-520q0 17-11.5 28.5T160-480h-40q-17 0-28.5-11.5T80-520q0-17 11.5-28.5T120-560Zm68 216 28-28q12-12 28-11.5t28 11.5q12 12 12.5 28.5T273-315l-28 28q-12 12-28.5 11.5T188-288q-11-12-11.5-28t11.5-28Zm28-324-28-28q-12-12-11.5-28t11.5-28q12-12 28.5-12.5T245-753l28 28q12 12 11.5 28.5T272-668q-12 11-28 11.5T216-668Zm476 480L530-350l-30 90q-2 7-7.5 10.5T481-246q-6 0-11.5-4t-7.5-11l-86-286q-2-8 .5-16t7.5-13q5-5 13-7.5t16-.5l288 86q7 2 10.5 7.5T715-479q0 6-3 11.5t-10 7.5l-90 32 160 160q12 12 12 28t-12 28l-24 24q-12 12-28 12t-28-12ZM400-760v-40q0-17 11.5-28.5T440-840q17 0 28.5 11.5T480-800v40q0 17-11.5 28.5T440-720q-17 0-28.5-11.5T400-760Zm207 35 29-29q11-11 27.5-11.5T692-754q11 11 11.5 27.5T693-698l-29 30q-11 12-27.5 11.5T608-668q-12-12-12.5-28.5T607-725Z"/></svg>',
  b = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-40q-33 0-56.5-23.5T240-120v-120q0-17 11.5-28.5T280-280q17 0 28.5 11.5T320-240h400v-480H320q0 17-11.5 28.5T280-680q-17 0-28.5-11.5T240-720v-120q0-33 23.5-56.5T320-920h400q33 0 56.5 23.5T800-840v720q0 33-23.5 56.5T720-40H320Zm0-120v40h400v-40H320Zm80-344L204-308q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196H240q-17 0-28.5-11.5T200-600q0-17 11.5-28.5T240-640h200q17 0 28.5 11.5T480-600v200q0 17-11.5 28.5T440-360q-17 0-28.5-11.5T400-400v-104Zm-80-296h400v-40H320v40Zm0 0v-40 40Zm0 640v40-40Z"/></svg>',
  f = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M792-56 56-792q-11-11-11-28t11-28q11-11 28-11t28 11l736 736q11 11 11 28t-11 28q-11 11-28 11t-28-11ZM200-703l80 80v383h384l96 96v24q0 33-23.5 56.5T680-40H280q-33 0-56.5-23.5T200-120v-583Zm80 543v40h400v-40H280Zm0 0v40-40Zm79-560q-17 0-28-11.5T320-760q0-17 11.5-28.5T360-800h320v-40H260q-17 0-28.5-11.5T220-880q0-17 11.5-28.5T260-920h420q33 0 56.5 23.5T760-840v480q0 17-11.5 28.5T720-320q-17 0-28.5-11.5T680-360v-360H359Zm98-80Z"/></svg>';
class v extends HTMLElement {
  constructor() {
    super(), this.attachShadow({ mode: 'open' }), (this.styles = new Set());
  }
  async connectedCallback() {
    this.render(), this.handleRemove(), this.handleClipboard(), this.handleNativeInstall(), this.hasAttribute('loaded') || (await this.handleCheckInstallCapabilities(), this.setAttribute('loaded', ''), this.handleUpdateContent());
  }
  static show() {
    let t = document.querySelector('pwa-install-overlay-header-banner');
    return (
      t ||
        ((t = document.createElement('pwa-install-prompt')),
        n.daftplugFrontend.appendChild(t),
        requestAnimationFrame(() => {
          const n = t.shadowRoot.querySelector('.install-prompt');
          (document.documentElement.style.paddingRight = window.innerWidth - document.documentElement.offsetWidth + 'px'), (document.documentElement.style.overflow = 'hidden'), n.classList.add('visible');
        })),
      t
    );
  }
  injectStyles(n) {
    this.styles.add(n);
  }
  addParamToUrl(n, t, e) {
    const o = new URL(n);
    return o.searchParams.set(t, e), o.href;
  }
  handleRemove() {
    const n = this.shadowRoot.querySelector('.install-prompt-close'),
      t = this.shadowRoot.querySelector('.install-prompt-footer_close'),
      e = this.shadowRoot.querySelector('.install-prompt'),
      o = () => {
        e.classList.remove('visible'),
          e.addEventListener(
            'transitionend',
            () => {
              document.documentElement.style.removeProperty('overflow'), (document.documentElement.style.paddingRight = ''), this.remove();
            },
            { once: !0 }
          );
      };
    n.addEventListener('click', o),
      t.addEventListener('click', o),
      e.addEventListener('click', (n) => {
        n.target === e && o();
      });
  }
  handleClipboard() {
    this.shadowRoot.querySelectorAll('[data-clipboard-content]').forEach((n) => {
      n.addEventListener('click', async function () {
        const t = n.getAttribute('data-clipboard-content'),
          e = n.querySelector('.clipboard-default'),
          o = n.querySelector('.clipboard-success'),
          s = n.querySelector('.tooltip');
        try {
          await navigator.clipboard.writeText(t),
            (e.style.display = 'none'),
            (o.style.display = 'block'),
            s.classList.add('visible'),
            (n.disabled = !0),
            setTimeout(() => {
              (e.style.display = 'block'), (o.style.display = 'none'), s.classList.remove('visible'), (n.disabled = !1);
            }, 2e3);
        } catch (n) {
          console.error('Failed to copy:', n);
        }
      });
    });
  }
  async handleCheckInstallCapabilities() {
    return new Promise((n) => {
      if (o) return void n(!0);
      const t = setTimeout(() => n(!1), 1700);
      window.addEventListener(
        'beforeinstallprompt',
        (e) => {
          e.preventDefault(), clearTimeout(t), (o = e), n(!0);
        },
        { once: !0 }
      );
    });
  }
  handleUpdateContent() {
    const n = this.shadowRoot.querySelector('.install-prompt-body');
    n && ((n.innerHTML = this.renderContent()), (this.shadowRoot.querySelector('style').textContent = Array.from(this.styles).join('\n')), this.handleClipboard(), this.handleNativeInstall());
  }
  handleNativeInstall() {
    var n = this;
    const t = this.shadowRoot.querySelector('#native-install-btn');
    t &&
      o &&
      t.addEventListener('click', async function () {
        try {
          await o.prompt();
          const t = await o.userChoice;
          (o = null), 'accepted' === t.outcome && n.remove();
        } catch (t) {
          console.error('Native installation failed:', t), n.handleUpdateContent();
        }
      });
  }
  renderAppIcon() {
    return n.jsVars.iconUrl ? (this.injectStyles('\n      .install-prompt-body-appinfo_icon {\n        border-radius: 9999px;\n        border: 1px solid #e5e7eb;\n        -ms-flex-negative: 0;\n            flex-shrink: 0;\n        height: 55px;\n        width: 55px;\n        display: inline-block;\n      }\n    '), `\n      <img \n        class="install-prompt-body-appinfo_icon" \n        src="${n.jsVars.iconUrl}" \n        alt="${n.jsVars.settings.webAppManifest.appIdentity.appName}"\n        onerror="this.style.display='none'"\n      >\n    `) : '';
  }
  renderAppName() {
    this.injectStyles('\n      .install-prompt-body-appinfo_appname {\n        font-size: 1rem;\n        line-height: 1.5rem;\n        font-weight: 500;\n        color: #1f2937;\n        display: -webkit-box;\n        overflow: hidden;\n        -webkit-box-orient: vertical;\n        -webkit-line-clamp: 1;\n      }\n    ');
    const t = n.jsVars.settings.webAppManifest.appIdentity.appName;
    return t ? `\n      <div class="install-prompt-body-appinfo_appname">${t}</div>\n    ` : '';
  }
  renderAppDescription() {
    this.injectStyles('\n      .install-prompt-body-appinfo_description {\n        font-size: 0.75rem;\n        line-height: 1rem;\n        font-weight: 400;\n        color: #6b7280;\n        margin-top: 0.12rem;\n        display: -webkit-box;\n        overflow: hidden;\n        -webkit-box-orient: vertical;\n        -webkit-line-clamp: 1;\n      }\n    ');
    const t = n.jsVars.settings.webAppManifest.appIdentity.description;
    return t ? `\n      <div class="install-prompt-body-appinfo_description">${t}</div>\n    ` : '';
  }
  renderAppInfo() {
    return this.injectStyles('\n      .install-prompt-body-appinfo {\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        background: #f3f4f6;\n        padding: 0.5rem;\n        border-radius: 0.5rem;\n        border: 1px solid #e5e7eb;\n      }\n\n      .install-prompt-body-appinfo_texts {\n        padding-left: 0.5rem;\n      }\n    '), `\n      <div class="install-prompt-body-appinfo">\n        ${this.renderAppIcon()}\n        <div class="install-prompt-body-appinfo_texts">\n          ${this.renderAppName()}\n          ${this.renderAppDescription()}\n        </div>\n      </div>\n    `;
  }
  renderCopyInstallUrlButton() {
    var t;
    this.injectStyles(
      '\n      .install-prompt-body-instructions_step_copy {\n        position: relative;\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        -webkit-column-gap: 0.5rem;\n           -moz-column-gap: 0.5rem;\n                column-gap: 0.5rem;\n        font-size: 0.875rem;\n        line-height: 0.875rem;\n        padding: 10px 13px;\n        border-radius: 0.5rem;\n        border: 1px solid #e5e7eb;\n        background-color: #ffffff;\n        color: #1f2937;\n        -webkit-box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n        outline: none;\n        -webkit-transition: all .1s ease;\n        -o-transition: all .1s ease;\n        transition: all .1s ease;\n        cursor: pointer;\n        margin-top: 0.5rem;\n      }\n\n      .install-prompt-body-instructions_step_copy:hover,\n      .install-prompt-body-instructions_step_copy:focus {\n        background-color: #f9fafb;\n      }\n\n      .install-prompt-body-instructions_step_copy_url {\n        -o-text-overflow: ellipsis;\n           text-overflow: ellipsis;\n        overflow: hidden;\n        -webkit-box-orient: vertical;\n        -webkit-line-clamp: 1;\n        max-width: 15rem;\n      }\n\n      .install-prompt-body-instructions_step_copy_icons {\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n        border-left: 1px solid #e5e7eb;\n        -webkit-padding-start: 0.75rem;\n                padding-inline-start: 0.75rem;\n      }\n\n      .install-prompt-body-instructions_step_copy_svg {\n        width: 1rem;\n        height: 1rem;\n      }\n\n      .install-prompt-body-instructions_step_copy_svg.clipboard-success {\n        display: none;\n        width: 1rem;\n        height: 1rem;\n        color: #2563eb;\n      }\n\n      .install-prompt-body-instructions_step_copy_tooltip {\n        display: none;\n        opacity: 0;\n        visibility: hidden;\n        position: absolute;\n        top: -2rem;\n        -webkit-transition: all 0.1s ease;\n        -o-transition: all 0.1s ease;\n        transition: all 0.1s ease;\n        z-index: 10;\n        padding: 0.25rem 0.5rem;\n        background-color: #111827;\n        font-size: 0.75rem;\n        line-height: 1rem;\n        font-weight: 500;\n        color: #ffffff;\n        border-radius: 0.5rem;\n        -webkit-box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n        cursor: default;\n      }\n\n      .install-prompt-body-instructions_step_copy_tooltip.visible {\n        visibility: visible;\n        opacity: 1;\n      }\n    '
    );
    const o = null == (t = n.jsVars.settings.webAppManifest.displaySettings) ? void 0 : t.startPage;
    return o
      ? `\n      <button type="button" class="install-prompt-body-instructions_step_copy" data-clipboard-content="${this.addParamToUrl(o, 'performInstall', 'true')}">\n        <span class="install-prompt-body-instructions_step_copy_url">\n          ${o}\n        </span>\n        <span class="install-prompt-body-instructions_step_copy_icons">\n          <svg class="install-prompt-body-instructions_step_copy_svg clipboard-default" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>\n            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>\n          </svg>\n          <svg class="install-prompt-body-instructions_step_copy_svg clipboard-success" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n            <polyline points="20 6 9 17 4 12"></polyline>\n          </svg>\n        </span>\n        <span class="install-prompt-body-instructions_step_copy_tooltip" role="tooltip">\n          ${e('Copied', n.slug)}\n        </span>\n      </button>\n    `
      : '';
  }
  renderLoadingInstallCheck() {
    return (
      this.injectStyles(
        '\n      .install-prompt-loading {\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-orient: vertical;\n        -webkit-box-direction: normal;\n            -ms-flex-direction: column;\n                flex-direction: column;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n      }\n\n      .install-prompt-loading-spinner {\n        width: 2rem;\n        height: 2rem;\n        border: 3px solid #f3f4f6;\n        border-top-color: #1f2937;\n        border-radius: 50%;\n        -webkit-animation: spinner 0.6s linear infinite;\n                animation: spinner 0.6s linear infinite;\n      }\n\n      @-webkit-keyframes spinner {\n        to {\n          -webkit-transform: rotate(360deg);\n                  transform: rotate(360deg);\n        }\n      }\n\n      @keyframes spinner {\n        to {\n          -webkit-transform: rotate(360deg);\n                  transform: rotate(360deg);\n        }\n      }\n\n      .install-prompt-loading-text {\n        margin-top: 1rem;\n        font-size: 0.875rem;\n        line-height: 1.25rem;\n        color: #374151;\n      }\n    '
      ),
      `\n      <div class="install-prompt-loading">\n        <div class="install-prompt-loading-spinner"></div>\n        <div class="install-prompt-loading-text">${e('Checking installation capabilities...', n.slug)}</div>\n      </div>\n    `
    );
  }
  renderNativeInstallButton() {
    var o, s;
    const i = null != (o = null == (s = n.jsVars.settings.webAppManifest) || null == (s = s.appearance) ? void 0 : s.themeColor) ? o : '#000000',
      l = t(i);
    this.injectStyles(
      `\n      .install-prompt-native-button {\n        width: 100%;\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        gap: 0.5rem;\n        padding: 1rem;\n        font-weight: 500;\n        font-size: 0.875rem;\n        line-height: 1.25rem;\n        border-radius: 0.5rem;\n        color: ${l};\n        background-color: ${i};\n        -webkit-transition: all 0.1s ease;\n        -o-transition: all 0.1s ease;\n        transition: all 0.1s ease;\n        cursor: pointer;\n        outline: none;\n        border: none;\n        margin-top: 1.5rem;\n      }\n\n      .install-prompt-native-button:hover {\n        opacity: 0.8;\n      }\n\n      .install-prompt-native-button:focus {\n        outline: 2px solid #60a5fa;\n        outline-offset: 2px;\n      }\n\n      .install-prompt-native-button svg {\n        width: 1.25rem;\n        height: 1.25rem;\n      }\n    `
    );
    const { device: r } = n.jsVars.userData;
    let a = '',
      p = e('Click to Install', n.slug);
    return r.isSmartphone || r.isTablet ? ((a = u), (p = e('Tap to Install', n.slug))) : r.isDesktop && (a = h), `\n      <button type="button" class="install-prompt-native-button" id="native-install-btn">\n        ${a}\n        ${p}\n      </button>\n    `;
  }
  renderContent() {
    return this.hasAttribute('loaded') ? (o ? `\n        ${this.renderAppInfo()}\n        ${this.renderNativeInstallButton()}\n      ` : `\n        ${this.renderAppInfo()}\n        ${this.renderManualInstallInstructions()}\n      `) : `\n        ${this.renderLoadingInstallCheck()}\n      `;
  }
  renderStep(n, t = '', e = '', o = '', s = '') {
    return (
      this.injectStyles(
        "\n      .install-prompt-body-instructions_step {\n        position: relative;\n        -webkit-padding-start: 2.8rem;\n                padding-inline-start: 2.8rem;\n        padding-bottom: 2.2rem;\n        counter-increment: step 1;\n      }\n\n      .install-prompt-body-instructions_step:last-child {\n        padding-bottom: 0px;\n      }\n\n      .install-prompt-body-instructions_step-icon {\n        position: absolute;\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        inset-inline-start: 0px;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n        width: 2rem;\n        height: 2rem;\n        color: #1f2937;\n        border-radius: 9999px;\n        background-color: #f3f4f6;\n      }\n\n      .install-prompt-body-instructions_step-icon svg {\n        width: 1.25rem;\n        height: 1.25rem;\n        -ms-flex-negative: 0;\n            flex-shrink: 0;\n      }\n\n      .install-prompt-body-instructions_step-icon:empty::before {\n        content: counter(step);\n        font-size: 0.75rem;\n        line-height: 1rem;\n        font-weight: 600;\n      }\n\n      .install-prompt-body-instructions_step {\n        counter-increment: step;\n      }\n\n      .install-prompt-body-instructions_step:last-child::after {\n        display: none;\n      }\n\n      .install-prompt-body-instructions_step::after {\n        content: '';\n        position: absolute;\n        top: 2.5rem;\n        bottom: 0.5rem;\n        inset-inline-start: 0.95rem;\n        width: 1px;\n        -webkit-transform: translateX(0.5px);\n            -ms-transform: translateX(0.5px);\n                transform: translateX(0.5px);\n        background-color: #e5e7eb;\n      }\n\n      .install-prompt-body-instructions_step_title {\n        display: block;\n        font-weight: 600;\n        font-size: 0.875rem;\n        line-height: 1.25rem;\n        color: #1f2937;\n      }\n\n      .install-prompt-body-instructions_step_description {\n        font-size: 0.8rem;\n        color: #6b7280;\n        line-height: 1.1rem;\n        margin: 0;\n        padding: 0;\n        margin-top: 0.2rem;\n      }\n    "
      ),
      `\n      <li class="install-prompt-body-instructions_step">\n        ${o ? `<div class="install-prompt-body-instructions_step-icon">${o}</div>` : '<div class="install-prompt-body-instructions_step-icon"></div>'}\n        <span class="install-prompt-body-instructions_step_title">\n           ${n}. ${t}\n        </span>\n        <p class="install-prompt-body-instructions_step_description">\n          ${e}\n        </p>\n        ${s}\n      </li> \n    `
    );
  }
  renderManualInstallInstructions() {
    this.injectStyles('\n      .install-prompt-body-instructions {\n        list-style: none;\n        margin: 0;\n        margin-top: 1.5rem;\n        padding: 0;\n      }\n    ');
    const { device: t, os: o, browser: v } = n.jsVars.userData;
    let w = [],
      q = 1;
    const T = (...n) => {
      w.push(this.renderStep(q, ...n)), q++;
    };
    return (
      t.isSmartphone || t.isTablet
        ? o.isAndroid
          ? v.isChrome
            ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three dots), located at the top-right of your screen.', n.slug), s), T(e('Select "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" option from the menu.', n.slug), b), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" text on the browser installation dialog.', n.slug), r))
            : v.isFirefox
              ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three dots), located at the top-right of your screen.', n.slug), s), T(e('Select "Install"', n.slug), e('Tap the "Install" option from the menu.', n.slug), b), T(e('Confirm by Tapping "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" button on the browser installation dialog.', n.slug), r))
              : v.isOpera
                ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three dots), located at the top-right of your screen.', n.slug), s), T(e('Select "Home Screen"', n.slug), e('Tap the "Install" option from the menu.', n.slug), u), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" text on the browser installation dialog.', n.slug), r))
                : v.isEdge
                  ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three horizontal lines) located at the bottom-right of your screen.', n.slug), a), T(e('Select "Add to Phone"', n.slug), e('Tap the "Add to Phone" option from the menu', n.slug), u), T(e('Confirm by Tapping "Install"', n.slug), e('Tap the "Install" text on the browser installation dialog.', n.slug), r))
                  : (T(e('Copy the Page URL', n.slug), e("Click the button below to copy the page's URL.", n.slug), c, this.renderCopyInstallUrlButton()), T(e('Open the Google Chrome Browser', n.slug), e('Launch the Google Chrome web browser from your home screen.', n.slug), d), T(e('Paste and Open the URL', n.slug), e("Paste the copied URL into Google Chrome's address bar and open the page.", n.slug), m))
          : o.isIos
            ? v.isSafari
              ? (T(e('Tap the Share Icon', n.slug), e('Tap the share icon located at the center-bottom of your screen.', n.slug), i), T(e('Select "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" option, represented by the plus [+] icon.', n.slug), l), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" button at the top-right corner of your screen.', n.slug), r))
              : v.isChrome
                ? (T(e('Tap the Share Icon', n.slug), e('Tap the share icon located at the top-right of your browser address bar.', n.slug), i), T(e('Select "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" option, represented by the plus [+] icon.', n.slug), l), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" button at the top-right corner of your screen.', n.slug), r))
                : v.isFirefox
                  ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three horizontal lines) located at the bottom-right of your screen.', n.slug), a), T(e('Tap the Share Icon', n.slug), e('Tap the share icon in the dialog overlay that the browser opens.', n.slug), i), T(e('Select "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" option, represented by the plus [+] icon.', n.slug), l), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" button at the top-right corner of your screen.', n.slug), r))
                  : v.isOpera
                    ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three dots), located at the bottom-right of your screen.', n.slug), s), T(e('Tap the Share Icon', n.slug), e('Tap the share icon located at the top of the dialog overlay that browser opens.', n.slug), p), T(e('Select "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" option, represented by the plus [+] icon.', n.slug), l), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" button at the top-right corner of your screen.', n.slug), r))
                    : v.isEdge
                      ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three horizontal lines) located at the bottom-right of your screen.', n.slug), a), T(e('Tap the Share Icon', n.slug), e('Tap the share icon in the dialog overlay that the browser opens.', n.slug), p), T(e('Select "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" option, represented by the plus [+] icon.', n.slug), l), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" button at the top-right corner of your screen.', n.slug), r))
                      : v.isDuckduckgo
                        ? (T(e('Tap the Share Icon', n.slug), e("Tap the share icon located at the right side of the browser's address bar.", n.slug), p), T(e('Select "Add to Home Screen"', n.slug), e('Tap the "Add to Home Screen" option, represented by the plus [+] icon.', n.slug), l), T(e('Confirm by Tapping "Add"', n.slug), e('Tap the "Add" button at the top-right corner of your screen.', n.slug), r))
                        : (T(e('Copy the Page URL', n.slug), e("Click the button below to copy the page's URL.", n.slug), c, this.renderCopyInstallUrlButton()),
                          T(
                            e('Open the Safari Browser', n.slug),
                            e('Launch the Safari web browser from your home screen.', n.slug),
                            '<svg style="width:1.5rem;height:1.5rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 5120 5120"><linearGradient x2="0" y2="100%" id="a"><stop offset="0" stop-color="#19d7ff"/><stop offset="1" stop-color="#1e64f0"/></linearGradient><circle cx="2560" cy="2560" r="2240" fill="url(#a)"/><path fill="red" d="M4090 1020 2370 2370l4e2 4e2z"/><path fill="#fff" d="M1020 4090l1350-1720 4e2 4e2z"/><path stroke="#fff" stroke-width="30" d="M2560 540v330m0 3370v330m350-4e3-57 325m-586 3318-57 327M3250 662l-113 310M1984 4138l-113 310m339-3878 57 325m586 3318 57 327M1870 662l113 310m1152 3166 113 310M1552 810l166 286m1685 2918 165 286M1265 1010l212 253m2166 2582 212 253M1015 1258l253 212m2582 2168 253 212M813 1548l286 165m2920 1685 286 165M665 1866l310 113m3166 1150 310 113M574 2202l326 58m3320 588 325 57M545 2555h330m3370 0h330M575 2905l325-57m3320-586 325-57M668 3245l310-113m3165-1152 310-113M815 3563l286-165m2920-1685 286-165M1016 3850l253-212m2580-2166 253-212M1262 41e2l212-253m2166-2582 212-253M1552 43e2l166-286m1685-2918 165-286M2384 548l16 180m320 3656 16 180M2038 610l47 174m950 3544 47 174M1708 730l76 163m1550 3326 77 163M1404 904l103 148m2106 3006 103 148M1135 1130l127 127m2596 2596 127 127M910 14e2l148 103m3006 2107 146 1e2M734 1703l163 76m3326 1550 163 77M614 2033l174 47m3544 950 174 47M553 2380l180 16m3656 320 180 16m-4014 0 180-16m3656-320 180-16M614 3077l174-47m3544-950 174-47M734 3407l163-76m3326-1550 163-76M910 3710l148-103m3006-2107 146-1e2M1404 4206l103-148m2105-3006 104-148M1708 4380l77-163M3335 890l77-163M2038 45e2l47-174m950-3544 47-174m-698 3952 16-180m320-3656 16-180"/></svg>'
                          ),
                          T(e('Paste and Open the URL', n.slug), e("Paste the copied URL into Safari's address bar and open the page.", n.slug), m))
            : T(e('Installation Not Supported', n.slug), e('Your operating system does not support web app installation. Please try accessing the website on an Android or iOS mobile device.', n.slug), f)
        : t.isDesktop
          ? v.isChrome
            ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three dots) in the top-right corner of your browser window.', n.slug), s),
              T(e('Expand "Cast, save and share"', n.slug), e('Hover over the "Cast, Save, and Share" menu item to expand its options.', n.slug), '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m680-272-36-36q-11-11-28-11t-28 11q-11 11-11 28t11 28l104 104q12 12 28 12t28-12l104-104q11-11 11-28t-11-28q-11-11-28-11t-28 11l-36 36v-127q0-17-11.5-28.5T720-439q-17 0-28.5 11.5T680-399v127ZM600-80h240q17 0 28.5 11.5T880-40q0 17-11.5 28.5T840 0H600q-17 0-28.5-11.5T560-40q0-17 11.5-28.5T600-80Zm-360-80q-33 0-56.5-23.5T160-240v-560q0-33 23.5-56.5T240-880h247q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v48q0 17-11.5 28.5T720-519q-17 0-28.5-11.5T680-559v-41H540q-25 0-42.5-17.5T480-660v-140H240v560h200q17 0 28.5 11.5T480-200q0 17-11.5 28.5T440-160H240Zm0-80v-560 560Z"/></svg>'),
              T(e('Select "Install page as app..."', n.slug), e('Click on "Install page as app..." from the menu.', n.slug), h),
              T(e('Confirm by Clicking "Install"', n.slug), e('Click the "Install" button in the browser\'s installation dialog.', n.slug), g))
            : v.isEdge
              ? (T(e('Tap the Menu Icon', n.slug), e('Tap the menu icon (three dots) in the top-right corner of your browser window.', n.slug), '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-400q-33 0-56.5-23.5T160-480q0-33 23.5-56.5T240-560q33 0 56.5 23.5T320-480q0 33-23.5 56.5T240-400Zm240 0q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm240 0q-33 0-56.5-23.5T640-480q0-33 23.5-56.5T720-560q33 0 56.5 23.5T800-480q0 33-23.5 56.5T720-400Z"/></svg>'),
                T(e('Expand "Apps"', n.slug), e('Hover over the "Apps" menu item to expand its options.', n.slug), '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M638-468 468-638q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l170-170q6-6 13-8.5t15-2.5q8 0 15 2.5t13 8.5l170 170q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L694-468q-6 6-13 8.5t-15 2.5q-8 0-15-2.5t-13-8.5Zm-518-92v-240q0-17 11.5-28.5T160-840h240q17 0 28.5 11.5T440-800v240q0 17-11.5 28.5T400-520H160q-17 0-28.5-11.5T120-560Zm400 400v-240q0-17 11.5-28.5T560-440h240q17 0 28.5 11.5T840-400v240q0 17-11.5 28.5T800-120H560q-17 0-28.5-11.5T520-160Zm-400 0v-240q0-17 11.5-28.5T160-440h240q17 0 28.5 11.5T440-400v240q0 17-11.5 28.5T400-120H160q-17 0-28.5-11.5T120-160Zm80-440h160v-160H200v160Zm467 48 113-113-113-113-113 113 113 113Zm-67 352h160v-160H600v160Zm-400 0h160v-160H200v160Zm160-400Zm194-65ZM360-360Zm240 0Z"/></svg>'),
                T(e('Select "Install this site as app"', n.slug), e('Click on "Install this site as app" from the menu.', n.slug), '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-17 0-28.5-11.5T160-160q0-17 11.5-28.5T200-200h560q17 0 28.5 11.5T800-160q0 17-11.5 28.5T760-120H200Zm280-177q-8 0-15-2.5t-13-8.5L308-452q-11-11-11-28t11-28q11-11 28-11t28 11l76 76v-368q0-17 11.5-28.5T480-840q17 0 28.5 11.5T520-800v368l76-76q11-11 28-11t28 11q11 11 11 28t-11 28L508-308q-6 6-13 8.5t-15 2.5Z"/></svg>'),
                T(e('Confirm by Clicking "Install"', n.slug), e('Click the "Install" button in the browser\'s installation dialog.', n.slug), g))
              : (T(e('Copy the Page URL', n.slug), e("Click the button below to copy the page's URL.", n.slug), c, this.renderCopyInstallUrlButton()), T(e('Open the Google Chrome Browser', n.slug), e('Launch the Google Chrome web browser from your start menu.', n.slug), d), T(e('Paste and Open the URL', n.slug), e("Paste the copied URL into Google Chrome's address bar and open the page.", n.slug), m))
          : T(e('Installation Not Supported', n.slug), e('Your device does not support web app installation. Please try accessing the website on a mobile or desktop device.', n.slug), f),
      w.length ? `<ul class="install-prompt-body-instructions">${w.join('')}</ul>` : ''
    );
  }
  render() {
    var t, o;
    this.injectStyles(
      '\n      .install-prompt {\n        position: fixed;\n        top: 0;\n        left: 0;\n        right: 0;\n        bottom: 0;\n        z-index: 9999999;\n        background: rgba(0, 0, 0, 0);\n        -webkit-backdrop-filter: blur(0px);\n                backdrop-filter: blur(0px);\n        -webkit-transition: all 0.2s ease-out;\n        -o-transition: all 0.2s ease-out;\n        transition: all 0.2s ease-out;\n        opacity: 0;\n        visibility: hidden;\n      }\n\n      .install-prompt.visible {      \n        background: rgba(0, 0, 0, 0.7);\n        -webkit-backdrop-filter: blur(5px);\n                backdrop-filter: blur(5px);\n        opacity: 1;\n        visibility: visible;\n      }\n\n      .install-prompt-container {\n        position: fixed;\n        top: 50%;\n        left: 50%;\n        -webkit-transform: translate(-50%, calc(-50% + 20px));\n            -ms-transform: translate(-50%, calc(-50% + 20px));\n                transform: translate(-50%, calc(-50% + 20px));\n        background: white;\n        border-radius: 10px;\n        -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);\n                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);\n        max-width: 32rem;\n        width: 95%;\n        overflow: hidden;\n        opacity: 0;\n        -webkit-transition: all 0.15s ease-out;\n        -o-transition: all 0.15s ease-out;\n        transition: all 0.15s ease-out;\n        z-index: 999999999999999999999;\n      }\n\n      .install-prompt.visible .install-prompt-container {\n        -webkit-transform: translate(-50%, -50%);\n            -ms-transform: translate(-50%, -50%);\n                transform: translate(-50%, -50%);\n        opacity: 1;\n      }\n\n      .install-prompt-header {\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        padding: 0.75rem 1rem;\n        gap: 1.5rem;\n        -webkit-box-pack: justify;\n            -ms-flex-pack: justify;\n                justify-content: space-between;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        border-bottom: 1px solid #e5e7eb;\n      }\n\n      .install-prompt-header-texts_title {\n        font-size: 1rem;\n        line-height: 1.5rem;\n        font-weight: 500;\n        color: #1f2937;\n        display: -webkit-box;\n        overflow: hidden;\n        -webkit-box-orient: vertical;\n        -webkit-line-clamp: 1;\n      }\n\n      .install-prompt-close {\n        display: -webkit-inline-box;\n        display: -ms-inline-flexbox;\n        display: inline-flex;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        width: 2rem;\n        height: 2rem;\n        color: #1f2937;\n        background: #f3f4f6;\n        border-radius: 9999px;\n        outline: none;\n        border: none;\n        cursor: pointer;\n        -webkit-transition: all 0.1s ease;\n        -o-transition: all 0.1s ease;\n        transition: all 0.1s ease;\n        -ms-flex-negative: 0;\n            flex-shrink: 0;\n      }\n\n      .install-prompt-close:hover {\n        background: #e5e7eb;\n      }\n\n      .install-prompt-close-icon {\n        display: block;\n        width: 1rem;\n        height: 1rem;\n        -ms-flex-negative: 0;\n            flex-shrink: 0;\n        vertical-align: middle;\n      }\n\n      .install-prompt-body {\n        padding: 1.5rem 1rem 2rem 1rem;\n        overflow-y: auto;\n        max-height: 34rem;\n      }\n\n      .install-prompt-body::-webkit-scrollbar {\n        width: .5rem;\n      }\n\n      .install-prompt-body::-webkit-scrollbar-thumb {\n        background-color: rgb(209 213 219 / 1);\n        border-radius: 9999px;\n      }\n\n      .install-prompt-body::-webkit-scrollbar-track {\n        background-color: rgb(243 244 246 / 1);\n      }\n\n      .install-prompt-footer {\n        display: none;\n        padding: 0.25rem;\n        border-top: 1px solid #e5e7eb;\n      }\n\n      .install-prompt-footer_close {\n        width: 100%;\n        display: -webkit-inline-box;\n        display: -ms-inline-flexbox;\n        display: inline-flex;\n        -webkit-box-pack: center;\n            -ms-flex-pack: center;\n                justify-content: center;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        -webkit-column-gap: 0.375rem;\n           -moz-column-gap: 0.375rem;\n                column-gap: 0.375rem;\n        padding: 0.75rem 1rem;\n        font-weight: 500;\n        font-size: 0.75rem;\n        line-height: 1rem;\n        border-radius: 0.5rem;\n        background-color: #ffffff;\n        color: #1f2937;\n        -webkit-transition: all 0.1s ease;\n        -o-transition: all 0.1s ease;\n        transition: all 0.1s ease;\n        cursor: pointer;\n        outline: none;\n        border: none;\n      }\n\n      .install-prompt-footer_close:hover {\n        background-color: #f3f4f6;\n      }\n        \n      .install-prompt-footer_close:focus {\n        outline: none;\n        border: none;\n        background-color: #f3f4f6;\n      }\n\n      @media (max-width: 700px) {\n       .install-prompt-container {\n          width: 100%;\n          max-width: 100%;\n          top: unset;\n          bottom: 0;\n          left: 0;\n          border-top-left-radius: 1rem;\n          border-top-right-radius: 1rem;\n          border-bottom-left-radius: 0;\n          border-bottom-right-radius: 0;\n          -webkit-box-shadow: none;\n                  box-shadow: none;\n          opacity: 1;\n          -webkit-transform: translateY(100%);\n              -ms-transform: translateY(100%);\n                  transform: translateY(100%);\n        } \n\n        .install-prompt.visible .install-prompt-container {\n          -webkit-transform: translateY(0);\n              -ms-transform: translateY(0);\n                  transform: translateY(0);\n        }\n      }\n    '
    );
    const s = this.renderContent(),
      i = null != (t = null == (o = n.jsVars.settings.installation) || null == (o = o.prompts) ? void 0 : o.text) ? t : e('Install Web App', n.slug),
      l = Array.from(this.styles).join('\n');
    this.shadowRoot.innerHTML = `\n      <style>${l}</style>\n      <div class="install-prompt">\n        <div class="install-prompt-container">\n          <div class="install-prompt-header">\n            <div class="install-prompt-header-texts">\n              <div class="install-prompt-header-texts_title">${i}</div>\n            </div>\n            <button type="button" class="install-prompt-close" aria-label="Close">\n              <svg class="install-prompt-close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>\n            </button>\n          </div>\n          <div class="install-prompt-body">\n            ${s}\n          </div>\n          <div class="install-prompt-footer">\n            <button type="button" class="install-prompt-footer_close">\n              ${e('Close Dialog', n.slug)}\n            </button>\n          </div>\n        </div>\n      </div>\n    `;
  }
}
function w() {
  const n = document.querySelector('pwa-install-prompt');
  n && n.remove(), customElements.get('pwa-install-prompt') || customElements.define('pwa-install-prompt', v), v.show();
}
export { w as p };
