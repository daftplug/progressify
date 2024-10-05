import { navigateTo } from './utils.js';

const daftplugAdmin = jQuery('#daftplugAdmin');

export function initNavigation() {
  jQuery(window).on('load', handleLoad);
  jQuery(window).on('hashchange', handleHashChange);
}

export function handleLoad() {
  let activationPage = daftplugAdmin.find('section[data-page-id="activation"]');
  if (activationPage.length) {
    location.hash = '#/activation/';
    navigateTo('activation');
  } else {
    if (location.hash) {
      let [pageId, subPageId] = location.hash.replace(/#|\//g, '').split('-');
      navigateTo(pageId, subPageId);
    } else {
      location.hash = '#/dashboard/';
      navigateTo('dashboard');
    }
  }
  // Dispatch pageChange event
  dispatchPageChangeEvent();
}

export function handleHashChange() {
  if (location.hash) {
    let [pageId, subPageId] = location.hash.replace(/#|\//g, '').split('-');
    navigateTo(pageId, subPageId);
    // Dispatch pageChange event
    dispatchPageChangeEvent();
  }
}

function dispatchPageChangeEvent() {
  window.dispatchEvent(new CustomEvent('pageChange'));
}
