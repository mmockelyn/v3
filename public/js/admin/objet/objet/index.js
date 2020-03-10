/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 35);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/medium-zoom/dist/medium-zoom.esm.js":
/*!**********************************************************!*\
  !*** ./node_modules/medium-zoom/dist/medium-zoom.esm.js ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/*! medium-zoom 1.0.5 | MIT License | https://github.com/francoischalifour/medium-zoom */
var _extends = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

var isSupported = function isSupported(node) {
  return node.tagName === 'IMG';
};

/* eslint-disable-next-line no-prototype-builtins */
var isNodeList = function isNodeList(selector) {
  return NodeList.prototype.isPrototypeOf(selector);
};

var isNode = function isNode(selector) {
  return selector && selector.nodeType === 1;
};

var isSvg = function isSvg(image) {
  var source = image.currentSrc || image.src;
  return source.substr(-4).toLowerCase() === '.svg';
};

var getImagesFromSelector = function getImagesFromSelector(selector) {
  try {
    if (Array.isArray(selector)) {
      return selector.filter(isSupported);
    }

    if (isNodeList(selector)) {
      // Do not use spread operator or Array.from() for IE support
      return [].slice.call(selector).filter(isSupported);
    }

    if (isNode(selector)) {
      return [selector].filter(isSupported);
    }

    if (typeof selector === 'string') {
      // Do not use spread operator or Array.from() for IE support
      return [].slice.call(document.querySelectorAll(selector)).filter(isSupported);
    }

    return [];
  } catch (err) {
    throw new TypeError('The provided selector is invalid.\n' + 'Expects a CSS selector, a Node element, a NodeList or an array.\n' + 'See: https://github.com/francoischalifour/medium-zoom');
  }
};

var createOverlay = function createOverlay(background) {
  var overlay = document.createElement('div');
  overlay.classList.add('medium-zoom-overlay');
  overlay.style.background = background;

  return overlay;
};

var cloneTarget = function cloneTarget(template) {
  var _template$getBounding = template.getBoundingClientRect(),
      top = _template$getBounding.top,
      left = _template$getBounding.left,
      width = _template$getBounding.width,
      height = _template$getBounding.height;

  var clone = template.cloneNode();
  var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
  var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0;

  clone.removeAttribute('id');
  clone.style.position = 'absolute';
  clone.style.top = top + scrollTop + 'px';
  clone.style.left = left + scrollLeft + 'px';
  clone.style.width = width + 'px';
  clone.style.height = height + 'px';
  clone.style.transform = '';

  return clone;
};

var createCustomEvent = function createCustomEvent(type, params) {
  var eventParams = _extends({
    bubbles: false,
    cancelable: false,
    detail: undefined
  }, params);

  if (typeof window.CustomEvent === 'function') {
    return new CustomEvent(type, eventParams);
  }

  var customEvent = document.createEvent('CustomEvent');
  customEvent.initCustomEvent(type, eventParams.bubbles, eventParams.cancelable, eventParams.detail);

  return customEvent;
};

var mediumZoom = function mediumZoom(selector) {
  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  /**
   * Ensure the compatibility with IE11 if no Promise polyfill are used.
   */
  var Promise = window.Promise || function Promise(fn) {
    function noop() {}
    fn(noop, noop);
  };

  var _handleClick = function _handleClick(event) {
    var target = event.target;


    if (target === overlay) {
      close();
      return;
    }

    if (images.indexOf(target) === -1) {
      return;
    }

    toggle({ target: target });
  };

  var _handleScroll = function _handleScroll() {
    if (isAnimating || !active.original) {
      return;
    }

    var currentScroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

    if (Math.abs(scrollTop - currentScroll) > zoomOptions.scrollOffset) {
      setTimeout(close, 150);
    }
  };

  var _handleKeyUp = function _handleKeyUp(event) {
    var key = event.key || event.keyCode;

    // Close if escape key is pressed
    if (key === 'Escape' || key === 'Esc' || key === 27) {
      close();
    }
  };

  var update = function update() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    var newOptions = options;

    if (options.background) {
      overlay.style.background = options.background;
    }

    if (options.container && options.container instanceof Object) {
      newOptions.container = _extends({}, zoomOptions.container, options.container);
    }

    if (options.template) {
      var template = isNode(options.template) ? options.template : document.querySelector(options.template);

      newOptions.template = template;
    }

    zoomOptions = _extends({}, zoomOptions, newOptions);

    images.forEach(function (image) {
      image.dispatchEvent(createCustomEvent('medium-zoom:update', {
        detail: { zoom: zoom }
      }));
    });

    return zoom;
  };

  var clone = function clone() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    return mediumZoom(_extends({}, zoomOptions, options));
  };

  var attach = function attach() {
    for (var _len = arguments.length, selectors = Array(_len), _key = 0; _key < _len; _key++) {
      selectors[_key] = arguments[_key];
    }

    var newImages = selectors.reduce(function (imagesAccumulator, currentSelector) {
      return [].concat(imagesAccumulator, getImagesFromSelector(currentSelector));
    }, []);

    newImages.filter(function (newImage) {
      return images.indexOf(newImage) === -1;
    }).forEach(function (newImage) {
      images.push(newImage);
      newImage.classList.add('medium-zoom-image');
    });

    eventListeners.forEach(function (_ref) {
      var type = _ref.type,
          listener = _ref.listener,
          options = _ref.options;

      newImages.forEach(function (image) {
        image.addEventListener(type, listener, options);
      });
    });

    return zoom;
  };

  var detach = function detach() {
    for (var _len2 = arguments.length, selectors = Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      selectors[_key2] = arguments[_key2];
    }

    if (active.zoomed) {
      close();
    }

    var imagesToDetach = selectors.length > 0 ? selectors.reduce(function (imagesAccumulator, currentSelector) {
      return [].concat(imagesAccumulator, getImagesFromSelector(currentSelector));
    }, []) : images;

    imagesToDetach.forEach(function (image) {
      image.classList.remove('medium-zoom-image');
      image.dispatchEvent(createCustomEvent('medium-zoom:detach', {
        detail: { zoom: zoom }
      }));
    });

    images = images.filter(function (image) {
      return imagesToDetach.indexOf(image) === -1;
    });

    return zoom;
  };

  var on = function on(type, listener) {
    var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    images.forEach(function (image) {
      image.addEventListener('medium-zoom:' + type, listener, options);
    });

    eventListeners.push({ type: 'medium-zoom:' + type, listener: listener, options: options });

    return zoom;
  };

  var off = function off(type, listener) {
    var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    images.forEach(function (image) {
      image.removeEventListener('medium-zoom:' + type, listener, options);
    });

    eventListeners = eventListeners.filter(function (eventListener) {
      return !(eventListener.type === 'medium-zoom:' + type && eventListener.listener.toString() === listener.toString());
    });

    return zoom;
  };

  var open = function open() {
    var _ref2 = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
        target = _ref2.target;

    var _animate = function _animate() {
      var container = {
        width: document.documentElement.clientWidth,
        height: document.documentElement.clientHeight,
        left: 0,
        top: 0,
        right: 0,
        bottom: 0
      };
      var viewportWidth = void 0;
      var viewportHeight = void 0;

      if (zoomOptions.container) {
        if (zoomOptions.container instanceof Object) {
          // The container is given as an object with properties like width, height, left, top
          container = _extends({}, container, zoomOptions.container);

          // We need to adjust custom options like container.right or container.bottom
          viewportWidth = container.width - container.left - container.right - zoomOptions.margin * 2;
          viewportHeight = container.height - container.top - container.bottom - zoomOptions.margin * 2;
        } else {
          // The container is given as an element
          var zoomContainer = isNode(zoomOptions.container) ? zoomOptions.container : document.querySelector(zoomOptions.container);

          var _zoomContainer$getBou = zoomContainer.getBoundingClientRect(),
              _width = _zoomContainer$getBou.width,
              _height = _zoomContainer$getBou.height,
              _left = _zoomContainer$getBou.left,
              _top = _zoomContainer$getBou.top;

          container = _extends({}, container, {
            width: _width,
            height: _height,
            left: _left,
            top: _top
          });
        }
      }

      viewportWidth = viewportWidth || container.width - zoomOptions.margin * 2;
      viewportHeight = viewportHeight || container.height - zoomOptions.margin * 2;

      var zoomTarget = active.zoomedHd || active.original;
      var naturalWidth = isSvg(zoomTarget) ? viewportWidth : zoomTarget.naturalWidth || viewportWidth;
      var naturalHeight = isSvg(zoomTarget) ? viewportHeight : zoomTarget.naturalHeight || viewportHeight;

      var _zoomTarget$getBoundi = zoomTarget.getBoundingClientRect(),
          top = _zoomTarget$getBoundi.top,
          left = _zoomTarget$getBoundi.left,
          width = _zoomTarget$getBoundi.width,
          height = _zoomTarget$getBoundi.height;

      var scaleX = Math.min(naturalWidth, viewportWidth) / width;
      var scaleY = Math.min(naturalHeight, viewportHeight) / height;
      var scale = Math.min(scaleX, scaleY);
      var translateX = (-left + (viewportWidth - width) / 2 + zoomOptions.margin + container.left) / scale;
      var translateY = (-top + (viewportHeight - height) / 2 + zoomOptions.margin + container.top) / scale;
      var transform = 'scale(' + scale + ') translate3d(' + translateX + 'px, ' + translateY + 'px, 0)';

      active.zoomed.style.transform = transform;

      if (active.zoomedHd) {
        active.zoomedHd.style.transform = transform;
      }
    };

    return new Promise(function (resolve) {
      if (target && images.indexOf(target) === -1) {
        resolve(zoom);
        return;
      }

      var _handleOpenEnd = function _handleOpenEnd() {
        isAnimating = false;
        active.zoomed.removeEventListener('transitionend', _handleOpenEnd);
        active.original.dispatchEvent(createCustomEvent('medium-zoom:opened', {
          detail: { zoom: zoom }
        }));

        resolve(zoom);
      };

      if (active.zoomed) {
        resolve(zoom);
        return;
      }

      if (target) {
        // The zoom was triggered manually via a click
        active.original = target;
      } else if (images.length > 0) {
var _images = images;
        active.original = _images[0];
      } else {
        resolve(zoom);
        return;
      }

      active.original.dispatchEvent(createCustomEvent('medium-zoom:open', {
        detail: { zoom: zoom }
      }));

      scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
      isAnimating = true;
      active.zoomed = cloneTarget(active.original);

      document.body.appendChild(overlay);

      if (zoomOptions.template) {
        var template = isNode(zoomOptions.template) ? zoomOptions.template : document.querySelector(zoomOptions.template);
        active.template = document.createElement('div');
        active.template.appendChild(template.content.cloneNode(true));

        document.body.appendChild(active.template);
      }

      document.body.appendChild(active.zoomed);

      window.requestAnimationFrame(function () {
        document.body.classList.add('medium-zoom--opened');
      });

      active.original.classList.add('medium-zoom-image--hidden');
      active.zoomed.classList.add('medium-zoom-image--opened');

      active.zoomed.addEventListener('click', close);
      active.zoomed.addEventListener('transitionend', _handleOpenEnd);

      if (active.original.getAttribute('data-zoom-src')) {
        active.zoomedHd = active.zoomed.cloneNode();

        // Reset the `scrset` property or the HD image won't load.
        active.zoomedHd.removeAttribute('srcset');
        active.zoomedHd.removeAttribute('sizes');

        active.zoomedHd.src = active.zoomed.getAttribute('data-zoom-src');

        active.zoomedHd.onerror = function () {
          clearInterval(getZoomTargetSize);
          console.warn('Unable to reach the zoom image target ' + active.zoomedHd.src);
          active.zoomedHd = null;
          _animate();
        };

        // We need to access the natural size of the full HD
        // target as fast as possible to compute the animation.
        var getZoomTargetSize = setInterval(function () {
          if ( active.zoomedHd.complete) {
            clearInterval(getZoomTargetSize);
            active.zoomedHd.classList.add('medium-zoom-image--opened');
            active.zoomedHd.addEventListener('click', close);
            document.body.appendChild(active.zoomedHd);
            _animate();
          }
        }, 10);
      } else if (active.original.hasAttribute('srcset')) {
        // If an image has a `srcset` attribuet, we don't know the dimensions of the
        // zoomed (HD) image (like when `data-zoom-src` is specified).
        // Therefore the approach is quite similar.
        active.zoomedHd = active.zoomed.cloneNode();

        // Resetting the sizes attribute tells the browser to load the
        // image best fitting the current viewport size, respecting the `srcset`.
        active.zoomedHd.removeAttribute('sizes');

        // Wait for the load event of the hd image. This will fire if the image
        // is already cached.
        var loadEventListener = active.zoomedHd.addEventListener('load', function () {
          active.zoomedHd.removeEventListener('load', loadEventListener);
          active.zoomedHd.classList.add('medium-zoom-image--opened');
          active.zoomedHd.addEventListener('click', close);
          document.body.appendChild(active.zoomedHd);
          _animate();
        });
      } else {
        _animate();
      }
    });
  };

  var close = function close() {
    return new Promise(function (resolve) {
      if (isAnimating || !active.original) {
        resolve(zoom);
        return;
      }

      var _handleCloseEnd = function _handleCloseEnd() {
        active.original.classList.remove('medium-zoom-image--hidden');
        document.body.removeChild(active.zoomed);
        if (active.zoomedHd) {
          document.body.removeChild(active.zoomedHd);
        }
        document.body.removeChild(overlay);
        active.zoomed.classList.remove('medium-zoom-image--opened');
        if (active.template) {
          document.body.removeChild(active.template);
        }

        isAnimating = false;
        active.zoomed.removeEventListener('transitionend', _handleCloseEnd);

        active.original.dispatchEvent(createCustomEvent('medium-zoom:closed', {
          detail: { zoom: zoom }
        }));

        active.original = null;
        active.zoomed = null;
        active.zoomedHd = null;
        active.template = null;

        resolve(zoom);
      };

      isAnimating = true;
      document.body.classList.remove('medium-zoom--opened');
      active.zoomed.style.transform = '';

      if (active.zoomedHd) {
        active.zoomedHd.style.transform = '';
      }

      // Fade out the template so it's not too abrupt
      if (active.template) {
        active.template.style.transition = 'opacity 150ms';
        active.template.style.opacity = 0;
      }

      active.original.dispatchEvent(createCustomEvent('medium-zoom:close', {
        detail: { zoom: zoom }
      }));

      active.zoomed.addEventListener('transitionend', _handleCloseEnd);
    });
  };

  var toggle = function toggle() {
    var _ref3 = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
        target = _ref3.target;

    if (active.original) {
      return close();
    }

    return open({ target: target });
  };

  var getOptions = function getOptions() {
    return zoomOptions;
  };

  var getImages = function getImages() {
    return images;
  };

  var getZoomedImage = function getZoomedImage() {
    return active.original;
  };

  var images = [];
  var eventListeners = [];
  var isAnimating = false;
  var scrollTop = 0;
  var zoomOptions = options;
  var active = {
    original: null,
    zoomed: null,
    zoomedHd: null,
    template: null

    // If the selector is omitted, it's replaced by the options
  };if (Object.prototype.toString.call(selector) === '[object Object]') {
    zoomOptions = selector;
  } else if (selector || typeof selector === 'string' // to process empty string as a selector
  ) {
      attach(selector);
    }

  // Apply the default option values
  zoomOptions = _extends({
    margin: 0,
    background: '#fff',
    scrollOffset: 40,
    container: null,
    template: null
  }, zoomOptions);

  var overlay = createOverlay(zoomOptions.background);

  document.addEventListener('click', _handleClick);
  document.addEventListener('keyup', _handleKeyUp);
  document.addEventListener('scroll', _handleScroll);
  window.addEventListener('resize', close);

  var zoom = {
    open: open,
    close: close,
    toggle: toggle,
    update: update,
    clone: clone,
    attach: attach,
    detach: detach,
    on: on,
    off: off,
    getOptions: getOptions,
    getImages: getImages,
    getZoomedImage: getZoomedImage
  };

  return zoom;
};

function styleInject(css, ref) {
  if ( ref === void 0 ) ref = {};
  var insertAt = ref.insertAt;

  if (!css || typeof document === 'undefined') { return; }

  var head = document.head || document.getElementsByTagName('head')[0];
  var style = document.createElement('style');
  style.type = 'text/css';

  if (insertAt === 'top') {
    if (head.firstChild) {
      head.insertBefore(style, head.firstChild);
    } else {
      head.appendChild(style);
    }
  } else {
    head.appendChild(style);
  }

  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    style.appendChild(document.createTextNode(css));
  }
}

var css = ".medium-zoom-overlay{position:fixed;top:0;right:0;bottom:0;left:0;opacity:0;transition:opacity .3s;will-change:opacity}.medium-zoom--opened .medium-zoom-overlay{cursor:pointer;cursor:zoom-out;opacity:1}.medium-zoom-image{cursor:pointer;cursor:zoom-in;transition:transform .3s cubic-bezier(.2,0,.2,1)!important}.medium-zoom-image--hidden{visibility:hidden}.medium-zoom-image--opened{position:relative;cursor:pointer;cursor:zoom-out;will-change:transform}";
styleInject(css);

