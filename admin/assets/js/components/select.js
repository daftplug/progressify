const daftplugAdmin = jQuery('#daftplugAdmin');

export function initSelect() {
  jQuery(window).on('load', handleSelect);
}

export function handleSelect() {
  daftplugAdmin.find('select[data-dp-select]:not([data-processed="true"])').each(function () {
    const self = jQuery(this);
    const config = JSON.parse(self.attr('data-dp-select'));
    const size = config.size || 'sm';
    const sizeClasses = {
      xs: 'text-xs',
      sm: 'text-sm',
      base: 'text-base',
      lg: 'text-lg',
    };
    const textSizeClass = sizeClasses[size] || sizeClasses.sm;
    const isMultiple = self.attr('multiple') !== undefined;
    const options = self.find('option').not('[value=""]');
    let optionTags = '';

    options.each(function (index) {
      const optionSelf = jQuery(this);
      const optionConfig = JSON.parse(optionSelf.attr('data-dp-select-option') || '{}');
      const value = optionSelf.val().trim();
      const title = optionSelf.text().trim();
      const icon = optionConfig.icon ?? '';
      const description = optionConfig.description ?? '';
      let iconMarkup = '';
      let descriptionMarkup = '';

      if (icon) {
        iconMarkup = `<div class="me-1 flex shrink-0" data-icon="">${icon}</div>`;
      }

      if (description) {
        descriptionMarkup = `<div class="text-xs mt-0.5 text-gray-500 dark:text-neutral-500" data-description="">${description}</div>`;
      }

      const titleClass = icon || description ? 'font-semibold' : '';

      optionTags += `
        <div data-value="${value}" tabindex="${index}" class="group data-[selected=true]:bg-gray-100 dark:data-[selected=true]:bg-neutral-800 py-2 px-4 w-full ${textSizeClass} text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200">
          <div class="flex items-center">
            ${iconMarkup}
            <div class="${titleClass} text-gray-800 dark:text-neutral-200 pr-3" data-title="">${title}</div>
            <span class="hidden group-data-[selected=true]:block ms-auto">
              <svg class="flex-shrink-0 size-3.5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </span>
          </div>
          ${descriptionMarkup}
        </div>
      `;
    });

    self.addClass('absolute pointer-events-none inset-0 appearance-none opacity-0 mx-auto peer');

    self.wrapAll('<div class="relative"></div>');
    const wrapper = self.parent('.relative');

    wrapper.append(`
     <button type="button" data-dp-select-toggle="" class="truncate max-w-full overflow-hidden data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 w-full relative py-2 ps-3 pe-7 flex items-center text-start bg-white border border-gray-200 text-gray-500 ${textSizeClass} rounded-lg shadow-sm align-middle focus:outline-none focus:ring-2 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
        <span class="text-gray-400">${config.placeholder}</span>
      </button>
      <div data-dp-select-dropdown="" class="absolute mt-3 z-50 min-w-44 max-h-72 p-1 space-y-0.5 overflow-hidden overflow-y-auto bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 top-full hidden">
        ${optionTags}
      </div>
      <div class="absolute top-1/2 end-3 -translate-y-1/2">
        <svg class="flex-shrink-0 size-3.5 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m7 15 5 5 5-5"></path>
          <path d="m7 9 5-5 5 5"></path>
        </svg>
      </div>
    `);

    const toggle = wrapper.find('[data-dp-select-toggle]');
    const dropdown = wrapper.find('[data-dp-select-dropdown]');

    toggle.on('click', function (event) {
      event.stopPropagation();
      daftplugAdmin.find('[data-dp-select-dropdown]').not(dropdown).addClass('hidden');
      dropdown.toggleClass('hidden');
      positionDropdown(dropdown, toggle);
    });

    dropdown.on('click', '[data-value]', function (event) {
      event.stopPropagation();
      const selectedOption = jQuery(this);
      const selectedValue = selectedOption.attr('data-value');
      let selectedValues = self.val() || [];

      if (isMultiple) {
        if (selectedValues.includes(selectedValue)) {
          selectedValues = selectedValues.filter((val) => val !== selectedValue);
        } else {
          selectedValues.push(selectedValue);
        }
      } else {
        selectedValues = [selectedValue];
        dropdown.addClass('hidden');
      }

      self.val(selectedValues).trigger('change');
      updateCustomSelect(self, toggle, dropdown, selectedValues, config.placeholder, isMultiple);
    });

    self
      .on('change', function () {
        const selectedValues = self.val() || [];
        updateCustomSelect(self, toggle, dropdown, selectedValues, config.placeholder, isMultiple);
      })
      .trigger('change');

    // Add scroll and resize event listeners
    window.addEventListener('scroll', () => handleDropdownPositioning(dropdown, toggle));
    window.addEventListener('resize', () => handleDropdownPositioning(dropdown, toggle));

    // Add event listener for clicks outside the dropdown
    document.addEventListener('click', function (event) {
      if (!dropdown.hasClass('hidden') && !dropdown.is(event.target) && !toggle.is(event.target) && dropdown.has(event.target).length === 0 && toggle.has(event.target).length === 0) {
        dropdown.addClass('hidden');
      }
    });

    self.attr('data-processed', true);
  });
}

