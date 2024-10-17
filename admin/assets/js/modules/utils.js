const daftplugAdmin = jQuery('#daftplugAdmin');

export function navigateTo(pageId, subPageId = '') {
  const allPages = daftplugAdmin.find('section[data-page-id]');
  const allMenuItems = daftplugAdmin.find('a[data-page-id]');
  const allSubpages = daftplugAdmin.find('article[data-subpage-id]');
  const allSubmenuItems = daftplugAdmin.find('a[data-subpage-id]');

  const page = allPages.filter(`[data-page-id="${pageId}"]`);
  const menuItem = allMenuItems.filter(`[data-page-id="${pageId}"]`);
  const subPage = allSubpages.filter(`[data-subpage-id="${pageId}-${subPageId}"]`);
  const submenuItem = allSubmenuItems.filter(`[data-subpage-id="${pageId}-${subPageId}"]`);
  const hasSubpages = page.find('article[data-subpage-id]').length;
  const firstSubpage = page.find('article[data-subpage-id]').first();
  const firstSubpageId = firstSubpage.attr('data-subpage-id');
  const firstSubmenuItem = menuItem.find('a[data-subpage-id]').first();
  const errorPage = allPages.filter('[data-page-id="error"]');

  if (page.length) {
    allPages.removeAttr('data-active');
    page.attr('data-active', 'true');
    if (hasSubpages) {
      if (subPageId !== '') {
        if (subPage.length) {
          allSubpages.add(allSubmenuItems).add(allMenuItems).removeAttr('data-active');
          subPage.add(submenuItem).attr('data-active', 'true');
        } else {
          allPages.add(allMenuItems).add(allSubmenuItems).removeAttr('data-active');
          errorPage.attr('data-active', 'true');
        }
      } else {
        firstSubpage.add(firstSubmenuItem).attr('data-active', 'true');
        if (firstSubpageId) {
          location.hash = `#/${firstSubpageId}/`;
        }
      }
    } else {
      allMenuItems.add(allSubmenuItems).removeAttr('data-active');
      menuItem.attr('data-active', 'true');
    }
  } else {
    allPages.add(allMenuItems).add(allSubmenuItems).removeAttr('data-active');
    errorPage.attr('data-active', 'true');
  }
}

// Validates attachments
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

// SerializeForm
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

    console.log('Processing field:', name); // Debug log

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

    console.log('Field value:', value); // Debug log

    try {
      assignNestedData(data, keys, value);
    } catch (error) {
      console.error('Error assigning data for field:', name, 'with value:', value, 'Error:', error);
    }
  });

  console.log('Final data object:', data); // Debug log

  try {
    return JSON.stringify(data);
  } catch (error) {
    console.error('Error stringifying data:', error);
    console.log('Data that failed to stringify:', data);
    throw error;
  }
};

export default jQuery;
