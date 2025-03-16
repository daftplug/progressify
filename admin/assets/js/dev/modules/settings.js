import jQuery from '../components/utils.js';
import generateAndSendPwaAssets from '../components/pwaAssetGenerator.js';
import showToast from '../components/toast.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');

export function initSettings() {
  daftplugAdmin.find('form[name="settingsForm"]').on('submit', saveSettings);
}

export async function saveSettings(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const settingsData = form.daftplugSerialize();
  const parsedSettings = JSON.parse(settingsData);
  const topLevelKey = Object.keys(parsedSettings)[0];
  const saveSettingsBtn = form.find('button[type="submit"]');
  const intractableComponents = daftplugAdmin.find('header, aside, main, footer');

  saveSettingsBtn.attr('data-saving', true);
  intractableComponents.attr('data-disabled', true);

  const requestBody = JSON.stringify({
    settings: parsedSettings,
    topLevelKey: topLevelKey,
  });

  try {
    const response = await fetch(wpApiSettings.root + slug + '/saveSettings', {
      method: 'POST',
      headers: {
        'X-WP-Nonce': wpApiSettings.nonce,
        'Content-Type': 'application/json',
      },
      body: requestBody,
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();

    if (data.status === 'success') {
      try {
        if (topLevelKey === 'webAppManifest') {
          const iconUrl = daftplugAdmin.find('#settingAppIcon').find('[data-attachment-holder]').attr('src');
          const backgroundColor = parsedSettings.webAppManifest.appearance.backgroundColor;
          await generateAndSendPwaAssets(iconUrl, backgroundColor);
        } else {
          await fetch(wpApiSettings.root + slug + '/generateServiceWorkerFile', {
            method: 'POST',
            headers: {
              'X-WP-Nonce': wpApiSettings.nonce,
              'Content-Type': 'application/json',
            },
          });
        }
      } catch (error) {
        console.error('Failed to generate PWA assets:', error);
        showToast('Warning', 'Settings saved but PWA assets generation failed!', 'warning', 'top-right', true, false);
      } finally {
        showToast('Success', 'Your changes have been saved successfully!', 'success', 'top-right', true, false);
      }
    } else {
      showToast('Fail', 'Your changes have failed to be saved!', 'fail', 'top-right', true, false);
    }
  } catch (error) {
    console.error('Save failed:', error);
    showToast('Fail', 'Your changes have failed to be saved!', 'fail', 'top-right', true, false);
  } finally {
    saveSettingsBtn.removeAttr('data-saving');
    intractableComponents.removeAttr('data-disabled');
  }
}
