import { config } from '../admin.js';
import { handleSelect } from './select.js';
import { handlePagePathInput } from './pagePathInput.js';

export function initCopyMarkup() {
  handleCopyMarkup();
}

function handleCopyMarkup() {
  config.daftplugAdminElm.find('[data-dp-copy-markup]').each(function () {
    const self = jQuery(this);
    const copyMarkupConfig = JSON.parse(self.attr('data-dp-copy-markup'));
    const wrapper = copyMarkupConfig.wrapper;
    const target = copyMarkupConfig.target;
    const firstShown = copyMarkupConfig.firstShown || false;
    const limit = copyMarkupConfig.limit || Infinity;
    const wrapperElement = config.daftplugAdminElm.find(`[data-dp-copy-markup-wrapper="${wrapper}"]`);
    const targetElements = wrapperElement.find(`[data-dp-copy-markup-target^="${target}"]`);
    const template = targetElements.first().clone().prop('outerHTML');

    // Clear the wrapper and render initial elements based on settings and firstShown
    wrapperElement.empty();

    // Calculate the number of initial elements to render based on settings
    const settingsArray = findKey(config.jsVars.settings, wrapper);
    const initialCount = Math.max(firstShown ? 1 : 0, settingsArray.length);

    for (let i = 0; i < initialCount; i++) {
      const newElement = jQuery(template);
      wrapperElement.append(newElement);
    }

    reindexElements(wrapperElement, wrapper, target);
    populateInitialValues(wrapperElement, target);
    checkLimit();

    // Handle the copy markup button click
    self.on('click', function () {
      const visibleTargets = wrapperElement.find(`[data-dp-copy-markup-target^="${target}"]`);
      if (visibleTargets.length < limit) {
        const newElement = jQuery(template);
        newElement.appendTo(wrapperElement);
        handleSelect();
        handlePagePathInput();
        reindexElements(wrapperElement, wrapper, target);
        checkLimit();
      }
    });

    // Handle the delete button click
    config.daftplugAdminElm.on('click', '[data-dp-copy-markup-delete]', function () {
      const deleteButton = jQuery(this);
      const deleteTarget = deleteButton.attr('data-dp-copy-markup-delete');
      const targetElement = wrapperElement.find(`[data-dp-copy-markup-target="${deleteTarget}"]`);
      targetElement.remove();
      reindexElements(wrapperElement, wrapper, target);
      checkLimit();
    });

    // Check the limit of visible elements and update button states
    function checkLimit() {
      const visibleTargets = wrapperElement.find(`[data-dp-copy-markup-target^="${target}"]`);
      if (visibleTargets.length >= limit) {
        self.attr('data-disabled', true);
      } else {
        self.removeAttr('data-disabled');
      }

      // Ensure the first element is not deletable if firstShown is true and it's the only one left
      if (firstShown && visibleTargets.length === 1) {
        visibleTargets.first().find('[data-dp-copy-markup-delete]').attr('data-disabled', true);
        visibleTargets.first().find(`[name*="${target}"]`).removeAttr('required');
      } else {
        visibleTargets.first().find('[data-dp-copy-markup-delete]').removeAttr('data-disabled');
        visibleTargets.each(function () {
          jQuery(this).find(`[name*="${target}"]`).attr('required', true);
        });
      }
    }

    checkLimit();
  });
}

function reindexElements(wrapperElement, wrapper, target) {
  const elements = wrapperElement.find(`[data-dp-copy-markup-target^="${target}"]`);
  elements.each(function (index, el) {
    const formEls = jQuery(el).find(`[name*="${target}"]`);
    formEls.each(function () {
      const formEl = jQuery(this);
      const name = formEl.attr('name');
      const newName = name.replace(new RegExp(`(\\[${wrapper}\\])(\\[\\d*\\])?`), `$1[${index}]`);
      formEl.attr('name', newName);
    });

    jQuery(el).attr('data-dp-copy-markup-target', `${target}${index}`);
    jQuery(el).find('[data-dp-copy-markup-delete]').attr('data-dp-copy-markup-delete', `${target}${index}`);
  });
}

function populateInitialValues(wrapperElement, target) {
  const elements = wrapperElement.find(`[data-dp-copy-markup-target^="${target}"]`);

  elements.each(function (index, el) {
    const formEls = jQuery(el).find(`[name*="${target}"]`);

    formEls.each(function () {
      const formEl = jQuery(this);
      const name = formEl.attr('name');

      // Extract the last two segments: index and key
      const match = name.match(/\[(\d+)\]\[(\w+)\]$/);

      if (match && match.length === 3) {
        const index = match[1];
        const key = match[2];

        // Extract the path to the parent object excluding the index and key
        const path = name
          .substring(0, name.lastIndexOf(`[${index}][${key}]`))
          .replace(/\[/g, '.')
          .replace(/\]/g, '');

        // Traverse the settings object to find the corresponding value
        let value = typeof config.jsVars.settings === 'object' ? config.jsVars.settings : undefined;
        if (value) {
          const segments = path.split('.');
          for (const segment of segments) {
            if (segment && value && typeof value === 'object' && segment in value) {
              value = value[segment];
            } else {
              value = undefined;
              break;
            }
          }

          // Get the value using index and key
          if (value && Array.isArray(value) && value[index] && typeof value[index] === 'object' && key in value[index]) {
            const settingValue = value[index][key];

            // For select elements, handle differently
            if (formEl.is('select')) {
              formEl.find('option').removeAttr('selected');
              formEl.find(`option[value="${settingValue}"]`).attr('selected', 'selected');
              formEl.val(settingValue).trigger('change');
            } else {
              formEl.val(settingValue);
            }
          }
        }
      }
    });
  });
}

function findKey(obj, targetKey) {
  let result = [];

  function search(obj, targetKey) {
    if (typeof obj !== 'object' || obj === null) {
      return;
    }
    for (const key in obj) {
      if (obj.hasOwnProperty(key)) {
        if (key === targetKey) {
          result = Array.isArray(obj[key]) ? obj[key] : [];
          return;
        } else if (typeof obj[key] === 'object' && obj[key] !== null) {
          search(obj[key], targetKey);
        }
      }
    }
  }

  search(obj, targetKey);
  return result;
}
