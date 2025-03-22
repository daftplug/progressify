import { config } from '../frontend.js';

// Parse the translations from the localized script
const getTranslations = () => {
  try {
    // The translations are a JSON string, need to parse it
    return typeof config.jsVars.translations === 'string' ? JSON.parse(config.jsVars.translations) : config.jsVars.translations || {};
  } catch (e) {
    console.error('Error parsing translations:', e);
    return {};
  }
};

// Get the translations
const translations = getTranslations();

/**
 * Custom __ function that uses our translations
 */
export function __(text, textDomain) {
  // Return from our translations if available
  if (translations[text] && translations[text][0]) {
    return translations[text][0];
  }

  // Fall back to wp.i18n if available
  if (window.wp?.i18n?.__ && textDomain) {
    return window.wp.i18n.__(text, textDomain);
  }

  // Otherwise return the original text
  return text;
}

// Export other i18n functions
export function _x(text, context, textDomain) {
  return __(text, textDomain);
}

export function _n(single, plural, count, textDomain) {
  const text = count === 1 ? single : plural;
  return __(text, textDomain);
}

export function _nx(single, plural, count, context, textDomain) {
  return _n(single, plural, count, textDomain);
}

export function sprintf(format, ...args) {
  if (window.wp?.i18n?.sprintf) {
    return window.wp.i18n.sprintf(format, ...args);
  }

  // Simple sprintf implementation
  return format.replace(/%(\d+)\$s/g, (match, number) => {
    return typeof args[number - 1] !== 'undefined' ? args[number - 1] : match;
  });
}
