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
    return __webpack_require__(__webpack_require__.s = 45);
    /******/
})
    /************************************************************************/
    /******/ ({

    /***/ "./resources/js/admin/wiki/article/index.js":
    /*!**************************************************!*\
      !*** ./resources/js/admin/wiki/article/index.js ***!
      \**************************************************/
    /*! no static exports found */
    /***/ (function (module, exports) {

        var article;

        function listeArticle() {
            article = $("#listeArticle").KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: "/api/admin/wiki/article/list",
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
                    input: $('#articleSearch')
                },
                columns: [{
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 30,
                    type: 'number',
                    textAlign: 'center'
                }, {
                    field: 'img',
                    title: 'Thumbnail',
                    sortable: false,
                    width: 120,
                    template: function template(row) {
                        return "<img src='".concat(row.img, "' alt='").concat(row.title, "' class=\"img-fluid\" width=\"100\" />");
                    }
                }, {
                    field: 'category',
                    title: 'Catégorie',
                    sortable: 'asc'
                }, {
                    field: 'title',
                    title: 'Titre',
                    sortable: 'asc'
                }, {
                    field: 'published',
                    title: 'Etat',
                    sortable: 'asc',
                    template: function template(row) {
                        if (row.published === 0) {
                            return "<span class=\"kt-badge kt-badge--pill kt-badge--inline kt-badge--danger\"><i class=\"la la-times-circle\"></i> Non Publier</span>";
                        } else {
                            return "<span class=\"kt-badge kt-badge--pill kt-badge--inline kt-badge--success\"><i class=\"la la-check-circle\"></i> Publier</span>";
                        }
                    }
                }, {
                    field: 'Actions',
                    title: 'Actions',
                    sortable: false,
                    width: 110,
                    autoHide: false,
                    textAlign: 'right',
                    template: function template(row) {
                        return "\n                    <a href=\"/administrator/wiki/article/".concat(row.id, "\" class=\"btn btn-icon btn-sm btn-default\"><i class=\"la la-eye\"></i> </a>\n                    <a href=\"/administrator/wiki/article/").concat(row.id, "/edit\" class=\"btn btn-icon btn-sm btn-info\"><i class=\"la la-edit\"></i> </a>\n                    <a href=\"/administrator/wiki/article/").concat(row.id, "/delete\" class=\"btn btn-icon btn-sm btn-danger\"><i class=\"la la-trash-o\"></i> </a>\n                    ");
                    }
                }],
                translate: {
                    records: {
                        processing: 'Chargement des articles...',
                        noRecords: 'Aucun Article'
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

        function formAddArticle() {
            var form = $("#formAddArticle");
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
                            toastr.success("L'article à été ajoutée avec succès", "Succès");
                            $(".modal").modal('hide');
                            article.reload();
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

        function appearSubcategory() {
            var category = document.querySelector('#category_id');
            category.addEventListener('change', function (e) {
                var field = $("#field_subcategory_id");
                KTApp.block($(".modal"));
                $.post('/api/admin/wiki/subcategory/list', {
                    category_id: category.value
                }).done(function (data) {
                    KTApp.unblock($(".modal"));
                    field.html(data.data);
                });
            });
        }

        appearSubcategory();
        formAddArticle();
        listeArticle();

        /***/
    }),

    /***/ 45:
    /*!********************************************************!*\
      !*** multi ./resources/js/admin/wiki/article/index.js ***!
      \********************************************************/
    /*! no static exports found */
    /***/ (function (module, exports, __webpack_require__) {

        module.exports = __webpack_require__(/*! E:\LOGICIEL\laragon\www\v3.trainznation\resources\js\admin\wiki\article\index.js */"./resources/js/admin/wiki/article/index.js");


        /***/
    })

    /******/
});
