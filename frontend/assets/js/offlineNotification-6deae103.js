import{config as n}from"./frontend.js";import{g as e}from"./utils-b7f0f688.js";const{__:t}=wp.i18n;class i extends HTMLElement{constructor(){super(),this.attachShadow({mode:"open"}),this.styles=new Set}connectedCallback(){this.render()}injectStyles(n){this.styles.add(n)}static showReconnecting(){let e=document.querySelector("pwa-offline-notification");return e||(e=document.createElement("pwa-offline-notification"),n.daftplugFrontend.appendChild(e)),requestAnimationFrame(()=>{const i=e.shadowRoot.querySelector(".offline-notification"),o=i.querySelector(".offline-notification_icon"),s=i.querySelector(".offline-notification_text");i.classList.remove("reconnected"),o.classList.add("spinner"),o.classList.remove("success"),s.textContent=t("Connection lost. Attempting to reconnect...",n.slug),i.classList.add("visible")}),e}static showReconnected(){const e=document.querySelector("pwa-offline-notification");if(!e)return;const i=e.shadowRoot.querySelector(".offline-notification"),o=i.querySelector(".offline-notification_icon"),s=i.querySelector(".offline-notification_text");i.classList.add("reconnected"),o.classList.remove("spinner"),o.classList.add("success"),s.textContent=t("Successfully reconnected to the internet!",n.slug),e._removeTimeout&&clearTimeout(e._removeTimeout),e._removeTimeout=setTimeout(()=>{i.classList.remove("visible"),i.addEventListener("transitionend",()=>{e.remove()},{once:!0})},2e3)}render(){var i,o;const s=null!=(i=null==(o=n.jsVars.settings.webAppManifest)||null==(o=o.appearance)?void 0:o.themeColor)?i:"#000000",r=e(s),a=e(r);this.injectStyles(`\n      .offline-notification {\n        position: fixed;\n        top: 0;\n        left: 50%;\n        -webkit-transform: translateX(-50%) translateY(-100%);\n            -ms-transform: translateX(-50%) translateY(-100%);\n                transform: translateX(-50%) translateY(-100%);\n        display: -webkit-box;\n        display: -ms-flexbox;\n        display: flex;\n        -webkit-box-align: center;\n            -ms-flex-align: center;\n                align-items: center;\n        padding: 0.75rem 1rem;\n        gap: 0.75rem;\n        width: 30rem;\n        max-width: 85%;\n        background-color: ${r};\n        color: ${a};\n        border: 1px solid ${a}15;\n        border-radius: 0.75rem;\n        -webkit-box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);\n                box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);\n        z-index: 9999999999999999;\n        -webkit-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);\n        -o-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);\n        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);\n        opacity: 0;\n      }\n\n      .offline-notification.visible {\n        opacity: 1;\n        -webkit-transform: translateX(-50%) translateY(1rem);\n            -ms-transform: translateX(-50%) translateY(1rem);\n                transform: translateX(-50%) translateY(1rem);\n      }\n\n      .offline-notification_icon {\n        display: inline-block;\n        flex-shrink: 0;\n        width: 12px;\n        height: 12px;\n        border-radius: 9999px;\n      }\n\n      .offline-notification_icon.spinner {\n        -webkit-animation: spin 1s linear infinite;\n                animation: spin 1s linear infinite;\n        border: 3px solid ${s};\n        border-top-color: transparent;\n      }\n\n      .offline-notification_icon.success {\n        background-color: #22c55e;\n        border-radius: 9999px;\n      }\n\n      .offline-notification_text {\n        font-size: 0.875rem;\n        line-height: 1.25rem;\n      }\n\n      @-webkit-keyframes spin {\n        to {\n          -webkit-transform: rotate(360deg);\n                  transform: rotate(360deg);\n        }\n      }\n\n      @keyframes spin {\n        to {\n          -webkit-transform: rotate(360deg);\n                  transform: rotate(360deg);\n        }\n      }\n    `);const l=Array.from(this.styles).join("\n");this.shadowRoot.innerHTML=`\n      <style>${l}</style>\n      <div class="offline-notification" role="alert" tabindex="-1">\n        <div class="offline-notification_icon spinner" role="status" aria-label="loading"></div>\n        <span class="offline-notification_text">\n          ${t("Connection lost. Attempting to reconnect...",n.slug)}\n        </span>\n      </div>\n    `}}function o(){customElements.get("pwa-offline-notification")||customElements.define("pwa-offline-notification",i),navigator.onLine||i.showReconnecting(),window.addEventListener("offline",()=>{i.showReconnecting()}),window.addEventListener("online",()=>{i.showReconnected()})}export{o as initOfflineNotification};
