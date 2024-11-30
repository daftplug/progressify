const daftplugAdmin = jQuery('#daftplugAdmin');

export default function showToast(title, description, type, position = 'bottom-right', autodismiss = true, dismissible = false, actionMarkup = '') {
  const icons = {
    success: `<svg class="flex-shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
              </svg>`,
    info: `<svg class="flex-shrink-0 size-4 text-blue-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
          </svg>`,
    fail: `<svg class="flex-shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
          </svg>`,
    warning: `<svg class="flex-shrink-0 size-4 text-yellow-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path>
            </svg>`,
  };

  const positions = {
    'top-left': ['top-16', 'start-7'],
    'top-right': ['top-16', 'end-7'],
    'bottom-left': ['bottom-8', 'start-7'],
    'bottom-right': ['bottom-8', 'end-7'],
  };

  const positionClasses = positions[position];
  const positionSelector = positionClasses.map((cls) => `.${cls}`).join('');
  let toastWrapper = daftplugAdmin.find(`.toast-wrapper${positionSelector.replace(/\s/g, '.')}`);

  if (!toastWrapper.length) {
    toastWrapper = jQuery(`<div class="toast-wrapper fixed ${positionClasses.join(' ')} space-y-3 z-[99999]"></div>`);
    daftplugAdmin.append(toastWrapper);
  }

  const toast = jQuery('<div>', {
    class: 'relative max-w-xs overflow-hidden bg-white border border-gray-200 border-b-0 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700 p-4 pb-5 transition-opacity duration-200 ease-in-out opacity-0',
    role: 'alert',
  });

  const toastContent = jQuery('<div>', { class: 'flex' });

  const iconContainer = jQuery('<div>', {
    class: 'flex-shrink-0',
    html: icons[type],
  });
  toastContent.append(iconContainer);

  const contentContainer = jQuery('<div>', { class: 'ms-3 me-5' });

  if (title) {
    const titleElement = jQuery('<h3>', {
      class: 'text-gray-800 font-semibold dark:text-white text-base leading-5',
      text: title,
    });
    contentContainer.append(titleElement);
  }

  if (description) {
    const descriptionElement = jQuery('<div>', {
      class: 'mt-1 text-sm text-gray-600 dark:text-neutral-400',
      text: description,
    });
    contentContainer.append(descriptionElement);
  }

  if (actionMarkup) {
    const actionsElement = jQuery('<div>', {
      class: 'mt-4',
      html: actionMarkup,
    });
    contentContainer.append(actionsElement);
  }

  toastContent.append(contentContainer);

  if (dismissible) {
    const closeButton = jQuery('<button>', {
      type: 'button',
      class: 'absolute top-3 end-3 inline-flex flex-shrink-0 justify-center items-center size-5 rounded-lg text-gray-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100 dark:text-white',
      html: `<span class="sr-only">Close</span>
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
              </svg>`,
    }).on('click', () => {
      toast.css('opacity', '0');
      setTimeout(() => toast.remove(), 200);
    });
    toastContent.append(closeButton);
  }

  toast.append(toastContent);

  if (autodismiss) {
    const progressBar = jQuery('<div>', {
      class: 'flex absolute left-0 bottom-0 w-full h-1.5 bg-white overflow-hidden dark:bg-neutral-700',
      role: 'progressbar',
      'aria-valuenow': '100',
      'aria-valuemin': '0',
      'aria-valuemax': '100',
      html: '<div class="flex flex-col justify-center overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition-all duration-[3000ms] ease-linear" style="width: 100%"></div>',
    });

    toast.append(progressBar);

    setTimeout(() => {
      progressBar.find('div').css('width', '0%');
      setTimeout(() => {
        toast.css('opacity', '0');
        setTimeout(() => toast.remove(), 200);
      }, 3000);
    }, 10);
  }

  toastWrapper.append(toast);

  setTimeout(() => {
    toast.css('opacity', '1');
  }, 10);
}
