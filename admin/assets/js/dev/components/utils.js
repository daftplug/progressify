import { config } from '../admin.js';

export function navigateToPage(pageId, subPageId = '', scrollToTop = true) {
  const allPages = config.daftplugAdminElm.find('[data-page-id]');
  const allMenuItems = config.daftplugAdminElm.find('nav a[data-page-id]');
  const allSubpages = config.daftplugAdminElm.find('[data-subpage-id]');
  const allSubmenuItems = config.daftplugAdminElm.find('nav a[data-subpage-id]');
  const page = allPages.filter(`[data-page-id="${pageId}"]`);
  const menuItem = allMenuItems.filter(`[data-page-id="${pageId}"]`);
  const subPage = allSubpages.filter(`[data-subpage-id="${pageId}-${subPageId}"]`);
  const submenuItem = allSubmenuItems.filter(`[data-subpage-id="${pageId}-${subPageId}"]`);
  const hasSubpages = page.find('[data-subpage-id]').length;
  const firstSubpage = page.find('[data-subpage-id]').first();
  const firstSubpageId = firstSubpage.attr('data-subpage-id');
  const firstSubmenuItem = menuItem.find('a[data-subpage-id]').first();
  const errorPage = allPages.filter('[data-page-id="error"]');

  return new Promise((resolve) => {
    // Function to update URL hash
    const updateHash = (hash) => {
      const currentHash = location.hash;
      if (currentHash !== hash) {
        location.hash = hash;
      }
    };

    if (page.length) {
      allPages.removeAttr('data-active');
      page.attr('data-active', 'true');
      if (hasSubpages) {
        if (subPageId !== '') {
          if (subPage.length) {
            allSubpages.add(allSubmenuItems).add(allMenuItems).removeAttr('data-active');
            subPage.add(submenuItem).attr('data-active', 'true');
            updateHash(`#/${pageId}-${subPageId}`);
          } else {
            allPages.add(allMenuItems).add(allSubmenuItems).removeAttr('data-active');
            errorPage.attr('data-active', 'true');
            updateHash('#/error');
          }
        } else {
          firstSubpage.add(firstSubmenuItem).attr('data-active', 'true');
          if (firstSubpageId) {
            const [firstPageId, firstSubId] = firstSubpageId.split('-');
            updateHash(`#/${firstPageId}-${firstSubId}`);
          }
        }
      } else {
        allMenuItems.add(allSubmenuItems).removeAttr('data-active');
        menuItem.attr('data-active', 'true');
        updateHash(`#/${pageId}`);
      }
    } else {
      allPages.add(allMenuItems).add(allSubmenuItems).removeAttr('data-active');
      errorPage.attr('data-active', 'true');
      updateHash('#/error');
    }

    // Scroll to top of the content only if scrollToTop is true
    if (scrollToTop) {
      config.daftplugAdminElm.find('main#content').scrollTop(0);
    }

    setTimeout(resolve, 0);
  });
}

