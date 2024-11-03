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
  if (!config.userData.platform.isPwa) {
    // Install Button
    if (config.settings.installation?.button?.feature === 'on') {
      const { initInstallButton } = await import('./modules/installButton.js');
      initInstallButton();
    }

    // Install Overlays
    // if (config.settings.installation?.overlays?.feature === 'on') {
    //   const { initInstallOverlays } = await import('./modules/installOverlays.js');
    //   initInstallOverlays();
    // }
  }
}

document.addEventListener('DOMContentLoaded', initModules);
