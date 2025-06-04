import { config } from '../admin.js';
import { findAndHighlightElement } from '../components/utils.js';

export function initSearch() {
  const searchBox = config.daftplugAdminElm.find('[data-dp-searchbox]');
  const searchBoxInput = searchBox.find('.dp-searchbox-input');
  const searchBoxOutput = searchBox.find('.dp-searchbox-output');
  const searchItemsWrapper = searchBoxOutput.find('.dp-searchbox-output-wrapper');

  // Show output when input is focused
  searchBoxInput
    .on('focus', function () {
      searchBoxOutput.removeClass('hidden');
    })
    .on('blur', function () {
      searchBoxOutput.addClass('hidden');
    });

  // Build and append search groups
  const searchGroups = buildSettingsItems();
  searchItemsWrapper.append(searchGroups);

  // Handle search input
  searchBoxInput.on('input', function () {
    const searchQuery = jQuery(this).val().toLowerCase();
    const searchItems = searchItemsWrapper.find('.dp-searchbox-item');

    searchItems.each(function () {
      const item = jQuery(this);
      const itemTitle = item.find('.dp-searchbox-item-title').text().toLowerCase();

      if (itemTitle.includes(searchQuery)) {
        item.removeClass('hidden');
      } else {
        item.addClass('hidden');
      }
    });

    const groups = searchItemsWrapper.find('.dp-searchbox-group');
    let hasVisibleGroups = false;

    groups.each(function () {
      const group = jQuery(this);
      const visibleItems = group.find('.dp-searchbox-item:not(.hidden)');
      if (visibleItems.length > 0) {
        group.removeClass('hidden');
        hasVisibleGroups = true;
      } else {
        group.addClass('hidden');
      }
    });

    const noResults = searchItemsWrapper.find('.dp-searchbox-no-results');
    if (hasVisibleGroups) {
      noResults.addClass('hidden');
    } else {
      noResults.removeClass('hidden');
    }
  });

  // Handle search item clicks
  searchItemsWrapper.on('mousedown', '[data-find-and-highlight-element]', function (e) {
    const highlightElementSelector = jQuery(this).data('find-and-highlight-element');
    if (highlightElementSelector) {
      findAndHighlightElement(highlightElementSelector);
    }
  });
}

function buildSettingsItems() {
  const sections = config.daftplugAdminElm.find('main section');
  let searchGroupsHTML = '';

  sections.each(function () {
    const section = jQuery(this);
    const pageId = section.attr('data-page-id');
    const pageTitle = pageId
      .replace(/([A-Z])/g, ' $1')
      .replace(/^./, (str) => str.toUpperCase())
      .trim();

    let groupItemsHTML = '';
    const fieldsets = section.find('form[name="settingsForm"] fieldset');

    fieldsets.each(function () {
      const fieldset = jQuery(this);
      const fieldsetId = fieldset.attr('id');
      const fieldsetTitle = fieldset.find('h5, label').first().text().trim();
      const fieldsetIcon = fieldset.find('svg').clone();
      fieldsetIcon.attr('class', 'shrink-0 size-5 fill-gray-500');

      groupItemsHTML += `
        <div class="dp-searchbox-item py-2 px-3 flex items-center gap-x-2 cursor-pointer hover:bg-gray-100 rounded-lg" data-find-and-highlight-element="#${fieldsetId}">
          ${fieldsetIcon.prop('outerHTML')}
          <span class="dp-searchbox-item-title text-sm truncate text-gray-800">${fieldsetTitle}</span>
        </div>
      `;
    });

    if (groupItemsHTML) {
      searchGroupsHTML += `
        <div class="dp-searchbox-group">
          <div class="dp-searchbox-item-group-title block text-xs text-gray-500 m-3 mb-1">${pageTitle}</div>
          ${groupItemsHTML}
        </div>
      `;
    }
  });

  return searchGroupsHTML;
}
