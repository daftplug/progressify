import jQuery from '../components/utils.js';
import showToast from '../components/toast.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');
const { __ } = wp.i18n;

export function initSupportRequest() {
  daftplugAdmin.find('form[name="supportForm"]').on('submit', sendSupportRequest);
}

async function sendSupportRequest(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const supportFormData = form.daftplugSerialize();
  const parsedFormData = JSON.parse(supportFormData);

  const submitRequestBtn = form.find('button[type="submit"]');
  const intractableComponents = daftplugAdmin.find('header, aside, main, footer');

  submitRequestBtn.attr('data-submitting', true);
  intractableComponents.attr('data-disabled', true);

  const requestBody = JSON.stringify({
    supportRequest: parsedFormData,
  });

  try {
    const response = await fetch(wpApiSettings.root + slug + '/submitSupportRequest', {
      method: 'POST',
      headers: {
        'X-WP-Nonce': wpApiSettings.nonce,
        'Content-Type': 'application/json',
      },
      body: requestBody,
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error('Support request failed:', {
        status: response.status,
        statusText: response.statusText,
        responseText: errorText,
      });
      throw new Error(`Server error (${response.status}): ${errorText || 'No error details available'}`);
    }

    const data = await response.json();

    if (data.status === 'success') {
      form.trigger('reset');
      showToast(__('Success', slug), __('Support request have submitted successfully!', slug), 'success', 'top-right', true, false);
    } else {
      showToast(__('Fail', slug), __('Support request have failed to be submitted!', slug), 'fail', 'top-right', true, false);
    }
  } catch (error) {
    showToast('Fail', error.message, 'fail', 'top-right', true, false);
  } finally {
    submitRequestBtn.removeAttr('data-submitting');
    intractableComponents.removeAttr('data-disabled');
  }
}
