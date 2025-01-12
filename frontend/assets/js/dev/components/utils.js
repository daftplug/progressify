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

export const urlBase64ToUint8Array = (base64String) => {
  const padding = '='.repeat((4 - (base64String.length % 4)) % 4);
  const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }

  return outputArray;
};

export const hasUrlParam = (paramName, paramValue = '', url = window.location.href) => {
  const urlObject = new URL(url);
  if (paramValue) {
    return urlObject.searchParams.get(paramName) === paramValue;
  }
  return urlObject.searchParams.has(paramName);
};

export const addParamToUrl = (paramName, paramValue = '', url = window.location.href) => {
  const urlObject = new URL(url);
  if (paramValue === '') {
    urlObject.searchParams.append(paramName, '');
    return urlObject.href.replace(`${paramName}=`, paramName);
  }
  urlObject.searchParams.set(paramName, paramValue);
  return urlObject.href;
};

export const removeParamFromUrl = (paramName, url = window.location.href) => {
  const urlObject = new URL(url);
  urlObject.searchParams.delete(paramName);
  return urlObject.href;
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
