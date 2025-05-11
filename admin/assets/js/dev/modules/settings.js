import jQuery from '../components/utils.js';
import generateAndSendPwaAssets from '../components/pwaAssetGenerator.js';
import showToast from '../components/toast.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');
const { __ } = wp.i18n;

export function initSettings() {
  checkAndGeneratePwaAssetsIfNeeded();
  daftplugAdmin.find('form[name="settingsForm"]').on('submit', saveSettings);
}

export async function checkAndGeneratePwaAssetsIfNeeded() {
  const response = await fetch(wpApiSettings.root + slug + '/checkPwaAssets', {
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
      const iconUrl = daftplugAdmin.find('#settingAppIcon').find('[data-attachment-holder]').attr('src');
      const backgroundColor = daftplugAdmin.find('input[name="webAppManifest[appearance][backgroundColor]"]').val();
      await generateAndSendPwaAssets(iconUrl, backgroundColor);

      // Generate service worker file
      await fetch(wpApiSettings.root + slug + '/generateServiceWorkerFile', {
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
  const settingPath = Object.keys(parsedSettings)[0];
  const saveSettingsBtn = form.find('button[type="submit"]');
  const intractableComponents = daftplugAdmin.find('header, aside, main, footer');

  saveSettingsBtn.attr('data-saving', true);
  intractableComponents.attr('data-disabled', true);

  // Validate that we have a setting path
  if (!settingPath) {
    console.error('Error: No setting path found in form data');
    showToast(__('Fail', slug), __('Your changes have failed to be saved!', slug), 'fail', 'top-right', true, false);
    saveSettingsBtn.removeAttr('data-saving');
    intractableComponents.removeAttr('data-disabled');
    return;
  }

  // Get the current settings from the server first
  try {
    const currentSettingsResponse = await fetch(wpApiSettings.root + slug + '/getSettings', {
      method: 'GET',
      headers: {
        'X-WP-Nonce': wpApiSettings.nonce,
        'Content-Type': 'application/json',
      },
    });

    if (!currentSettingsResponse.ok) {
      throw new Error('Failed to get current settings');
    }

    const currentSettings = await currentSettingsResponse.json();

    // Create a deep copy of the current settings
    const mergedSettings = JSON.parse(JSON.stringify(currentSettings));

    // Get the path parts and navigate to the correct location
    const pathParts = settingPath.split('[').map((part) => part.replace(']', ''));
    let current = mergedSettings;

    // Navigate to the correct location in the settings object
    for (let i = 0; i < pathParts.length - 1; i++) {
      if (!current[pathParts[i]]) {
        current[pathParts[i]] = {};
      }
      current = current[pathParts[i]];
    }

    // Update only the specific setting
    const lastKey = pathParts[pathParts.length - 1];
    const newValue = parsedSettings[settingPath];

    // If the new value is an object, merge it with existing value
    if (typeof newValue === 'object' && newValue !== null) {
      current[lastKey] = { ...current[lastKey], ...newValue };
    } else {
      current[lastKey] = newValue;
    }

    const requestBody = JSON.stringify({
      settings: mergedSettings,
      settingPath: settingPath,
    });

    console.log('Sending request with data:', requestBody);

    const response = await fetch(wpApiSettings.root + slug + '/saveSettings', {
      method: 'POST',
      headers: {
        'X-WP-Nonce': wpApiSettings.nonce,
        'Content-Type': 'application/json',
      },
      body: requestBody,
    });

    // Check for text response which might indicate an error
    const contentType = response.headers.get('content-type');
    let data;

    if (contentType && contentType.includes('application/json')) {
      data = await response.json();
    } else {
      const text = await response.text();
      console.error('Non-JSON response:', text);
      throw new Error('Server returned non-JSON response');
    }

    console.log('Server response:', data);

    if (data.status === 'success') {
      try {
        // Generate PWA assets if the setting path starts with webAppManifest
        if (settingPath.startsWith('webAppManifest')) {
          const iconUrl = daftplugAdmin.find('#settingAppIcon').find('[data-attachment-holder]').attr('src');
          const backgroundColor = daftplugAdmin.find('input[name="webAppManifest[appearance][backgroundColor]"]').val();
          await generateAndSendPwaAssets(iconUrl, backgroundColor);
        }

        // Generate service worker file
        await fetch(wpApiSettings.root + slug + '/generateServiceWorkerFile', {
          method: 'POST',
          headers: {
            'X-WP-Nonce': wpApiSettings.nonce,
            'Content-Type': 'application/json',
          },
        });
      } catch (error) {
        console.error('Failed to generate PWA assets:', error);
        showToast(__('Warning', slug), __('Settings saved but PWA assets generation failed!', slug), 'warning', 'top-right', true, false);
      } finally {
        showToast(__('Success', slug), __('Your changes have been saved successfully!', slug), 'success', 'top-right', true, false);
      }
    } else {
      showToast(__('Fail', slug), __('Your changes have failed to be saved!', slug), 'fail', 'top-right', true, false);
    }
  } catch (error) {
    console.error('Save failed:', error);
    showToast(__('Fail', slug), __('Your changes have failed to be saved!', slug), 'fail', 'top-right', true, false);
  } finally {
    saveSettingsBtn.removeAttr('data-saving');
    intractableComponents.removeAttr('data-disabled');
  }
}