export function highlightElement(selector) {
  const element = document.querySelector(selector);
  if (!element) return;

  const originalStyles = {
    zIndex: element.style.zIndex,
    position: element.style.position,
    background: element.style.background,
    boxShadow: element.style.boxShadow,
    borderRadius: element.style.borderRadius,
  };

  const createOverlay = () => {
    const overlay = document.createElement('div');
    overlay.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      transition: opacity 0.3s ease-in-out;
      z-index: 999999;
      pointer-events: none;
    `;
    return overlay;
  };

  const spotlight = () => {
    return new Promise((resolve) => {
      const overlay = createOverlay();
      config.daftplugAdminElm[0].appendChild(overlay);
      element.style.cssText = `
        z-index: 9999999999999999999 !important;
        position: relative !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 15px #ffffff !important;
        border-radius: 4px !important;
      `;

      requestAnimationFrame(() => {
        overlay.style.opacity = '1';
        setTimeout(() => {
          overlay.style.opacity = '0';
          overlay.addEventListener(
            'transitionend',
            () => {
              Object.keys(originalStyles).forEach((key) => {
                element.style[key] = originalStyles[key];
              });
              overlay.remove();
              resolve();
            },
            { once: true }
          );
        }, 1000);
      });
    });
  };

  const scrollIntoViewPromise = new Promise((resolve) => {
    const observer = new IntersectionObserver(
      (entries) => {
        const [entry] = entries;
        if (entry.isIntersecting) {
          observer.disconnect();
          resolve();
        }
      },
      {
        threshold: 1.0,
        rootMargin: '-10% 0px',
      }
    );

    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
    observer.observe(element);
  });

  scrollIntoViewPromise
    .then(() => spotlight())
    .catch((error) => {
      console.error('Error during highlight animation:', error);
    });
}

export function findAndHighlightElement(selector) {
  const element = document.querySelector(selector);
  if (!element) return Promise.reject(new Error('Element not found'));

  // Find the parent section with data-page-id
  let parentSection = element.closest('section[data-page-id]');
  if (!parentSection) {
    // If no direct section parent, try to find any ancestor with data-page-id
    parentSection = element.closest('[data-page-id]');
  }

  if (!parentSection) {
    // If still not found, just highlight the element without navigation
    return new Promise((resolve) => {
      highlightElement(selector);
      resolve();
    });
  }

  const pageId = parentSection.getAttribute('data-page-id');

  // Find if there's a subpage ID
  const subPageElement = element.closest('[data-subpage-id]');
  let subPageId = '';

  if (subPageElement) {
    const fullSubpageId = subPageElement.getAttribute('data-subpage-id');
    // The format is typically pageId-subPageId, so extract just the subPageId
    const parts = fullSubpageId.split('-');
    if (parts.length > 1) {
      subPageId = parts[1];
    }
  }

  // Navigate to the page without scrolling to top
  return navigateToPage(pageId, subPageId, false).then(() => {
    // After navigation completes, find the element again (as DOM might have changed)
    const updatedElement = document.querySelector(selector);
    if (updatedElement) {
      highlightElement(selector);
    }
  });
}

export function validateAttachment(attachment, mimes, maxWidth, minWidth, maxHeight, minHeight) {
  const errors = [];

  if (mimes && mimes !== '') {
    const mimesArray = mimes.split(',');
    const fileMime = attachment.subtype;
    if (!mimesArray.includes(fileMime)) {
      errors.push('This file should be one of the following file types:\n' + mimes);
    }
  }

  if (maxHeight && attachment.height > parseInt(maxHeight)) {
    errors.push("Image can't be higher than " + maxHeight + 'px.');
  }

  if (minHeight && attachment.height < parseInt(minHeight)) {
    errors.push('Image should be at least ' + minHeight + 'px high.');
  }

  if (maxWidth && attachment.width > parseInt(maxWidth)) {
    errors.push("Image can't be wider than " + maxWidth + 'px.');
  }

  if (minWidth && attachment.width < parseInt(minWidth)) {
    errors.push('Image should be at least ' + minWidth + 'px wide.');
  }

  return errors;
}

jQuery.fn.daftplugSerialize = function () {
  var data = {};

  function assignNestedData(obj, keys, value) {
    var current = obj;
    for (var i = 0; i < keys.length; i++) {
      var key = keys[i];
      if (key === '') continue;
      if (i === keys.length - 1) {
        current[key] = value;
      } else {
        if (!current[key] || typeof current[key] !== 'object') {
          current[key] = {};
        }
        current = current[key];
      }
    }
  }

  // Handle all form elements
  this.find('input, select, textarea').each(function () {
    var $el = jQuery(this);
    var name = $el.attr('name');
    if (!name) return;

    var keys = name.split('[').map((key) => key.replace(']', ''));
    var value;

    if ($el.is(':checkbox')) {
      value = $el.is(':checked') ? $el.val() || 'on' : 'off';
    } else if ($el.is(':radio')) {
      if ($el.is(':checked')) {
        value = $el.val();
      } else {
        return; // Skip unchecked radio buttons
      }
    } else if ($el.is('select[multiple]')) {
      value = $el.val() || [];
    } else {
      value = $el.val();
    }

    try {
      assignNestedData(data, keys, value);
    } catch (error) {
      console.error('Error assigning data for field:', name, 'with value:', value, 'Error:', error);
    }
  });

  try {
    return JSON.stringify(data);
  } catch (error) {
    console.error('Error stringifying data:', error);
    console.log('Data that failed to stringify:', data);
    throw error;
  }
};

export default jQuery;