/* harmony default export */ __webpack_exports__["default"] = (mediumZoom);


/***/ }),

/***/ "./resources/demo5/src/assets/js/global/components/base/datatable/core.datatable.js":
/*!******************************************************************************************!*\
  !*** ./resources/demo5/src/assets/js/global/components/base/datatable/core.datatable.js ***!
  \******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

(function ($) {
  var pluginName = 'KTDatatable';
  var pfx = 'kt-';
  var util = KTUtil;
  var app = KTApp;
  if (typeof util === 'undefined') throw new Error('Util class is required and must be included before ' + pluginName); // plugin setup

  $.fn[pluginName] = function (options) {
    if ($(this).length === 0) {
      console.warn('No ' + pluginName + ' element exist.');
      return;
    } // global variables


    var datatable = this; // debug enabled?
    // 1) state will be cleared on each refresh
    // 2) enable some logs
    // 3) etc.

    datatable.debug = false;
    datatable.API = {
      record: null,
      value: null,
      params: null
    };
    var Plugin = {
      /********************
       ** PRIVATE METHODS
       ********************/
      isInit: false,
      cellOffset: 110,
      iconOffset: 15,
      stateId: 'meta',
      ajaxParams: {},
      pagingObject: {},
      init: function init(options) {
        var isHtmlTable = false; // data source option empty is normal table

        if (options.data.source === null) {
          Plugin.extractTable();
          isHtmlTable = true;
        }

        Plugin.setupBaseDOM.call();
        Plugin.setupDOM(datatable.table); // set custom query from options

        Plugin.setDataSourceQuery(Plugin.getOption('data.source.read.params.query')); // on event after layout had done setup, show datatable

        $(datatable).on(pfx + 'datatable--on-layout-updated', Plugin.afterRender);

        if (datatable.debug) {
          Plugin.stateRemove(Plugin.stateId);
        } // initialize extensions


        $.each(Plugin.getOption('extensions'), function (extName, extOptions) {
          if (typeof $.fn[pluginName][extName] === 'function') {
            new $.fn[pluginName][extName](datatable, extOptions);
          }
        });
        Plugin.spinnerCallback(true); // get data

        if (options.data.type === 'remote' || options.data.type === 'local') {
          if (options.data.saveState === false || options.data.saveState.cookie === false && options.data.saveState.webstorage === false) {
            Plugin.stateRemove(Plugin.stateId);
          } // get data for local datatable and local table


          if (options.data.type === 'local' && _typeof(options.data.source) === 'object') {
            datatable.dataSet = datatable.originalDataSet = Plugin.dataMapCallback(options.data.source);
          }

          Plugin.dataRender();
        } // if html table, remove and setup a new header


        if (isHtmlTable) {
          $(datatable.tableHead).find('tr').remove();
          $(datatable.tableFoot).find('tr').remove();
        }

        Plugin.setHeadTitle();

        if (Plugin.getOption('layout.footer')) {
          Plugin.setHeadTitle(datatable.tableFoot);
        } // hide header


        if (typeof options.layout.header !== 'undefined' && options.layout.header === false) {
          $(datatable.table).find('thead').remove();
        } // hide footer


        if (typeof options.layout.footer !== 'undefined' && options.layout.footer === false) {
          $(datatable.table).find('tfoot').remove();
        } // for normal and local data type, run layoutUpdate


        if (options.data.type === null || options.data.type === 'local') {
          Plugin.setupCellField.call();
          Plugin.setupTemplateCell.call(); // setup nested datatable, if option enabled

          Plugin.setupSubDatatable.call(); // setup extra system column properties

          Plugin.setupSystemColumn.call();
          Plugin.redraw();
        }

        var width;
        var initialWidth = false;
        $(window).resize(function () {
          // issue: URL Bar Resizing on mobile, https://developers.google.com/web/updates/2016/12/url-bar-resizing
          // trigger datatable resize on width change only
          if ($(this).width() !== width) {
            width = $(this).width();
            Plugin.fullRender();
          } // get initial width


          if (!initialWidth) {
            width = $(this).width();
            initialWidth = true;
          }
        });
        $(datatable).height('');
        var prevKeyword = '';
        $(Plugin.getOption('search.input')).on('keyup', function (e) {
          if (Plugin.getOption('search.onEnter') && e.which !== 13) return;
          var keyword = $(this).val(); // prevent multiple search request on every button keyup

          if (prevKeyword !== keyword) {
            Plugin.search(keyword);
            prevKeyword = keyword;
          }
        });
        return datatable;
      },

      /**
       * Extract static HTML table content into datasource
       */
      extractTable: function extractTable() {
        var columns = [];
        var headers = $(datatable).find('tr:first-child th').get().map(function (cell, i) {
          var field = $(cell).data('field');

          if (typeof field === 'undefined') {
            field = $(cell).text().trim();
          }

          var column = {
            field: field,
            title: field
          };

          for (var ii in options.columns) {
            if (options.columns[ii].field === field) {
              column = $.extend(true, {}, options.columns[ii], column);
            }
          }

          columns.push(column);
          return field;
        }); // auto create columns config

        options.columns = columns;
        var rowProp = [];
        var source = [];
        $(datatable).find('tr').each(function () {
          if ($(this).find('td').length) {
            rowProp.push($(this).prop('attributes'));
          }

          var td = {};
          $(this).find('td').each(function (i, cell) {
            td[headers[i]] = cell.innerHTML.trim();
          });

          if (!util.isEmpty(td)) {
            source.push(td);
          }
        });
        options.data.attr.rowProps = rowProp;
        options.data.source = source;
      },

      /**
       * One time layout update on init
       */
      layoutUpdate: function layoutUpdate() {
        // setup nested datatable, if option enabled
        Plugin.setupSubDatatable.call(); // setup extra system column properties

        Plugin.setupSystemColumn.call(); // setup cell hover event

        Plugin.setupHover.call();

        if (typeof options.detail === 'undefined' // temporary disable lock column in subtable
        && Plugin.getDepth() === 1) {
          // lock columns handler
          Plugin.lockTable.call();
        }

        Plugin.resetScroll(); // check if not is a locked column

        if (!Plugin.isLocked()) {
          Plugin.redraw.call(); // check if its not a subtable and has autoHide option enabled

          if (!Plugin.isSubtable() && Plugin.getOption('rows.autoHide') === true) {
            Plugin.autoHide();
          } // reset row


          $(datatable.table).find('.' + pfx + 'datatable__row').css('height', '');
        }

        Plugin.columnHide.call();
        Plugin.rowEvenOdd.call();
        Plugin.sorting.call();
        Plugin.scrollbar.call();

        if (!Plugin.isInit) {
          // run once dropdown inside datatable
          Plugin.dropdownFix();
          $(datatable).trigger(pfx + 'datatable--on-init', {
            table: $(datatable.wrap).attr('id'),
            options: options
          });
          Plugin.isInit = true;
        }

        $(datatable).trigger(pfx + 'datatable--on-layout-updated', {
          table: $(datatable.wrap).attr('id')
        });
      },
      dropdownFix: function dropdownFix() {
        var dropdownMenu;
        $('body').on('show.bs.dropdown', '.' + pfx + 'datatable .' + pfx + 'datatable__body', function (e) {
          dropdownMenu = $(e.target).find('.dropdown-menu');
          $('body').append(dropdownMenu.detach());
          dropdownMenu.css('display', 'block');
          dropdownMenu.position({
            'my': 'right top',
            'at': 'right bottom',
            'of': $(e.relatedTarget)
          }); // if datatable is inside modal

          if (datatable.closest('.modal').length) {
            // increase dropdown z-index
            dropdownMenu.css('z-index', '2000');
          }
        }).on('hide.bs.dropdown', '.' + pfx + 'datatable .' + pfx + 'datatable__body', function (e) {
          $(e.target).append(dropdownMenu.detach());
          dropdownMenu.hide();
        }); // remove dropdown if window resize

        $(window).on('resize', function (e) {
          if (typeof dropdownMenu !== 'undefined') {
            dropdownMenu.hide();
          }
        });
      },
      lockTable: function lockTable() {
        var lock = {
          lockEnabled: false,
          init: function init() {
            // check if table should be locked columns
            lock.lockEnabled = Plugin.lockEnabledColumns();

            if (lock.lockEnabled.left.length === 0 && lock.lockEnabled.right.length === 0) {
              return;
            }

            lock.enable();
          },
          enable: function enable() {
            var enableLock = function enableLock(tablePart) {
              // check if already has lock column
              if ($(tablePart).find('.' + pfx + 'datatable__lock').length > 0) {
                Plugin.log('Locked container already exist in: ', tablePart);
                return;
              } // check if no rows exists


              if ($(tablePart).find('.' + pfx + 'datatable__row').length === 0) {
                Plugin.log('No row exist in: ', tablePart);
                return;
              } // locked div container


              var lockLeft = $('<div/>').addClass(pfx + 'datatable__lock ' + pfx + 'datatable__lock--left');
              var lockScroll = $('<div/>').addClass(pfx + 'datatable__lock ' + pfx + 'datatable__lock--scroll');
              var lockRight = $('<div/>').addClass(pfx + 'datatable__lock ' + pfx + 'datatable__lock--right');
              $(tablePart).find('.' + pfx + 'datatable__row').each(function () {
                // create new row for lock columns and pass the data
                var rowLeft = $('<tr/>').addClass(pfx + 'datatable__row').data('obj', $(this).data('obj')).appendTo(lockLeft);
                var rowScroll = $('<tr/>').addClass(pfx + 'datatable__row').data('obj', $(this).data('obj')).appendTo(lockScroll);
                var rowRight = $('<tr/>').addClass(pfx + 'datatable__row').data('obj', $(this).data('obj')).appendTo(lockRight);
                $(this).find('.' + pfx + 'datatable__cell').each(function () {
                  var locked = $(this).data('locked');

                  if (typeof locked !== 'undefined') {
                    if (typeof locked.left !== 'undefined' || locked === true) {
                      // default locked to left
                      $(this).appendTo(rowLeft);
                    }

                    if (typeof locked.right !== 'undefined') {
                      $(this).appendTo(rowRight);
                    }
                  } else {
                    $(this).appendTo(rowScroll);
                  }
                }); // remove old row

                $(this).remove();
              });

              if (lock.lockEnabled.left.length > 0) {
                $(datatable.wrap).addClass(pfx + 'datatable--lock');
                $(lockLeft).appendTo(tablePart);
              }

              if (lock.lockEnabled.left.length > 0 || lock.lockEnabled.right.length > 0) {
                $(lockScroll).appendTo(tablePart);
              }

              if (lock.lockEnabled.right.length > 0) {
                $(datatable.wrap).addClass(pfx + 'datatable--lock');
                $(lockRight).appendTo(tablePart);
              }
            };

            $(datatable.table).find('thead,tbody,tfoot').each(function () {
              var tablePart = this;

              if ($(this).find('.' + pfx + 'datatable__lock').length === 0) {
                $(this).ready(function () {
                  enableLock(tablePart);
                });
              }
            });
          }
        };
        lock.init();
        return lock;
      },

      /**
       * Render everything for resize
       */
      fullRender: function fullRender() {
        $(datatable.tableHead).empty();
        Plugin.setHeadTitle();

        if (Plugin.getOption('layout.footer')) {
          $(datatable.tableFoot).empty();
          Plugin.setHeadTitle(datatable.tableFoot);
        }

        Plugin.spinnerCallback(true);
        $(datatable.wrap).removeClass(pfx + 'datatable--loaded');
        Plugin.insertData();
      },
      lockEnabledColumns: function lockEnabledColumns() {
        var screen = $(window).width();
        var columns = options.columns;
        var enabled = {
          left: [],
          right: []
        };
        $.each(columns, function (i, column) {
          if (typeof column.locked !== 'undefined') {
            if (typeof column.locked.left !== 'undefined') {
              if (util.getBreakpoint(column.locked.left) <= screen) {
                enabled['left'].push(column.locked.left);
              }
            }

            if (typeof column.locked.right !== 'undefined') {
              if (util.getBreakpoint(column.locked.right) <= screen) {
                enabled['right'].push(column.locked.right);
              }
            }
          }
        });
        return enabled;
      },

      /**
       * After render event, called by
       * '+pfx+'-datatable--on-layout-updated
       * @param e
       * @param args
       */
      afterRender: function afterRender(e, args) {
        $(datatable).ready(function () {
          // redraw locked columns table
          if (Plugin.isLocked()) {
            Plugin.redraw();
          }

          $(datatable.tableBody).css('visibility', '');
          $(datatable.wrap).addClass(pfx + 'datatable--loaded');
          Plugin.spinnerCallback(false);
        });
      },
      hoverTimer: 0,
      isScrolling: false,
      setupHover: function setupHover() {
        $(window).scroll(function (e) {
          // stop hover when scrolling
          clearTimeout(Plugin.hoverTimer);
          Plugin.isScrolling = true;
        });
        $(datatable.tableBody).find('.' + pfx + 'datatable__cell').off('mouseenter', 'mouseleave').on('mouseenter', function () {
          // reset scroll timer to hover class
          Plugin.hoverTimer = setTimeout(function () {
            Plugin.isScrolling = false;
          }, 200);
          if (Plugin.isScrolling) return; // normal table

          var row = $(this).closest('.' + pfx + 'datatable__row').addClass(pfx + 'datatable__row--hover');
          var index = $(row).index() + 1; // lock table

          $(row).closest('.' + pfx + 'datatable__lock').parent().find('.' + pfx + 'datatable__row:nth-child(' + index + ')').addClass(pfx + 'datatable__row--hover');
        }).on('mouseleave', function () {
          // normal table
          var row = $(this).closest('.' + pfx + 'datatable__row').removeClass(pfx + 'datatable__row--hover');
          var index = $(row).index() + 1; // look table

          $(row).closest('.' + pfx + 'datatable__lock').parent().find('.' + pfx + 'datatable__row:nth-child(' + index + ')').removeClass(pfx + 'datatable__row--hover');
        });
      },

      /**
       * Adjust width of locked table containers by resize handler
       * @returns {number}
       */
      adjustLockContainer: function adjustLockContainer() {
        if (!Plugin.isLocked()) return 0; // refer to head dimension

        var containerWidth = $(datatable.tableHead).width();
        var lockLeft = $(datatable.tableHead).find('.' + pfx + 'datatable__lock--left').width();
        var lockRight = $(datatable.tableHead).find('.' + pfx + 'datatable__lock--right').width();
        if (typeof lockLeft === 'undefined') lockLeft = 0;
        if (typeof lockRight === 'undefined') lockRight = 0;
        var lockScroll = Math.floor(containerWidth - lockLeft - lockRight);
        $(datatable.table).find('.' + pfx + 'datatable__lock--scroll').css('width', lockScroll);
        return lockScroll;
      },

      /**
       * todo; not in use
       */
      dragResize: function dragResize() {
        var pressed = false;
        var start = undefined;
        var startX, startWidth;
        $(datatable.tableHead).find('.' + pfx + 'datatable__cell').mousedown(function (e) {
          start = $(this);
          pressed = true;
          startX = e.pageX;
          startWidth = $(this).width();
          $(start).addClass(pfx + 'datatable__cell--resizing');
        }).mousemove(function (e) {
          if (pressed) {
            var i = $(start).index();
            var tableBody = $(datatable.tableBody);
            var ifLocked = $(start).closest('.' + pfx + 'datatable__lock');

            if (ifLocked) {
              var lockedIndex = $(ifLocked).index();
              tableBody = $(datatable.tableBody).find('.' + pfx + 'datatable__lock').eq(lockedIndex);
            }

            $(tableBody).find('.' + pfx + 'datatable__row').each(function (tri, tr) {
              $(tr).find('.' + pfx + 'datatable__cell').eq(i).width(startWidth + (e.pageX - startX)).children().width(startWidth + (e.pageX - startX));
            });
            $(start).children().css('width', startWidth + (e.pageX - startX));
          }
        }).mouseup(function () {
          $(start).removeClass(pfx + 'datatable__cell--resizing');
          pressed = false;
        });
        $(document).mouseup(function () {
          $(start).removeClass(pfx + 'datatable__cell--resizing');
          pressed = false;
        });
      },

      /**
       * To prepare placeholder for table before content is loading
       */
      initHeight: function initHeight() {
        if (options.layout.height && options.layout.scroll) {
          var theadHeight = $(datatable.tableHead).find('.' + pfx + 'datatable__row').outerHeight();
          var tfootHeight = $(datatable.tableFoot).find('.' + pfx + 'datatable__row').outerHeight();
          var bodyHeight = options.layout.height;

          if (theadHeight > 0) {
            bodyHeight -= theadHeight;
          }

          if (tfootHeight > 0) {
            bodyHeight -= tfootHeight;
          } // scrollbar offset


          bodyHeight -= 2;
          $(datatable.tableBody).css('max-height', Math.floor(parseFloat(bodyHeight))); // set scrollable area fixed height
          // $(datatable.tableBody).find('.' + pfx + 'datatable__lock--scroll').css('height', Math.floor(parseFloat(bodyHeight)));
        }
      },

      /**
       * Setup base DOM (table, thead, tbody, tfoot) and create if not
       * exist.
       */
      setupBaseDOM: function setupBaseDOM() {
        // keep original state before datatable initialize
        datatable.initialDatatable = $(datatable).clone(); // main element

        if ($(datatable).prop('tagName') === 'TABLE') {
          // if main init element is <table>, wrap with div
          datatable.table = $(datatable).removeClass(pfx + 'datatable').addClass(pfx + 'datatable__table');

          if ($(datatable.table).parents('.' + pfx + 'datatable').length === 0) {
            datatable.table.wrap($('<div/>').addClass(pfx + 'datatable').addClass(pfx + 'datatable--' + options.layout.theme));
            datatable.wrap = $(datatable.table).parent();
          }
        } else {
          // create table
          datatable.wrap = $(datatable).addClass(pfx + 'datatable').addClass(pfx + 'datatable--' + options.layout.theme);
          datatable.table = $('<table/>').addClass(pfx + 'datatable__table').appendTo(datatable);
        }

        if (typeof options.layout["class"] !== 'undefined') {
          $(datatable.wrap).addClass(options.layout["class"]);
        }

        $(datatable.table).removeClass(pfx + 'datatable--destroyed').css('display', 'block'); // force disable save state

        if (typeof $(datatable).attr('id') === 'undefined') {
          Plugin.setOption('data.saveState', false);
          $(datatable.table).attr('id', util.getUniqueID(pfx + 'datatable--'));
        } // predefine table height


        if (Plugin.getOption('layout.minHeight')) $(datatable.table).css('min-height', Plugin.getOption('layout.minHeight'));
        if (Plugin.getOption('layout.height')) $(datatable.table).css('max-height', Plugin.getOption('layout.height')); // for normal table load

        if (options.data.type === null) {
          $(datatable.table).css('width', '').css('display', '');
        } // create table head element


        datatable.tableHead = $(datatable.table).find('thead');

        if ($(datatable.tableHead).length === 0) {
          datatable.tableHead = $('<thead/>').prependTo(datatable.table);
        } // create table head element


        datatable.tableBody = $(datatable.table).find('tbody');

        if ($(datatable.tableBody).length === 0) {
          datatable.tableBody = $('<tbody/>').appendTo(datatable.table);
        }

        if (typeof options.layout.footer !== 'undefined' && options.layout.footer) {
          // create table foot element
          datatable.tableFoot = $(datatable.table).find('tfoot');

          if ($(datatable.tableFoot).length === 0) {
            datatable.tableFoot = $('<tfoot/>').appendTo(datatable.table);
          }
        }
      },

      /**
       * Set column data before table manipulation.
       */
      setupCellField: function setupCellField(tableParts) {
        if (typeof tableParts === 'undefined') tableParts = $(datatable.table).children();
        var columns = options.columns;
        $.each(tableParts, function (part, tablePart) {
          $(tablePart).find('.' + pfx + 'datatable__row').each(function (tri, tr) {
            // prepare data
            $(tr).find('.' + pfx + 'datatable__cell').each(function (tdi, td) {
              if (typeof columns[tdi] !== 'undefined') {
                $(td).data(columns[tdi]);
              }
            });
          });
        });
      },

      /**
       * Set column template callback
       * @param tablePart
       */
      setupTemplateCell: function setupTemplateCell(tablePart) {
        if (typeof tablePart === 'undefined') tablePart = datatable.tableBody;
        var columns = options.columns;
        $(tablePart).find('.' + pfx + 'datatable__row').each(function (tri, tr) {
          // row data object, if any
          var obj = $(tr).data('obj');

          if (typeof obj === 'undefined') {
            return;
          } // @deprecated in v5.0.6
          // obj['getIndex'] = function() {
          // 	return tri;
          // };
          // @deprecated in v5.0.6
          // obj['getDatatable'] = function() {
          // 	return datatable;
          // };
          // @deprecated in v5.0.6


          var rowCallback = Plugin.getOption('rows.callback');

          if (typeof rowCallback === 'function') {
            rowCallback($(tr), obj, tri);
          } // before template row callback


          var beforeTemplate = Plugin.getOption('rows.beforeTemplate');

          if (typeof beforeTemplate === 'function') {
            beforeTemplate($(tr), obj, tri);
          } // if data object is undefined, collect from table


          if (typeof obj === 'undefined') {
            obj = {};
            $(tr).find('.' + pfx + 'datatable__cell').each(function (tdi, td) {
              // get column settings by field
              var column = $.grep(columns, function (n, i) {
                return $(td).data('field') === n.field;
              })[0];

              if (typeof column !== 'undefined') {
                obj[column['field']] = $(td).text();
              }
            });
          }

          $(tr).find('.' + pfx + 'datatable__cell').each(function (tdi, td) {
            // get column settings by field
            var column = $.grep(columns, function (n, i) {
              return $(td).data('field') === n.field;
            })[0];

            if (typeof column !== 'undefined') {
              // column template
              if (typeof column.template !== 'undefined') {
                var finalValue = ''; // template string

                if (typeof column.template === 'string') {
                  finalValue = Plugin.dataPlaceholder(column.template, obj);
                } // template callback function


                if (typeof column.template === 'function') {
                  finalValue = column.template(obj, tri, datatable);
                } // sanitize using DOMPurify if installed


                if (typeof DOMPurify !== 'undefined') {
                  finalValue = DOMPurify.sanitize(finalValue);
                }

                var span = document.createElement('span');
                span.innerHTML = finalValue; // insert to cell, wrap with span

                $(td).html(span); // set span overflow

                if (typeof column.overflow !== 'undefined') {
                  $(span).css('overflow', column.overflow);
                  $(span).css('position', 'relative');
                }
              }
            }
          }); // after template row callback

          var afterTemplate = Plugin.getOption('rows.afterTemplate');

          if (typeof afterTemplate === 'function') {
            afterTemplate($(tr), obj, tri);
          }
        });
      },

      /**
       * Setup extra system column properties
       * Note: selector checkbox, subtable toggle
       */
      setupSystemColumn: function setupSystemColumn() {
        datatable.dataSet = datatable.dataSet || []; // no records available

        if (datatable.dataSet.length === 0) return;
        var columns = options.columns;
        $(datatable.tableBody).find('.' + pfx + 'datatable__row').each(function (tri, tr) {
          $(tr).find('.' + pfx + 'datatable__cell').each(function (tdi, td) {
            // get column settings by field
            var column = $.grep(columns, function (n, i) {
              return $(td).data('field') === n.field;
            })[0];

            if (typeof column !== 'undefined') {
              var value = $(td).text(); // enable column selector

              if (typeof column.selector !== 'undefined' && column.selector !== false) {
                // check if checkbox exist
                if ($(td).find('.' + pfx + 'checkbox [type="checkbox"]').length > 0) return;
                $(td).addClass(pfx + 'datatable__cell--check'); // append checkbox

                var chk = $('<label/>').addClass(pfx + 'checkbox ' + pfx + 'checkbox--single').append($('<input/>').attr('type', 'checkbox').attr('value', value).on('click', function () {
                  if ($(this).is(':checked')) {
                    // add checkbox active row class
                    Plugin.setActive(this);
                  } else {
                    // add checkbox active row class
                    Plugin.setInactive(this);
                  }
                })).append('&nbsp;<span></span>'); // checkbox selector has outline style

                if (typeof column.selector["class"] !== 'undefined') {
                  $(chk).addClass(column.selector["class"]);
                }

                $(td).children().html(chk);
              } // enable column subtable toggle


              if (typeof column.subtable !== 'undefined' && column.subtable) {
                // check if subtable toggle exist
                if ($(td).find('.' + pfx + 'datatable__toggle-subtable').length > 0) return; // append subtable toggle

                $(td).children().html($('<a/>').addClass(pfx + 'datatable__toggle-subtable').attr('href', '#').attr('data-value', value).append($('<i/>').addClass(Plugin.getOption('layout.icons.rowDetail.collapse'))));
              }
            }
          });
        }); // init checkbox for header/footer

        var initCheckbox = function initCheckbox(tr) {
          // get column settings by field
          var column = $.grep(columns, function (n, i) {
            return typeof n.selector !== 'undefined' && n.selector !== false;
          })[0];

          if (typeof column !== 'undefined') {
            // enable column selector
            if (typeof column.selector !== 'undefined' && column.selector !== false) {
              var td = $(tr).find('[data-field="' + column.field + '"]'); // check if checkbox exist

              if ($(td).find('.' + pfx + 'checkbox [type="checkbox"]').length > 0) return;
              $(td).addClass(pfx + 'datatable__cell--check'); // append checkbox

              var chk = $('<label/>').addClass(pfx + 'checkbox ' + pfx + 'checkbox--single ' + pfx + 'checkbox--all').append($('<input/>').attr('type', 'checkbox').on('click', function () {
                if ($(this).is(':checked')) {
                  Plugin.setActiveAll(true);
                } else {
                  Plugin.setActiveAll(false);
                }
              })).append('&nbsp;<span></span>'); // checkbox selector has outline style

              if (typeof column.selector["class"] !== 'undefined') {
                $(chk).addClass(column.selector["class"]);
              }

              $(td).children().html(chk);
            }
          }
        };

        if (options.layout.header) {
          initCheckbox($(datatable.tableHead).find('.' + pfx + 'datatable__row').first());
        }

        if (options.layout.footer) {
          initCheckbox($(datatable.tableFoot).find('.' + pfx + 'datatable__row').first());
        }
      },
      maxWidthList: {},

      /**
       * Adjust width to match container size
       */
      adjustCellsWidth: function adjustCellsWidth() {
        // get table width
        var containerWidth = $(datatable.tableBody).innerWidth() - Plugin.iconOffset; // get total number of columns

        var columns = $(datatable.tableBody).find('.' + pfx + 'datatable__row:first-child').find('.' + pfx + 'datatable__cell'). // exclude expand icon
        not('.' + pfx + 'datatable__toggle-detail').not(':hidden').length;

        if (columns > 0) {
          //  remove reserved sort icon width
          containerWidth = containerWidth - Plugin.iconOffset * columns;
          var minWidth = Math.floor(containerWidth / columns); // minimum width

          if (minWidth <= Plugin.cellOffset) {
            minWidth = Plugin.cellOffset;
          }

          $(datatable.table).find('.' + pfx + 'datatable__row').find('.' + pfx + 'datatable__cell'). // exclude expand icon
          not('.' + pfx + 'datatable__toggle-detail').not(':hidden').each(function (tdi, td) {
            var width = minWidth;
            var dataWidth = $(td).data('width');

            if (typeof dataWidth !== 'undefined') {
              if (dataWidth === 'auto') {
                var field = $(td).data('field');

                if (Plugin.maxWidthList[field]) {
                  width = Plugin.maxWidthList[field];
                } else {
                  var cells = $(datatable.table).find('.' + pfx + 'datatable__cell[data-field="' + field + '"]');
                  width = Plugin.maxWidthList[field] = Math.max.apply(null, $(cells).map(function () {
                    return $(this).outerWidth();
                  }).get());
                }
              } else {
                width = dataWidth;
              }
            }

            $(td).children().css('width', Math.ceil(width));
          });
        }

        return datatable;
      },

      /**
       * Adjust height to match container size
       */
      adjustCellsHeight: function adjustCellsHeight() {
        $.each($(datatable.table).children(), function (part, tablePart) {
          var totalRows = $(tablePart).find('.' + pfx + 'datatable__row').first().parent().find('.' + pfx + 'datatable__row').length;

          for (var i = 1; i <= totalRows; i++) {
            var rows = $(tablePart).find('.' + pfx + 'datatable__row:nth-child(' + i + ')');

            if ($(rows).length > 0) {
              var maxHeight = Math.max.apply(null, $(rows).map(function () {
                return $(this).outerHeight();
              }).get());
              $(rows).css('height', Math.ceil(maxHeight));
            }
          }
        });
      },

      /**
       * Setup table DOM and classes
       */
      setupDOM: function setupDOM(table) {
        // set table classes
        $(table).find('> thead').addClass(pfx + 'datatable__head');
        $(table).find('> tbody').addClass(pfx + 'datatable__body');
        $(table).find('> tfoot').addClass(pfx + 'datatable__foot');
        $(table).find('tr').addClass(pfx + 'datatable__row');
        $(table).find('tr > th, tr > td').addClass(pfx + 'datatable__cell');
        $(table).find('tr > th, tr > td').each(function (i, td) {
          if ($(td).find('span').length === 0) {
            $(td).wrapInner($('<span/>').css('width', Plugin.cellOffset));
          }
        });
      },

      /**
       * Default scrollbar
       * @returns {{tableLocked: null, init: init, onScrolling:
       *     onScrolling}}
       */
      scrollbar: function scrollbar() {
        var scroll = {
          scrollable: null,
          tableLocked: null,
          initPosition: null,
          init: function init() {
            var screen = util.getViewPort().width; // setup scrollable datatable

            if (options.layout.scroll) {
              // add scrollable datatable class
              $(datatable.wrap).addClass(pfx + 'datatable--scroll');
              var scrollable = $(datatable.tableBody).find('.' + pfx + 'datatable__lock--scroll'); // check if scrollable area have rows

              if ($(scrollable).find('.' + pfx + 'datatable__row').length > 0 && $(scrollable).length > 0) {
                scroll.scrollHead = $(datatable.tableHead).find('> .' + pfx + 'datatable__lock--scroll > .' + pfx + 'datatable__row');
                scroll.scrollFoot = $(datatable.tableFoot).find('> .' + pfx + 'datatable__lock--scroll > .' + pfx + 'datatable__row');
                scroll.tableLocked = $(datatable.tableBody).find('.' + pfx + 'datatable__lock:not(.' + pfx + 'datatable__lock--scroll)');

                if (Plugin.getOption('layout.customScrollbar') && util.detectIE() != 10 && screen > util.getBreakpoint('lg')) {
                  scroll.initCustomScrollbar(scrollable[0]);
                } else {
                  scroll.initDefaultScrollbar(scrollable);
                }
              } else if ($(datatable.tableBody).find('.' + pfx + 'datatable__row').length > 0) {
                scroll.scrollHead = $(datatable.tableHead).find('> .' + pfx + 'datatable__row');
                scroll.scrollFoot = $(datatable.tableFoot).find('> .' + pfx + 'datatable__row');

                if (Plugin.getOption('layout.customScrollbar') && util.detectIE() != 10 && screen > util.getBreakpoint('lg')) {
                  scroll.initCustomScrollbar(datatable.tableBody);
                } else {
                  scroll.initDefaultScrollbar(datatable.tableBody);
                }
              }
            }
          },
          initDefaultScrollbar: function initDefaultScrollbar(scrollable) {
            // get initial scroll position
            scroll.initPosition = $(scrollable).scrollLeft();
            $(scrollable).css('overflow-y', 'auto').off().on('scroll', scroll.onScrolling);
            $(scrollable).css('overflow-x', 'auto');
          },
          onScrolling: function onScrolling(e) {
            var left = $(this).scrollLeft();
            var top = $(this).scrollTop();

            if (util.isRTL()) {
              // deduct initial position for RTL
              left = left - scroll.initPosition;
            }

            $(scroll.scrollHead).css('left', -left);
            $(scroll.scrollFoot).css('left', -left);
            $(scroll.tableLocked).each(function (i, table) {
              if (Plugin.isLocked()) {
                // scrollbar offset
                top -= 1;
              }

              $(table).css('top', -top);
            });
          },
          initCustomScrollbar: function initCustomScrollbar(scrollable) {
            scroll.scrollable = scrollable; // create a new instance for table body with scrollbar

            Plugin.initScrollbar(scrollable); // get initial scroll position

            scroll.initPosition = $(scrollable).scrollLeft();
            $(scrollable).off().on('scroll', scroll.onScrolling);
          }
        };
        scroll.init();
        return scroll;
      },

      /**
       * Init custom scrollbar and reset position
       * @param element
       * @param options
       */
      initScrollbar: function initScrollbar(element, options) {
        if (!element || !element.nodeName) {
          return;
        }

        $(datatable.tableBody).css('overflow', '');
        var ps = $(element).data('ps');

        if (util.hasClass(element, 'ps') && typeof ps !== 'undefined') {
          ps.update();
        } else {
          ps = new PerfectScrollbar(element, Object.assign({}, {
            wheelSpeed: 0.5,
            swipeEasing: true,
            // wheelPropagation: false,
            minScrollbarLength: 40,
            maxScrollbarLength: 300,
            suppressScrollX: Plugin.getOption('rows.autoHide') && !Plugin.isLocked()
          }, options));
          $(element).data('ps', ps);
        } // reset perfect scrollbar on resize


        $(window).resize(function () {
          ps.update();
        });
      },

      /**
       * Set column title from options.columns settings
       */
      setHeadTitle: function setHeadTitle(tablePart) {
        if (typeof tablePart === 'undefined') tablePart = datatable.tableHead;
        tablePart = $(tablePart)[0];
        var columns = options.columns;
        var row = tablePart.getElementsByTagName('tr')[0];
        var ths = tablePart.getElementsByTagName('td');

        if (typeof row === 'undefined') {
          row = document.createElement('tr');
          tablePart.appendChild(row);
        }

        $.each(columns, function (i, column) {
          var th = ths[i];

          if (typeof th === 'undefined') {
            th = document.createElement('th');
            row.appendChild(th);
          } // set column title


          if (typeof column['title'] !== 'undefined') {
            th.innerHTML = column.title;
            th.setAttribute('data-field', column.field);
            util.addClass(th, column["class"]); // set disable autoHide or force enable

            if (typeof column.autoHide !== 'undefined') {
              if (column.autoHide !== true) {
                th.setAttribute('data-autohide-disabled', column.autoHide);
              } else {
                th.setAttribute('data-autohide-enabled', column.autoHide);
              }
            }

            $(th).data(column);
          } // set header attr option


          if (typeof column.attr !== 'undefined') {
            $.each(column.attr, function (key, val) {
              th.setAttribute(key, val);
            });
          } // apply text align to thead/tfoot


          if (typeof column.textAlign !== 'undefined') {
            var align = typeof datatable.textAlign[column.textAlign] !== 'undefined' ? datatable.textAlign[column.textAlign] : '';
            util.addClass(th, align);
          }
        });
        Plugin.setupDOM(tablePart);
      },

      /**
       * Initiate to get remote or local data via ajax
       */
      dataRender: function dataRender(action) {
        $(datatable.table).siblings('.' + pfx + 'datatable__pager').removeClass(pfx + 'datatable--paging-loaded');

        var buildMeta = function buildMeta() {
          datatable.dataSet = datatable.dataSet || [];
          Plugin.localDataUpdate(); // local pagination meta

          var meta = Plugin.getDataSourceParam('pagination');

          if (meta.perpage === 0) {
            meta.perpage = options.data.pageSize || 10;
          }

          meta.total = datatable.dataSet.length;
          var start = Math.max(meta.perpage * (meta.page - 1), 0);
          var end = Math.min(start + meta.perpage, meta.total);
          datatable.dataSet = $(datatable.dataSet).slice(start, end);
          return meta;
        };

        var afterGetData = function afterGetData(result) {
          var localPagingCallback = function localPagingCallback(ctx, meta) {
            if (!$(ctx.pager).hasClass(pfx + 'datatable--paging-loaded')) {
              $(ctx.pager).remove();
              ctx.init(meta);
            }

            $(ctx.pager).off().on(pfx + 'datatable--on-goto-page', function (e) {
              $(ctx.pager).remove();
              ctx.init(meta);
            });
            var start = Math.max(meta.perpage * (meta.page - 1), 0);
            var end = Math.min(start + meta.perpage, meta.total);
            Plugin.localDataUpdate();
            datatable.dataSet = $(datatable.dataSet).slice(start, end); // insert data into table content

            Plugin.insertData();
          };

          $(datatable.wrap).removeClass(pfx + 'datatable--error'); // pagination enabled

          if (options.pagination) {
            if (options.data.serverPaging && options.data.type !== 'local') {
              // server pagination
              var serverMeta = Plugin.getObject('meta', result || null);

              if (serverMeta !== null) {
                Plugin.pagingObject = Plugin.paging(serverMeta);
              } else {
                // no meta object from server response, fallback to local pagination
                Plugin.pagingObject = Plugin.paging(buildMeta(), localPagingCallback);
              }
            } else {
              // local pagination can be used by remote data also
              Plugin.pagingObject = Plugin.paging(buildMeta(), localPagingCallback);
            }
          } else {
            // pagination is disabled
            Plugin.localDataUpdate();
          } // insert data into table content


          Plugin.insertData();
        }; // get local datasource


        if (options.data.type === 'local' // for remote json datasource
        // || typeof options.data.source.read === 'undefined' && datatable.dataSet !== null
        // for remote datasource, server sorting is disabled and data already received from remote
        || options.data.serverSorting === false && action === 'sort' || options.data.serverFiltering === false && action === 'search') {
          setTimeout(function () {
            afterGetData();
            Plugin.setAutoColumns();
          });
          return;
        } // getting data from remote only


        Plugin.getData().done(afterGetData);
      },

      /**
       * Process ajax data
       */
      insertData: function insertData() {
        datatable.dataSet = datatable.dataSet || [];
        var params = Plugin.getDataSourceParam(); // get row attributes

        var pagination = params.pagination;
        var start = (Math.max(pagination.page, 1) - 1) * pagination.perpage;
        var end = Math.min(pagination.page, pagination.pages) * pagination.perpage;
        var rowProps = {};

        if (typeof options.data.attr.rowProps !== 'undefined' && options.data.attr.rowProps.length) {
          rowProps = options.data.attr.rowProps.slice(start, end);
        }

        var tableBody = document.createElement('tbody');
        tableBody.style.visibility = 'hidden';
        var colLength = options.columns.length;
        $.each(datatable.dataSet, function (rowIndex, row) {
          var tr = document.createElement('tr');
          tr.setAttribute('data-row', rowIndex); // keep data object to row

          $(tr).data('obj', row);

          if (typeof rowProps[rowIndex] !== 'undefined') {
            $.each(rowProps[rowIndex], function () {
              tr.setAttribute(this.name, this.value);
            });
          }

          var cellIndex = 0;
          var tds = [];

          for (var a = 0; a < colLength; a += 1) {
            var column = options.columns[a];
            var classes = []; // add sorted class to cells

            if (Plugin.getObject('sort.field', params) === column.field) {
              classes.push(pfx + 'datatable__cell--sorted');
            } // apply text align


            if (typeof column.textAlign !== 'undefined') {
              var align = typeof datatable.textAlign[column.textAlign] !== 'undefined' ? datatable.textAlign[column.textAlign] : '';
              classes.push(align);
            } // var classAttr = '';


            if (typeof column["class"] !== 'undefined') {
              classes.push(column["class"]);
            }

            var td = document.createElement('td');
            util.addClass(td, classes.join(' '));
            td.setAttribute('data-field', column.field); // set disable autoHide or force enable

            if (typeof column.autoHide !== 'undefined') {
              if (column.autoHide !== true) {
                td.setAttribute('data-autohide-disabled', column.autoHide);
              } else {
                td.setAttribute('data-autohide-enabled', column.autoHide);
              }
            }

            td.innerHTML = Plugin.getObject(column.field, row);
            tr.appendChild(td);
          }

          tableBody.appendChild(tr);
        }); // display no records message

        if (datatable.dataSet.length === 0) {
          var errorSpan = document.createElement('span');
          util.addClass(errorSpan, pfx + 'datatable--error');
          errorSpan.innerHTML = Plugin.getOption('translate.records.noRecords');
          tableBody.appendChild(errorSpan);
          $(datatable.wrap).addClass(pfx + 'datatable--error ' + pfx + 'datatable--loaded');
          Plugin.spinnerCallback(false);
        } // replace existing table body


        $(datatable.tableBody).replaceWith(tableBody);
        datatable.tableBody = tableBody; // layout update

        Plugin.setupDOM(datatable.table);
        Plugin.setupCellField([datatable.tableBody]);
        Plugin.setupTemplateCell(datatable.tableBody);
        Plugin.layoutUpdate();
      },
      updateTableComponents: function updateTableComponents() {
        datatable.tableHead = $(datatable.table).children('thead').get(0);
        datatable.tableBody = $(datatable.table).children('tbody').get(0);
        datatable.tableFoot = $(datatable.table).children('tfoot').get(0);
      },

      /**
       * Call ajax for raw JSON data
       */
      getData: function getData() {
        // Plugin.spinnerCallback(true);
        var ajaxParams = {
          dataType: 'json',
          method: 'POST',
          data: {},
          timeout: Plugin.getOption('data.source.read.timeout') || 30000
        };

        if (options.data.type === 'local') {
          ajaxParams.url = options.data.source;
        }

        if (options.data.type === 'remote') {
          var data = Plugin.getDataSourceParam(); // remove if server params is not enabled

          if (!Plugin.getOption('data.serverPaging')) {
            delete data['pagination'];
          }

          if (!Plugin.getOption('data.serverSorting')) {
            delete data['sort'];
          }

          ajaxParams.data = $.extend({}, ajaxParams.data, Plugin.getOption('data.source.read.params'), data);
          ajaxParams = $.extend({}, ajaxParams, Plugin.getOption('data.source.read'));
          if (typeof ajaxParams.url !== 'string') ajaxParams.url = Plugin.getOption('data.source.read');
          if (typeof ajaxParams.url !== 'string') ajaxParams.url = Plugin.getOption('data.source'); // ajaxParams.data = $.extend(ajaxParams.data, data.pagination);
        }

        return $.ajax(ajaxParams).done(function (response, textStatus, jqXHR) {
          datatable.lastResponse = response; // extendible data map callback for custom datasource

          datatable.dataSet = datatable.originalDataSet = Plugin.dataMapCallback(response);
          Plugin.setAutoColumns();
          $(datatable).trigger(pfx + 'datatable--on-ajax-done', [datatable.dataSet]);
        }).fail(function (jqXHR, textStatus, errorThrown) {
          $(datatable).trigger(pfx + 'datatable--on-ajax-fail', [jqXHR]);
          $(datatable.tableBody).html($('<span/>').addClass(pfx + 'datatable--error').html(Plugin.getOption('translate.records.noRecords')));
          $(datatable.wrap).addClass(pfx + 'datatable--error ' + pfx + 'datatable--loaded');
          Plugin.spinnerCallback(false);
        }).always(function () {});
      },

      /**
       * Pagination object
       * @param meta if null, local pagination, otherwise remote
       *     pagination
       * @param callback for update data when navigating page
       */
      paging: function paging(meta, callback) {
        var pg = {
          meta: null,
          pager: null,
          paginateEvent: null,
          pagerLayout: {
            pagination: null,
            info: null
          },
          callback: null,
          init: function init(meta) {
            pg.meta = meta; // parse pagination meta to integer

            pg.meta.page = parseInt(pg.meta.page);
            pg.meta.pages = parseInt(pg.meta.pages);
            pg.meta.perpage = parseInt(pg.meta.perpage);
            pg.meta.total = parseInt(pg.meta.total); // always recount total pages

            pg.meta.pages = Math.max(Math.ceil(pg.meta.total / pg.meta.perpage), 1); // current page must be not over than total pages

            if (pg.meta.page > pg.meta.pages) pg.meta.page = pg.meta.pages; // set unique event name between tables

            pg.paginateEvent = Plugin.getTablePrefix('paging');
            pg.pager = $(datatable.table).siblings('.' + pfx + 'datatable__pager');
            if ($(pg.pager).hasClass(pfx + 'datatable--paging-loaded')) return; // if class .'+pfx+'datatable--paging-loaded not exist, recreate pagination

            $(pg.pager).remove(); // if no pages available

            if (pg.meta.pages === 0) return; // update datasource params

            Plugin.setDataSourceParam('pagination', {
              page: pg.meta.page,
              pages: pg.meta.pages,
              perpage: pg.meta.perpage,
              total: pg.meta.total
            }); // default callback function, contains remote pagination handler

            pg.callback = pg.serverCallback; // custom callback function

            if (typeof callback === 'function') pg.callback = callback;
            pg.addPaginateEvent();
            pg.populate();
            pg.meta.page = Math.max(pg.meta.page || 1, pg.meta.page);
            $(datatable).trigger(pg.paginateEvent, pg.meta);
            pg.pagingBreakpoint.call();
            $(window).resize(pg.pagingBreakpoint);
          },
          serverCallback: function serverCallback(ctx, meta) {
            Plugin.dataRender();
          },
          populate: function populate() {
            var icons = Plugin.getOption('layout.icons.pagination');
            var title = Plugin.getOption('translate.toolbar.pagination.items.default'); // pager root element

            pg.pager = $('<div/>').addClass(pfx + 'datatable__pager ' + pfx + 'datatable--paging-loaded'); // numbering links

            var pagerNumber = $('<ul/>').addClass(pfx + 'datatable__pager-nav');
            pg.pagerLayout['pagination'] = pagerNumber; // pager first/previous button

            $('<li/>').append($('<a/>').attr('title', title.first).addClass(pfx + 'datatable__pager-link ' + pfx + 'datatable__pager-link--first').append($('<i/>').addClass(icons.first)).on('click', pg.gotoMorePage).attr('data-page', 1)).appendTo(pagerNumber);
            $('<li/>').append($('<a/>').attr('title', title.prev).addClass(pfx + 'datatable__pager-link ' + pfx + 'datatable__pager-link--prev').append($('<i/>').addClass(icons.prev)).on('click', pg.gotoMorePage)).appendTo(pagerNumber); // more previous pages

            $('<li/>').append($('<a/>').attr('title', title.more).addClass(pfx + 'datatable__pager-link ' + pfx + 'datatable__pager-link--more-prev').html($('<i/>').addClass(icons.more)).on('click', pg.gotoMorePage)).appendTo(pagerNumber);
            $('<li/>').append($('<input/>').attr('type', 'text').addClass(pfx + 'pager-input form-control').attr('title', title.input).on('keyup', function () {
              // on keyup update [data-page]
              $(this).attr('data-page', Math.abs($(this).val()));
            }).on('keypress', function (e) {
              // on keypressed enter button
              if (e.which === 13) pg.gotoMorePage(e);
            })).appendTo(pagerNumber);
            var pagesNumber = Plugin.getOption('toolbar.items.pagination.pages.desktop.pagesNumber');
            var end = Math.ceil(pg.meta.page / pagesNumber) * pagesNumber;
            var start = end - pagesNumber;

            if (end > pg.meta.pages) {
              end = pg.meta.pages;
            }

            for (var x = start; x < end; x++) {
              var pageNumber = x + 1;
              $('<li/>').append($('<a/>').addClass(pfx + 'datatable__pager-link ' + pfx + 'datatable__pager-link-number').text(pageNumber).attr('data-page', pageNumber).attr('title', pageNumber).on('click', pg.gotoPage)).appendTo(pagerNumber);
            } // more next pages


            $('<li/>').append($('<a/>').attr('title', title.more).addClass(pfx + 'datatable__pager-link ' + pfx + 'datatable__pager-link--more-next').html($('<i/>').addClass(icons.more)).on('click', pg.gotoMorePage)).appendTo(pagerNumber); // pager next/last button

            $('<li/>').append($('<a/>').attr('title', title.next).addClass(pfx + 'datatable__pager-link ' + pfx + 'datatable__pager-link--next').append($('<i/>').addClass(icons.next)).on('click', pg.gotoMorePage)).appendTo(pagerNumber);
            $('<li/>').append($('<a/>').attr('title', title.last).addClass(pfx + 'datatable__pager-link ' + pfx + 'datatable__pager-link--last').append($('<i/>').addClass(icons.last)).on('click', pg.gotoMorePage).attr('data-page', pg.meta.pages)).appendTo(pagerNumber); // page info

            if (Plugin.getOption('toolbar.items.info')) {
              pg.pagerLayout['info'] = $('<div/>').addClass(pfx + 'datatable__pager-info').append($('<span/>').addClass(pfx + 'datatable__pager-detail'));
            }

            $.each(Plugin.getOption('toolbar.layout'), function (i, layout) {
              $(pg.pagerLayout[layout]).appendTo(pg.pager);
            }); // page size select

            var pageSizeSelect = $('<select/>').addClass('selectpicker ' + pfx + 'datatable__pager-size').attr('title', Plugin.getOption('translate.toolbar.pagination.items.default.select')).attr('data-width', '60px').attr('data-container', 'body').val(pg.meta.perpage).on('change', pg.updatePerpage).prependTo(pg.pagerLayout['info']);
            var pageSizes = Plugin.getOption('toolbar.items.pagination.pageSizeSelect'); // default value here, to fix override option by user

            if (pageSizes.length == 0) pageSizes = [10, 20, 30, 50, 100];
            $.each(pageSizes, function (i, size) {
              var display = size;
              if (size === -1) display = Plugin.getOption('translate.toolbar.pagination.items.default.all');
              $('<option/>').attr('value', size).html(display).appendTo(pageSizeSelect);
            }); // init selectpicker to dropdown

            $(datatable).ready(function () {
              $('.selectpicker').selectpicker().on('hide.bs.select', function () {
                // fix dropup arrow icon on hide
                $(this).closest('.bootstrap-select').removeClass('dropup');
              }).siblings('.dropdown-toggle').attr('title', Plugin.getOption('translate.toolbar.pagination.items.default.select'));
            });
            pg.paste();
          },
          paste: function paste() {
            // insert pagination based on placement position, top|bottom
            $.each($.unique(Plugin.getOption('toolbar.placement')), function (i, position) {
              if (position === 'bottom') {
                $(pg.pager).clone(true).insertAfter(datatable.table);
              }

              if (position === 'top') {
                // pager top need some extra space
                $(pg.pager).clone(true).addClass(pfx + 'datatable__pager--top').insertBefore(datatable.table);
              }
            });
          },
          gotoMorePage: function gotoMorePage(e) {
            e.preventDefault(); // $(this) is a link of .'+pfx+'datatable__pager-link

            if ($(this).attr('disabled') === 'disabled') return false;
            var page = $(this).attr('data-page'); // event from text input

            if (typeof page === 'undefined') {
              page = $(e.target).attr('data-page');
            }

            pg.openPage(parseInt(page));
            return false;
          },
          gotoPage: function gotoPage(e) {
            e.preventDefault(); // prevent from click same page number

            if ($(this).hasClass(pfx + 'datatable__pager-link--active')) return;
            pg.openPage(parseInt($(this).data('page')));
          },
          openPage: function openPage(page) {
            // currentPage is 1-based index
            pg.meta.page = parseInt(page);
            $(datatable).trigger(pg.paginateEvent, pg.meta);
            pg.callback(pg, pg.meta); // update page callback function

            $(pg.pager).trigger(pfx + 'datatable--on-goto-page', pg.meta);
          },
          updatePerpage: function updatePerpage(e) {
            e.preventDefault(); // if (Plugin.getOption('layout.height') === null) {
            // fix white space, when perpage is set from many records to less records
            // $('html, body').animate({scrollTop: $(datatable).position().top});
            // }
            // hide dropdown after select

            $(this).selectpicker('toggle');
            pg.pager = $(datatable.table).siblings('.' + pfx + 'datatable__pager').removeClass(pfx + 'datatable--paging-loaded'); // on change select page size

            if (e.originalEvent) {
              pg.meta.perpage = parseInt($(this).val());
            }

            $(pg.pager).find('select.' + pfx + 'datatable__pager-size').val(pg.meta.perpage).attr('data-selected', pg.meta.perpage); // update datasource params

            Plugin.setDataSourceParam('pagination', {
              page: pg.meta.page,
              pages: pg.meta.pages,
              perpage: pg.meta.perpage,
              total: pg.meta.total
            }); // update page callback function

            $(pg.pager).trigger(pfx + 'datatable--on-update-perpage', pg.meta);
            $(datatable).trigger(pg.paginateEvent, pg.meta);
            pg.callback(pg, pg.meta); // update pagination info

            pg.updateInfo.call();
          },
          addPaginateEvent: function addPaginateEvent(e) {
            // pagination event
            $(datatable).off(pg.paginateEvent).on(pg.paginateEvent, function (e, meta) {
              Plugin.spinnerCallback(true);
              pg.pager = $(datatable.table).siblings('.' + pfx + 'datatable__pager');
              var pagerNumber = $(pg.pager).find('.' + pfx + 'datatable__pager-nav'); // set sync active page class

              $(pagerNumber).find('.' + pfx + 'datatable__pager-link--active').removeClass(pfx + 'datatable__pager-link--active');
              $(pagerNumber).find('.' + pfx + 'datatable__pager-link-number[data-page="' + meta.page + '"]').addClass(pfx + 'datatable__pager-link--active'); // set next and previous link page number

              $(pagerNumber).find('.' + pfx + 'datatable__pager-link--prev').attr('data-page', Math.max(meta.page - 1, 1));
              $(pagerNumber).find('.' + pfx + 'datatable__pager-link--next').attr('data-page', Math.min(meta.page + 1, meta.pages)); // current page input value sync

              $(pg.pager).each(function () {
                $(this).find('.' + pfx + 'pager-input[type="text"]').prop('value', meta.page);
              });
              $(pg.pager).find('.' + pfx + 'datatable__pager-nav').show();

              if (meta.pages <= 1) {
                // hide pager if has 1 page
                $(pg.pager).find('.' + pfx + 'datatable__pager-nav').hide();
              } // update datasource params


              Plugin.setDataSourceParam('pagination', {
                page: pg.meta.page,
                pages: pg.meta.pages,
                perpage: pg.meta.perpage,
                total: pg.meta.total
              });
              $(pg.pager).find('select.' + pfx + 'datatable__pager-size').val(meta.perpage).attr('data-selected', meta.perpage); // clear active rows

              $(datatable.table).find('.' + pfx + 'checkbox > [type="checkbox"]').prop('checked', false);
              $(datatable.table).find('.' + pfx + 'datatable__row--active').removeClass(pfx + 'datatable__row--active');
              pg.updateInfo.call();
              pg.pagingBreakpoint.call(); // Plugin.resetScroll();
            });
          },
          updateInfo: function updateInfo() {
            var start = Math.max(pg.meta.perpage * (pg.meta.page - 1) + 1, 1);
            var end = Math.min(start + pg.meta.perpage - 1, pg.meta.total); // page info update

            $(pg.pager).find('.' + pfx + 'datatable__pager-info').find('.' + pfx + 'datatable__pager-detail').html(Plugin.dataPlaceholder(Plugin.getOption('translate.toolbar.pagination.items.info'), {
              // set start page 0 if the is no records. eg. Showing 0 - 0 of 0
              start: pg.meta.total === 0 ? 0 : start,
              end: pg.meta.perpage === -1 ? pg.meta.total : end,
              pageSize: pg.meta.perpage === -1 || pg.meta.perpage >= pg.meta.total ? pg.meta.total : pg.meta.perpage,
              total: pg.meta.total
            }));
          },

          /**
           * Update pagination layout breakpoint
           */
          pagingBreakpoint: function pagingBreakpoint() {
            // keep page links reference
            var pagerNumber = $(datatable.table).siblings('.' + pfx + 'datatable__pager').find('.' + pfx + 'datatable__pager-nav');
            if ($(pagerNumber).length === 0) return;
            var currentPage = Plugin.getCurrentPage();
            var pagerInput = $(pagerNumber).find('.' + pfx + 'pager-input').closest('li'); // reset

            $(pagerNumber).find('li').show(); // pagination update

            $.each(Plugin.getOption('toolbar.items.pagination.pages'), function (mode, option) {
              if (util.isInResponsiveRange(mode)) {
                switch (mode) {
                  case 'desktop':
                  case 'tablet':
                    var end = Math.ceil(currentPage / option.pagesNumber) * option.pagesNumber;
                    var start = end - option.pagesNumber;
                    $(pagerInput).hide();
                    pg.meta = Plugin.getDataSourceParam('pagination');
                    pg.paginationUpdate();
                    break;

                  case 'mobile':
                    $(pagerInput).show();
                    $(pagerNumber).find('.' + pfx + 'datatable__pager-link--more-prev').closest('li').hide();
                    $(pagerNumber).find('.' + pfx + 'datatable__pager-link--more-next').closest('li').hide();
                    $(pagerNumber).find('.' + pfx + 'datatable__pager-link-number').closest('li').hide();
                    break;
                }

                return false;
              }
            });
          },

          /**
           * Update pagination number and button display
           */
          paginationUpdate: function paginationUpdate() {
            var pager = $(datatable.table).siblings('.' + pfx + 'datatable__pager').find('.' + pfx + 'datatable__pager-nav'),
                pagerMorePrev = $(pager).find('.' + pfx + 'datatable__pager-link--more-prev'),
                pagerMoreNext = $(pager).find('.' + pfx + 'datatable__pager-link--more-next'),
                pagerFirst = $(pager).find('.' + pfx + 'datatable__pager-link--first'),
                pagerPrev = $(pager).find('.' + pfx + 'datatable__pager-link--prev'),
                pagerNext = $(pager).find('.' + pfx + 'datatable__pager-link--next'),
                pagerLast = $(pager).find('.' + pfx + 'datatable__pager-link--last'); // get visible page

            var pagerNumber = $(pager).find('.' + pfx + 'datatable__pager-link-number'); // get page before of first visible

            var morePrevPage = Math.max($(pagerNumber).first().data('page') - 1, 1);
            $(pagerMorePrev).each(function (i, prev) {
              $(prev).attr('data-page', morePrevPage);
            }); // show/hide <li>

            if (morePrevPage === 1) {
              $(pagerMorePrev).parent().hide();
            } else {
              $(pagerMorePrev).parent().show();
            } // get page after of last visible


            var moreNextPage = Math.min($(pagerNumber).last().data('page') + 1, pg.meta.pages);
            $(pagerMoreNext).each(function (i, prev) {
              $(pagerMoreNext).attr('data-page', moreNextPage).show();
            }); // show/hide <li>

            if (moreNextPage === pg.meta.pages // missing dot fix when last hidden page is one left
            && moreNextPage === $(pagerNumber).last().data('page')) {
              $(pagerMoreNext).parent().hide();
            } else {
              $(pagerMoreNext).parent().show();
            } // begin/end of pages


            if (pg.meta.page === 1) {
              $(pagerFirst).attr('disabled', true).addClass(pfx + 'datatable__pager-link--disabled');
              $(pagerPrev).attr('disabled', true).addClass(pfx + 'datatable__pager-link--disabled');
            } else {
              $(pagerFirst).removeAttr('disabled').removeClass(pfx + 'datatable__pager-link--disabled');
              $(pagerPrev).removeAttr('disabled').removeClass(pfx + 'datatable__pager-link--disabled');
            }

            if (pg.meta.page === pg.meta.pages) {
              $(pagerNext).attr('disabled', true).addClass(pfx + 'datatable__pager-link--disabled');
              $(pagerLast).attr('disabled', true).addClass(pfx + 'datatable__pager-link--disabled');
            } else {
              $(pagerNext).removeAttr('disabled').removeClass(pfx + 'datatable__pager-link--disabled');
              $(pagerLast).removeAttr('disabled').removeClass(pfx + 'datatable__pager-link--disabled');
            } // display more buttons


            var nav = Plugin.getOption('toolbar.items.pagination.navigation');
            if (!nav.first) $(pagerFirst).remove();
            if (!nav.prev) $(pagerPrev).remove();
            if (!nav.next) $(pagerNext).remove();
            if (!nav.last) $(pagerLast).remove();

            if (!nav.more) {
              $(pagerMorePrev).remove();
              $(pagerMoreNext).remove();
            }
          }
        };
        pg.init(meta);
        return pg;
      },

      /**
       * Hide/show table cell defined by
       * options[columns][i][responsive][visible/hidden]
       */
      columnHide: function columnHide() {
        var screen = util.getViewPort().width; // foreach columns setting

        $.each(options.columns, function (i, column) {
          if (typeof column.responsive !== 'undefined' || typeof column.visible !== 'undefined') {
            var field = column.field;
            var tds = $.grep($(datatable.table).find('.' + pfx + 'datatable__cell'), function (n, i) {
              return field === $(n).data('field');
            });
            setTimeout(function () {
              // hide by force
              if (Plugin.getObject('visible', column) === false) {
                $(tds).hide();
              } else {
                // show/hide by responsive breakpoint
                if (util.getBreakpoint(Plugin.getObject('responsive.hidden', column)) >= screen) {
                  $(tds).hide();
                } else {
                  $(tds).show();
                }

                if (util.getBreakpoint(Plugin.getObject('responsive.visible', column)) <= screen) {
                  $(tds).show();
                } else {
                  $(tds).hide();
                }
              }
            });
          }
        });
      },

      /**
       * Setup sub datatable
       */
      setupSubDatatable: function setupSubDatatable() {
        var subTableCallback = Plugin.getOption('detail.content');
        if (typeof subTableCallback !== 'function') return; // subtable already exist

        if ($(datatable.table).find('.' + pfx + 'datatable__subtable').length > 0) return;
        $(datatable.wrap).addClass(pfx + 'datatable--subtable');
        options.columns[0]['subtable'] = true; // toggle on open sub table

        var toggleSubTable = function toggleSubTable(e) {
          e.preventDefault(); // get parent row of this subtable

          var parentRow = $(this).closest('.' + pfx + 'datatable__row'); // get subtable row for sub table

          var subTableRow = $(parentRow).next('.' + pfx + 'datatable__row-subtable');

          if ($(subTableRow).length === 0) {
            // prepare DOM for sub table, each <tr> as parent and add <tr> as child table
            subTableRow = $('<tr/>').addClass(pfx + 'datatable__row-subtable ' + pfx + 'datatable__row-loading').hide().append($('<td/>').addClass(pfx + 'datatable__subtable').attr('colspan', Plugin.getTotalColumns()));
            $(parentRow).after(subTableRow); // add class to even row

            if ($(parentRow).hasClass(pfx + 'datatable__row--even')) {
              $(subTableRow).addClass(pfx + 'datatable__row-subtable--even');
            }
          }

          $(subTableRow).toggle();
          var subTable = $(subTableRow).find('.' + pfx + 'datatable__subtable'); // get id from first column of parent row

          var primaryKey = $(this).closest('[data-field]:first-child').find('.' + pfx + 'datatable__toggle-subtable').data('value');
          var icon = $(this).find('i').removeAttr('class'); // prevent duplicate datatable init

          if ($(parentRow).hasClass(pfx + 'datatable__row--subtable-expanded')) {
            $(icon).addClass(Plugin.getOption('layout.icons.rowDetail.collapse')); // remove expand class from parent row

            $(parentRow).removeClass(pfx + 'datatable__row--subtable-expanded'); // trigger event on collapse

            $(datatable).trigger(pfx + 'datatable--on-collapse-subtable', [parentRow]);
          } else {
            // expand and run callback function
            $(icon).addClass(Plugin.getOption('layout.icons.rowDetail.expand')); // add expand class to parent row

            $(parentRow).addClass(pfx + 'datatable__row--subtable-expanded'); // trigger event on expand

            $(datatable).trigger(pfx + 'datatable--on-expand-subtable', [parentRow]);
          } // prevent duplicate datatable init


          if ($(subTable).find('.' + pfx + 'datatable').length === 0) {
            // get data by primary id
            $.map(datatable.dataSet, function (n, i) {
              // primary id must be at the first column, otherwise e.data will be undefined
              if (primaryKey === n[options.columns[0].field]) {
                e.data = n;
                return true;
              }

              return false;
            }); // deprecated in v5.0.6

            e.detailCell = subTable;
            e.parentRow = parentRow;
            e.subTable = subTable; // run callback with event

            subTableCallback(e);
            $(subTable).children('.' + pfx + 'datatable').on(pfx + 'datatable--on-init', function (e) {
              $(subTableRow).removeClass(pfx + 'datatable__row-loading');
            });

            if (Plugin.getOption('data.type') === 'local') {
              $(subTableRow).removeClass(pfx + 'datatable__row-loading');
            }
          }
        };

        var columns = options.columns;
        $(datatable.tableBody).find('.' + pfx + 'datatable__row').each(function (tri, tr) {
          $(tr).find('.' + pfx + 'datatable__cell').each(function (tdi, td) {
            // get column settings by field
            var column = $.grep(columns, function (n, i) {
              return $(td).data('field') === n.field;
            })[0];

            if (typeof column !== 'undefined') {
              var value = $(td).text(); // enable column subtable toggle

              if (typeof column.subtable !== 'undefined' && column.subtable) {
                // check if subtable toggle exist
                if ($(td).find('.' + pfx + 'datatable__toggle-subtable').length > 0) return; // append subtable toggle

                $(td).html($('<a/>').addClass(pfx + 'datatable__toggle-subtable').attr('href', '#').attr('data-value', value).attr('title', Plugin.getOption('detail.title')).on('click', toggleSubTable).append($('<i/>').css('width', $(td).data('width')).addClass(Plugin.getOption('layout.icons.rowDetail.collapse'))));
              }
            }
          });
        }); // $(datatable.tableHead).find('.'+pfx+'-datatable__row').first()
      },

      /**
       * Datasource mapping callback
       */
      dataMapCallback: function dataMapCallback(raw) {
        // static dataset array
        var dataSet = raw; // dataset mapping callback

        if (typeof Plugin.getOption('data.source.read.map') === 'function') {
          return Plugin.getOption('data.source.read.map')(raw);
        } else {
          // default data mapping fallback
          if (typeof raw !== 'undefined' && typeof raw.data !== 'undefined') {
            dataSet = raw.data;
          }
        }

        return dataSet;
      },
      isSpinning: false,

      /**
       * BlockUI spinner callback
       * @param block
       * @param target
       */
      spinnerCallback: function spinnerCallback(block, target) {
        if (typeof target === 'undefined') target = datatable; // get spinner options

        var spinnerOptions = Plugin.getOption('layout.spinner'); // spinner is disabled

        if (typeof spinnerOptions === 'undefined' || !spinnerOptions) {
          return;
        }

        if (block) {
          if (!Plugin.isSpinning) {
            if (typeof spinnerOptions.message !== 'undefined' && spinnerOptions.message === true) {
              // use default spinner message from translation
              spinnerOptions.message = Plugin.getOption('translate.records.processing');
            }

            Plugin.isSpinning = true;

            if (typeof app !== 'undefined') {
              app.block(target, spinnerOptions);
            }
          }
        } else {
          Plugin.isSpinning = false;

          if (typeof app !== 'undefined') {
            app.unblock(target);
          }
        }
      },

      /**
       * Default sort callback function
       * @param data
       * @param sort
       * @param column
       * @returns {*|Array.<T>|{sort, field}|{asc, desc}}
       */
      sortCallback: function sortCallback(data, sort, column) {
        var type = column['type'] || 'string';
        var format = column['format'] || '';
        var field = column['field'];
        return $(data).sort(function (a, b) {
          var aField = a[field];
          var bField = b[field];

          switch (type) {
            case 'date':
              if (typeof moment === 'undefined') {
                throw new Error('Moment.js is required.');
              }

              var diff = moment(aField, format).diff(moment(bField, format));

              if (sort === 'asc') {
                return diff > 0 ? 1 : diff < 0 ? -1 : 0;
              } else {
                return diff < 0 ? 1 : diff > 0 ? -1 : 0;
              }

              break;

            case 'number':
              if (isNaN(parseFloat(aField)) && aField != null) {
                aField = Number(aField.replace(/[^0-9\.-]+/g, ''));
              }

              if (isNaN(parseFloat(bField)) && bField != null) {
                bField = Number(bField.replace(/[^0-9\.-]+/g, ''));
              }

              aField = parseFloat(aField);
              bField = parseFloat(bField);

              if (sort === 'asc') {
                return aField > bField ? 1 : aField < bField ? -1 : 0;
              } else {
                return aField < bField ? 1 : aField > bField ? -1 : 0;
              }

              break;

            case 'html':
              return $(data).sort(function (a, b) {
                // get the text only from html
                aField = $(a[field]).text();
                bField = $(b[field]).text(); // sort

                if (sort === 'asc') {
                  return aField > bField ? 1 : aField < bField ? -1 : 0;
                } else {
                  return aField < bField ? 1 : aField > bField ? -1 : 0;
                }
              });
              break;

            case 'string':
            default:
              if (sort === 'asc') {
                return aField > bField ? 1 : aField < bField ? -1 : 0;
              } else {
                return aField < bField ? 1 : aField > bField ? -1 : 0;
              }

              break;
          }
        });
      },

      /**
       * Custom debug log
       * @param text
       * @param obj
       */
      log: function log(text, obj) {
        if (typeof obj === 'undefined') obj = '';

        if (datatable.debug) {
          console.log(text, obj);
        }
      },

      /**
       * Auto hide columnds overflow in row
       */
      autoHide: function autoHide() {
        var hiddenExist = false; // force hide enabled

        var hidDefault = $(datatable.table).find('[data-autohide-enabled]');

        if (hidDefault.length) {
          hiddenExist = true;
          hidDefault.hide();
        }

        var toggleHiddenColumns = function toggleHiddenColumns(e) {
          e.preventDefault();
          var row = $(this).closest('.' + pfx + 'datatable__row');
          var detailRow = $(row).next();

          if (!$(detailRow).hasClass(pfx + 'datatable__row-detail')) {
            $(this).find('i').removeClass(Plugin.getOption('layout.icons.rowDetail.collapse')).addClass(Plugin.getOption('layout.icons.rowDetail.expand'));
            var hiddenCells = $(row).find('.' + pfx + 'datatable__cell:hidden');
            var clonedCells = hiddenCells.clone().show();
            detailRow = $('<tr/>').addClass(pfx + 'datatable__row-detail').insertAfter(row);
            var detailRowTd = $('<td/>').addClass(pfx + 'datatable__detail').attr('colspan', Plugin.getTotalColumns()).appendTo(detailRow);
            var detailSubTable = $('<table/>');
            $(clonedCells).each(function () {
              var field = $(this).data('field');
              var column = $.grep(options.columns, function (n, i) {
                return field === n.field;
              })[0];

              if (typeof column === 'undefined' || column.visible !== false) {
                $(detailSubTable).append($('<tr class="' + pfx + 'datatable__row"></tr>').append($('<td class="' + pfx + 'datatable__cell"></td>').append($('<span/>').append(column.title))).append(this));
              }
            });
            $(detailRowTd).append(detailSubTable);
          } else {
            $(this).find('i').removeClass(Plugin.getOption('layout.icons.rowDetail.expand')).addClass(Plugin.getOption('layout.icons.rowDetail.collapse'));
            $(detailRow).remove();
          }
        };

        setTimeout(function () {
          $(datatable.table).find('.' + pfx + 'datatable__cell').show();
          $(datatable.tableBody).each(function () {
            var recursive = 0;

            while ($(this)[0].offsetWidth < $(this)[0].scrollWidth && recursive < options.columns.length) {
              $(datatable.table).find('.' + pfx + 'datatable__row').each(function (i) {
                var cell = $(this).find('.' + pfx + 'datatable__cell:not(:hidden):not([data-autohide-disabled])').last();
                $(cell).hide();
                hiddenExist = true;
              });
              recursive++;
            }
          });

          if (hiddenExist) {
            // toggle show hidden columns
            $(datatable.tableBody).find('.' + pfx + 'datatable__row').each(function () {
              // if no toggle yet
              if ($(this).find('.' + pfx + 'datatable__toggle-detail').length === 0) {
                // add toggle
                $(this).prepend($('<td/>').addClass(pfx + 'datatable__cell ' + pfx + 'datatable__toggle-detail').append($('<a/>').addClass(pfx + 'datatable__toggle-detail').attr('href', '').on('click', toggleHiddenColumns).append('<i class="' + Plugin.getOption('layout.icons.rowDetail.collapse') + '"></i>')));
              } // check if subtable toggle exist


              if ($(datatable.tableHead).find('.' + pfx + 'datatable__toggle-detail').length === 0) {
                // add empty column to the header and footer
                $(datatable.tableHead).find('.' + pfx + 'datatable__row').first().prepend('<th class="' + pfx + 'datatable__cell ' + pfx + 'datatable__toggle-detail"><span></span></th>');
                $(datatable.tableFoot).find('.' + pfx + 'datatable__row').first().prepend('<th class="' + pfx + 'datatable__cell ' + pfx + 'datatable__toggle-detail"><span></span></th>');
              } else {
                $(datatable.tableHead).find('.' + pfx + 'datatable__toggle-detail').find('span');
              }
            });
          }
        });
        Plugin.adjustCellsWidth.call();
      },

      /**
       * To enable auto columns features for remote data source
       */
      setAutoColumns: function setAutoColumns() {
        if (Plugin.getOption('data.autoColumns')) {
          $.each(datatable.dataSet[0], function (k, v) {
            var found = $.grep(options.columns, function (n, i) {
              return k === n.field;
            });

            if (found.length === 0) {
              options.columns.push({
                field: k,
                title: k
              });
            }
          });
          $(datatable.tableHead).find('.' + pfx + 'datatable__row').remove();
          Plugin.setHeadTitle();

          if (Plugin.getOption('layout.footer')) {
            $(datatable.tableFoot).find('.' + pfx + 'datatable__row').remove();
            Plugin.setHeadTitle(datatable.tableFoot);
          }
        }
      },

      /********************
       ** HELPERS
       ********************/

      /**
       * Check if table is a locked colums table
       */
      isLocked: function isLocked() {
        var isLocked = Plugin.lockEnabledColumns();
        return isLocked.left.length > 0 || isLocked.right.length > 0;
      },
      isSubtable: function isSubtable() {
        return util.hasClass(datatable.wrap[0], pfx + 'datatable--subtable') || false;
      },

      /**
       * Get total extra space of an element for width calculation,
       * including padding, margin, border
       * @param element
       * @returns {number}
       */
      getExtraSpace: function getExtraSpace(element) {
        var padding = parseInt($(element).css('paddingRight')) + parseInt($(element).css('paddingLeft'));
        var margin = parseInt($(element).css('marginRight')) + parseInt($(element).css('marginLeft'));
        var border = Math.ceil($(element).css('border-right-width').replace('px', ''));
        return padding + margin + border;
      },

      /**
       * Insert data of array into {{ }} template placeholder
       * @param template
       * @param data
       * @returns {*}
       */
      dataPlaceholder: function dataPlaceholder(template, data) {
        var result = template;
        $.each(data, function (key, val) {
          result = result.replace('{{' + key + '}}', val);
        });
        return result;
      },

      /**
       * Get table unique ID
       * Note: table unique change each time refreshed
       * @param suffix
       * @returns {*}
       */
      getTableId: function getTableId(suffix) {
        if (typeof suffix === 'undefined') suffix = '';
        var id = $(datatable).attr('id');

        if (typeof id === 'undefined') {
          id = $(datatable).attr('class').split(' ')[0];
        }

        return id + suffix;
      },

      /**
       * Get table prefix with depth number
       */
      getTablePrefix: function getTablePrefix(suffix) {
        if (typeof suffix !== 'undefined') suffix = '-' + suffix;
        return Plugin.getTableId() + '-' + Plugin.getDepth() + suffix;
      },

      /**
       * Get current table depth of sub table
       * @returns {number}
       */
      getDepth: function getDepth() {
        var depth = 0;
        var table = datatable.table;

        do {
          table = $(table).parents('.' + pfx + 'datatable__table');
          depth++;
        } while ($(table).length > 0);

        return depth;
      },

      /**
       * Keep state item
       * @param key
       * @param value
       */
      stateKeep: function stateKeep(key, value) {
        key = Plugin.getTablePrefix(key);
        if (Plugin.getOption('data.saveState') === false) return;

        if (Plugin.getOption('data.saveState.webstorage') && localStorage) {
          localStorage.setItem(key, JSON.stringify(value));
        }

        if (Plugin.getOption('data.saveState.cookie')) {
          Cookies.set(key, JSON.stringify(value));
        }
      },

      /**
       * Get state item
       * @param key
       * @param defValue
       */
      stateGet: function stateGet(key, defValue) {
        key = Plugin.getTablePrefix(key);
        if (Plugin.getOption('data.saveState') === false) return;
        var value = null;

        if (Plugin.getOption('data.saveState.webstorage') && localStorage) {
          value = localStorage.getItem(key);
        } else {
          value = Cookies.get(key);
        }

        if (typeof value !== 'undefined' && value !== null) {
          return JSON.parse(value);
        }
      },

      /**
       * Update data in state without clear existing
       * @param key
       * @param value
       */
      stateUpdate: function stateUpdate(key, value) {
        var ori = Plugin.stateGet(key);
        if (typeof ori === 'undefined' || ori === null) ori = {};
        Plugin.stateKeep(key, $.extend({}, ori, value));
      },

      /**
       * Remove state item
       * @param key
       */
      stateRemove: function stateRemove(key) {
        key = Plugin.getTablePrefix(key);

        if (localStorage) {
          localStorage.removeItem(key);
        }

        Cookies.remove(key);
      },

      /**
       * Get total columns.
       */
      getTotalColumns: function getTotalColumns(tablePart) {
        if (typeof tablePart === 'undefined') tablePart = datatable.tableBody;
        return $(tablePart).find('.' + pfx + 'datatable__row').first().find('.' + pfx + 'datatable__cell').length;
      },

      /**
       * Get table row. Useful to get row when current table is in lock
       * mode. Can be used for both lock and normal table mode. By
       * default, returning result will be in a list of <td>.
       * @param tablePart
       * @param row 1-based index
       * @param tdOnly Optional. Default true
       * @returns {*}
       */
      getOneRow: function getOneRow(tablePart, row, tdOnly) {
        if (typeof tdOnly === 'undefined') tdOnly = true; // get list of <tr>

        var result = $(tablePart).find('.' + pfx + 'datatable__row:not(.' + pfx + 'datatable__row-detail):nth-child(' + row + ')');

        if (tdOnly) {
          // get list of <td> or <th>
          result = result.find('.' + pfx + 'datatable__cell');
        }

        return result;
      },

      /**
       * Sort table row at HTML level by column index.
       * todo; Not in use.
       * @param header Header sort clicked
       * @param sort asc|desc. Optional. Default asc
       * @param int Boolean. Optional. Comparison value parse to integer.
       *     Default false
       */
      sortColumn: function sortColumn(header, sort, _int) {
        if (typeof sort === 'undefined') sort = 'asc'; // desc

        if (typeof _int === 'undefined') _int = false;
        var column = $(header).index();
        var rows = $(datatable.tableBody).find('.' + pfx + 'datatable__row');
        var hIndex = $(header).closest('.' + pfx + 'datatable__lock').index();

        if (hIndex !== -1) {
          rows = $(datatable.tableBody).find('.' + pfx + 'datatable__lock:nth-child(' + (hIndex + 1) + ')').find('.' + pfx + 'datatable__row');
        }

        var container = $(rows).parent();
        $(rows).sort(function (a, b) {
          var tda = $(a).find('td:nth-child(' + column + ')').text();
          var tdb = $(b).find('td:nth-child(' + column + ')').text();

          if (_int) {
            // useful for integer type sorting
            tda = parseInt(tda);
            tdb = parseInt(tdb);
          }

          if (sort === 'asc') {
            return tda > tdb ? 1 : tda < tdb ? -1 : 0;
          } else {
            return tda < tdb ? 1 : tda > tdb ? -1 : 0;
          }
        }).appendTo(container);
      },

      /**
       * Perform sort remote and local
       */
      sorting: function sorting() {
        var sortObj = {
          init: function init() {
            if (options.sortable) {
              $(datatable.tableHead).find('.' + pfx + 'datatable__cell:not(.' + pfx + 'datatable__cell--check)').addClass(pfx + 'datatable__cell--sort').off('click').on('click', sortObj.sortClick); // first init

              sortObj.setIcon();
            }
          },
          setIcon: function setIcon() {
            var meta = Plugin.getDataSourceParam('sort');
            if ($.isEmptyObject(meta)) return;
            var column = Plugin.getColumnByField(meta.field); // sort is disabled for this column

            if (typeof column !== 'undefined' && typeof column.sortable !== 'undefined' && column.sortable === false) return; // sort icon beside column header

            var td = $(datatable.tableHead).find('.' + pfx + 'datatable__cell[data-field="' + meta.field + '"]').attr('data-sort', meta.sort);
            var sorting = $(td).find('span');
            var icon = $(sorting).find('i');
            var icons = Plugin.getOption('layout.icons.sort'); // update sort icon; desc & asc

            if ($(icon).length > 0) {
              $(icon).removeAttr('class').addClass(icons[meta.sort]);
            } else {
              $(sorting).append($('<i/>').addClass(icons[meta.sort]));
            } // set sorted class to header on init


            $(td).addClass(pfx + 'datatable__cell--sorted');
          },
          sortClick: function sortClick(e) {
            var meta = Plugin.getDataSourceParam('sort');
            var field = $(this).data('field');
            var column = Plugin.getColumnByField(field); // sort is disabled for this column

            if (typeof column.sortable !== 'undefined' && column.sortable === false) return; // set sorted class to header

            $(datatable.tableHead).find('th').removeClass(pfx + 'datatable__cell--sorted');
            util.addClass(this, pfx + 'datatable__cell--sorted');
            $(datatable.tableHead).find('.' + pfx + 'datatable__cell > span > i').remove();

            if (options.sortable) {
              Plugin.spinnerCallback(true);
              var sort = 'desc';

              if (Plugin.getObject('field', meta) === field) {
                sort = Plugin.getObject('sort', meta);
              } // toggle sort


              sort = typeof sort === 'undefined' || sort === 'desc' ? 'asc' : 'desc'; // update field and sort params

              meta = {
                field: field,
                sort: sort
              };
              Plugin.setDataSourceParam('sort', meta);
              sortObj.setIcon();
              setTimeout(function () {
                Plugin.dataRender('sort');
                $(datatable).trigger(pfx + 'datatable--on-sort', meta);
              }, 300);
            }
          }
        };
        sortObj.init();
      },

      /**
       * Update JSON data list linked with sort, filter and pagination.
       * Call this method, before using dataSet variable.
       * @returns {*|null}
       */
      localDataUpdate: function localDataUpdate() {
        var params = Plugin.getDataSourceParam();

        if (typeof datatable.originalDataSet === 'undefined') {
          datatable.originalDataSet = datatable.dataSet;
        }

        var field = Plugin.getObject('sort.field', params);
        var sort = Plugin.getObject('sort.sort', params);
        var column = Plugin.getColumnByField(field);

        if (typeof column !== 'undefined' && Plugin.getOption('data.serverSorting') !== true) {
          if (typeof column.sortCallback === 'function') {
            datatable.dataSet = column.sortCallback(datatable.originalDataSet, sort, column);
          } else {
            datatable.dataSet = Plugin.sortCallback(datatable.originalDataSet, sort, column);
          }
        } else {
          datatable.dataSet = datatable.originalDataSet;
        } // if server filter enable, don't pass local filter


        if (_typeof(params.query) === 'object' && !Plugin.getOption('data.serverFiltering')) {
          params.query = params.query || {};

          var nestedSearch = function nestedSearch(obj) {
            for (var field in obj) {
              if (!obj.hasOwnProperty(field)) continue;

              if (typeof obj[field] === 'string') {
                if (obj[field].toLowerCase() == search || obj[field].toLowerCase().indexOf(search) !== -1) {
                  return true;
                }
              } else if (typeof obj[field] === 'number') {
                if (obj[field] === search) {
                  return true;
                }
              } else if (_typeof(obj[field]) === 'object') {
                if (nestedSearch(obj[field])) {
                  return true;
                }
              }
            }

            return false;
          };

          var search = $(Plugin.getOption('search.input')).val();

          if (typeof search !== 'undefined' && search !== '') {
            search = search.toLowerCase();
            datatable.dataSet = $.grep(datatable.dataSet, nestedSearch); // remove generalSearch as we don't need this for next columns filter

            delete params.query[Plugin.getGeneralSearchKey()];
          } // remove empty element from array


          $.each(params.query, function (k, v) {
            if (v === '') {
              delete params.query[k];
            }
          }); // filter array by query

          datatable.dataSet = Plugin.filterArray(datatable.dataSet, params.query); // reset array index

          datatable.dataSet = datatable.dataSet.filter(function () {
            return true;
          });
        }

        return datatable.dataSet;
      },

      /**
       * Utility helper to filter array by object pair of {key:value}
       * @param list
       * @param args
       * @param operator
       * @returns {*}
       */
      filterArray: function filterArray(list, args, operator) {
        if (_typeof(list) !== 'object') {
          return [];
        }

        if (typeof operator === 'undefined') operator = 'AND';

        if (_typeof(args) !== 'object') {
          return list;
        }

        operator = operator.toUpperCase();

        if ($.inArray(operator, ['AND', 'OR', 'NOT']) === -1) {
          return [];
        }

        var count = Object.keys(args).length;
        var filtered = [];
        $.each(list, function (key, obj) {
          var to_match = obj;
          var matched = 0;
          $.each(args, function (m_key, m_value) {
            m_value = m_value instanceof Array ? m_value : [m_value];
            var match_property = Plugin.getObject(m_key, to_match);

            if (typeof match_property !== 'undefined' && match_property) {
              var lhs = match_property.toString().toLowerCase();
              m_value.forEach(function (item, index) {
                if (item.toString().toLowerCase() == lhs || lhs.indexOf(item.toString().toLowerCase()) !== -1) {
                  matched++;
                }
              });
            }
          });

          if ('AND' == operator && matched == count || 'OR' == operator && matched > 0 || 'NOT' == operator && 0 == matched) {
            filtered[key] = obj;
          }
        });
        list = filtered;
        return list;
      },

      /**
       * Reset lock column scroll to 0 when resize
       */
      resetScroll: function resetScroll() {
        if (typeof options.detail === 'undefined' && Plugin.getDepth() === 1) {
          $(datatable.table).find('.' + pfx + 'datatable__row').css('left', 0);
          $(datatable.table).find('.' + pfx + 'datatable__lock').css('top', 0);
          $(datatable.tableBody).scrollTop(0);
        }
      },

      /**
       * Get column options by field
       * @param field
       * @returns {boolean}
       */
      getColumnByField: function getColumnByField(field) {
        if (typeof field === 'undefined') return;
        var result;
        $.each(options.columns, function (i, column) {
          if (field === column.field) {
            result = column;
            return false;
          }
        });
        return result;
      },

      /**
       * Get default sort column
       */
      getDefaultSortColumn: function getDefaultSortColumn() {
        var result;
        $.each(options.columns, function (i, column) {
          if (typeof column.sortable !== 'undefined' && $.inArray(column.sortable, ['asc', 'desc']) !== -1) {
            result = {
              sort: column.sortable,
              field: column.field
            };
            return false;
          }
        });
        return result;
      },

      /**
       * Helper to get element dimensions, when the element is hidden
       * @param element
       * @param includeMargin
       * @returns {{width: number, height: number, innerWidth: number,
       *     innerHeight: number, outerWidth: number, outerHeight:
       *     number}}
       */
      getHiddenDimensions: function getHiddenDimensions(element, includeMargin) {
        var props = {
          position: 'absolute',
          visibility: 'hidden',
          display: 'block'
        },
            dim = {
          width: 0,
          height: 0,
          innerWidth: 0,
          innerHeight: 0,
          outerWidth: 0,
          outerHeight: 0
        },
            hiddenParents = $(element).parents().addBack().not(':visible');
        includeMargin = typeof includeMargin === 'boolean' ? includeMargin : false;
        var oldProps = [];
        hiddenParents.each(function () {
          var old = {};

          for (var name in props) {
            old[name] = this.style[name];
            this.style[name] = props[name];
          }

          oldProps.push(old);
        });
        dim.width = $(element).width();
        dim.outerWidth = $(element).outerWidth(includeMargin);
        dim.innerWidth = $(element).innerWidth();
        dim.height = $(element).height();
        dim.innerHeight = $(element).innerHeight();
        dim.outerHeight = $(element).outerHeight(includeMargin);
        hiddenParents.each(function (i) {
          var old = oldProps[i];

          for (var name in props) {
            this.style[name] = old[name];
          }
        });
        return dim;
      },
      getGeneralSearchKey: function getGeneralSearchKey() {
        var searchInput = $(Plugin.getOption('search.input'));
        return $(searchInput).prop('name') || $(searchInput).prop('id');
      },

      /**
       * Get value by dot notation path string and to prevent undefined
       * errors
       * @param path String Dot notation path in string
       * @param object Object to iterate
       * @returns {*}
       */
      getObject: function getObject(path, object) {
        return path.split('.').reduce(function (obj, i) {
          return obj !== null && typeof obj[i] !== 'undefined' ? obj[i] : null;
        }, object);
      },

      /**
       * Extend object
       * @param obj
       * @param path
       * @param value
       * @returns {*}
       */
      extendObj: function extendObj(obj, path, value) {
        var levels = path.split('.'),
            i = 0;

        function createLevel(child) {
          var name = levels[i++];

          if (typeof child[name] !== 'undefined' && child[name] !== null) {
            if (_typeof(child[name]) !== 'object' && typeof child[name] !== 'function') {
              child[name] = {};
            }
          } else {
            child[name] = {};
          }

          if (i === levels.length) {
            child[name] = value;
          } else {
            createLevel(child[name]);
          }
        }

        createLevel(obj);
        return obj;
      },
      rowEvenOdd: function rowEvenOdd() {
        // row even class
        $(datatable.tableBody).find('.' + pfx + 'datatable__row').removeClass(pfx + 'datatable__row--even');

        if ($(datatable.wrap).hasClass(pfx + 'datatable--subtable')) {
          $(datatable.tableBody).find('.' + pfx + 'datatable__row:not(.' + pfx + 'datatable__row-detail):even').addClass(pfx + 'datatable__row--even');
        } else {
          $(datatable.tableBody).find('.' + pfx + 'datatable__row:nth-child(even)').addClass(pfx + 'datatable__row--even');
        }
      },

      /********************
       ** PUBLIC API METHODS
       ********************/
      // delay timer
      timer: 0,

      /**
       * Redraw datatable by recalculating its DOM elements, etc.
       * @returns {jQuery}
       */
      redraw: function redraw() {
        Plugin.adjustCellsWidth.call();

        if (Plugin.isLocked()) {
          // fix hiding cell width issue
          Plugin.scrollbar();
          Plugin.resetScroll();
          Plugin.adjustCellsHeight.call();
        }

        Plugin.adjustLockContainer.call();
        Plugin.initHeight.call();
        return datatable;
      },

      /**
       * Shortcode to reload
       * @returns {jQuery}
       */
      load: function load() {
        Plugin.reload();
        return datatable;
      },

      /**
       * Datasource reload
       * @returns {jQuery}
       */
      reload: function reload() {
        var delay = function () {
          return function (callback, ms) {
            clearTimeout(Plugin.timer);
            Plugin.timer = setTimeout(callback, ms);
          };
        }();

        delay(function () {
          // local only. remote pagination will skip this block
          if (!options.data.serverFiltering) {
            Plugin.localDataUpdate();
          }

          Plugin.dataRender();
          $(datatable).trigger(pfx + 'datatable--on-reloaded');
        }, Plugin.getOption('search.delay'));
        return datatable;
      },

      /**
       * Get record by record ID
       * @param id
       * @returns {jQuery}
       */
      getRecord: function getRecord(id) {
        if (typeof datatable.tableBody === 'undefined') datatable.tableBody = $(datatable.table).children('tbody');
        $(datatable.tableBody).find('.' + pfx + 'datatable__cell:first-child').each(function (i, cell) {
          if (id == $(cell).text()) {
            var rowNumber = $(cell).closest('.' + pfx + 'datatable__row').index() + 1;
            datatable.API.record = datatable.API.value = Plugin.getOneRow(datatable.tableBody, rowNumber);
            return datatable;
          }
        });
        return datatable;
      },

      /**
       * @deprecated in v5.0.6
       * Get column of current record ID
       * @param columnName
       * @returns {jQuery}
       */
      getColumn: function getColumn(columnName) {
        Plugin.setSelectedRecords();
        datatable.API.value = $(datatable.API.record).find('[data-field="' + columnName + '"]');
        return datatable;
      },

      /**
       * Destroy datatable to original DOM state before datatable was
       * initialized
       * @returns {jQuery}
       */
      destroy: function destroy() {
        $(datatable).parent().find('.' + pfx + 'datatable__pager').remove();
        var initialDatatable = $(datatable.initialDatatable).addClass(pfx + 'datatable--destroyed').show();
        $(datatable).replaceWith(initialDatatable);
        datatable = initialDatatable;
        $(datatable).trigger(pfx + 'datatable--on-destroy');
        Plugin.isInit = false;
        initialDatatable = null;
        return initialDatatable;
      },

      /**
       * Sort by column field
       * @param field
       * @param sort
       */
      sort: function sort(field, _sort) {
        // toggle sort
        _sort = typeof _sort === 'undefined' ? 'asc' : _sort;
        Plugin.spinnerCallback(true); // update field and sort params

        var meta = {
          field: field,
          sort: _sort
        };
        Plugin.setDataSourceParam('sort', meta);
        setTimeout(function () {
          Plugin.dataRender('sort');
          $(datatable).trigger(pfx + 'datatable--on-sort', meta);
          $(datatable.tableHead).find('.' + pfx + 'datatable__cell > span > i').remove();
        }, 300);
        return datatable;
      },

      /**
       * @deprecated in v5.0.6
       * Get current selected column value
       * @returns {jQuery}
       */
      getValue: function getValue() {
        return $(datatable.API.value).text();
      },

      /**
       * Set checkbox active
       * @param cell JQuery selector or checkbox ID
       */
      setActive: function setActive(cell) {
        if (typeof cell === 'string') {
          // set by checkbox id
          cell = $(datatable.tableBody).find('.' + pfx + 'checkbox--single > [type="checkbox"][value="' + cell + '"]');
        }

        $(cell).prop('checked', true);
        var ids = [];
        $(cell).each(function (i, td) {
          // normal table
          var row = $(td).closest('tr').addClass(pfx + 'datatable__row--active');
          var id = $(td).attr('value');

          if (typeof id !== 'undefined') {
            ids.push(id);
          }
        });
        $(datatable).trigger(pfx + 'datatable--on-check', [ids]);
      },

      /**
       * Set checkbox inactive
       * @param cell JQuery selector or checkbox ID
       */
      setInactive: function setInactive(cell) {
        if (typeof cell === 'string') {
          // set by checkbox id
          cell = $(datatable.tableBody).find('.' + pfx + 'checkbox--single > [type="checkbox"][value="' + cell + '"]');
        }

        $(cell).prop('checked', false);
        var ids = [];
        $(cell).each(function (i, td) {
          // normal table
          var row = $(td).closest('tr').removeClass(pfx + 'datatable__row--active');
          var id = $(td).attr('value');

          if (typeof id !== 'undefined') {
            ids.push(id);
          }
        });
        $(datatable).trigger(pfx + 'datatable--on-uncheck', [ids]);
      },

      /**
       * Set all checkboxes active or inactive
       * @param active
       */
      setActiveAll: function setActiveAll(active) {
        var checkboxes = $(datatable.table).find('> tbody, > thead').find('tr').not('.' + pfx + 'datatable__row-subtable').find('.' + pfx + 'datatable__cell--check [type="checkbox"]');

        if (active) {
          Plugin.setActive(checkboxes);
        } else {
          Plugin.setInactive(checkboxes);
        }
      },

      /**
       * @deprecated in v5.0.6
       * Get selected rows which are active
       * @returns {jQuery}
       */
      setSelectedRecords: function setSelectedRecords() {
        datatable.API.record = $(datatable.tableBody).find('.' + pfx + 'datatable__row--active');
        return datatable;
      },

      /**
       * Get selected records
       * @returns {null}
       */
      getSelectedRecords: function getSelectedRecords() {
        // support old method
        Plugin.setSelectedRecords();
        datatable.API.record = datatable.rows('.' + pfx + 'datatable__row--active').nodes();
        return datatable.API.record;
      },

      /**
       * Get options by dots notation path
       * @param path String Dot notation path in string
       * @returns {*}
       */
      getOption: function getOption(path) {
        return Plugin.getObject(path, options);
      },

      /**
       * Set global options nodes by dots notation path
       * @param path
       * @param object
       */
      setOption: function setOption(path, object) {
        options = Plugin.extendObj(options, path, object);
      },

      /**
       * Search filter for local & remote
       * @param value
       * @param columns. Optional list of columns to be filtered.
       */
      search: function search(value, columns) {
        if (typeof columns !== 'undefined') columns = $.makeArray(columns);

        var delay = function () {
          return function (callback, ms) {
            clearTimeout(Plugin.timer);
            Plugin.timer = setTimeout(callback, ms);
          };
        }();

        delay(function () {
          // get query parameters
          var query = Plugin.getDataSourceQuery(); // search not by columns

          if (typeof columns === 'undefined' && typeof value !== 'undefined') {
            var key = Plugin.getGeneralSearchKey();
            query[key] = value;
          } // search by columns, support multiple columns


          if (_typeof(columns) === 'object') {
            $.each(columns, function (k, column) {
              query[column] = value;
            }); // remove empty element from arrays

            $.each(query, function (k, v) {
              if (v === '' || $.isEmptyObject(v)) {
                delete query[k];
              }
            });
          }

          Plugin.setDataSourceQuery(query); // reset pagination to 1 when doing seearching

          datatable.setDataSourceParam('pagination', Object.assign({}, datatable.getDataSourceParam('pagination'), {
            page: 1
          })); // local filter only. remote pagination will skip this block

          if (!options.data.serverFiltering) {
            Plugin.localDataUpdate();
          }

          Plugin.dataRender('search');
        }, Plugin.getOption('search.delay'));
      },

      /**
       * Set datasource params extract
       * @param param
       * @param value
       */
      setDataSourceParam: function setDataSourceParam(param, value) {
        datatable.API.params = $.extend({}, {
          pagination: {
            page: 1,
            perpage: Plugin.getOption('data.pageSize')
          },
          sort: Plugin.getDefaultSortColumn(),
          query: {}
        }, datatable.API.params, Plugin.stateGet(Plugin.stateId));
        datatable.API.params = Plugin.extendObj(datatable.API.params, param, value);
        Plugin.stateKeep(Plugin.stateId, datatable.API.params);
      },

      /**
       * Get datasource params
       * @param param
       */
      getDataSourceParam: function getDataSourceParam(param) {
        datatable.API.params = $.extend({}, {
          pagination: {
            page: 1,
            perpage: Plugin.getOption('data.pageSize')
          },
          sort: Plugin.getDefaultSortColumn(),
          query: {}
        }, datatable.API.params, Plugin.stateGet(Plugin.stateId));

        if (typeof param === 'string') {
          return Plugin.getObject(param, datatable.API.params);
        }

        return datatable.API.params;
      },

      /**
       * Shortcode to datatable.getDataSourceParam('query');
       * @returns {*}
       */
      getDataSourceQuery: function getDataSourceQuery() {
        return Plugin.getDataSourceParam('query') || {};
      },

      /**
       * Shortcode to datatable.setDataSourceParam('query', query);
       * @param query
       */
      setDataSourceQuery: function setDataSourceQuery(query) {
        Plugin.setDataSourceParam('query', query);
      },

      /**
       * Get current page number
       * @returns {number}
       */
      getCurrentPage: function getCurrentPage() {
        return $(datatable.table).siblings('.' + pfx + 'datatable__pager').last().find('.' + pfx + 'datatable__pager-nav').find('.' + pfx + 'datatable__pager-link.' + pfx + 'datatable__pager-link--active').data('page') || 1;
      },

      /**
       * Get selected dropdown page size
       * @returns {*|number}
       */
      getPageSize: function getPageSize() {
        return $(datatable.table).siblings('.' + pfx + 'datatable__pager').last().find('select.' + pfx + 'datatable__pager-size').val() || 10;
      },

      /**
       * Get total rows
       */
      getTotalRows: function getTotalRows() {
        return datatable.API.params.pagination.total;
      },

      /**
       * Get full dataset in grid
       * @returns {*|null|Array}
       */
      getDataSet: function getDataSet() {
        return datatable.originalDataSet;
      },
      nodeTr: [],
      nodeTd: [],
      nodeCols: [],
      recentNode: [],
      table: function table() {
        if (typeof datatable.table !== 'undefined') {
          return datatable.table;
        }
      },

      /**
       * Select a single row from the table
       * @param selector
       * @returns {jQuery}
       */
      row: function row(selector) {
        Plugin.rows(selector);
        Plugin.nodeTr = Plugin.recentNode = $(Plugin.nodeTr).first();
        return datatable;
      },

      /**
       * Select multiple rows from the table
       * @param selector
       * @returns {jQuery}
       */
      rows: function rows(selector) {
        if (Plugin.isLocked()) {
          Plugin.nodeTr = Plugin.recentNode = $(datatable.tableBody).find(selector).filter('.' + pfx + 'datatable__lock--scroll > .' + pfx + 'datatable__row');
        } else {
          Plugin.nodeTr = Plugin.recentNode = $(datatable.tableBody).find(selector).filter('.' + pfx + 'datatable__row');
        }

        return datatable;
      },

      /**
       * Select a single column from the table
       * @param index zero-based index
       * @returns {jQuery}
       */
      column: function column(index) {
        Plugin.nodeCols = Plugin.recentNode = $(datatable.tableBody).find('.' + pfx + 'datatable__cell:nth-child(' + (index + 1) + ')');
        return datatable;
      },

      /**
       * Select multiple columns from the table
       * @param selector
       * @returns {jQuery}
       */
      columns: function columns(selector) {
        var context = datatable.table;

        if (Plugin.nodeTr === Plugin.recentNode) {
          context = Plugin.nodeTr;
        }

        var columns = $(context).find('.' + pfx + 'datatable__cell[data-field="' + selector + '"]');

        if (columns.length > 0) {
          Plugin.nodeCols = Plugin.recentNode = columns;
        } else {
          Plugin.nodeCols = Plugin.recentNode = $(context).find(selector).filter('.' + pfx + 'datatable__cell');
        }

        return datatable;
      },
      cell: function cell(selector) {
        Plugin.cells(selector);
        Plugin.nodeTd = Plugin.recentNode = $(Plugin.nodeTd).first();
        return datatable;
      },
      cells: function cells(selector) {
        var cells = $(datatable.tableBody).find('.' + pfx + 'datatable__cell');

        if (typeof selector !== 'undefined') {
          cells = $(cells).filter(selector);
        }

        Plugin.nodeTd = Plugin.recentNode = cells;
        return datatable;
      },

      /**
       * Delete the selected row from the table
       * @returns {jQuery}
       */
      remove: function remove() {
        if ($(Plugin.nodeTr.length) && Plugin.nodeTr === Plugin.recentNode) {
          $(Plugin.nodeTr).remove();
        }

        Plugin.layoutUpdate();
        return datatable;
      },

      /**
       * Show or hide the columns or rows
       */
      visible: function visible(bool) {
        if ($(Plugin.recentNode.length)) {
          var locked = Plugin.lockEnabledColumns();

          if (Plugin.recentNode === Plugin.nodeCols) {
            var index = Plugin.recentNode.index();

            if (Plugin.isLocked()) {
              var scrollColumns = $(Plugin.recentNode).closest('.' + pfx + 'datatable__lock--scroll').length;

              if (scrollColumns) {
                // is at center of scrollable area
                index += locked.left.length + 1;
              } else if ($(Plugin.recentNode).closest('.' + pfx + 'datatable__lock--right').length) {
                // is at the right locked table
                index += locked.left.length + scrollColumns + 1;
              }
            }
          }

          if (bool) {
            if (Plugin.recentNode === Plugin.nodeCols) {
              delete options.columns[index].visible;
            }

            $(Plugin.recentNode).show();
          } else {
            if (Plugin.recentNode === Plugin.nodeCols) {
              Plugin.setOption('columns.' + index + '.visible', false);
            }

            $(Plugin.recentNode).hide();
          }

          Plugin.columnHide();
          Plugin.redraw();
        }
      },

      /**
       * Get the the DOM element for the selected rows or columns
       * @returns {Array}
       */
      nodes: function nodes() {
        return Plugin.recentNode;
      },

      /**
       * will be implemented soon
       * @returns {jQuery}
       */
      dataset: function dataset() {
        return datatable;
      },

      /**
       * Open page by number
       * @param page number
       */
      gotoPage: function gotoPage(page) {
        if (typeof Plugin.pagingObject !== 'undefined') {
          Plugin.isInit = true;
          Plugin.pagingObject.openPage(page);
        }
      }
    };
    /**
     * Public API methods can be used directly by datatable
     */

    $.each(Plugin, function (funcName, func) {
      datatable[funcName] = func;
    }); // initialize main datatable plugin

    if (typeof options !== 'undefined') {
      if (typeof options === 'string') {
        var method = options;
        datatable = $(this).data(pluginName);

        if (typeof datatable !== 'undefined') {
          options = datatable.options;
          Plugin[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }
      } else {
        if (!datatable.data(pluginName) && !$(this).hasClass(pfx + 'datatable--loaded')) {
          datatable.dataSet = null;
          datatable.textAlign = {
            left: pfx + 'datatable__cell--left',
            center: pfx + 'datatable__cell--center',
            right: pfx + 'datatable__cell--right'
          }; // merge default and user defined options

          options = $.extend(true, {}, $.fn[pluginName].defaults, options);
          datatable.options = options; // init plugin process

          Plugin.init.apply(this, [options]);
          $(datatable.wrap).data(pluginName, datatable);
        }
      }
    } else {
      // get existing instance datatable
      datatable = $(this).data(pluginName);

      if (typeof datatable === 'undefined') {
        $.error(pluginName + ' not initialized');
      }

      options = datatable.options;
    }

    return datatable;
  }; // default options


  $.fn[pluginName].defaults = {
    // datasource definition
    data: {
      type: 'local',
      source: null,
      pageSize: 10,
      // display records per page
      saveState: {
        // save datatable state(pagination, filtering, sorting, etc) in cookie or browser webstorage
        cookie: false,
        webstorage: true
      },
      serverPaging: false,
      serverFiltering: false,
      serverSorting: false,
      autoColumns: false,
      attr: {
        rowProps: []
      }
    },
    // layout definition
    layout: {
      theme: 'default',
      // datatable will support multiple themes and designs
      "class": pfx + 'datatable--brand',
      // custom wrapper class
      scroll: false,
      // enable/disable datatable scroll both horizontal and vertical when needed.
      height: null,
      // datatable's body's fixed height
      minHeight: null,
      footer: false,
      // display/hide footer
      header: true,
      // display/hide header
      customScrollbar: true,
      // set false to disable custom scrollbar
      // datatable spinner
      spinner: {
        overlayColor: '#000000',
        opacity: 0,
        type: 'loader',
        state: 'brand',
        message: true
      },
      // datatable UI icons
      icons: {
        sort: {
          asc: 'flaticon2-arrow-up',
          desc: 'flaticon2-arrow-down'
        },
        pagination: {
          next: 'flaticon2-next',
          prev: 'flaticon2-back',
          first: 'flaticon2-fast-back',
          last: 'flaticon2-fast-next',
          more: 'flaticon-more-1'
        },
        rowDetail: {
          expand: 'fa fa-caret-down',
          collapse: 'fa fa-caret-right'
        }
      }
    },
    // column sorting
    sortable: true,
    // resize column size with mouse drag coming soon)
    resizable: false,
    // column based filtering (coming soon)
    filterable: false,
    pagination: true,
    // inline and bactch editing (cooming soon)
    editable: false,
    // columns definition
    columns: [],
    search: {
      // enable trigger search by keyup enter
      onEnter: false,
      // input text for search
      input: null,
      // search delay in milliseconds
      delay: 400
    },
    rows: {
      // deprecated
      callback: function callback() {},
      // call before row template
      beforeTemplate: function beforeTemplate() {},
      // call after row template
      afterTemplate: function afterTemplate() {},
      autoHide: true
    },
    // toolbar
    toolbar: {
      // place pagination and displayInfo blocks according to the array order
      layout: ['pagination', 'info'],
      // toolbar placement can be at top or bottom or both top and bottom repeated
      placement: ['bottom'],
      //'top', 'bottom'
      // toolbar items
      items: {
        // pagination
        pagination: {
          // pagination type(default or scroll)
          type: 'default',
          // number of pages to display by breakpoints
          pages: {
            desktop: {
              layout: 'default',
              pagesNumber: 5
            },
            tablet: {
              layout: 'default',
              pagesNumber: 3
            },
            mobile: {
              layout: 'compact'
            }
          },
          // navigation buttons
          navigation: {
            prev: true,
            // display prev button
            next: true,
            // display next button
            first: true,
            // display first button
            last: true,
            // display last button
            more: false // display more button

          },
          // page size select
          pageSizeSelect: [] // display dropdown to select pagination size. -1 is used for "ALl" option

        },
        // records info
        info: true
      }
    },
    // here we will keep all strings and message used by datatable UI so developer can easiliy translate to any language.
    // By default the stirngs will be in the plugin source and here can override it
    translate: {
      records: {
        processing: 'Please wait...',
        noRecords: 'No records found'
      },
      toolbar: {
        pagination: {
          items: {
            "default": {
              first: 'First',
              prev: 'Previous',
              next: 'Next',
              last: 'Last',
              more: 'More pages',
              input: 'Page number',
              select: 'Select page size',
              all: 'all'
            },
            info: 'Showing {{start}} - {{end}} of {{total}}'
          }
        }
      }
    },
    extensions: {}
  };
})(jQuery);

