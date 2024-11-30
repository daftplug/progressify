import { config as e } from './frontend.js';
class s extends HTMLElement {
  constructor() {
    super(), this.attachShadow({ mode: 'open' }), (this.styles = new Set());
  }
  connectedCallback() {
    this.render(), this.handleScrollProgress();
  }
  static show() {
    let e = document.querySelector('pwa-scroll-progress-bar');
    return e || ((e = document.createElement('pwa-scroll-progress-bar')), document.body.appendChild(e)), e;
  }
  injectStyles(e) {
    this.styles.add(e);
  }
  handleScrollProgress() {
    const e = this.shadowRoot.querySelector('.scroll-progress-bar_fill');
    let s = !1;
    const t = () => {
      const t = window.scrollY || window.pageYOffset,
        n = document.documentElement.scrollHeight - window.innerHeight;
      (e.style.width = (t / n) * 100 + '%'), (s = !1);
    };
    document.addEventListener('scroll', () => {
      s ||
        (window.requestAnimationFrame(() => {
          t();
        }),
        (s = !0));
    }),
      t();
  }
  render() {
    var s, t;
    const n = null != (s = null == (t = e.jsVars.settings.webAppManifest) || null == (t = t.appearance) ? void 0 : t.themeColor) ? s : '#000000';
    this.injectStyles(`\n      .scroll-progress-bar {\n          position: fixed;\n          top: 0;\n          left: 0;\n          width: 100%;\n          height: 0.375rem;\n          background-color: #ccc;\n          z-index: 999999999;\n          padding-top: env(safe-area-inset-top);\n      }\n\n      .scroll-progress-bar_fill {\n          width: 100%;\n          height: 100%;\n          background-color: ${n};\n          transition: width 0.05s ease-out;\n      }\n    `);
    const o = Array.from(this.styles).join('\n');
    this.shadowRoot.innerHTML = `\n      <style>${o}</style>\n      <div class="scroll-progress-bar">\n        <div class="scroll-progress-bar_fill"></div>\n      </div>\n    `;
  }
}
async function t() {
  const { device: t } = e.jsVars.userData;
  e.jsVars.settings.uiComponents.scrollProgressBar.supportedDevices.some((e) => ('smartphone' === e && t.isSmartphone) || ('tablet' === e && t.isTablet) || ('desktop' === e && t.isDesktop)) && (customElements.get('pwa-scroll-progress-bar') || customElements.define('pwa-scroll-progress-bar', s), s.show());
}
export { t as initScrollProgressBar };
