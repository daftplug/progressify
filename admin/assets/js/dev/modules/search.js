import { navigateToPage, highlightElement } from '../components/utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');

export function initSearch() {
  const searchBox = daftplugAdmin.find('#searchComboBox');
  const searchItemsWrapper = searchBox.find('[data-hs-combo-box-output-items-wrapper]');

  // Build and append search items
  const searchItems = buildSettingsItems();
  searchItemsWrapper.append(searchItems);

  // Handle search item clicks
  searchItemsWrapper.on('click', '[data-navigate-to-page]', function (e) {
    const pageId = jQuery(this).data('navigate-to-page');
    const highlightElementSelector = jQuery(this).data('highlight-element');
    const searchComboBox = new HSComboBox(document.getElementById('searchComboBox'));

    searchComboBox.close();

    navigateToPage(pageId);
    if (highlightElementSelector) {
      highlightElement(highlightElementSelector);
    }
  });
}

function buildSettingsItems() {
  const sections = daftplugAdmin.find('main section');
  let searchItemsHTML = '';

  sections.each(function () {
    const section = jQuery(this);
    const pageId = section.attr('data-page-id');
    const pageTitle = pageId
      .replace(/([A-Z])/g, ' $1')
      .replace(/^./, (str) => str.toUpperCase())
      .trim();

    const fieldsets = section.find('#settingsForm fieldset');

    fieldsets.each(function () {
      const fieldset = jQuery(this);
      const fieldsetId = fieldset.attr('id');

      // Extract fieldset title from the h5 element
      const fieldsetTitle = fieldset.find('h5, label').first().text().trim();

      // Extract SVG icon from the fieldset
      const fieldsetIcon = fieldset.find('svg').clone();
      fieldsetIcon.attr('class', 'shrink-0 size-5 fill-gray-500 dark:fill-neutral-500');

      // Create search item HTML
      searchItemsHTML += `
        <div data-hs-combo-box-output-item='{"group": {"name": "settings", "title": "Settings"}}' tabindex="0">
          <div class="py-2 px-3 flex items-center gap-x-2 cursor-pointer hover:bg-gray-100 rounded-lg dark:hover:bg-neutral-700" data-navigate-to-page="${pageId}" data-highlight-element="#${fieldsetId}">
            ${fieldsetIcon.prop('outerHTML')}
            <span class="text-sm truncate text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="${fieldsetTitle}" data-hs-combo-box-value="">${fieldsetTitle}</span>
            <span class="ms-auto truncate text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="${pageTitle}" data-hs-combo-box-value="">${pageTitle}</span>
          </div>
        </div>
      `;
    });
  });

  return searchItemsHTML;
}