/***/ }),

/***/ "./resources/js/admin/objet/objet/index.js":
/*!*************************************************!*\
  !*** ./resources/js/admin/objet/objet/index.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _demo5_src_assets_js_global_components_base_datatable_core_datatable_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js */ "./resources/demo5/src/assets/js/global/components/base/datatable/core.datatable.js");
/* harmony import */ var _demo5_src_assets_js_global_components_base_datatable_core_datatable_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_demo5_src_assets_js_global_components_base_datatable_core_datatable_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var medium_zoom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! medium-zoom */ "./node_modules/medium-zoom/dist/medium-zoom.esm.js");


var table;

function loadTable() {
  table = $("#listeObjet").KTDatatable({
    data: {
      type: 'remote',
      source: {
        read: {
          url: '/api/admin/objet/objet/list',
          // sample custom headers
          // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
          map: function map(raw) {
            // sample data mapping
            var dataSet = raw;

            if (typeof raw.data !== 'undefined') {
              dataSet = raw.data;
            }

            return dataSet;
          }
        }
      },
      pageSize: 10,
      serverPaging: true,
      serverFiltering: true,
      serverSorting: true
    },
    // layout definition
    layout: {
      scroll: false,
      footer: false
    },
    // column sorting
    sortable: true,
    pagination: true,
    search: {
      input: $('#objetSearch')
    },
    columns: [{
      field: 'id',
      title: '#',
      sortable: 'asc',
      width: 30,
      type: 'number',
      textAlign: 'center',
      autoHide: false
    }, {
      field: 'img',
      title: 'Images',
      sortable: false,
      textAlign: 'center',
      autoHide: false
    }, {
      field: 'designation',
      title: 'Designation',
      width: 300,
      sortable: false,
      autoHide: false
    }, {
      field: 'short_description',
      title: 'Description',
      sortable: false,
      autoHide: true,
      width: '100%'
    }, {
      field: 'published',
      title: 'Publier',
      sortable: 'asc',
      autoHide: false,
      template: function template(row) {
        var published = {
          0: {
            'title': 'Non Publier',
            'class': 'kt-badge--danger'
          },
          1: {
            'title': 'Publier',
            'class': 'kt-badge--success'
          }
        };
        return "<span class=\"kt-badge ".concat(published[row.published]["class"], " kt-badge--inline kt-badge--pill\">").concat(published[row.published].title, "</span>");
      }
    }, {
      field: 'price',
      title: "Prix",
      sortable: 'asc',
      autoHide: true,
      width: '100%',
      template: function template(row) {
        if (row.pricing === 0) {
          return "<span class=\"kt-badge kt-badge--success kt-badge--inline kt-badge--pill\">Gratuit</span>";
        } else {
          return "<span class=\"kt-badge kt-badge--danger kt-badge--inline kt-badge--pill\">".concat(row.price, "</span>");
        }
      }
    }, {
      field: 'social',
      title: 'Social',
      sortable: 'asc',
      autoHide: true,
      width: '100%',
      template: function template(row) {
        var social = {
          0: {
            'title': 'Non Publier',
            'class': 'kt-badge--danger'
          },
          1: {
            'title': 'Publier',
            'class': 'kt-badge--success'
          }
        };
        return "<span class=\"kt-badge ".concat(social[row.published]["class"], " kt-badge--inline kt-badge--pill\">").concat(social[row.published].title, "</span>");
      }
    }, {
      field: 'Actions',
      title: 'Actions',
      sortable: false,
      width: 110,
      autoHide: false,
      textAlign: 'right',
      template: function template(row) {
          if (row.published === 0) {
              return "\n                        <a href=\"/administrator/objet/objet/".concat(row.id, "\" class=\"btn btn-icon btn-sm btn-default\"><i class=\"la la-eye\"></i> </a>\n                        <a href=\"/administrator/objet/objet/").concat(row.id, "/edit\" class=\"btn btn-icon btn-sm btn-info\"><i class=\"la la-edit\"></i> </a>\n                        <a href=\"/administrator/objet/objet/").concat(row.id, "/delete\" class=\"btn btn-icon btn-sm btn-danger\"><i class=\"la la-trash-o\"></i> </a>\n                    ");
          } else {
              return "\n                        <a href=\"/administrator/objet/objet/".concat(row.id, "\" class=\"btn btn-icon btn-sm btn-default\"><i class=\"la la-eye\"></i> </a>\n                    ");
          }
      }
    }],
    translate: {
      records: {
        processing: 'Chargement des objets...',
        noRecords: 'Aucun objet'
      },
      toolbar: {
        pagination: {
          items: {
            "default": {
              first: 'Premier',
              prev: 'Précédent',
              next: 'Suivant',
              last: 'Dernier',
              more: 'Plus',
              input: 'Numéro de page',
              select: 'Sélectionnez la taille de la page'
            },
            info: "Affichage de l'élément {{start}} à {{end}} sur {{total}} éléments",
            infoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément"
          }
        }
      }
    }
  });
  table.on('kt-datatable--on-layout-updated', function (e) {
    var imgs = document.querySelectorAll('img');
    Array.from(imgs).forEach(function (img) {
      img.addEventListener('click', function (e) {
        Object(medium_zoom__WEBPACK_IMPORTED_MODULE_1__["default"])(img);
      });
    });
  });
}

