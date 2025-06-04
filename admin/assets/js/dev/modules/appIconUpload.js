import { config } from '../admin.js';
import { validateAttachment } from '../components/utils.js';

export function initAppIconUpload() {
  handleAppIconUpload();
}

export function handleAppIconUpload() {
  const settingAppIcon = config.daftplugAdminElm.find('#settingAppIcon');
  const appIconUploadBtn = settingAppIcon.find('[data-file-upload-btn]');
  const appIconDeleteBtn = settingAppIcon.find('[data-file-delete-btn]');
  const attachmentPlaceholder = settingAppIcon.find('[data-attachment-placeholder]');
  const attachmentHolder = settingAppIcon.find('[data-attachment-holder]');
  const appIconInput = settingAppIcon.find('[data-file-upload-input]');
  const iconContainer = attachmentHolder.closest('.group');
  const mimes = appIconInput.attr('data-mimes');
  const maxWidth = appIconInput.attr('data-max-width');
  const minWidth = appIconInput.attr('data-min-width');
  const maxHeight = appIconInput.attr('data-max-height');
  const minHeight = appIconInput.attr('data-min-height');
  const imageSrc = attachmentHolder.attr('src');

  function updateUIState() {
    if (appIconInput.val() && attachmentHolder.attr('src')) {
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
          appIconInput.val('');
          updateUIState();
        }
      })
      .catch(() => {
        appIconInput.val('');
        updateUIState();
        console.error('App icon attachment has a problem');
      });
  } else {
    updateUIState();
  }

  appIconUploadBtn.on('click', function (e) {
    e.preventDefault();
    let frame;

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select or upload an App Icon',
      button: {
        text: 'Select App Icon',
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
      appIconInput.val(attachment.id);
      attachmentHolder.attr('src', imageSrc);
      updateUIState();
    });

    frame.open();
  });

  appIconDeleteBtn.on('click', function (e) {
    e.preventDefault();
    appIconInput.val('');
    attachmentHolder.attr('src', '');
    updateUIState();
  });
}
