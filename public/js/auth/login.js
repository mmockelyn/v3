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
/******/ 	return __webpack_require__(__webpack_require__.s = 15);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/auth/login.js":
/*!************************************!*\
  !*** ./resources/js/auth/login.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class Definition

var KTLoginGeneral = function () {
  var login = $('#kt_login');

  var showErrorMsg = function showErrorMsg(form, type, msg) {
    var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
			<div class="alert-text">' + msg + '</div>\
			<div class="alert-close">\
                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
            </div>\
		</div>');
    form.find('.alert').remove();
    alert.prependTo(form); //alert.animateClass('fadeIn animated');

    KTUtil.animateClass(alert[0], 'fadeIn animated');
    alert.find('span').html(msg);
  }; // Private Functions


  var displaySignUpForm = function displaySignUpForm() {
    login.removeClass('kt-login--forgot');
    login.removeClass('kt-login--signin');
    login.addClass('kt-login--signup');
    KTUtil.animateClass(login.find('.kt-login__signup')[0], 'flipInX animated');
  };

  var displaySignInForm = function displaySignInForm() {
    login.removeClass('kt-login--forgot');
    login.removeClass('kt-login--signup');
    login.addClass('kt-login--signin');
    KTUtil.animateClass(login.find('.kt-login__signin')[0], 'flipInX animated'); //login.find('.kt-login__signin').animateClass('flipInX animated');
  };

  var displayForgotForm = function displayForgotForm() {
    login.removeClass('kt-login--signin');
    login.removeClass('kt-login--signup');
    login.addClass('kt-login--forgot'); //login.find('.kt-login--forgot').animateClass('flipInX animated');

    KTUtil.animateClass(login.find('.kt-login__forgot')[0], 'flipInX animated');
  };

  var handleFormSwitch = function handleFormSwitch() {
    $('#kt_login_forgot').click(function (e) {
      e.preventDefault();
      displayForgotForm();
    });
    $('#kt_login_forgot_cancel').click(function (e) {
      e.preventDefault();
      displaySignInForm();
    });
    $('#kt_login_signup').click(function (e) {
      e.preventDefault();
      displaySignUpForm();
    });
    $('#kt_login_signup_cancel').click(function (e) {
      e.preventDefault();
      displaySignInForm();
    });
  };

  var handleSignInFormSubmit = function handleSignInFormSubmit() {
    $('#kt_login_signin_submit').click(function (e) {
      e.preventDefault();
      var btn = $(this);
      var form = $(this).closest('form');
      form.validate({
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true
          }
        }
      });

      if (!form.valid()) {
        return;
      }

      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      form.ajaxSubmit({
        url: form.attr('action'),
        method: "POST",
        data: form.serializeArray(),
        success: function success(response, status, xhr, $form) {
          window.location.href = '/';
        },
        statusCode: {
          422: function _(jqxhr) {
            btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
            showErrorMsg(form, 'danger', jqxhr.responseJSON.errors.email[0]);
          }
        }
      });
    });
  };

  var handleSignUpFormSubmit = function handleSignUpFormSubmit() {
    $('#kt_login_signup_submit').click(function (e) {
      e.preventDefault();
      var btn = $(this);
      var form = $(this).closest('form');
      form.validate({
        rules: {
          fullname: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          password: {
            required: true
          },
          password_confirmation: {
            required: true
          },
          agree: {
            required: true
          }
        }
      });

      if (!form.valid()) {
        return;
      }

      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      form.ajaxSubmit({
        url: form.attr('action'),
        method: "POST",
        data: form.serializeArray(),
        success: function success(response, status, xhr, $form) {
          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
          form.clearForm();
          form.validate().resetForm(); // display signup form

          displaySignInForm();
          var signInForm = login.find('.kt-login__signin form');
          signInForm.clearForm();
          signInForm.validate().resetForm();
          showErrorMsg(signInForm, 'success', 'Nous vous remercions. Pour terminer votre inscription, veuillez vérifier votre boite mail.');
        },
        statusCode: {
          422: function _(jqxhr) {
            btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
            var jsons = jqxhr.responseJSON.errors;

            if (jsons.password) {
              showErrorMsg(form, 'danger', jsons.password[0]);
            }
          }
        }
      });
    });
  };

  var handleForgotFormSubmit = function handleForgotFormSubmit() {
    $('#kt_login_forgot_submit').click(function (e) {
      e.preventDefault();
      var btn = $(this);
      var form = $(this).closest('form');
      form.validate({
        rules: {
          email: {
            required: true,
            email: true
          }
        }
      });

      if (!form.valid()) {
        return;
      }

      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      form.ajaxSubmit({
        url: form.attr('action'),
        method: "POST",
        data: form.serializeArray(),
        success: function success(response, status, xhr, $form) {
          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false); // remove

          form.clearForm(); // clear form

          form.validate().resetForm(); // reset validation states
          // display signup form

          displaySignInForm();
          var signInForm = login.find('.kt-login__signin form');
          signInForm.clearForm();
          signInForm.validate().resetForm();
          showErrorMsg(signInForm, 'success', 'Cool! Des instructions de récupération du mot de passe ont été envoyées à votre adresse e-mail.');
        }
      });
    });
  }; // Public Functions


  return {
    // public functions
    init: function init() {
      handleFormSwitch();
      handleSignInFormSubmit();
      handleSignUpFormSubmit();
      handleForgotFormSubmit();
    }
  };
}(); // Class Initialization


jQuery(document).ready(function () {
  KTLoginGeneral.init();
});

/***/ }),

/***/ 15:
/*!******************************************!*\
  !*** multi ./resources/js/auth/login.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\site\trainznation\resources\js\auth\login.js */"./resources/js/auth/login.js");


/***/ })

/******/ });