/******/
(function (modules) { // webpackBootstrap
    /******/ 	// The module cache
    /******/
    var installedModules = {};
    /******/
    /******/ 	// The require function
    /******/
    function __webpack_require__(moduleId) {
        /******/
        /******/ 		// Check if module is in cache
        /******/
        if (installedModules[moduleId]) {
            /******/
            return installedModules[moduleId].exports;
            /******/
        }
        /******/ 		// Create a new module (and put it into the cache)
        /******/
        var module = installedModules[moduleId] = {
            /******/            i: moduleId,
            /******/            l: false,
            /******/            exports: {}
            /******/
        };
        /******/
        /******/ 		// Execute the module function
        /******/
        modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
        /******/
        /******/ 		// Flag the module as loaded
        /******/
        module.l = true;
        /******/
        /******/ 		// Return the exports of the module
        /******/
        return module.exports;
        /******/
    }

    /******/
    /******/
    /******/ 	// expose the modules object (__webpack_modules__)
    /******/
    __webpack_require__.m = modules;
    /******/
    /******/ 	// expose the module cache
    /******/
    __webpack_require__.c = installedModules;
    /******/
    /******/ 	// define getter function for harmony exports
    /******/
    __webpack_require__.d = function (exports, name, getter) {
        /******/
        if (!__webpack_require__.o(exports, name)) {
            /******/
            Object.defineProperty(exports, name, {enumerable: true, get: getter});
            /******/
        }
        /******/
    };
    /******/
    /******/ 	// define __esModule on exports
    /******/
    __webpack_require__.r = function (exports) {
        /******/
        if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
            /******/
            Object.defineProperty(exports, Symbol.toStringTag, {value: 'Module'});
            /******/
        }
        /******/
        Object.defineProperty(exports, '__esModule', {value: true});
        /******/
    };
    /******/
    /******/ 	// create a fake namespace object
    /******/ 	// mode & 1: value is a module id, require it
    /******/ 	// mode & 2: merge all properties of value into the ns
    /******/ 	// mode & 4: return value when already ns object
    /******/ 	// mode & 8|1: behave like require
    /******/
    __webpack_require__.t = function (value, mode) {
        /******/
        if (mode & 1) value = __webpack_require__(value);
        /******/
        if (mode & 8) return value;
        /******/
        if ((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
        /******/
        var ns = Object.create(null);
        /******/
        __webpack_require__.r(ns);
        /******/
        Object.defineProperty(ns, 'default', {enumerable: true, value: value});
        /******/
        if (mode & 2 && typeof value != 'string') for (var key in value) __webpack_require__.d(ns, key, function (key) {
            return value[key];
        }.bind(null, key));
        /******/
        return ns;
        /******/
    };
    /******/
    /******/ 	// getDefaultExport function for compatibility with non-harmony modules
    /******/
    __webpack_require__.n = function (module) {
        /******/
        var getter = module && module.__esModule ?
            /******/            function getDefault() {
                return module['default'];
            } :
            /******/            function getModuleExports() {
                return module;
            };
        /******/
        __webpack_require__.d(getter, 'a', getter);
        /******/
        return getter;
        /******/
    };
    /******/
    /******/ 	// Object.prototype.hasOwnProperty.call
    /******/
    __webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/ 	// __webpack_public_path__
    /******/
    __webpack_require__.p = "/";
    /******/
    /******/
    /******/ 	// Load entry module and return exports
    /******/
    return __webpack_require__(__webpack_require__.s = 44);
    /******/
})
    /************************************************************************/
    /******/ ({

    /***/ "./resources/js/admin/wiki/category/index.js":
    /*!***************************************************!*\
      !*** ./resources/js/admin/wiki/category/index.js ***!
      \***************************************************/
    /*! no static exports found */
    /***/ (function (module, exports) {

        var category;
        var sub;

        function listeCategory() {
            category = $("#listeCategory").KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: "/api/admin/wiki/category/list",
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
                columns: [{
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 50,
                    type: 'number',
                    textAlign: 'center'
                }, {
                    field: 'name',
                    title: 'Désignation',
                    sortable: 'asc'
                }, {
                    field: 'Actions',
                    title: 'Actions',
                    sortable: false,
                    width: 110,
                    autoHide: false,
                    textAlign: 'right',
                    template: function template(row) {
                        return "\n                    <a href=\"/administrator/wiki/category/".concat(row.id, "/delete\" class=\"btn btn-icon btn-sm btn-danger\"><i class=\"la la-trash-o\"></i> </a>\n                    ");
                    }
                }],
                translate: {
                    records: {
                        processing: 'Chargement des catégories...',
                        noRecords: 'Aucune catégories'
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
        }

        function listeSubCategory() {
            sub = $("#listeSubCategory").KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: "/api/admin/wiki/subcategory/list",
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
                columns: [{
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 50,
                    type: 'number',
                    textAlign: 'center',
                    autoHide: false
                }, {
                    field: 'category',
                    title: 'Catégorie Parente',
                    sortable: 'asc',
                    autoHide: false,
                    width: 300
                }, {
                    field: 'name',
                    title: 'Catégorie',
                    sortable: 'asc',
                    autoHide: false,
                    width: 300
                }, {
                    field: 'description',
                    title: 'Description',
                    sortable: 'asc',
                    autoHide: true
                }, {
                    field: 'icon',
                    title: 'Icone',
                    sortable: 'asc',
                    autoHide: true,
                    template: function template(row) {
                        return "<i class=\"".concat(row.icon, "\"></i>");
                    }
                }, {
                    field: 'Actions',
                    title: 'Actions',
                    sortable: false,
                    width: 110,
                    autoHide: false,
                    textAlign: 'right',
                    template: function template(row) {
                        return "\n                    <a href=\"/administrator/wiki/subcategory/".concat(row.id, "/delete\" class=\"btn btn-icon btn-sm btn-danger\"><i class=\"la la-trash-o\"></i> </a>\n                    ");
                    }
                }],
                translate: {
                    records: {
                        processing: 'Chargement des sous catégories...',
                        noRecords: 'Aucune sous catégorie'
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
        }

        function formAddCategory() {
            var form = $("#formAddCategory");
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
                            toastr.success("La catégorie à été ajouté", "Succès");
                            $(".modal").modal('hide');
                            category.reload();
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

        function formAddSubCategory() {
            var form = $("#formAddSubCategory");
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
                            toastr.success("La sous catégorie à été ajouté", "Succès");
                            $(".modal").modal('hide');
                            sub.reload();
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

        formAddSubCategory();
        formAddCategory();
        listeSubCategory();
        listeCategory();

        /***/
    }),

    /***/ 44:
    /*!*********************************************************!*\
      !*** multi ./resources/js/admin/wiki/category/index.js ***!
      \*********************************************************/
    /*! no static exports found */
    /***/ (function (module, exports, __webpack_require__) {

        module.exports = __webpack_require__(/*! E:\LOGICIEL\laragon\www\v3.trainznation\resources\js\admin\wiki\category\index.js */"./resources/js/admin/wiki/category/index.js");


        /***/
    })

    /******/
});
