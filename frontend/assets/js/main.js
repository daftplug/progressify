export const config = (() => {
  const daftplugFrontend = document.getElementById('daftplugFrontend');
  const optionName = daftplugFrontend.getAttribute('data-option-name');
  const slug = daftplugFrontend.getAttribute('data-slug');
  const jsVars = window[optionName + '_frontend_js_vars'] || {};

  return {
    daftplugFrontend,
    optionName,
    slug,
    adminUrl: jsVars.adminUrl,
    iconUrl: jsVars.iconUrl,
    settings: jsVars.settings || { settings: {} },
    userData: jsVars.userData || { userData: {} },
  };
})();

async function initModules() {
  if (config.userData.platform.isBrowser) {
    // Install Url
    const { initInstallUrl } = await import('./modules/installUrl.js');
    initInstallUrl();

    // Installation Overlays and Button
    if (config.settings.installation?.prompts?.feature === 'on') {
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
