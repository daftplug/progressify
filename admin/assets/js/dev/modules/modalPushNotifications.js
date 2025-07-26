import { config } from '../admin.js';
import jQuery from '../components/utils.js';
import showToast from '../components/toast.js';

export function initModalPushNotifications() {
  config.daftplugAdminElm.find('form[id="send-notification-popup"]').on('submit', doModalPushNotification);
  config.daftplugAdminElm.find('form[id="send-notification-popup"] #previewPushNotification').on('click', previewPushNotification);
}

function doModalPushNotification(e) {
  e.preventDefault();
  const form = jQuery(e.target);
  const parsedData = JSON.parse(form.daftplugSerialize());
  const sendNotificationBtn = form.find('button[type="submit"]');
  const intractableComponents = config.daftplugAdminElm.find('header, aside, button, footer');

  sendNotificationBtn.attr('data-sending', true);
  intractableComponents.attr('data-disabled', true);

  const requestBody = JSON.stringify({
    notificationData: parsedData.pushNotifications.notification,
  });

  fetch(wpApiSettings.root + config.jsVars.slug + '/doModalPushNotification', {
    method: 'POST',
    headers: {
      'X-WP-Nonce': wpApiSettings.nonce,
      'Content-Type': 'application/json',
    },
    body: requestBody,
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.status === '1') {
        form.trigger('reset');
        form.find('[data-file-delete-btn]').trigger('click');
        form.find('[data-dp-copy-markup-delete="actionButton1"]').trigger('click');
        showToast('Success', response.message, 'success', 'top-right', true, false);
      } else {
        throw new Error(response.message || 'Server error');
      }
    })
    .catch((error) => {
      showToast('Fail', error.message || wp.i18n.__('Sending failed. There was an error on server.', config.jsVars.slug), 'fail', 'top-right', true, false);
    })
    .finally(() => {
      sendNotificationBtn.removeAttr('data-sending');
      intractableComponents.removeAttr('data-disabled');
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
    icon: config.jsVars.iconUrl || '',
    tag: 'notification',
    renotify: true,
    requireInteraction: form.find('[name="pushNotifications[notification][persistent]"]').is(':checked'),
    vibrate: form.find('[name="pushNotifications[notification][vibration]"]').is(':checked') ? [200, 100, 200] : [],
  };

  // Check browser support
  if (!('Notification' in window)) {
    showToast(wp.i18n.__('Fail', config.jsVars.slug), wp.i18n.__('Notifications are not supported by your browser.', config.jsVars.slug), 'fail', 'top-right', true, false);
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
        showToast(wp.i18n.__('Fail', config.jsVars.slug), wp.i18n.__('You need to accept the notifications permission to preview.', config.jsVars.slug), 'fail', 'top-right', true, false);
      }
    });
  } else {
    showToast(wp.i18n.__('Fail', config.jsVars.slug), wp.i18n.__('Push notifications are blocked by your browser.', config.jsVars.slug), 'fail', 'top-right', true, false);
  }
}
