import { config } from '../frontend.js';

// WeakMap to store form-specific data and event handlers
const formData = new WeakMap();

function persist(form) {
  // Skip if form is already being tracked
  if (formData.has(form)) {
    return;
  }

  // Load existing data
  load(form);

  // Create bound event handlers
  const saveForm = () => save(form);
  const inputHandler = debounce(() => save(form), 500);
  const saveFormBeforeUnload = () => {
    window.removeEventListener('unload', saveForm);
    saveForm();
  };
  const submitHandler = () => {
    cleanup(form);
    if (config.jsVars.settings.appCapabilities.autosaveForms.persistOnSubmit !== 'on') {
      clearStorage(form);
    }
  };

  // Store handlers for cleanup
  formData.set(form, {
    saveForm,
    inputHandler,
    saveFormBeforeUnload,
    submitHandler,
  });

  // Add event listeners
  window.addEventListener('beforeunload', saveFormBeforeUnload);
  window.addEventListener('unload', saveForm);
  form.addEventListener('input', inputHandler);
  form.addEventListener('change', inputHandler);
  form.addEventListener('submit', submitHandler);
}

function serialize(form) {
  const data = {};

  for (const element of form.elements) {
    // Skip elements without names or disabled elements
    if (!element.name || element.disabled) {
      continue;
    }

    const tag = element.tagName;
    const type = element.type;

    // Skip sensitive data
    if (tag === 'INPUT' && (type === 'password' || type === 'file')) {
      continue;
    }

    // Skip buttons and submits
    if (tag === 'INPUT' && (type === 'submit' || type === 'button' || type === 'reset' || type === 'image')) {
      continue;
    }

    if (tag === 'INPUT') {
      if (type === 'radio') {
        if (element.checked) {
          data[element.name] = element.value;
        }
      } else if (type === 'checkbox') {
        if (!data[element.name]) {
          data[element.name] = [];
        }
        if (element.checked) {
          data[element.name].push(element.value);
        }
      } else {
        data[element.name] = element.value;
      }
    } else if (tag === 'TEXTAREA') {
      data[element.name] = element.value;
    } else if (tag === 'SELECT') {
      if (element.multiple) {
        data[element.name] = Array.from(element.selectedOptions).map((option) => option.value);
      } else {
        data[element.name] = element.value;
      }
    }
  }

  return data;
}

function save(form) {
  try {
    const data = serialize(form);
    const key = getStorageKey(form);

    // Only save if there's actual data
    if (Object.keys(data).length > 0) {
      // Add timestamp for cleanup purposes
      data._timestamp = Date.now();
      localStorage.setItem(key, JSON.stringify(data));
    }
  } catch (error) {
    console.warn('Failed to save form data:', error);
  }
}

function deserialize(form, data) {
  for (const name in data) {
    // Skip internal properties
    if (name.startsWith('_')) {
      continue;
    }

    const elements = Array.from(form.elements).filter((element) => element.name === name);

    elements.forEach((element) => {
      applyValues(element, data[name]);
    });
  }
}

function applyValues(element, value) {
  const tag = element.tagName;
  const type = element.type;

  try {
    if (tag === 'INPUT') {
      if (type === 'radio') {
        element.checked = element.value === value;
      } else if (type === 'checkbox') {
        // Handle both array and boolean values for checkboxes
        if (Array.isArray(value)) {
          element.checked = value.includes(element.value);
        } else {
          element.checked = Boolean(value);
        }
      } else {
        element.value = value || '';
      }
    } else if (tag === 'TEXTAREA') {
      element.value = value || '';
    } else if (tag === 'SELECT') {
      if (element.multiple && Array.isArray(value)) {
        Array.from(element.options).forEach((option) => {
          option.selected = value.includes(option.value);
        });
      } else {
        element.value = value || '';
      }
    }
  } catch (error) {
    console.warn('Failed to apply value to element:', element, error);
  }
}

function load(form) {
  try {
    const json = localStorage.getItem(getStorageKey(form));
    if (json) {
      const data = JSON.parse(json);
      deserialize(form, data);
    }
  } catch (error) {
    console.warn('Failed to load form data:', error);
    // Clean up corrupted data
    clearStorage(form);
  }
}

function clearStorage(form) {
  try {
    localStorage.removeItem(getStorageKey(form));
  } catch (error) {
    console.warn('Failed to clear form storage:', error);
  }
}

function getStorageKey(form) {
  let identifier = form.id;

  if (!identifier) {
    // Create a more stable identifier based on form structure
    const formStructure = {
      action: form.action || '',
      method: form.method || 'get',
      fieldCount: form.elements.length,
      fieldNames: Array.from(form.elements)
        .filter((el) => el.name)
        .slice(0, 5) // Take first 5 named fields
        .map((el) => el.name)
        .sort()
        .join(','),
    };

    // Create a hash-like identifier from form characteristics
    identifier = btoa(JSON.stringify(formStructure))
      .replace(/[^a-zA-Z0-9]/g, '')
      .substring(0, 16);
  }

  const path = window.location.pathname.replace(/[^a-zA-Z0-9]/g, '_');
  return `autosave_${path}_${identifier}`;
}

// Utility function for debouncing
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

// Cleanup function to remove event listeners
function cleanup(form) {
  const handlers = formData.get(form);
  if (handlers) {
    window.removeEventListener('beforeunload', handlers.saveFormBeforeUnload);
    window.removeEventListener('unload', handlers.saveForm);
    form.removeEventListener('input', handlers.inputHandler);
    form.removeEventListener('change', handlers.inputHandler);
    form.removeEventListener('submit', handlers.submitHandler);
    formData.delete(form);
  }
}

// Clean up old localStorage entries
function cleanupOldStorage() {
  try {
    const now = Date.now();
    const maxAge = 7 * 24 * 60 * 60 * 1000; // 7 days

    for (let i = localStorage.length - 1; i >= 0; i--) {
      const key = localStorage.key(i);
      if (key && key.startsWith('autosave_')) {
        try {
          const data = JSON.parse(localStorage.getItem(key));
          if (data && data._timestamp && now - data._timestamp > maxAge) {
            localStorage.removeItem(key);
          }
        } catch (e) {
          // Remove corrupted entries
          localStorage.removeItem(key);
        }
      }
    }
  } catch (error) {
    console.warn('Failed to cleanup old storage:', error);
  }
}

export async function initAutosaveForms() {
  try {
    // Process existing forms
    Array.from(document.forms).forEach((form) => {
      persist(form);
    });

    // Watch for dynamically added forms
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
          if (node.nodeType === Node.ELEMENT_NODE) {
            // Check if the added node is a form
            if (node.tagName === 'FORM') {
              persist(node);
            }
            // Check if the added node contains forms
            const forms = node.querySelectorAll ? node.querySelectorAll('form') : [];
            forms.forEach((form) => persist(form));
          }
        });
      });
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });

    // Clean up old storage entries (older than 7 days)
    cleanupOldStorage();
  } catch (error) {
    console.error('Failed to initialize autosave forms:', error);
  }
}
