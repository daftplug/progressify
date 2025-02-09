const daftplugAdmin = jQuery('#daftplugAdmin');

export function initSelect() {
  jQuery(window).on('load', handleSelect);
}

export function handleSelect() {
  daftplugAdmin.find('select[data-dp-select]:not([data-processed="true"])').each(function () {
    const self = jQuery(this);
    const config = JSON.parse(self.attr('data-dp-select') || '{}');
    const placeholder = config.placeholder || 'Select...';
    const size = config.size || 'sm';
    const hasSearch = config.hasSearch || false;
    const showIconOnly = config.showIconOnly || false;
    const sizeClasses = {
      xs: 'text-xs',
      sm: 'text-sm',
      base: 'text-base',
      lg: 'text-lg',
    };
    const textSizeClass = sizeClasses[size] || sizeClasses.sm;
    const isMultiple = self.attr('multiple') !== undefined;

    const hasSelectedOption = self.find('option:selected[selected]').length > 0;
    if (!isMultiple && !hasSelectedOption) {
      self.prop('selectedIndex', -1).trigger('change');
    }

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
        iconMarkup = `<div class="me-1.5 flex shrink-0" data-icon>${icon}</div>`;
      }

      if (description) {
        descriptionMarkup = `<div class="text-xs mt-0.5 text-gray-500 dark:text-neutral-500" data-description>${description}</div>`;
      }

      const titleClass = description ? 'font-semibold' : '';

      optionTags += `
        <div data-value="${value}" tabindex="${index}" class="group data-[selected=true]:bg-gray-100 dark:data-[selected=true]:bg-neutral-800 py-2 px-4 ${textSizeClass} text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200">
          <div class="flex items-center min-w-max w-full">
            ${iconMarkup}
            <div class="${titleClass} text-gray-800 dark:text-neutral-200 pr-3 flex-shrink-0" data-title>${title}</div>
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
      <button type="button" data-dp-select-toggle class="truncate max-w-full overflow-hidden data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 w-full relative py-2 ps-3 pe-7 flex items-center text-start flex-nowrap bg-white border border-gray-200 text-gray-500 ${textSizeClass} rounded-lg shadow-sm align-middle focus:outline-none focus:ring-2 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
        <span class="text-gray-400">${placeholder}</span>
      </button>
      <div data-dp-select-dropdown class="absolute mt-3 z-50 min-w-44 max-h-72 ${hasSearch ? 'pb-1 px-1' : 'p-1'} space-y-0.5 overflow-hidden overflow-y-auto bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 top-full hidden dark:bg-neutral-900 dark:border dark:border-neutral-700">
        ${
          hasSearch
            ? `
          <div class="bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900">
            <input type="text" class="block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3" placeholder="Search..." data-dp-select-search>
          </div>
        `
            : ''
        }
        <div class="space-y-0.5" data-dp-select-options>
          ${optionTags}
        </div>
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
    const searchInput = dropdown.find('[data-dp-select-search]');
    const optionsContainer = dropdown.find('[data-dp-select-options]');

    // Store showIconOnly in the wrapper's data for access in updateCustomSelect
    wrapper.data('showIconOnly', showIconOnly);

    const initialValue = self.val();
    if (initialValue) {
      updateCustomSelect(self, toggle, dropdown, initialValue, placeholder, isMultiple);
    }

    // Improved dropdown positioning with IntersectionObserver
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            dropdown.addClass('hidden');
          }
        });
      },
      { threshold: 0.1 }
    );

    observer.observe(wrapper[0]);

    // Enhanced keyboard navigation
    wrapper.on('keydown', function (e) {
      if (!dropdown.hasClass('hidden')) {
        const options = optionsContainer.find('[data-value]:not(.hidden)');
        const currentFocus = document.activeElement;
        const currentIndex = options.index(currentFocus);

        switch (e.key) {
          case 'ArrowDown':
            e.preventDefault();
            if (currentIndex < options.length - 1) {
              options.eq(currentIndex + 1).focus();
            }
            break;
          case 'ArrowUp':
            e.preventDefault();
            if (currentIndex > 0) {
              options.eq(currentIndex - 1).focus();
            }
            break;
          case 'Enter':
            e.preventDefault();
            if (currentFocus && currentFocus.hasAttribute('data-value')) {
              currentFocus.click();
            }
            break;
          case 'Escape':
            e.preventDefault();
            dropdown.addClass('hidden');
            toggle.focus();
            break;
        }
      }
    });

    toggle.on('click', function (event) {
      event.stopPropagation();
      daftplugAdmin.find('[data-dp-select-dropdown]').not(dropdown).addClass('hidden');
      dropdown.toggleClass('hidden');
      if (!dropdown.hasClass('hidden')) {
        if (hasSearch) {
          setTimeout(() => searchInput.focus(), 0);
          searchInput.val('');
          optionsContainer.find('[data-value]').removeClass('hidden');
          optionsContainer.find('.no-results-message').remove();
        } else {
          optionsContainer.find('[data-value]').first().focus();
        }
      }
      positionDropdown(dropdown, toggle);
    });

    // Improved search functionality
    if (hasSearch) {
      let searchTimeout;
      searchInput.on('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
          const searchTerm = jQuery(this).val().toLowerCase();
          let hasVisibleOptions = false;

          optionsContainer.find('[data-value]').each(function () {
            const option = jQuery(this);
            const title = option.find('[data-title]').text().toLowerCase();
            const description = option.find('[data-description]').text().toLowerCase();
            const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
            option.toggleClass('hidden', !matchesSearch);
            if (matchesSearch) {
              hasVisibleOptions = true;
            }
          });

          optionsContainer.find('.no-results-message').remove();
          if (!hasVisibleOptions) {
            optionsContainer.append(`
              <div class="no-results-message py-2 px-4 text-sm text-gray-500 dark:text-neutral-400 text-center">
                No results found
              </div>
            `);
          }
        }, 150); // Debounce search for better performance
      });

      searchInput.on('click keydown keyup', function (event) {
        event.stopPropagation();
      });
    }

    dropdown.on('click', '[data-value]', function (event) {
      event.stopPropagation();
      const selectedOption = jQuery(this);
      const selectedValue = selectedOption.attr('data-value');
      let selectedValues = self.val() || [];

      if (isMultiple) {
        selectedValues = Array.isArray(selectedValues) ? selectedValues : [selectedValues];
        if (selectedValues.includes(selectedValue)) {
          selectedValues = selectedValues.filter((val) => val !== selectedValue);
        } else {
          selectedValues.push(selectedValue);
        }
      } else {
        selectedValues = [selectedValue];
        dropdown.addClass('hidden');
        if (hasSearch) {
          searchInput.val('');
          optionsContainer.find('[data-value]').removeClass('hidden');
          optionsContainer.find('.no-results-message').remove();
        }
      }

      self.val(selectedValues).trigger('change');
      updateCustomSelect(self, toggle, dropdown, selectedValues, placeholder, isMultiple);
    });

    self.on('change', function () {
      const selectedValues = self.val() || [];
      updateCustomSelect(self, toggle, dropdown, selectedValues, placeholder, isMultiple);
    });

    // More efficient event handling for scroll and resize
    const debouncedPositioning = debounce(() => handleDropdownPositioning(dropdown, toggle), 100);
    window.addEventListener('scroll', debouncedPositioning, { passive: true });
    window.addEventListener('resize', debouncedPositioning, { passive: true });

    document.addEventListener('click', function (event) {
      if (!dropdown.hasClass('hidden') && !dropdown.is(event.target) && !toggle.is(event.target) && dropdown.has(event.target).length === 0 && toggle.has(event.target).length === 0) {
        dropdown.addClass('hidden');
        if (hasSearch) {
          searchInput.val('');
          optionsContainer.find('[data-value]').removeClass('hidden');
          optionsContainer.find('.no-results-message').remove();
        }
      }
    });

    self.attr('data-processed', true);
  });
}

function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Update the positioning function to default to left alignment
function positionDropdown(dropdown, toggle) {
  const dropdownHeight = dropdown.outerHeight();
  const toggleRect = toggle[0].getBoundingClientRect();
  const viewportHeight = window.innerHeight;
  const viewportWidth = window.innerWidth;

  // Calculate space above and below the toggle element
  const spaceBelow = viewportHeight - toggleRect.bottom;
  const spaceAbove = toggleRect.top;

  // Calculate horizontal position
  const toggleWidth = toggle.outerWidth();
  const dropdownWidth = dropdown.outerWidth();
  const leftSpace = toggleRect.left;
  const rightSpace = viewportWidth - (toggleRect.left + toggleWidth);

  // Reset any previous positioning
  dropdown.css({
    left: '0',
    right: 'auto',
  });

  // Vertical positioning
  if (spaceBelow < dropdownHeight && spaceAbove > spaceBelow) {
    dropdown.removeClass('top-full mt-3').addClass('bottom-full mb-3');
  } else {
    dropdown.removeClass('bottom-full mb-3').addClass('top-full mt-3');
  }

  // Only adjust to right alignment if there's not enough space on the left
  // and there's more space on the right
  if (leftSpace + dropdownWidth > viewportWidth && rightSpace > leftSpace) {
    dropdown.css({
      left: 'auto',
      right: '0',
    });
  }
}

function handleDropdownPositioning(dropdown, toggle) {
  if (!dropdown.hasClass('hidden')) {
    positionDropdown(dropdown, toggle);
  }
}

// Update the updateCustomSelect function to handle showIconOnly
function updateCustomSelect(select, toggle, dropdown, selectedValues, placeholder, isMultiple) {
  selectedValues = selectedValues ? (Array.isArray(selectedValues) ? selectedValues : [selectedValues]) : [];
  const showIconOnly = toggle.parent().data('showIconOnly');

  if (!isMultiple && (!selectedValues.length || selectedValues[0] === '')) {
    toggle.html(`<span class="text-gray-400">${placeholder}</span>`);
    dropdown.find('[data-selected=true]').attr('data-selected', false);
    toggle.addClass('text-gray-500');
    return;
  }

  dropdown.find('[data-selected=true]').attr('data-selected', false);

  selectedValues.forEach((value) => {
    dropdown.find(`[data-value="${value}"]`).attr('data-selected', true);
  });

  if (selectedValues.length === 0) {
    toggle.html(`<span class="text-gray-400">${placeholder}</span>`);
  } else if (isMultiple) {
    const displayedItems = selectedValues.slice(0, 3);
    const remainingCount = selectedValues.length - displayedItems.length;

    const selectedOptions = displayedItems
      .map((value, index) => {
        const selectedOption = dropdown.find(`[data-value="${value}"]`);
        const selectedTitle = selectedOption.find('[data-title]').text();
        const selectedIcon = selectedOption.find('[data-icon]').html() || '';

        if (showIconOnly && selectedIcon) {
          return `<div class="inline-flex items-center">${selectedIcon}</div>`;
        }

        return `
          <div class="inline-flex items-center">
            ${selectedIcon ? `<div class="me-1.5 flex shrink-0">${selectedIcon}</div>` : ''}
            <div class="text-gray-800 dark:text-neutral-200 truncate">${selectedTitle}</div>
            ${index < displayedItems.length - 1 ? '<span class="text-gray-800 dark:text-neutral-200 me-1">,</span>' : ''}
          </div>
        `;
      })
      .join('');

    let toggleContent = `
      <div class="flex flex-wrap items-center">
        ${selectedOptions}
        ${remainingCount > 0 ? `<span class="text-gray-500 truncate ms-1">(+${remainingCount} more)</span>` : ''}
      </div>
    `;

    toggle.html(toggleContent);
  } else {
    const value = selectedValues[0];
    const selectedOption = dropdown.find(`[data-value="${value}"]`);
    const selectedTitle = selectedOption.find('[data-title]').text();
    const selectedIcon = selectedOption.find('[data-icon]').html() || '';

    if (showIconOnly && selectedIcon) {
      toggle.html(`<div class="flex items-center justify-center">${selectedIcon}</div>`);
    } else {
      toggle.html(`
        <div class="flex items-center">
          ${selectedIcon ? `<div class="me-1.5 flex shrink-0">${selectedIcon}</div>` : ''}
          <div class="text-gray-800 dark:text-neutral-200 truncate">${selectedTitle}</div>
        </div>
      `);
    }
  }

  toggle.toggleClass('text-gray-500', selectedValues.length === 0);
  toggle.addClass('flex items-center');
}
