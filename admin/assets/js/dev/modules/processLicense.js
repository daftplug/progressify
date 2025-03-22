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

    // First get the raw response text
    const responseText = await response.text();

    // Look for JSON at the end of the response, even if there's other content
    const jsonMatch = responseText.match(/\{.*\}/s);
    if (jsonMatch) {
      try {
        const jsonStr = jsonMatch[0];
        const data = JSON.parse(jsonStr);
        return data;
      } catch (e) {
        console.error('Failed to extract JSON from response:', e);
      }
    }

    // If we can't find valid JSON in the response, try to parse the whole thing
    try {
      const data = JSON.parse(responseText);
      return data;
    } catch (jsonError) {
      console.error('Failed to parse server response as JSON:', jsonError);
      throw new Error('The server returned an invalid response. Please try again or contact support.');
    }
  } catch (error) {
    console.error('Request processing error:', error);
    throw error;
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
      showToast('Fail', response.message || 'License activation failed.', 'fail', 'top-right', true, false);
    } else {
      showToast('Fail', 'Invalid response from the server. Please try again.', 'fail', 'top-right', true, false);
    }
  } catch (error) {
    console.error('License activation error:', error);
    showToast('Fail', `Error: ${error.message}`, 'fail', 'top-right', true, false);
  } finally {
    submitRequestBtn.removeAttr('data-activating');
  }
}
