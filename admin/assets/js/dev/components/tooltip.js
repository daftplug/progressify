const daftplugAdmin = jQuery('#daftplugAdmin');

export function initTooltip() {
  window.addEventListener('load', () => handleTooltip());
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

{
  /* <button type="button" class="group ms-1 flex" data-dp-tooltip='{
  "trigger": "hover",
  "placement": "top",
  "text": "<?php _e('Related application option gives you the ability to list your native applications related to your web app, for cross-promotion or additional functionality. So if you will relate your native application to your PWA, the browser will prompt the user with your native app instead of the PWA web app. If you don\"t have a native application for your web app, you can request generation of them by clicking the \"Generate Native Apps\" button on the navigation menu.', $this->textDomain); ?>"
}'>
  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
  </svg>
</button> */
}
