import { config } from '../main.js';

export function getContrastTextColor(backgroundColor) {
  const temp = document.createElement('div');
  temp.style.backgroundColor = backgroundColor;
  temp.style.display = 'none';
  config.daftplugFrontend.appendChild(temp);

  const computedColor = window.getComputedStyle(temp).backgroundColor;
  config.daftplugFrontend.removeChild(temp);

  const [r, g, b] = computedColor.match(/\d+/g).map(Number);
  const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

  return luminance > 0.5 ? '#000000' : '#ffffff';
}

export function isSingleBlogPost() {
  return document.body.classList.contains('single-post');
}

export function isReturningVisitor() {
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
}

export function setCookie(name, value, days) {
  var expires = '';
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = '; expires=' + date.toUTCString();
  }
  document.cookie = name + '=' + (value || '') + expires + '; path=/';
}

export function getCookie(name) {
  var nameEQ = name + '=';
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

export function removeCookie(name) {
  setCookie(name, '', -1);
}
