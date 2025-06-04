import { config } from '../admin.js';

export function initDependentMarkup() {
  handleDependentMarkup();
}

export function handleDependentMarkup() {
  config.daftplugAdminElm.find('[data-dp-dependant-markup]').each(function () {
    const self = jQuery(this);
    const dependentMarkupConfig = JSON.parse(self.attr('data-dp-dependant-markup'));
    const target = dependentMarkupConfig.target;
    const state = dependentMarkupConfig.state || 'checked';
    const mode = dependentMarkupConfig.mode || 'availability';
    const targetElement = config.daftplugAdminElm.find(`[name="${target}"]`);

    function updateState() {
      const isChecked = targetElement.is(':checked');
      const shouldActivate = state === 'checked' ? isChecked : !isChecked;

      if (mode === 'availability') {
        if (shouldActivate) {
          self.removeAttr('data-disabled');
          enableFields(self);
        } else {
          self.attr('data-disabled', 'true');
          disableFields(self);
        }
      } else if (mode === 'visibility') {
        if (shouldActivate) {
          self.show();
          enableFields(self);
        } else {
          self.hide();
          disableFields(self);
        }
      }

      // Update nested dependent markup without triggering events
      self.find('[data-dp-dependant-markup]').each(function () {
        updateDependentMarkup(jQuery(this));
      });
    }

    function enableFields(element) {
      element.find('input, select, textarea').each(function () {
        const field = jQuery(this);
        field.prop('disabled', false);
        if (field.attr('data-required') === 'true') {
          field.prop('required', true);
        }
      });
    }

    function disableFields(element) {
      element.find('input, select, textarea').each(function () {
        const field = jQuery(this);
        field.prop('disabled', true);
        field.prop('required', false);
        // We're not resetting the value here
      });
    }

    function updateDependentMarkup(element) {
      const dependentMarkupConfig = JSON.parse(element.attr('data-dp-dependant-markup'));
      const target = dependentMarkupConfig.target;
      const state = dependentMarkupConfig.state || 'checked';
      const mode = dependentMarkupConfig.mode || 'availability';
      const targetElement = config.daftplugAdminElm.find(`[name="${target}"]`);
      const isChecked = targetElement.is(':checked');
      const shouldActivate = state === 'checked' ? isChecked : !isChecked;

      if (mode === 'availability') {
        if (shouldActivate) {
          element.removeAttr('data-disabled');
          enableFields(element);
        } else {
          element.attr('data-disabled', 'true');
          disableFields(element);
        }
      } else if (mode === 'visibility') {
        if (shouldActivate) {
          element.show();
          enableFields(element);
        } else {
          element.hide();
          disableFields(element);
        }
      }

      // Recursively update nested elements
      element.find('[data-dp-dependant-markup]').each(function () {
        updateDependentMarkup(jQuery(this));
      });
    }

    // Store initial required state
    self.find('input, select, textarea').each(function () {
      const field = jQuery(this);
      if (field.prop('required')) {
        field.attr('data-required', 'true');
      }
    });

    updateState();

    targetElement.on('change', function () {
      updateState();
    });
  });
}
