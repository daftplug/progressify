export function initClipboard() {
  jQuery(window).on('load', handleClipboard);
}

export function handleClipboard() {
  const clipboardButtons = document.querySelectorAll('[data-clipboard-content]');

  clipboardButtons.forEach((button) => {
    button.addEventListener('click', function () {
      const content = this.getAttribute('data-clipboard-content');
      const successText = this.getAttribute('data-clipboard-success-text');

      // Copy to clipboard
      navigator.clipboard
        .writeText(content)
        .then(() => {
          // Show success state
          const defaultIcon = this.querySelector('.clipboard-default');
          const successIcon = this.querySelector('.clipboard-success');
          const tooltip = this.querySelector('.hs-tooltip-content');

          defaultIcon.classList.add('hidden');
          successIcon.classList.remove('hidden');
          tooltip.textContent = successText;
          tooltip.classList.remove('hidden', 'invisible');
          tooltip.classList.add('hs-tooltip-shown');

          // Reset after 2 seconds
          setTimeout(() => {
            defaultIcon.classList.remove('hidden');
            successIcon.classList.add('hidden');
            tooltip.classList.add('hidden', 'invisible');
            tooltip.classList.remove('hs-tooltip-shown');
            tooltip.textContent = ''; // Clear tooltip text
          }, 2000);
        })
        .catch((err) => {
          console.error('Failed to copy text: ', err);
        });
    });
  });
}
