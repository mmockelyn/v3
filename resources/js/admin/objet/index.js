import KTDatatable from '../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'

let tableauLatestCategories;
let tableauLatestObjets;

function loadLatestCategories() {
    let tableLatestCategories = $("#loadLatestCategories").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/objet/loadLatestCategories',
                    // sample custom headers
                    // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                    map: function (raw) {
                        // sample data mapping
                        let dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },
        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        columns: [
            {
                field: 'id',
                title: "#",
                sortable: true,
                width: 30,
                type: 'number',
            },
            {
                field: 'name',
                title: "Type",
                width: 250,
                sortable: false,
                autoHide: false
            },
            {
                field: 'actions',
                title: "Action",
                sortable: false,
                autoHide: false,
                width: 100,
                template: function (row) {
                    return `
                    <a href="/administrator/objet/category/${row.id}/delete" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Supprimer la catégorie"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des catégories...',
                noRecords: 'Aucune catégorie',
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'Premier',
                            prev: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier',
                            more: 'Plus',
                            input: 'Numéro de page',
                            select: 'Sélectionnez la taille de la page',
                        },
                        info: "Affichage de l'élément {{start}} à {{end}} sur {{total}} éléments",
                        infoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément"
                    },
                },
            },
        },
    });

    tableauLatestCategories = tableLatestCategories
}
function loadLatestObjets() {
    let tableLatestObjets = $("#loadLatestObjects").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/objet/loadLatestObjets',
                    // sample custom headers
                    // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                    map: function (raw) {
                        // sample data mapping
                        let dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },
        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        columns: [
            {
                field: 'id',
                title: "Identifiant",
                sortable: true,
                type: 'number',
                autoHide: true
            },
            {
                field: 'designation',
                title: "Designation",
                sortable: false,
                autoHide: false
            },
            {
                field: "category_id",
                title: "Catégorie",
                autoHide: true,
            },
            {
                field: 'published',
                title: "Publier",
                sortable: false,
                autoHide: true,
                template: function (row) {
                    let published = {
                        0:{'title': 'Non publier', 'icon': 'la la-times-circle la-3x', 'class': 'kt-font-danger'},
                        1:{'title': 'Publier', 'icon': 'la la-check-circle la-3x', 'class': 'kt-font-success'},
                    };
                    return `<i class="${published[row.published].icon} ${published[row.published].class}" data-toggle="kt-tooltip" title="${published[row.published].title}"></i>`
                }
            },
            {
                field: 'actions',
                title: "Action",
                sortable: false,
                autoHide: false,
                template: function (row) {
                    return `
                    <a href="/api/admin/objet/objet/${row.id}/delete" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Supprimer l'objet"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des Objets...',
                noRecords: 'Aucun objets',
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'Premier',
                            prev: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier',
                            more: 'Plus',
                            input: 'Numéro de page',
                            select: 'Sélectionnez la taille de la page',
                        },
                        info: "Affichage de l'élément {{start}} à {{end}} sur {{total}} éléments",
                        infoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément"
                    },
                },
            },
        },
    });

    tableauLatestObjets = tableLatestObjets
}

loadLatestCategories()
loadLatestObjets()
