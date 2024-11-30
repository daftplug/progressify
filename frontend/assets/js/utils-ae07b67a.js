import { config as t } from './frontend.js';
function e(e) {
  const n = document.createElement('div');
  (n.style.backgroundColor = e), (n.style.display = 'none'), t.daftplugFrontend.appendChild(n);
  const o = window.getComputedStyle(n).backgroundColor;
  t.daftplugFrontend.removeChild(n);
  const [s, r, i] = o.match(/\d+/g).map(Number);
  return (0.299 * s + 0.587 * r + 0.114 * i) / 255 > 0.5 ? '#000000' : '#ffffff';
}
function n() {
  return document.body.classList.contains('single-post');
}
function o() {
  return localStorage.getItem('pwa_has_visited') ? !sessionStorage.getItem('pwa_first_session') : (localStorage.setItem('pwa_has_visited', 'true'), sessionStorage.setItem('pwa_first_session', 'true'), !1);
}
function s(t, e, n) {
  var o = '';
  if (n) {
    var s = new Date();
    s.setTime(s.getTime() + 24 * n * 60 * 60 * 1e3), (o = '; expires=' + s.toUTCString());
  }
  document.cookie = t + '=' + (e || '') + o + '; path=/';
}
function r(t) {
  for (var e = t + '=', n = document.cookie.split(';'), o = 0; o < n.length; o++) {
    for (var s = n[o]; ' ' == s.charAt(0); ) s = s.substring(1, s.length);
    if (0 == s.indexOf(e)) return s.substring(e.length, s.length);
  }
  return null;
}
export { r as a, n as b, e as g, o as i, s };
