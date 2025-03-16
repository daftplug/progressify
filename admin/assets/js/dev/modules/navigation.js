import { navigateToPage } from '../components/utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');

export function initNavigation() {
  window.handleHashChange = handleNavigation;
  jQuery(window).on('load', handleNavigation);
  jQuery(window).on('hashchange', handleNavigation);
}

function handleNavigation() {
  if (daftplugAdmin.find('main[data-page-id="activation"]').length) {
    navigateToPage('activation');
    return;
  }

  if (location.hash) {
    const hashValue = location.hash.replace(/#|\//g, '');
    const [pageId, subPageId] = hashValue.split('-');
    navigateToPage(pageId, subPageId);
  } else {
    navigateToPage('dashboard');
  }
}
