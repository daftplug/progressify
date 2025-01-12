import jQuery from '../components/utils.js';
import showToast from '../components/toast.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const optionName = daftplugAdmin.attr('data-option-name');
const slug = daftplugAdmin.attr('data-slug');
const jsVars = window[optionName + '_admin_js_vars'];
const { __ } = wp.i18n;

export function initModalPushNotifications() {
  daftplugAdmin.find('form[id="send-notification-popup"]').on('submit', doModalPushNotification);
  daftplugAdmin.find('form[id="send-notification-popup"] #previewPushNotification').on('click', previewPushNotification);
}

function doModalPushNotification(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const parsedData = JSON.parse(form.daftplugSerialize());
  const sendNotificationBtn = form.find('button[type="submit"]');
  const intractableComponents = daftplugAdmin.find('header, aside, main, footer');

  sendNotificationBtn.attr('data-sending', true);
  intractableComponents.attr('data-disabled', true);

  const requestBody = JSON.stringify({
    notificationData: parsedData.pushNotifications.notification,
  });

  fetch(wpApiSettings.root + slug + '/doModalPushNotification', {
    method: 'POST',
    headers: {
      'X-WP-Nonce': wpApiSettings.nonce,
      'Content-Type': 'application/json',
    },
    body: requestBody,
  })
    .then((response) => response.json())
    .then((response) => {
      sendNotificationBtn.removeAttr('data-sending');
      intractableComponents.removeAttr('data-disabled');

      if (response.status === '1') {
        showToast('Success', response.message, 'success', 'top-right', false, true);
        form.trigger('reset');
        form.find('[data-file-delete-btn]').trigger('click');
        form.find('[data-dp-copy-markup-delete="actionButton1"]').trigger('click');
      } else {
        throw new Error(response.message || 'Server error');
      }
    })
    .catch((error) => {
      sendNotificationBtn.removeAttr('data-sending');
      intractableComponents.removeAttr('data-disabled');
      showToast('Fail', error.message || __('Sending failed. There was an error on server.', slug), 'fail', 'top-right', true, false);
    });
}

function previewPushNotification(e) {
  e.preventDefault();
  const form = jQuery(e.target).closest('form');

  // Gather notification data
  const notificationData = {
    title: form.find('[name="pushNotifications[notification][title]"]').val() || '',
    body: form.find('[name="pushNotifications[notification][message]"]').val() || '',
    image: form.find('[data-attachment-holder]').attr('src') || '',
    icon: jsVars.iconUrl || '',
    tag: 'notification',
    renotify: true,
    requireInteraction: form.find('[name="pushNotifications[notification][persistent]"]').is(':checked'),
    vibrate: form.find('[name="pushNotifications[notification][vibration]"]').is(':checked') ? [200, 100, 200] : [],
  };

  // Check browser support
  if (!('Notification' in window)) {
    showToast('Fail', __('Notifications are not supported by your browser.', slug), 'fail', 'top-right', true, false);
    return;
  }

  // Handle permissions
  if (Notification.permission === 'granted') {
    new Notification(notificationData.title, notificationData);
  } else if (Notification.permission === 'default') {
    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
        new Notification(notificationData.title, notificationData);
      } else {
        showToast('Fail', __('You need to accept the notifications permission to preview.', slug), 'fail', 'top-right', true, false);
      }
    });
  } else {
    showToast('Fail', __('Push notifications are blocked by your browser.', slug), 'fail', 'top-right', true, false);
  }
}
