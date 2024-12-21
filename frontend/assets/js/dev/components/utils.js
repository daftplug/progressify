import { config } from '../main.js';

export const getContrastTextColor = (backgroundColor) => {
  const temp = document.createElement('div');
  temp.style.backgroundColor = backgroundColor;
  temp.style.display = 'none';
  config.daftplugFrontend.appendChild(temp);

  const computedColor = window.getComputedStyle(temp).backgroundColor;
  config.daftplugFrontend.removeChild(temp);

  const [r, g, b] = computedColor.match(/\d+/g).map(Number);
  const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

  return luminance > 0.5 ? '#000000' : '#ffffff';
};

export const isHomepage = () => {
  return document.body.classList.contains('home');
};

export const is404 = () => {
  return document.body.classList.contains('error404');
};

export const isSearchResults = () => {
  return document.body.classList.contains('search');
};

export const isSingleBlogPost = () => {
  return document.body.classList.contains('single-post');
};

export const isWoocommerceShop = () => {
  return document.body.classList.contains('woocommerce-shop');
};

export const isWoocommerceProduct = () => {
  return document.body.classList.contains('single-product');
};

export const isReturningVisitor = () => {
  const hadPreviousSession = localStorage.getItem('pwa_has_visited');

  if (!hadPreviousSession) {
    localStorage.setItem('pwa_has_visited', 'true');
    sessionStorage.setItem('pwa_first_session', 'true');
    return false;
  }

  if (sessionStorage.getItem('pwa_first_session')) {
    return false;
  }

  return true;
};

export const setCookie = (name, value, days) => {
  var expires = '';
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = '; expires=' + date.toUTCString();
  }
  document.cookie = name + '=' + (value || '') + expires + '; path=/';
};

export const getCookie = (name) => {
  var nameEQ = name + '=';
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
};

export const removeCookie = (name) => {
  setCookie(name, '', -1);
};
