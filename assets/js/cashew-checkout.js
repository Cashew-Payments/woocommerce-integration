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
    (content = renderContent()),
    wrap.appendChild(content),
    document.body.appendChild(container),
    show();
}

function renderContent() {
  var o = document.createElement("div");
  return (
    (o.id = "spotii-popup__content"),
    (o.className = "spotii-popup__content"),
    o
  );
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

  function t() {
    const o = e(
        "p",
        {},
        (function () {
          return navigator.vendor.startsWith("Apple");
        })()
          ? "Redirecting you to Spotii..."
          : "Checking your payment status with Spotii..."
      ),
      t = e(
        "span",
        {
          className: "sptii-text",
        },
        o
      ),
      i = e(
        "span",
        {
          className: "sptii-loading",
        },
        (function () {
          const o = e("span");
          return (
            (o.className = "sptii-loading-icon"),
            (o.innerHTML =
              '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path d="M988 548c-19.9 0-36-16.1-36-36 0-59.4-11.6-117-34.6-171.3a440.45 440.45 0 0 0-94.3-139.9 437.71 437.71 0 0 0-139.9-94.3C629 83.6 571.4 72 512 72c-19.9 0-36-16.1-36-36s16.1-36 36-36c69.1 0 136.2 13.5 199.3 40.3C772.3 66 827 103 874 150c47 47 83.9 101.8 109.7 162.7 26.7 63.1 40.2 130.2 40.2 199.3.1 19.9-16 36-35.9 36z" fill="orange" /></svg>'),
            o
          );
        })()
      ),
      n = e(
        "span",
        {
          className: "sptii-spinnerText",
        },
        t
      );
    return n.appendChild(i), n;
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
