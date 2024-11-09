import { validateAttachment } from '../components/utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');

export function initPushImageUpload() {
  jQuery(window).on('load', handlePushImageUpload);
}

export function handlePushImageUpload() {
  const sendPushPopup = daftplugAdmin.find('#send-notification-popup');
  const pushImageUploadBtn = sendPushPopup.find('[data-file-upload-btn]');
  const pushImageDeleteBtn = sendPushPopup.find('[data-file-delete-btn]');
  const attachmentPlaceholder = sendPushPopup.find('[data-attachment-placeholder]');
  const attachmentHolder = sendPushPopup.find('[data-attachment-holder]');
  const pushImageInput = sendPushPopup.find('[data-file-upload-input]');
  const iconContainer = attachmentHolder.closest('.group');
  const mimes = pushImageInput.attr('data-mimes');
  const maxWidth = pushImageInput.attr('data-max-width');
  const minWidth = pushImageInput.attr('data-min-width');
  const maxHeight = pushImageInput.attr('data-max-height');
  const minHeight = pushImageInput.attr('data-min-height');
  const imageSrc = attachmentHolder.attr('src');

  function updateUIState() {
    if (pushImageInput.val() && attachmentHolder.attr('src')) {
      attachmentHolder.removeClass('hidden');
      attachmentPlaceholder.addClass('hidden');
      iconContainer.removeClass('hidden');
    } else {
      attachmentHolder.addClass('hidden');
      attachmentPlaceholder.removeClass('hidden');
      iconContainer.addClass('hidden');
    }
  }

  if (imageSrc) {
    fetch(imageSrc, { method: 'HEAD' })
      .then((response) => {
        if (response.ok) {
          updateUIState();
        } else {
          pushImageInput.val('');
          updateUIState();
        }
      })
      .catch(() => {
        pushImageInput.val('');
        updateUIState();
        console.error('App icon attachment has a problem');
      });
  } else {
    updateUIState();
  }

  pushImageUploadBtn.on('click', function (e) {
    e.preventDefault();
    let frame;

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select or upload a notification image',
      button: {
        text: 'Select Notification Image',
      },
      multiple: false,
    });

    frame.on('select', function () {
      const attachment = frame.state().get('selection').first().toJSON();
      const errors = validateAttachment(attachment, mimes, maxWidth, minWidth, maxHeight, minHeight);

      if (errors.length) {
        alert(errors.join('\n\n'));
        return;
      }

      const imageSrc = attachment.url;
      pushImageInput.val(attachment.id);
      attachmentHolder.attr('src', imageSrc);
      updateUIState();
    });

    frame.open();
  });

  pushImageDeleteBtn.on('click', function (e) {
    e.preventDefault();
    pushImageInput.val('');
    attachmentHolder.attr('src', '');
    updateUIState();
  });
}
