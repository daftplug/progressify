import { validateAttachment } from './utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const optionName = daftplugAdmin.attr('data-option-name');
const jsVars = window[optionName + '_admin_js_vars'];

export function initAppScreenshotsUpload() {
  jQuery(window).on('load', handleAppScreenshotsUpload);
}

export function handleAppScreenshotsUpload() {
  const settingAppScreenshots = daftplugAdmin.find('#settingAppScreenshots');
  const appScreenshotsUploadBtn = settingAppScreenshots.find('[data-file-upload]');
  const screenshotsContainer = settingAppScreenshots.find('[data-screenshots-container]');
  const dropzone = settingAppScreenshots.find('[data-attachment-dropzone]');
  const maxFiles = 5;

  const defaultScreenshots = [`https://s0.wp.com/mshots/v1/${jsVars.settings.startPage}?vpw=750&vph=1334`, `https://s0.wp.com/mshots/v1/${jsVars.settings.startPage}?vpw=1280&vph=800`];

  const inputs = [settingAppScreenshots.find('#appScreenshot1')[0], settingAppScreenshots.find('#appScreenshot2')[0], settingAppScreenshots.find('#appScreenshot3')[0], settingAppScreenshots.find('#appScreenshot4')[0], settingAppScreenshots.find('#appScreenshot5')[0]];

  function initializeScreenshots() {
    jQuery.each(inputs, (index, input) => {
      let imageSrc = jQuery(input).attr('data-attach-url');
      if (!jQuery(input).val() && index < 2) {
        imageSrc = defaultScreenshots[index];
      }
      if (imageSrc) {
        const screenshotElement = createScreenshotElement(imageSrc, jQuery(input).val(), index);
        screenshotsContainer.append(screenshotElement);
      }
    });
  }

  function reindexScreenshots() {
    const screenshots = screenshotsContainer.find('div[id^="dismiss-img"]');
    screenshots.each((newIndex, screenshot) => {
      jQuery(screenshot).attr('id', `dismiss-img${newIndex}`);
      const button = jQuery(screenshot).find('button[data-hs-remove-element]');
      button.attr('data-hs-remove-element', `#dismiss-img${newIndex}`);
      const img = jQuery(screenshot).find('img');
      const hiddenInput = settingAppScreenshots.find(`#appScreenshot${newIndex + 1}`);
      hiddenInput.val(img.length ? img.attr('data-attachment-id') : '');
    });

    for (let i = screenshots.length; i < maxFiles; i++) {
      const hiddenInput = settingAppScreenshots.find(`#appScreenshot${i + 1}`);
      hiddenInput.val('');
    }
  }

  appScreenshotsUploadBtn.on('click', function (e) {
    e.preventDefault();
    let frame;

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select or upload App Screenshots',
      button: {
        text: 'Select Screenshots',
      },
      multiple: true,
    });

    frame.on('select', function () {
      const attachments = frame.state().get('selection').toJSON();
      const currentScreenshotsCount = screenshotsContainer.find('img').length;

      if (attachments.length + currentScreenshotsCount > maxFiles) {
        alert(`You can only upload up to ${maxFiles} screenshots.`);
        return;
      }

      attachments.forEach((attachment, index) => {
        const currentIndex = index + currentScreenshotsCount;
        const mimes = settingAppScreenshots.find(`#appScreenshot${currentIndex + 1}`).attr('data-mimes');
        const maxWidth = settingAppScreenshots.find(`#appScreenshot${currentIndex + 1}`).attr('data-max-width');
        const minWidth = settingAppScreenshots.find(`#appScreenshot${currentIndex + 1}`).attr('data-min-width');
        const maxHeight = settingAppScreenshots.find(`#appScreenshot${currentIndex + 1}`).attr('data-max-height');
        const minHeight = settingAppScreenshots.find(`#appScreenshot${currentIndex + 1}`).attr('data-min-height');
        const errors = validateAttachment(attachment, mimes, maxWidth, minWidth, maxHeight, minHeight);

        if (errors.length) {
          alert(errors.join('\n\n'));
          return;
        }

        const imgSrc = attachment.url;
        const screenshotElement = createScreenshotElement(imgSrc, attachment.id, currentIndex);
        screenshotsContainer.append(screenshotElement);

        // Update hidden input values
        const hiddenInput = settingAppScreenshots.find(`#appScreenshot${currentIndex + 1}`);
        hiddenInput.val(attachment.id);
      });
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
    if (files.length + screenshotsContainer.find('img').length > maxFiles) {
      alert(`You can only upload up to ${maxFiles} screenshots.`);
      return;
    }

    jQuery.each(files, (index, file) => {
      uploadFile(file);
    });
  });

  function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('action', 'upload-attachment');
    formData.append('post_id', 0); // This can be set to the post ID you want to attach the image to

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
          const imgSrc = attachment.source_url;
          const index = screenshotsContainer.find('img').length;
          const screenshotElement = createScreenshotElement(imgSrc, attachment.id, index);
          screenshotsContainer.append(screenshotElement);

          // Update hidden input values
          const hiddenInput = settingAppScreenshots.find(`#appScreenshot${index + 1}`);
          hiddenInput.val(attachment.id);
        } else {
          alert('Failed to upload the image.');
        }
      })
      .catch((error) => {
        console.error('Error uploading file:', error);
        alert('An error occurred while uploading the file.');
      });
  }

  function createScreenshotElement(imgSrc, attachmentId, index) {
    const screenshotDiv = jQuery('<div>', {
      class: 'relative',
      id: `dismiss-img${index}`,
    });

    const innerDiv = jQuery('<div>', {
      class: 'flex-shrink-0 relative rounded-xl overflow-hidden w-full h-36 !border',
    });

    const img = jQuery('<img>', {
      class: 'size-full absolute top-0 start-0 object-cover rounded-xl',
      src: imgSrc,
      alt: 'Image Description',
      'data-attachment-id': attachmentId,
    });

    const buttonDiv = jQuery('<div>', {
      class: 'absolute top-2 end-2 z-10',
    });

    const button = jQuery('<button>', {
      type: 'button',
      class: 'size-5 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
      'data-hs-remove-element': `#dismiss-img${index}`,
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
      d: 'M18 6 6 18',
    });

    const path2 = jQuery(document.createElementNS('http://www.w3.org/2000/svg', 'path')).attr({
      d: 'M6 6 18 18',
    });

    svg.append(path1, path2);
    button.append(svg);
    buttonDiv.append(button);
    innerDiv.append(img);
    screenshotDiv.append(innerDiv, buttonDiv);

    button.on('click', function () {
      screenshotDiv.remove();
      reindexScreenshots();
    });

    return screenshotDiv;
  }

  initializeScreenshots();
}
