const daftplugAdmin = jQuery('#daftplugAdmin');

export function initTooltip() {
  handleTooltip();
}

export function handleTooltip() {
  daftplugAdmin.find('[data-dp-tooltip]').each(function () {
    const self = jQuery(this);
    const config = JSON.parse(self.attr('data-dp-tooltip'));
    const tooltipText = config.text || '';
    const trigger = config.trigger || 'hover';
    const placement = config.placement || 'top';

    const tooltip = jQuery(`
      <span class="group-data-[shown=true]:opacity-100 group-data-[shown=true]:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
        ${tooltipText}
      </span>
    `);

    self.append(tooltip);

    const showTooltip = () => {
      self.attr('data-shown', true);
      positionTooltip(tooltip, self, placement);
    };

    const hideTooltip = () => {
      self.attr('data-shown', false);
    };

    if (trigger === 'hover') {
      self.on('mouseenter', showTooltip);
      self.on('mouseleave', hideTooltip);
    } else if (trigger === 'click') {
      self.on('click', (event) => {
        event.stopPropagation();
        if (self.attr('data-shown') === 'true') {
          hideTooltip();
        } else {
          hideAllTooltips();
          showTooltip();
        }
      });

      jQuery(document).on('click', function (event) {
        if (!self.is(event.target) && self.has(event.target).length === 0) {
          hideTooltip();
        }
      });
    }

    window.addEventListener('scroll', () => handleTooltipPositioning(tooltip, self, placement));
    window.addEventListener('resize', () => handleTooltipPositioning(tooltip, self, placement));
  });
}

function hideAllTooltips() {
  daftplugAdmin.find('[data-dp-tooltip]').each(function () {
    const self = jQuery(this);
    self.attr('data-shown', false);
  });
}

function positionTooltip(tooltip, element, placement) {
  const tooltipHeight = tooltip.outerHeight();
  const tooltipWidth = tooltip.outerWidth();
  const elementRect = element[0].getBoundingClientRect();
  const viewportHeight = window.innerHeight;
  const viewportWidth = window.innerWidth;

  let top, left;

  const calculateTopPlacement = () => ({
    top: elementRect.top - tooltipHeight - 5,
    left: elementRect.left + elementRect.width / 2 - tooltipWidth / 2,
  });

  const calculateBottomPlacement = () => ({
    top: elementRect.bottom + 5,
    left: elementRect.left + elementRect.width / 2 - tooltipWidth / 2,
  });

  const calculateLeftPlacement = () => ({
    top: elementRect.top + elementRect.height / 2 - tooltipHeight / 2,
    left: elementRect.left - tooltipWidth - 5,
  });

  const calculateRightPlacement = () => ({
    top: elementRect.top + elementRect.height / 2 - tooltipHeight / 2,
    left: elementRect.right + 5,
  });

  if (placement === 'top' && elementRect.top >= tooltipHeight) {
    ({ top, left } = calculateTopPlacement());
  } else if (placement === 'bottom' && viewportHeight - elementRect.bottom >= tooltipHeight) {
    ({ top, left } = calculateBottomPlacement());
  } else if (placement === 'left' && elementRect.left >= tooltipWidth) {
    ({ top, left } = calculateLeftPlacement());
  } else if (placement === 'right' && viewportWidth - elementRect.right >= tooltipWidth) {
    ({ top, left } = calculateRightPlacement());
  } else if (elementRect.top >= tooltipHeight) {
    ({ top, left } = calculateTopPlacement());
  } else if (viewportHeight - elementRect.bottom >= tooltipHeight) {
    ({ top, left } = calculateBottomPlacement());
  } else if (elementRect.left >= tooltipWidth) {
    ({ top, left } = calculateLeftPlacement());
  } else {
    ({ top, left } = calculateRightPlacement());
  }

  tooltip.css({ top: `${top}px`, left: `${left}px` });
}

function handleTooltipPositioning(tooltip, element, placement) {
  if (element.attr('data-shown') === 'true') {
    positionTooltip(tooltip, element, placement);
  }
}
