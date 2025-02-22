export function initTextareaAutoHeight() {
  handleTextareaAutoHeight();
}

export function handleTextareaAutoHeight() {
  const textareas = document.querySelectorAll('textarea');

  textareas.forEach((textarea) => {
    const overlay = textarea.closest('.hs-overlay');

    if (overlay) {
      const { element } = HSOverlay.getInstance(overlay, true);
      element.on('open', () => adjustTextareaHeight(textarea));
    }

    // Remove any inline height style
    textarea.style.removeProperty('height');

    // Set a min-height if necessary
    textarea.style.minHeight = '98px';

    adjustTextareaHeight(textarea);

    if (!textarea.classList.contains('auto')) {
      textarea.classList.add('auto');
      textarea.addEventListener('input', () => adjustTextareaHeight(textarea));
    }

    // Trigger initial adjustment
    triggerInputEvent(textarea);
  });
}

function adjustTextareaHeight(el, offsetTop = 2) {
  // Store the current scroll position
  const scrollPos = window.pageYOffset || document.documentElement.scrollTop;

  // Temporarily shrink the textarea to get the correct scrollHeight
  el.style.height = 'auto';

  // Set the height to scrollHeight + offsetTop
  el.style.height = `${Math.max(el.scrollHeight, 98) + offsetTop}px`;

  // Restore the scroll position
  window.scrollTo(0, scrollPos);
}

function triggerInputEvent(el) {
  const event = new Event('input', {
    bubbles: true,
    cancelable: true,
  });
  el.dispatchEvent(event);
}
