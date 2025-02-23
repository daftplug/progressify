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
      const errorText = await response.text();
      throw new Error(`Network response was not ok (${response.status}): ${errorText}`);
    }

    const data = await response.json();
    return data;
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

    if (response.status === 'success') {
      showToast('Success', 'License has been activated successfully!', 'success', 'top-right', true, false);
      window.location.hash = '#/dashboard/';
      window.location.reload();
    } else if (response.status === 'fail') {
      showToast('Fail', response.message, 'fail', 'top-right', true, false);
    } else {
      showToast('Fail', 'An unexpected error occurred', 'fail', 'top-right', true, false);
    }
  } catch (error) {
    showToast('Fail', 'Failed to process license request. Please try again.', 'fail', 'top-right', true, false);
  } finally {
    submitRequestBtn.removeAttr('data-activating');
  }
}
