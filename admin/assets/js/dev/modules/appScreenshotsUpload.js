import { validateAttachment } from '../components/utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const optionName = daftplugAdmin.attr('data-option-name');
const jsVars = window[optionName + '_admin_js_vars'] || { settings: {} };

export function initAppScreenshotsUpload() {
  handleAppScreenshotsUpload();
}

export function handleAppScreenshotsUpload() {
  const settingAppScreenshots = daftplugAdmin.find('#settingAppScreenshots');
  const appScreenshotsUploadBtn = settingAppScreenshots.find('[data-file-upload]');
  const screenshotsContainer = settingAppScreenshots.find('[data-screenshots-container]');
  const dropzone = settingAppScreenshots.find('[data-attachment-dropzone]');
  const maxFiles = 5;

  const defaultScreenshots = [`https://s0.wp.com/mshots/v1/${jsVars.settings.webAppManifest?.displaySettings?.startPage}?vpw=750&vph=1334&format=png`, `https://s0.wp.com/mshots/v1/${jsVars.settings.webAppManifest?.displaySettings?.startPage}?vpw=1280&vph=800&format=png`];

  function initializeScreenshots() {
    const savedScreenshots = jsVars.settings.webAppManifest?.appIdentity?.appScreenshots || [];
    screenshotsContainer.empty();

    if (savedScreenshots.length === 0) {
      addDefaultScreenshots();
    } else {
      const promises = savedScreenshots.map((attachmentId) =>
        fetchAttachmentUrl(attachmentId).then((url) => {
          if (url) {
            addScreenshot(url, attachmentId, false);
          } else {
            console.error(`Failed to fetch URL for attachment ID: ${attachmentId}`);
          }
        })
      );

      Promise.all(promises).then(() => {
        updateInputFields();
      });
    }
  }

  function fetchAttachmentUrl(attachmentId) {
    return new Promise((resolve) => {
      wp.media
        .attachment(attachmentId)
        .fetch()
        .then(function () {
          const imageSrc = wp.media.attachment(attachmentId).get('url');
          resolve(imageSrc);
        })
        .catch(() => {
          console.error(`Screenshot attachment ${attachmentId} has a problem`);
          resolve(null);
        });
    });
  }

  function addDefaultScreenshots() {
    defaultScreenshots.forEach((screenshot) => {
      addScreenshot(screenshot, '', true);
    });
  }

  function addScreenshot(imgSrc, attachmentId, isDefault = false) {
    // Prevent duplicates for user-uploaded screenshots
    if (!isDefault && attachmentId) {
      const existingImg = screenshotsContainer.find(`img[data-attachment-id="${attachmentId}"]`);
      if (existingImg.length > 0) {
        alert('This screenshot is already added.');
        return;
      }
    }

    if (!isDefault) {
      // Remove default screenshots if present
      screenshotsContainer.find('div[data-is-default="true"]').remove();
    }

    const screenshotElement = createScreenshotElement(imgSrc, attachmentId, isDefault);
    screenshotsContainer.append(screenshotElement);
    updateInputFields();
  }

  function updateInputFields() {
    // Remove all existing input fields
    settingAppScreenshots.find('input[name^="webAppManifest[appIdentity][appScreenshots]"]').remove();

    const screenshotDivs = screenshotsContainer.find('div[data-is-default]');
    let index = 0;
    screenshotDivs.each((_, div) => {
      const $div = jQuery(div);
      const isDefault = $div.attr('data-is-default') === 'true';

      if (!isDefault) {
        const $img = $div.find('img');
        const attachmentId = $img.attr('data-attachment-id');

        if (attachmentId) {
          const inputField = jQuery('<input>', {
            class: 'hidden',
            type: 'hidden',
            name: `webAppManifest[appIdentity][appScreenshots][${index}]`,
            value: attachmentId,
          });
          screenshotsContainer.after(inputField);
          index++;
        }
      }
    });

    // If there are no user-uploaded screenshots, indicate an empty array
    if (index === 0) {
      const inputField = jQuery('<input>', {
        type: 'hidden',
        name: 'webAppManifest[appIdentity][appScreenshots]',
        value: '', // Empty value to represent an empty array
      });
      screenshotsContainer.after(inputField);
    }
  }

  appScreenshotsUploadBtn.on('click', function (e) {
    e.preventDefault();
    let frame = wp.media({
      title: 'Select or upload App Screenshots',
      button: {
        text: 'Select Screenshots',
      },
      multiple: true,
    });

    frame.on('select', function () {
      const attachments = frame.state().get('selection').toJSON();

      if (!canAddMoreScreenshots(attachments.length)) {
        return;
      }

      attachments.forEach((attachment) => {
        const errors = validateAttachment(attachment, 'png', '3840', '320', '3840', '320');

        if (errors.length) {
          alert(errors.join('\n\n'));
          return;
        }

        addScreenshot(attachment.url, attachment.id, false);
      });

      updateInputFields();
    });

    frame.open();
  });

  dropzone.on('dragover', (e) => {
    e.preventDefault();
    dropzone.addClass('bg-gray-200');
  });

  dropzone.on('dragleave', () => {
    dropzone.removeClass('bg-gray-200');
  });

  dropzone.on('drop', (e) => {
    e.preventDefault();
    dropzone.removeClass('bg-gray-200');

    const files = e.originalEvent.dataTransfer.files;

    if (!canAddMoreScreenshots(files.length)) {
      return;
    }

    jQuery.each(files, (_, file) => {
      uploadFile(file);
    });
  });

  function canAddMoreScreenshots(countToAdd) {
    const currentCount = screenshotsContainer.find('div[data-is-default="false"]').length;
    if (currentCount + countToAdd > maxFiles) {
      alert(`You can only upload up to ${maxFiles} screenshots.`);
      return false;
    }
    return true;
  }

  function createScreenshotElement(imgSrc, attachmentId, isDefault = false) {
    const uniqueId = 'dismiss-img' + Date.now() + Math.floor(Math.random() * 1000);
    const screenshotDiv = jQuery('<div>', {
      class: 'relative',
      id: uniqueId,
      'data-is-default': isDefault ? 'true' : 'false',
    });

    const innerDiv = jQuery('<div>', {
      class: 'flex-shrink-0 relative rounded-xl overflow-hidden w-full h-36 !border',
    });

    const img = jQuery('<img>', {
      class: 'size-full absolute top-0 start-0 object-cover rounded-xl',
      src: imgSrc,
      alt: 'App Screenshot',
      'data-attachment-id': attachmentId,
    });

    innerDiv.append(img);
    screenshotDiv.append(innerDiv);

    if (!isDefault) {
      // Only add the remove button for non-default screenshots
      const buttonDiv = jQuery('<div>', {
        class: 'absolute top-2 end-2 z-10',
      });

      const button = jQuery('<button>', {
        type: 'button',
        class: 'size-5 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'data-hs-remove-element': `#${uniqueId}`,
      });

      const svg = jQuery(document.createElementNS('http://www.w3.org/2000/svg', 'svg')).attr({
        class: 'flex-shrink-0 size-3',
        viewBox: '0 0 24 24',
        fill: 'none',
        stroke: 'currentColor',
        'stroke-width': '2',
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
      });

      const path1 = jQuery(document.createElementNS('http://www.w3.org/2000/svg', 'path')).attr({
        d: 'M18 6L6 18',
      });

      const path2 = jQuery(document.createElementNS('http://www.w3.org/2000/svg', 'path')).attr({
        d: 'M6 6L18 18',
      });

      svg.append(path1, path2);
      button.append(svg);
      buttonDiv.append(button);
      screenshotDiv.append(buttonDiv);

      button.on('click', function () {
        screenshotDiv.remove();
        updateInputFields();

        // Check if any manually added screenshots remain
        const manualScreenshots = screenshotsContainer.find('div[data-is-default="false"]');
        if (manualScreenshots.length === 0) {
          // No manually added screenshots, add default screenshots
          addDefaultScreenshots();
        }
      });
    }

    return screenshotDiv;
  }

  function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('action', 'upload-attachment');
    formData.append('post_id', 0);

    fetch(wpApiSettings.root + 'wp/v2/media', {
      method: 'POST',
      body: formData,
      credentials: 'same-origin',
      headers: {
        'X-WP-Nonce': wpApiSettings.nonce,
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.id) {
          const attachment = data;
          addScreenshot(attachment.source_url, attachment.id, false);
          updateInputFields();
        } else {
          alert('Failed to upload the image.');
        }
      })
      .catch((error) => {
        console.error('Error uploading file:', error);
        alert('An error occurred while uploading the file.');
      });
  }

  initializeScreenshots();
}
