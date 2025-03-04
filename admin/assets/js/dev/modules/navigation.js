import { navigateToPage } from '../components/utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');

export function initNavigation() {
  window.handleHashChange = handleHashChange; // Make it accessible for the navigation function
  jQuery(window).on('load', handleLoad);
  jQuery(window).on('hashchange', handleHashChange);
}

export function handleLoad() {
  if (location.hash) {
    const [pageId, subPageId] = location.hash.replace(/#|\//g, '').split('-');
    navigateToPage(pageId, subPageId);
  } else {
    navigateToPage('dashboard');
  }
}

export function handleHashChange() {
  if (location.hash) {
    const [pageId, subPageId] = location.hash.replace(/#|\//g, '').split('-');
    navigateToPage(pageId, subPageId);
  }
}
