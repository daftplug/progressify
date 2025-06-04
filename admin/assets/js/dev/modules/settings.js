import { config } from '../admin.js';
import jQuery from '../components/utils.js';
import generateAndSendPwaAssets from '../components/pwaAssetGenerator.js';
import showToast from '../components/toast.js';

const { __ } = wp.i18n;

export function initSettings() {
  checkAndGeneratePwaAssetsIfNeeded();
  config.daftplugAdminElm.find('form[name="settingsForm"]').on('submit', saveSettings);
}

export async function checkAndGeneratePwaAssetsIfNeeded() {
  const response = await fetch(wpApiSettings.root + config.jsVars.slug + '/checkPwaAssets', {
    method: 'POST',
    headers: {
      'X-WP-Nonce': wpApiSettings.nonce,
      'Content-Type': 'application/json',
    },
  });

  const data = await response.json();

  if (data.needsToGenerate) {
    try {
      // Get the PWA pwa icons, splash screens and installation QR code
      const iconUrl = config.daftplugAdminElm.find('#settingAppIcon').find('[data-attachment-holder]').attr('src');
      const backgroundColor = config.daftplugAdminElm.find('input[name="webAppManifest[appearance][backgroundColor]"]').val();
      await generateAndSendPwaAssets(iconUrl, backgroundColor);

      // Generate service worker file
      await fetch(wpApiSettings.root + config.jsVars.slug + '/generateServiceWorkerFile', {
        method: 'POST',
        headers: {
          'X-WP-Nonce': wpApiSettings.nonce,
          'Content-Type': 'application/json',
        },
      });
    } catch (error) {
      console.error('Failed to generate PWA assets:', error);
    }
  }
}

export async function saveSettings(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const settingsData = form.daftplugSerialize();
  const parsedSettings = JSON.parse(settingsData);
  const topLevelKey = Object.keys(parsedSettings)[0];
  const saveSettingsBtn = form.find('button[type="submit"]');
  const intractableComponents = config.daftplugAdminElm.find('header, aside, main, footer');

  saveSettingsBtn.attr('data-saving', true);
  intractableComponents.attr('data-disabled', true);

  const requestBody = JSON.stringify({
    settings: parsedSettings,
    topLevelKey: topLevelKey,
  });

  try {
    const response = await fetch(wpApiSettings.root + config.jsVars.slug + '/saveSettings', {
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
        // Generate PWA assets if the PWA icon is changed
        if (topLevelKey === 'webAppManifest' && parsedSettings.webAppManifest.appIdentity.appIcon !== config.jsVars.settings.webAppManifest.appIdentity.appIcon) {
          const iconUrl = config.daftplugAdminElm.find('#settingAppIcon').find('[data-attachment-holder]').attr('src');
          const backgroundColor = parsedSettings.webAppManifest.appearance.backgroundColor;
          await generateAndSendPwaAssets(iconUrl, backgroundColor);
        }

        // Generate service worker file
        await fetch(wpApiSettings.root + config.jsVars.slug + '/generateServiceWorkerFile', {
          method: 'POST',
          headers: {
            'X-WP-Nonce': wpApiSettings.nonce,
            'Content-Type': 'application/json',
          },
        });
      } catch (error) {
        console.error('Failed to generate PWA assets:', error);
        showToast(__('Warning', config.jsVars.slug), __('Settings saved but PWA assets generation failed!', config.jsVars.slug), 'warning', 'top-right', true, false);
      } finally {
        showToast(__('Success', config.jsVars.slug), __('Your changes have been saved successfully!', config.jsVars.slug), 'success', 'top-right', true, false);
      }
    } else {
      showToast(__('Fail', config.jsVars.slug), __('Your changes have failed to be saved!', config.jsVars.slug), 'fail', 'top-right', true, false);
    }
  } catch (error) {
    console.error('Save failed:', error);
    showToast(__('Fail', config.jsVars.slug), __('Your changes have failed to be saved!', config.jsVars.slug), 'fail', 'top-right', true, false);
  } finally {
    saveSettingsBtn.removeAttr('data-saving');
    intractableComponents.removeAttr('data-disabled');
  }
}