function loadFormSubcategoryField() {
  var category_field = document.querySelector('#category_id');
  var subfield = document.querySelector('#subcategory');
  category_field.addEventListener('change', function () {
    KTApp.block($(".modal"));
    $.get('/api/admin/objet/subcategory/' + category_field.value + '/list').done(function (data) {
      KTApp.unblock($(".modal"));
      subfield.innerHTML = data.data;
      $(".selectpicker").selectpicker();
    });
  });
}

function formAddObjet() {
  var form = $("#formAddObjet");
  form.on('submit', function (e) {
    e.preventDefault();
    var btn = form.find('button');
    var url = form.attr('action');
    var data = form.serializeArray();
    KTApp.progress(btn);
    $.ajax({
      url: url,
      method: 'post',
      data: data,
      statusCode: {
        200: function _(data) {
          KTApp.unprogress(btn);
          toastr.success("L'objet <strong>" + data.data.designation + "</strong> à été ajouter avec succès", "Succès");
          $(".modal").modal('hide');
          table.reload();
        },
        203: function _(data) {
          KTApp.unprogress(btn);
          Array.from(data.data.errors).forEach(function (err) {
            toastr.warning(err, "Validation");
          });
        },
        404: function _(err) {
          KTApp.unprogress(btn);
          toastr.error("Erreur lors de l'execution du script", "Erreur Système 500");
          console.error(err);
        },
        500: function _(err) {
          KTApp.unprogress(btn);
          toastr.error("Erreur lors de l'execution du script", "Erreur Système 500");
          console.log(err);
        }
      }
    });
  });
}

formAddObjet();
loadTable();
loadFormSubcategoryField();
$(".selectpicker").selectpicker();
$("#short_description").summernote({
  height: 200
});

/***/ }),

/***/ 35:
/*!*******************************************************!*\
  !*** multi ./resources/js/admin/objet/objet/index.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\LOGICIEL\laragon\www\v3.trainznation\resources\js\admin\objet\objet\index.js */"./resources/js/admin/objet/objet/index.js");


/***/ })

/******/ });
