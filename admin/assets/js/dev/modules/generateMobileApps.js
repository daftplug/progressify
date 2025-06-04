import { config } from '../admin.js';

const { __ } = wp.i18n;

export function initGenerateMobileApps() {
  const paypalContainers = config.daftplugAdminElm.find('.paypalButtonsContainer');
  paypalContainers.each(function (e) {
    const self = jQuery(this);
    const productName = self.attr('data-product-name');
    const price = self.attr('data-price');
    const buttonColor = self.attr('data-button-color');

    initPayPalButton(self, productName, price, buttonColor);
  });
}

function initPayPalButton(container, productName, price, buttonColor) {
  const paypalButtons = container.find('.paypalButtons');
  const paypalResponse = container.find('.paypalResponse');

  // Check if already initialized
  if (paypalButtons.data('initialized')) {
    return;
  }

  paypal
    .Buttons({
      style: {
        shape: 'rect',
        color: buttonColor,
        layout: 'vertical',
        label: 'paypal',
      },
      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [
            {
              description: `Website: ${window.location.hostname}; Product: ${productName}`,
              amount: {
                currency_code: 'USD',
                value: price,
              },
            },
          ],
        });
      },
      onApprove: function (data, actions) {
        return actions.order.capture().then(function (orderData) {
          paypalButtons.hide();
          paypalResponse
            .css({
              background: '#4ad504',
              padding: '17px',
              borderRadius: '8px',
              marginTop: '10px',
              color: '#fff',
            })
            .html(__('Thank you for the payment! We are starting to create apps for you and will send it to you soon.', config.jsVars.slug))
            .fadeIn('fast');

          setTimeout(function () {
            paypalResponse.fadeOut('fast', function () {
              paypalButtons.fadeIn('fast');
            });
          }, 5000);
        });
      },
      onError: function (err) {
        paypalButtons.hide();
        paypalResponse
          .css({
            background: '#ff4734',
            padding: '17px',
            borderRadius: '8px',
            marginTop: '10px',
            color: '#fff',
          })
          .html(__('Payment failed! Please try again or contact us on support@daftplug.com', config.jsVars.slug))
          .fadeIn('fast');

        setTimeout(function () {
          paypalResponse.fadeOut('fast', function () {
            paypalButtons.fadeIn('fast');
          });
        }, 5000);
        console.log(err);
      },
    })
    .render(paypalButtons.get(0));

  // Mark as initialized
  paypalButtons.data('initialized', true);
}
