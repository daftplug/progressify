import { handleSelect } from './select.js';

const daftplugAdmin = jQuery('#daftplugAdmin');
const optionName = daftplugAdmin.attr('data-option-name');
const jsVars = window[optionName + '_admin_js_vars'];

export function initCopyMarkup() {
  window.addEventListener('load', () => handleCopyMarkup());
}

function handleCopyMarkup() {
  daftplugAdmin.find('[data-dp-copy-markup]').each(function () {
    const self = jQuery(this);
    const config = JSON.parse(self.attr('data-dp-copy-markup'));
    const wrapper = config.wrapper;
    const target = config.target;
    const firstShown = config.firstShown || false;
    const limit = config.limit || Infinity;
    const wrapperElement = daftplugAdmin.find(`[data-dp-copy-markup-wrapper="${wrapper}"]`);
    const targetElements = wrapperElement.find(`[data-dp-copy-markup-target^="${target}"]`);
    const template = targetElements.first().clone().prop('outerHTML');

    // Clear the wrapper and render initial elements based on settings and firstShown
    wrapperElement.empty();

    // Calculate the number of initial elements to render based on settings
    const settingsArray = findKey(jsVars.settings, wrapper);
    const initialCount = Math.max(firstShown ? 1 : 0, settingsArray.length);

    for (let i = 0; i < initialCount; i++) {
      const newElement = jQuery(template);
      wrapperElement.append(newElement);
    }

    reindexElements(wrapperElement, wrapper, target);
    populateInitialValues(wrapperElement, wrapper, target);
    checkLimit();

    // Handle the copy markup button click
    self.on('click', function () {
      const visibleTargets = wrapperElement.find(`[data-dp-copy-markup-target^="${target}"]`);
      if (visibleTargets.length < limit) {
        const newElement = jQuery(template);
        newElement.appendTo(wrapperElement);
        handleSelect();
        reindexElements(wrapperElement, wrapper, target);
        checkLimit();
      }
    });

    // Handle the delete button click
    daftplugAdmin.on('click', '[data-dp-copy-markup-delete]', function () {
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

function populateInitialValues(wrapperElement, wrapper, target) {
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
        let value = jsVars && jsVars.settings ? jsVars.settings : undefined;
        if (value) {
          path.split('.').forEach((segment) => {
            if (segment && value && segment in value) {
              value = value[segment];
            } else {
              value = undefined;
              return;
            }
          });

          // Get the value using index and key
          if (value && value[index] && value[index][key] !== undefined) {
            formEl.val(value[index][key]);
          }
        }
      }
    });
  });
}

function findKey(obj, targetKey) {
  let result = [];

  function search(obj, targetKey) {
    for (const key in obj) {
      if (obj.hasOwnProperty(key)) {
        if (key === targetKey) {
          result = obj[key];
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