function positionDropdown(dropdown, toggle) {
  const dropdownHeight = dropdown.outerHeight();
  const toggleRect = toggle[0].getBoundingClientRect();
  const viewportHeight = window.innerHeight;

  // Calculate space above and below the toggle element
  const spaceBelow = viewportHeight - toggleRect.bottom;
  const spaceAbove = toggleRect.top;

  if (spaceBelow < dropdownHeight && spaceAbove > dropdownHeight) {
    dropdown.removeClass('top-full mt-3').addClass('bottom-full mb-3');
  } else {
    dropdown.removeClass('bottom-full mb-3').addClass('top-full mt-3');
  }
}

function handleDropdownPositioning(dropdown, toggle) {
  if (!dropdown.hasClass('hidden')) {
    positionDropdown(dropdown, toggle);
  }
}

function updateCustomSelect(select, toggle, dropdown, selectedValues, placeholder, isMultiple) {
  // Clear previous selection
  dropdown.find('[data-selected=true]').attr('data-selected', false);

  // Set new selection
  if (Array.isArray(selectedValues)) {
    selectedValues.forEach((selectedValue) => {
      const selectedOption = dropdown.find(`[data-value="${selectedValue}"]`);
      selectedOption.attr('data-selected', true);
    });
  } else if (selectedValues) {
    const selectedOption = dropdown.find(`[data-value="${selectedValues}"]`);
    selectedOption.attr('data-selected', true);
  }

  // Update toggle button content
  if (!selectedValues || (Array.isArray(selectedValues) && selectedValues.length === 0)) {
    toggle.html(`<span class="text-gray-400">${placeholder}</span>`);
  } else if (isMultiple && Array.isArray(selectedValues)) {
    const displayedItems = selectedValues.slice(0, 5);
    const remainingCount = selectedValues.length - displayedItems.length;

    const selectedOptions = displayedItems.map((value) => {
      const selectedOption = dropdown.find(`[data-value="${value}"]`);
      const selectedTitle = selectedOption.find('[data-title]').text();
      const selectedIcon = selectedOption.find('[data-icon]').html();
      let toggleContent = '';
      if (selectedIcon) {
        toggleContent += `<div class="me-1 flex shrink-0">${selectedIcon}</div>`;
      }
      toggleContent += `<div class="text-gray-800 dark:text-neutral-200">${selectedTitle}</div>`;
      return toggleContent;
    });

    let toggleContent = selectedOptions.join('<span class="mr-1.5">,</span> ');
    if (remainingCount > 0) {
      toggleContent += `<span class="ml-1.5 text-gray-500">(+${remainingCount} more)</span>`;
    }

    toggle.html(toggleContent);
  } else {
    const selectedOptions = Array.isArray(selectedValues)
      ? selectedValues.map((value) => {
          const selectedOption = dropdown.find(`[data-value="${value}"]`);
          const selectedTitle = selectedOption.find('[data-title]').text();
          const selectedIcon = selectedOption.find('[data-icon]').html();
          let toggleContent = '';
          if (selectedIcon) {
            toggleContent += `<div class="me-1 flex shrink-0">${selectedIcon}</div>`;
          }
          toggleContent += `<div class="text-gray-800 dark:text-neutral-200">${selectedTitle}</div>`;
          return toggleContent;
        })
      : (() => {
          const selectedOption = dropdown.find(`[data-value="${selectedValues}"]`);
          const selectedTitle = selectedOption.find('[data-title]').text();
          const selectedIcon = selectedOption.find('[data-icon]').html();
          let toggleContent = '';
          if (selectedIcon) {
            toggleContent += `<div class="me-1 flex shrink-0">${selectedIcon}</div>`;
          }
          toggleContent += `<div class="text-gray-800 dark:text-neutral-200">${selectedTitle}</div>`;
          return [toggleContent];
        })();

    toggle.html(selectedOptions.join(isMultiple ? '<span class="mr-1.5">,</span> ' : ''));
  }

  // Add classes for better content management
  toggle.addClass('flex flex-wrap items-center');
}
