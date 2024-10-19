async function initModules() {
  const daftplugFrontend = jQuery('#daftplugFrontend');
  const optionName = daftplugFrontend.attr('data-option-name');
  const settings = window[optionName + '_frontend_js_vars'].settings || { settings: {} };

  if (settings.installation?.button?.feature) {
    const { initInstallButton } = await import('./modules/installButton.js');
    initInstallButton();
  }
}

document.addEventListener('DOMContentLoaded', initModules);
