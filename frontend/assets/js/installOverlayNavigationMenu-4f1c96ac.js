import{config as n}from"./frontend.js";import{p as e}from"./installPrompt-689ca566.js";import{i,g as t}from"./utils-ae07b67a.js";const{__:o}=wp.i18n;class a extends HTMLElement{constructor(){super(),this.attachShadow({mode:"open"}),this.styles=new Set}connectedCallback(){this.render(),this.handlePerformInstallation()}static findVisibleMenuElement(n){if("ul"===n.tagName.toLowerCase()&&"none"!==window.getComputedStyle(n).display&&n.querySelector("li"))return n;for(const e of n.children){const n=this.findVisibleMenuElement(e);if(n)return n}return null}static findMobileMenu(){const n=[".wp-block-navigation","#ast-mobile-header","#mobile-menu",".mobile-menu",".mobile-navigation",'[class*="mobile-header"]','[id*="mobile-header"]','[class*="mobile-menu"]','[id*="mobile-menu"]',"nav","header"];for(const e of n){const n=document.querySelectorAll(e);for(const e of n)if("none"!==window.getComputedStyle(e).display){const n=this.findVisibleMenuElement(e);if(n)return{container:e,menu:n}}}return null}static show(){let n=document.querySelector("pwa-install-overlay-navigation-menu");if(!n){const e=this.findMobileMenu();if(null!=e&&e.menu){n=document.createElement("pwa-install-overlay-navigation-menu");const i=document.createElement("li");i.className="menu-item pwa-install-menu-item";const t=e.menu.querySelector("li");if(t){const n=Array.from(t.classList).filter(n=>!n.includes("current")&&!n.includes("active"));i.classList.add(...n)}i.appendChild(n),e.menu.appendChild(i)}}return n}injectStyles(n){this.styles.add(n)}handlePerformInstallation(){const n=this.shadowRoot.querySelector(".navigation-menu-overlay-button_install");null==n||n.addEventListener("click",()=>{e()})}render(){var e,i,a,l,s;const r=null!=(e=n.jsVars.settings.webAppManifest.appIdentity.appName)?e:"",m=null!=(i=null==(a=n.jsVars.settings.webAppManifest)||null==(a=a.appearance)?void 0:a.themeColor)?i:"#000000",d=t(m),u=null!=(l=null==(s=n.jsVars.settings.installation)||null==(s=s.prompts)?void 0:s.text)?l:o("Install Web App",n.slug),c=n.jsVars.iconUrl?`<img class="navigation-menu-overlay-appinfo_icon" src="${n.jsVars.iconUrl}" alt="${r}" onerror="this.style.display='none'"/>`:"";this.injectStyles(`\n      .navigation-menu-overlay {\n        position: relative;\n        border-radius: 0.5rem;\n        padding: 1rem;\n        background-color: ${m};\n        color: ${d};\n        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n        -webkit-transition: all 0.2s ease-out;\n        -o-transition: all 0.2s ease-out;\n        transition: all 0.2s ease-out;\n        overflow: hidden;\n        text-transform: none;\n      }\n\n      .navigation-menu-overlay-appinfo {\n        display: flex;\n        align-items: center;\n        gap: 0.75rem;\n        flex: 1;\n      }\n\n      .navigation-menu-overlay-appinfo_icon {\n        border-radius: 9999px;\n        border: 1px solid #e5e7eb;\n        flex-shrink: 0;\n        height: 50px;\n        width: 50px;\n        display: inline-block;\n      }\n\n      .navigation-menu-overlay-appinfo_texts {\n        flex: 1;\n        min-width: 0;\n      }\n\n      .navigation-menu-overlay-appinfo_title {\n        font-size: 0.875rem;\n        line-height: 1.25rem;\n        font-weight: 500;\n        color: ${d};\n        display: -webkit-box;\n        overflow: hidden;\n        -webkit-box-orient: vertical;\n        -webkit-line-clamp: 1;\n      }\n\n      .navigation-menu-overlay-appinfo_description {\n        font-size: 0.75rem;\n        line-height: 1rem;\n        font-weight: 400;\n        color: ${d}cc;\n        margin-top: 0.12rem;\n        display: -webkit-box;\n        overflow: hidden;\n        -webkit-box-orient: vertical;\n        -webkit-line-clamp: 2;\n      }\n\n      .navigation-menu-overlay-button_install {\n        display: block;\n        background-color: ${d};\n        color: ${m};\n        vertical-align: middle;\n        text-decoration: none;\n        font-size: 0.875rem;\n        line-height: 1.25rem;\n        font-weight: 600;\n        padding: 0.375rem 0.875rem;\n        margin-left: auto;\n        margin-top: 1rem;\n        border: none;\n        outline: none;\n        border-radius: 9999px;\n        cursor: pointer;\n      }\n    `);const p=Array.from(this.styles).join("\n");this.shadowRoot.innerHTML=`\n      <style>${p}</style>\n      <div class="navigation-menu-overlay">\n        <div class="navigation-menu-overlay-appinfo">\n          ${c}\n          <div class="navigation-menu-overlay-appinfo_texts">\n            <div class="navigation-menu-overlay-appinfo_title">${u}</div>\n            <div class="navigation-menu-overlay-appinfo_description">${o("Find what you need faster by installing our web app!",n.slug)}</div>\n          </div>\n        </div>\n        <button type="button" class="navigation-menu-overlay-button_install">\n          ${o("Install Now",n.slug)}\n        </button>\n      </div>\n    `}}async function l(){var e;const{device:t,platform:o}=n.jsVars.userData,l="on"===(null==(e=n.jsVars.settings.installation)||null==(e=e.prompts)?void 0:e.skipFirstVisit);!t.isSmartphone&&!t.isTablet||!o.isBrowser||o.isPwa||l&&!i()||(customElements.get("pwa-install-overlay-navigation-menu")||customElements.define("pwa-install-overlay-navigation-menu",a),a.show(),setTimeout(()=>{a.show()},1e3))}export{l as initInstallOverlayNavigationMenu};
