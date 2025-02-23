import jQuery from '../components/utils.js';
import showToast from '../components/toast.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');

export function initSupportRequest() {
  handleProblemAttachments();
  daftplugAdmin.find('form[name="supportForm"]').on('submit', sendSupportRequest);
}

function handleProblemAttachments() {
  const $attachmentsInput = daftplugAdmin.find('#problemAttachments');
  const $attachmentsHolder = daftplugAdmin.find('#problemAttachmentsHolder');
  let attachmentCount = 0;

  $attachmentsInput.on('change', function (e) {
    const files = e.target.files;
    for (let i = 0; i < files.length; i++) {
      if (attachmentCount >= 5) {
        alert('You can only upload a maximum of 5 files.');
        break;
      }
      const file = files[i];
      if (!file.type.startsWith('image/')) {
        alert('You can attach only images.');
        continue;
      }
      attachmentCount++;
      addAttachmentPreview(file);
    }
    // Reset the file input
    $attachmentsInput.val('');
  });

  function addAttachmentPreview(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const $attachmentEl = createAttachmentElement(e.target.result, file.name);
      $attachmentsHolder.append($attachmentEl);
    };
    reader.readAsDataURL(file);
  }

  function createAttachmentElement(dataUrl, fileName) {
    const $attachment = jQuery(`
      <div class="flex flex-nowrap items-center relative z-10 bg-white border border-gray-200 rounded-full p-0.5 dark:bg-neutral-900 dark:border-neutral-700">
        <div class="size-5 me-1 flex items-center justify-center">
            <img class="inline-block rounded-full object-cover size-full" src="${dataUrl}" alt="${fileName}">
        </div>
        <div class="text-xs whitespace-nowrap text-gray-800 dark:text-neutral-200">${fileName.length > 8 ? fileName.substring(0, 5) + '...' : fileName}</div>
        <div class="inline-flex shrink-0 justify-center items-center size-4 ms-2 rounded-full text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm dark:bg-neutral-700/50 dark:hover:bg-neutral-700 dark:text-neutral-400 cursor-pointer" data-remove>
            <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </div>
      </div>
    `);

    $attachment.find('[data-remove]').on('click', function () {
      $attachment.remove();
      attachmentCount--;
    });

    return $attachment;
  }
}

async function sendSupportRequest(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const supportFormData = form.daftplugSerialize();
  const parsedFormData = JSON.parse(supportFormData);

  // Add file attachments
  parsedFormData.problemAttachments = [];
  form.find('#problemAttachmentsHolder img').each(function () {
    parsedFormData.problemAttachments.push({
      dataUrl: jQuery(this).attr('src'),
      name: jQuery(this).attr('alt'),
    });
  });

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
      throw new Error('Network response was not ok');
    }

    const data = await response.json();

    if (data.status === 'success') {
      form.trigger('reset');
      form.find('#problemAttachmentsHolder [data-remove]').trigger('click');
      showToast('Success', 'Support request have submitted successfully!', 'success', 'top-right', true, false);
    } else {
      showToast('Fail', 'Support request have failed to be submitted!', 'fail', 'top-right', true, false);
    }
  } catch (error) {
    showToast('Fail', error.message, 'fail', 'top-right', true, false);
  } finally {
    submitRequestBtn.removeAttr('data-submitting');
    intractableComponents.removeAttr('data-disabled');
  }
}
