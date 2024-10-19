import { validateAttachment } from './utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const optionName = daftplugAdmin.attr('data-option-name');
const jsVars = window[optionName + '_admin_js_vars'] || { settings: {} };

export function initAppShortcutIconUpload() {
  jQuery(window).on('load', () => {
    handleAppShortcutIconUpload();
    populateInitialShortcutIcons();
  });
}

function handleAppShortcutIconUpload() {
  const settingAppShortcuts = daftplugAdmin.find('#settingAppShortcuts');

  settingAppShortcuts.on('click', '[data-file-upload]', function (e) {
    e.preventDefault();
    const self = jQuery(this);
    const attachmentPlaceholder = self.find('[data-attachment-placeholder]');
    const attachmentHolder = self.find('[data-attachment-holder]');
    const appShortcutIconInput = self.find('input[type="text"]');
    const mimes = appShortcutIconInput.attr('data-mimes');
    const maxWidth = appShortcutIconInput.attr('data-max-width');
    const minWidth = appShortcutIconInput.attr('data-min-width');
    const maxHeight = appShortcutIconInput.attr('data-max-height');
    const minHeight = appShortcutIconInput.attr('data-min-height');

    let frame;

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select or upload an App Shortcut Icon',
      button: {
        text: 'Select App Shortcut Icon',
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
      appShortcutIconInput.val(attachment.id);
      attachmentHolder.attr('src', imageSrc);
      attachmentHolder.removeClass('hidden');
      attachmentPlaceholder.addClass('hidden');
    });

    frame.open();
  });
}

function populateInitialShortcutIcons() {
  const elements = daftplugAdmin.find('[data-dp-copy-markup-target^="appShortcut"]');

  elements.each(function (index, el) {
    const appShortcutIconInput = jQuery(el).find('input[name*="[icon]"]');
    const attachmentHolder = jQuery(el).find('[data-attachment-holder]');
    const attachmentPlaceholder = jQuery(el).find('[data-attachment-placeholder]');
    const attachmentLoader = jQuery(el).find('[data-attachment-loader]');
    let imageID;

    JSON.parse(JSON.stringify(jsVars.settings), (key, value) => {
      if (key === 'appShortcuts') {
        imageID = value[index]?.icon;
      }
      return value;
    });

    if (imageID) {
      attachmentPlaceholder.addClass('hidden');
      attachmentLoader.removeClass('hidden');

      wp.media
        .attachment(imageID)
        .fetch()
        .then(function () {
          const imageSrc = wp.media.attachment(imageID).get('url');
          if (imageSrc) {
            attachmentLoader.addClass('hidden');
            attachmentHolder.attr('src', imageSrc);
            attachmentHolder.removeClass('hidden');
          } else {
            appShortcutIconInput.val('');
          }
        })
        .catch(() => {
          appShortcutIconInput.val('');
          console.error('App icon attachment has a problem');
        });
    }
  });
}
