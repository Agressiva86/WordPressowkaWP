/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets_tw/js/app.js":
/*!*****************************!*\
  !*** ./assets_tw/js/app.js ***!
  \*****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _lib_router__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./lib/router */ "./assets_tw/js/lib/router.js");
/* harmony import */ var _routes_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./routes/common */ "./assets_tw/js/routes/common.js");
 //import barba from '@barba/core';
//import css from '@barba/css';
// Routes

 // barba.use(css);
// barba.init({
// 	debug: false,
// 	logLevel: 4,
//     views: [
//         {
//             namespace: 'bhome',
//             afterLeave() {
// 				window.scrollTo(0, 0);
// 			},
// 			afterEnter() {
// 				routes.loadEvents();
// 			}
//         }
//     ]
// });

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */

var routes = new _lib_router__WEBPACK_IMPORTED_MODULE_0__["default"]({
  common: _routes_common__WEBPACK_IMPORTED_MODULE_1__["default"]
});
/** Load Events */

document.addEventListener('DOMContentLoaded', function () {
  return routes.loadEvents();
}, false);

/***/ }),

/***/ "./assets_tw/js/lib/camelCase.js":
/*!***************************************!*\
  !*** ./assets_tw/js/lib/camelCase.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// the most terrible camelizer on the internet, guaranteed!
/* harmony default export */ __webpack_exports__["default"] = (function (str) {
  return "".concat(str.charAt(0).toLowerCase()).concat(str.replace(/[\W_]/g, '|').split('|').map(function (part) {
    return "".concat(part.charAt(0).toUpperCase()).concat(part.slice(1));
  }).join('').slice(1));
});

/***/ }),

/***/ "./assets_tw/js/lib/router.js":
/*!************************************!*\
  !*** ./assets_tw/js/lib/router.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Router; }
/* harmony export */ });
/* harmony import */ var _camelCase__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./camelCase */ "./assets_tw/js/lib/camelCase.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 * ======================================================================== */
 // The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event

var Router = /*#__PURE__*/function () {
  function Router(routes) {
    _classCallCheck(this, Router);

    this.routes = routes;
  }

  _createClass(Router, [{
    key: "fire",
    value: function fire(route) {
      var fn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'init';
      var args = arguments.length > 2 ? arguments[2] : undefined;
      var fire = route !== '' && this.routes[route] && typeof this.routes[route][fn] === 'function';

      if (fire) {
        this.routes[route][fn](args);
      }
    }
  }, {
    key: "loadEvents",
    value: function loadEvents() {
      var _this = this;

      // Fire common init JS
      this.fire('common'); // Fire page-specific init JS, and then finalize JS

      document.body.className.toLowerCase().replace(/-/g, '_').split(/\s+/).map(_camelCase__WEBPACK_IMPORTED_MODULE_0__["default"]).forEach(function (className) {
        _this.fire(className);

        _this.fire(className, 'finalize');
      }); // Fire common finalize JS

      this.fire('common', 'finalize');
    }
  }]);

  return Router;
}();



/***/ }),

/***/ "./assets_tw/js/routes/common.js":
/*!***************************************!*\
  !*** ./assets_tw/js/routes/common.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/* harmony default export */ __webpack_exports__["default"] = ({
  init: function init() {
    if (window.CSS && CSS.supports('color', 'var(--fake-var)')) {
      new ThemeSwitcher();
    }

    var open_nav = document.getElementById('open-navigation');
    var close_nav = document.getElementById('close-navigation');
    var nav = document.getElementById('owl-navigation');
    open_nav.addEventListener('click', function (event) {
      event.preventDefault();
      document.body.classList.add('overflow-hidden');
      nav.classList.add('top-0');
      nav.classList.remove('-top-full');
    });
    close_nav.addEventListener('click', function (event) {
      event.preventDefault();
      document.body.classList.remove('overflow-hidden');
      nav.classList.remove('top-0');
      nav.classList.add('-top-full');
    });
  }
});

var ThemeSwitcher = /*#__PURE__*/function () {
  function ThemeSwitcher() {
    var _this = this;

    _classCallCheck(this, ThemeSwitcher);

    // define some state variables
    this.hasLocalStorage = typeof Storage !== 'undefined';
    this.activeTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'light';
    document.documentElement.classList.add(this.activeTheme);
    var btn = document.getElementById('themeswitcher');
    btn.addEventListener('click', function (event) {
      return _this.setTheme();
    });
  }

  _createClass(ThemeSwitcher, [{
    key: "setTheme",
    value: function setTheme() {
      event.preventDefault();
      document.documentElement.classList.remove(this.activeTheme);
      this.activeTheme = this.activeTheme === 'light' ? 'dark' : 'light'; // set the theme id on the <html> element...

      document.documentElement.classList.add(this.activeTheme); // and save the selection in localStorage for later

      if (this.hasLocalStorage) {
        localStorage.setItem('theme', this.activeTheme);
      }
    }
  }]);

  return ThemeSwitcher;
}();

/***/ }),

/***/ "./assets_tw/css/app.css":
/*!*******************************!*\
  !*** ./assets_tw/css/app.css ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./assets_tw/css/editor.css":
/*!**********************************!*\
  !*** ./assets_tw/css/editor.css ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/editor": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunksasquatch_wp"] = self["webpackChunksasquatch_wp"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/editor","css/app"], function() { return __webpack_require__("./assets_tw/js/app.js"); })
/******/ 	__webpack_require__.O(undefined, ["css/editor","css/app"], function() { return __webpack_require__("./assets_tw/css/app.css"); })
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/editor","css/app"], function() { return __webpack_require__("./assets_tw/css/editor.css"); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;