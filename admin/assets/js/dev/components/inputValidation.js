import { config } from '../admin.js';

export function initInputValidation() {
  validateInputs();
}

export function validateInputs() {
  const inputs = config.daftplugAdminElm.find('input, textarea, select');

  inputs.each(function () {
    const self = jQuery(this);
    self.on('invalid', function (e) {
      self.attr('data-invalid', 'true');
      setTimeout(function () {
        self.removeAttr('data-invalid');
      }, 2300);
    });
  });
}
