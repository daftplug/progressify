!(function (e) {
  function t(t) {
    for (var n, i, s = t[0], c = t[1], u = t[2], d = 0, p = []; d < s.length; d++) (i = s[d]), Object.prototype.hasOwnProperty.call(a, i) && a[i] && p.push(a[i][0]), (a[i] = 0);
    for (n in c) Object.prototype.hasOwnProperty.call(c, n) && (e[n] = c[n]);
    for (l && l(t); p.length; ) p.shift()();
    return o.push.apply(o, u || []), r();
  }
  function r() {
    for (var e, t = 0; t < o.length; t++) {
      for (var r = o[t], n = !0, s = 1; s < r.length; s++) {
        var c = r[s];
        0 !== a[c] && (n = !1);
      }
      n && (o.splice(t--, 1), (e = i((i.s = r[0]))));
    }
    return e;
  }
  var n = {},
    a = { 2: 0 },
    o = [];
  function i(t) {
    if (n[t]) return n[t].exports;
    var r = (n[t] = { i: t, l: !1, exports: {} });
    return e[t].call(r.exports, r, r.exports, i), (r.l = !0), r.exports;
  }
  (i.m = e),
    (i.c = n),
    (i.d = function (e, t, r) {
      i.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: r });
    }),
    (i.r = function (e) {
      'undefined' !== typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: 'Module' }), Object.defineProperty(e, '__esModule', { value: !0 });
    }),
    (i.t = function (e, t) {
      if ((1 & t && (e = i(e)), 8 & t)) return e;
      if (4 & t && 'object' === typeof e && e && e.__esModule) return e;
      var r = Object.create(null);
      if ((i.r(r), Object.defineProperty(r, 'default', { enumerable: !0, value: e }), 2 & t && 'string' != typeof e))
        for (var n in e)
          i.d(
            r,
            n,
            function (t) {
              return e[t];
            }.bind(null, n)
          );
      return r;
    }),
    (i.n = function (e) {
      var t =
        e && e.__esModule
          ? function () {
              return e.default;
            }
          : function () {
              return e;
            };
      return i.d(t, 'a', t), t;
    }),
    (i.o = function (e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    }),
    (i.p = '/');
  var s = (this.webpackJsonp = this.webpackJsonp || []),
    c = s.push.bind(s);
  (s.push = t), (s = s.slice());
  for (var u = 0; u < s.length; u++) t(s[u]);
  var l = c;
  o.push([8, 0]), r();
})([
  ,
  function (e, t) {
    e.exports = jQuery;
  },
  ,
  ,
  function (e, t, r) {
    'use strict';
    var n = r(0);
    Object.defineProperty(t, '__esModule', { value: !0 }), (t.handleResponse = t.addUserToLast = t.isSupport = t.debug = t.getBottomBlock = t.serverAction = t.errorHook = t.fetchEndpoint = t.nonce = t.hasCredentials = t.ajaxUrl = t.t = t.cantWork = void 0);
    var a = n(r(2)),
      o = n(r(3)),
      i = n(r(1)),
      s = r(5),
      c = window.WP_TOUCH_LOGIN || {},
      u = c.t,
      l = c.ajaxUrl,
      d = c.pluginUrl,
      p = c.hasCredentials,
      f = c.nonce,
      v = c.cantWork;
    (t.nonce = f), (t.hasCredentials = p), (t.ajaxUrl = l), (t.t = u), (r.p = ''.concat(d, '/build/'));
    var g = v > 0;
    t.cantWork = g;
    var m = (function () {
      var e = (0, o.default)(
        a.default.mark(function e(t, r) {
          var n;
          return a.default.wrap(function (e) {
            for (;;)
              switch ((e.prev = e.next)) {
                case 0:
                  return (e.next = 2), i.default.ajax({ url: l + '?action='.concat(t, '&nonce=').concat(f), method: 'POST', data: JSON.stringify(r), contentType: 'application/json', dataType: 'json', redirect: 'error', xhrFields: { withCredentials: !0 }, crossDomain: !1 });
                case 2:
                  return (n = e.sent), h(n), e.abrupt('return', n);
                case 5:
                case 'end':
                  return e.stop();
              }
          }, e);
        })
      );
      return function (t, r) {
        return e.apply(this, arguments);
      };
    })();
    t.fetchEndpoint = m;
    t.errorHook = function () {
      var e = (0, i.default)('.wtl-error');
      return (
        e.slideUp(),
        function (t, r) {
          'NotAllowedError' === (null === r || void 0 === r ? void 0 : r.name) && (t = u.errorNoCreds + '<br/><br/>' + t), e.html(t).slideDown();
        }
      );
    };
    t.serverAction = function (e) {
      return (function () {
        var t = (0, o.default)(
          a.default.mark(function t(r) {
            var n, o, i, c;
            return a.default.wrap(function (t) {
              for (;;)
                switch ((t.prev = t.next)) {
                  case 0:
                    return (t.next = 2), m('plwp_'.concat(e, '_options'), r);
                  case 2:
                    if (((n = t.sent), (o = (0, s.preparePublicKeyOptions)(n.data)), (i = !1), 'register' !== e)) {
                      t.next = 11;
                      break;
                    }
                    return (t.next = 8), navigator.credentials.create({ publicKey: o });
                  case 8:
                    (i = t.sent), (t.next = 15);
                    break;
                  case 11:
                    if ('login' !== e) {
                      t.next = 15;
                      break;
                    }
                    return (t.next = 14), navigator.credentials.get({ publicKey: o });
                  case 14:
                    i = t.sent;
                  case 15:
                    return (c = (0, s.preparePublicKeyCredentials)(i)), (t.next = 18), m('plwp_'.concat(e), c);
                  case 18:
                    return (n = t.sent), t.abrupt('return', n);
                  case 20:
                  case 'end':
                    return t.stop();
                }
            }, t);
          })
        );
        return function (e) {
          return t.apply(this, arguments);
        };
      })();
    };
    t.getBottomBlock = function (e) {
      var t = e.text,
        r = e.image;
      return '<div class="wtl-form-bottom">\n<div class="wtl-form-bottom-image wtl-form-bottom-image--'.concat(r, '"></div>\n<div class="wtl-form-bottom-text">').concat(t, '</div>\n</div>');
    };
    t.debug = function (e) {
      console.log(e);
    };
    var w = (function () {
      var e = (0, o.default)(
        a.default.mark(function e() {
          return a.default.wrap(function (e) {
            for (;;)
              switch ((e.prev = e.next)) {
                case 0:
                  if (((e.t0 = void 0 !== window.PublicKeyCredential && void 0 !== navigator.credentials.create && 'function' === typeof navigator.credentials.create), !e.t0)) {
                    e.next = 5;
                    break;
                  }
                  return (e.next = 4), PublicKeyCredential.isUserVerifyingPlatformAuthenticatorAvailable();
                case 4:
                  e.t0 = e.sent;
                case 5:
                  return e.abrupt('return', e.t0);
                case 6:
                case 'end':
                  return e.stop();
              }
          }, e);
        })
      );
      return function () {
        return e.apply(this, arguments);
      };
    })();
    t.isSupport = w;
    t.addUserToLast = function (e) {
      if (e) {
        var t = JSON.parse(localStorage.getItem('wtl')) || {};
        (t.users = t.users || {}), (t.users[e.name] = e), localStorage.setItem('wtl', JSON.stringify(t));
      }
    };
    var h = function (e) {
      var t = e.success,
        r = e.data;
      if (!t) throw (r.redirect_to && (r.message ? confirm(r.message) && (location.href = r.redirect_to) : (location.href = r.redirect_to)), new Error(r.message || 'Unknown Error'));
    };
    t.handleResponse = h;
  },
  function (e, t, r) {
    'use strict';
    var n = r(0);
    Object.defineProperty(t, '__esModule', { value: !0 }), (t.preparePublicKeyCredentials = t.preparePublicKeyOptions = void 0);
    var a = n(r(7)),
      o = n(r(6)),
      i = function (e) {
        var t = (e = e.replace(/-/g, '+').replace(/_/g, '/')).length % 4;
        if (t) {
          if (1 === t) throw new Error('InvalidLengthError: Input base64url string is the wrong length to determine padding');
          e += new Array(5 - t).join('=');
        }
        return window.atob(e);
      },
      s = function (e) {
        return btoa(String.fromCharCode.apply(String, (0, o.default)(e)));
      };
    t.preparePublicKeyOptions = function (e) {
      return (
        (e.challenge = Uint8Array.from(i(e.challenge), function (e) {
          return e.charCodeAt(0);
        })),
        void 0 !== e.user &&
          (e.user = (0, a.default)({}, e.user, {
            id: Uint8Array.from(window.atob(e.user.id), function (e) {
              return e.charCodeAt(0);
            }),
          })),
        void 0 !== e.excludeCredentials &&
          (e.excludeCredentials = e.excludeCredentials.map(function (e) {
            return (0, a.default)({}, e, {
              id: Uint8Array.from(i(e.id), function (e) {
                return e.charCodeAt(0);
              }),
            });
          })),
        void 0 !== e.allowCredentials &&
          (e.allowCredentials = e.allowCredentials.map(function (e) {
            return (0, a.default)({}, e, {
              id: Uint8Array.from(i(e.id), function (e) {
                return e.charCodeAt(0);
              }),
            });
          })),
        e
      );
    };
    t.preparePublicKeyCredentials = function (e) {
      var t = { id: e.id, type: e.type, rawId: s(new Uint8Array(e.rawId)), response: { clientDataJSON: s(new Uint8Array(e.response.clientDataJSON)) } };
      return void 0 !== e.response.attestationObject && (t.response.attestationObject = s(new Uint8Array(e.response.attestationObject))), void 0 !== e.response.authenticatorData && (t.response.authenticatorData = s(new Uint8Array(e.response.authenticatorData))), void 0 !== e.response.signature && (t.response.signature = s(new Uint8Array(e.response.signature))), void 0 !== e.response.userHandle && (t.response.userHandle = s(new Uint8Array(e.response.userHandle))), t;
    };
  },
  ,
  ,
  function (e, t, r) {
    'use strict';
    var n = r(0),
      a = n(r(2)),
      o = n(r(3)),
      i = n(r(1));
    r(10);
    var s = r(4),
      c = function (e) {
        var t = e.displayName,
          r = e.id;
        return (0, i.default)('\n  <div class="wtl-login-form__user">\n    <div class="wtl-login-form__user-name">\n      '.concat(t, '\n    </div>\n    <span class="dashicons dashicons-arrow-right-alt"></span>\n  </div>\n')).click(
          (function () {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null;
            return (0, o.default)(
              a.default.mark(function t() {
                var r, n, o;
                return a.default.wrap(
                  function (t) {
                    for (;;)
                      switch ((t.prev = t.next)) {
                        case 0:
                          return (r = (0, s.errorHook)()), (t.prev = 1), (t.next = 4), (0, s.serverAction)('login')({ id: e });
                        case 4:
                          (n = t.sent), (o = n.data), n.success && (o.user && (0, s.addUserToLast)(o.user), o.redirect_to && (location.href = o.redirect_to)), (t.next = 13);
                          break;
                        case 10:
                          (t.prev = 10), (t.t0 = t.catch(1)), r(t.t0.message, t.t0);
                        case 13:
                        case 'end':
                          return t.stop();
                      }
                  },
                  t,
                  null,
                  [[1, 10]]
                );
              })
            );
          })(r)
        );
      },
      u = function () {
        var e = (0, i.default)('#loginform'),
          t = (0, i.default)('\n  <div class="wtl-login-form">\n    <h1>Biometric Authentication</h1>\n    \n    <div class="wtl-login-form__items"></div>\n    <div class="wtl-error"></div>\n    <div class="wtl-login-form__desc">'.concat(s.t.loginDesc, '</div>\n  </div>\n')).hide();
        e.before(t);
        var r = JSON.parse(localStorage.getItem('wtl')) || {};
        r.users = r.users || {};
        var n = (0, i.default)('.wtl-login-form__items');
        for (var a in r.users) {
          var o = r.users[a];
          n.append(c({ displayName: o.displayName, id: o.id }));
        }
        n.append(c({ displayName: s.t.anotherUser, id: void 0 })), t.slideDown('fast');
      };
    (0, o.default)(
      a.default.mark(function e() {
        var t, r, n, o;
        return a.default.wrap(function (e) {
          for (;;)
            switch ((e.prev = e.next)) {
              case 0:
                return (e.next = 2), (0, s.isSupport)();
              case 2:
                (t = e.sent), (r = (0, i.default)('#loginform')), t && !s.cantWork ? (s.hasCredentials && u(), r.addClass('wtl-bottom-block').append((0, s.getBottomBlock)({ image: 'sentiment', text: s.t.suportedText })), r.append('<input name="plwp_supported" value="1" type="hidden" />')) : s.cantWork ? ((n = '<strong>' + s.t.requiredSSL + '</strong>'), r.addClass('wtl-bottom-block').append((0, s.getBottomBlock)({ image: 'noted', text: n }))) : ((o = s.t.useCorrectBrowserOrLogin + '<br/>' + s.t.unsuportedText), s.cantWork || (o = '<strong>' + s.t.requiredSSL + '</strong><br/><br/>' + o), r.addClass('wtl-bottom-block').append((0, s.getBottomBlock)({ image: 'noted', text: o })));
              case 5:
              case 'end':
                return e.stop();
            }
        }, e);
      })
    )();
  },
  ,
  function (e, t, r) {},
]);
