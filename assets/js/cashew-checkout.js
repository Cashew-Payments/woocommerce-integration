const root = document.getElementsByTagName("body")[0];

const thirdPartySupported = (root) => {
  return new Promise((resolve, reject) => {
    const receiveMessage = function (evt) {
      if (evt.data === "MM:3PCunsupported") {
        reject();
      } else if (evt.data === "MM:3PCsupported") {
        resolve();
      }
    };
    window.addEventListener("message", receiveMessage, false);
    const frame = document.createElement("iframe");
    frame.src = "https://mindmup.github.io/3rdpartycookiecheck/start.html";
    frame.style.display = "none";
    root.appendChild(frame);
  });
};
var container,
  backdrop,
  styles,
  wrap,
  closeBtn,
  content,
  first = !0;

!(function (o) {
  "function" == typeof define && define.amd
    ? define(["jquery"], o)
    : "object" == typeof exports
    ? o(require("jquery"))
    : o(jQuery);
})(function (o) {
  function e(o) {
    return r.raw ? o : encodeURIComponent(o);
  }

  function t(o) {
    return r.raw ? o : decodeURIComponent(o);
  }

  function i(o) {
    return e(r.json ? JSON.stringify(o) : String(o));
  }

  function n(e, t) {
    var i = r.raw
      ? e
      : (function (o) {
          0 === o.indexOf('"') &&
            (o = o.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
          try {
            return (
              (o = decodeURIComponent(o.replace(p, " "))),
              r.json ? JSON.parse(o) : o
            );
          } catch (o) {}
        })(e);
    return o.isFunction(t) ? t(i) : i;
  }
  var p = /\+/g,
    r = (o.cookie = function (p, s, a) {
      if (void 0 !== s && !o.isFunction(s)) {
        if ("number" == typeof (a = o.extend({}, r.defaults, a)).expires) {
          var c = a.expires,
            l = (a.expires = new Date());
          l.setTime(+l + 864e5 * c);
        }
        return (document.cookie = [
          e(p),
          "=",
          i(s),
          a.expires ? "; expires=" + a.expires.toUTCString() : "",
          a.path ? "; path=" + a.path : "",
          a.domain ? "; domain=" + a.domain : "",
          a.secure ? "; secure" : "",
        ].join(""));
      }
      for (
        var d = p ? void 0 : {},
          u = document.cookie ? document.cookie.split("; ") : [],
          m = 0,
          h = u.length;
        h > m;
        m++
      ) {
        var g = u[m].split("="),
          f = t(g.shift()),
          _ = g.join("=");
        if (p && p === f) {
          d = n(_, s);
          break;
        }
        p || void 0 === (_ = n(_)) || (d[f] = _);
      }
      return d;
    });
  (r.defaults = {}),
    (o.removeCookie = function (e, t) {
      return (
        void 0 !== o.cookie(e) &&
        (o.cookie(
          e,
          "",
          o.extend({}, t, {
            expires: -1,
          })
        ),
        !o.cookie(e))
      );
    });
});

function render() {
  ((container = document.createElement("div")).className = "spotii-popup"),
    (container.id = "spotii-popup__container"),
    ((backdrop = document.createElement("div")).className =
      "spotii-popup__backdrop"),
    container.appendChild(backdrop),
    ((wrap = document.createElement("div")).className = "spotii-popup__wrap"),
    container.appendChild(wrap),
    document.body.appendChild(container),
    show();
}

function show() {
  var o = document.getElementById("spotii-popup__content");
  o.classList.add("spotii-animation-zoom-in"),
    (document.getElementById("spotii-popup__container").style.display =
      "block"),
    window.requestAnimationFrame(function () {
      o.classList.add("spotii-animation-zoom-in-enter");
    }),
    document.addEventListener("keydown", onDocumentKeyDown, !1);
}

function hide() {
  document
    .getElementById("spotii-popup__content")
    .classList.remove(
      "spotii-animation-zoom-in",
      "spotii-animation-zoom-in-enter"
    ),
    (document.getElementById("spotii-popup__container").style.display = "none"),
    document.removeEventListener("keydown", onDocumentKeyDown, !1),
    destroy();
}

function onDocumentKeyDown(o) {
  27 === o.keyCode && hide();
}

function destroy() {
  closeBtn.removeEventListener("click", hide, !1),
    document.removeEventListener("keydown", onDocumentKeyDown, !1),
    container.parentElement.removeChild(container),
    styles.parentElement.removeChild(styles),
    (container = null),
    (backdrop = null),
    (wrap = null),
    (content = null),
    (closeBtn = null),
    (styles = null);
}
jQuery(document).ready(function (o) {
  function e(o, e, t) {
    const i = document.createElement(o);
    return (
      e &&
        Object.keys(e).forEach(function (o) {
          i[o] = e[o];
        }),
      t && t.nodeType === Node.ELEMENT_NODE
        ? i.appendChild(t)
        : (i.innerHTML = t),
      i
    );
  }
  
  (showOverlay = function () {}),
    (openCashewCheckout = function (resp) {
      thirdPartySupported(root)
        .then(() => {
          cashew.checkout.response = {
            token: resp.token,
            orderId: resp.orderId,
            storeToken: resp.storeToken,
            successUrl: resp.successUrl,
            failureUrl: resp.failureUrl,
          };
          cashew.checkout.load();
        })
        .catch(() => {
          cashew.checkout.response = {
            token: resp.token,
            orderId: resp.orderId,
            storeToken: resp.storeToken,
            successUrl: resp.sucessURL,
            failureUrl: resp.cancelURL,
          };
          cashew.checkout.load();
        });
    }),
    (submit_error = function (e) {
      var t = o("form.checkout");
      o(
        ".woocommerce-NoticeGroup-checkout, .woocommerce-error, .woocommerce-message"
      ).remove(),
        t.prepend(
          '<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout">' +
            e +
            "</div>"
        ),
        t.removeClass("processing"),
        o(document).find(".blockUI.blockOverlay").remove(),
        t
          .find(".input-text, select, input:checkbox")
          .trigger("validate")
          .blur(),
        removeOverlay(),
        o(document.body).trigger("checkout_error");
    });
});
