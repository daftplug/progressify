export const config = (() => {
  const daftplugFrontend = document.getElementById('daftplugFrontend');
  const optionName = daftplugFrontend.getAttribute('data-option-name');
  const slug = daftplugFrontend.getAttribute('data-slug');
  const jsVars = window[optionName + '_frontend_js_vars'] || {};

  return {
    daftplugFrontend,
    optionName,
    slug,
    jsVars,
  };
})();

async function initModules() {
  if (config.jsVars.userData.platform.isBrowser) {
    // Installation Overlays and Button
    if (config.jsVars.settings.installation?.prompts?.feature === 'on') {
      // Install Url
      const { initInstallUrl } = await import('./modules/installUrl.js');
      initInstallUrl();

      // Installation Button
      const { initInstallButton } = await import('./modules/installButton.js');
      initInstallButton();

      // Installation Overlays
      const { initInstallOverlays } = await import('./modules/installOverlays.js');
      initInstallOverlays();
    }
  }
}

document.addEventListener('DOMContentLoaded', initModules);
