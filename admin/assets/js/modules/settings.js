import jQuery from './utils.js';
import showToast from '../components/toast.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');

export function initSettings() {
  daftplugAdmin.find('form[name="settingsForm"]').on('submit', saveSettings);
}

export function saveSettings(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const settingsData = form.daftplugSerialize();
  const parsedSettings = JSON.parse(settingsData);

  // Get the top-level key (e.g., 'webAppManifest')
  const topLevelKey = Object.keys(parsedSettings)[0];

  const saveSettingsBtn = form.find('button[type="submit"]');
  const intractableComponents = daftplugAdmin.find('header, aside, main, footer');

  saveSettingsBtn.attr('data-saving', true);
  intractableComponents.attr('data-disabled', true);

  const requestBody = JSON.stringify({
    settings: parsedSettings,
    topLevelKey: topLevelKey,
  });

  fetch(wpApiSettings.root + slug + '/saveSettings', {
    method: 'POST',
    headers: {
      'X-WP-Nonce': wpApiSettings.nonce,
      'Content-Type': 'application/json',
    },
    body: requestBody,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then((response) => {
      saveSettingsBtn.removeAttr('data-saving');
      intractableComponents.removeAttr('data-disabled');

      if (response.status === '1') {
        showToast('Success', 'Your changes have been saved successfully!', 'success', 'top-right', true, false);
      } else {
        showToast('Fail', 'Your changes have failed to be saved!', 'fail', 'top-right', true, false);
      }
    })
    .catch((error) => {
      saveSettingsBtn.removeAttr('data-saving');
      intractableComponents.removeAttr('data-disabled');
      showToast('Fail', 'Your changes have failed to be saved!', 'fail', 'top-right', true, false);
    });
}
