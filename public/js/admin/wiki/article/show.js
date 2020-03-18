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
/******/ 	return __webpack_require__(__webpack_require__.s = 47);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/wiki/article/show.js":
/*!*************************************************!*\
  !*** ./resources/js/admin/wiki/article/show.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

            var article = $("#article");
            var article_id = article.attr('data-id');

            function formAddContent() {
                var form = $("#formAddContent");
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
                                toastr.success("Un contenue à été ajouté avec succès", "Succès");
                                /*setTimeout(function () {
                                    window.location.reload()
                                }, 1200)*/
                            },
                            203: function _(data) {
                                KTApp.unprogress(btn);
                                Array.from(data.data.errors).forEach(function (err) {
                                    toastr.warning(err, "Validation");
                                });
                            },
                            500: function _(data) {
                                KTApp.unprogress(btn);
                                toastr.error("Erreur lors de l'execution du script", "Erreur Système 500");
                            }
                        }
                    });
                });
            }

            $("#btnPublishArticle").on('click', function (e) {
                e.preventDefault();
                var btn = $(this);
                KTApp.progress(btn);
                $.get('/api/admin/wiki/article/' + article_id + '/publish').done(function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("L'article à été publier", "Succès");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1200);
                }).fail(function (err) {
                    KTApp.unprogress(btn);
                    toastr.error(err, "Erreur Système 500");
                });
            });
            $("#btnUnpublishArticle").on('click', function (e) {
                e.preventDefault();
                var btn = $(this);
                KTApp.progress(btn);
                $.get('/api/admin/wiki/article/' + article_id + '/unpublish').done(function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("L'article à été dépublier", "Succès");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1200);
                }).fail(function (err) {
                    KTApp.unprogress(btn);
                    toastr.error(err, "Erreur Système 500");
                });
            });
            formAddContent();
            $("#content").summernote();

            /***/
        }),

        /***/ 47:
        /*!*******************************************************!*\
          !*** multi ./resources/js/admin/wiki/article/show.js ***!
          \*******************************************************/
        /*! no static exports found */
        /***/ (function (module, exports, __webpack_require__) {

            module.exports = __webpack_require__(/*! E:\LOGICIEL\laragon\www\v3.trainznation\resources\js\admin\wiki\article\show.js */"./resources/js/admin/wiki/article/show.js");


            /***/
        })

        /******/
    });
