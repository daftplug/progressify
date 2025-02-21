import showToast from '../components/toast.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');

export function initProcessLicense() {
  daftplugAdmin.find('form[name="licenseActivationForm"]').on('submit', activateLicense);
}

async function sendLicenseProcessRequest(licenseKey, action) {
  const requestBody = JSON.stringify({
    licenseKey: licenseKey,
    action: action,
  });

  try {
    const response = await fetch(wpApiSettings.root + slug + '/requestLicenseProcessing', {
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

    try {
      return data;
    } catch (error) {
      throw new Error('Invalid JSON response from server');
    }
  } catch (error) {
    return error;
  }
}

async function activateLicense(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const licenseKey = form.find('#licenseKey').val();
  const submitRequestBtn = form.find('button[type="submit"]');
  submitRequestBtn.attr('data-activating', true);

  try {
    const response = await sendLicenseProcessRequest(licenseKey, 'activate');

    console.log(response);

    if (response.status === 'error') {
      showToast('Fail', response.error, 'fail', 'top-right', true, false);
    } else if (response.data && response.data.status === 'success') {
      showToast('Success', 'License has been activated successfully!', 'success', 'top-right', true, false);
      location.reload();
    } else if (response.code === 'invalid_license') {
      showToast('Fail', response.message, 'fail', 'top-right', true, false);
    } else {
      showToast('Fail', 'An unexpected error occurred', 'fail', 'top-right', true, false);
    }
  } catch (error) {
    console.error('License activation error:', error);
    showToast('Fail', 'Failed to process license request. Please try again.', 'fail', 'top-right', true, false);
  } finally {
    submitRequestBtn.removeAttr('data-activating');
  }
}
