import { config } from '../frontend.js';

export async function initPwaCustomCssAndJs() {
  const style = document.createElement('style');
  const script = document.createElement('script');

  style.textContent = config.jsVars.settings.uiComponents.pwaCustomCssAndJs.css || '';
  script.textContent = config.jsVars.settings.uiComponents.pwaCustomCssAndJs.js || '';

  document.head.appendChild(style);
  document.body.appendChild(script);
}
