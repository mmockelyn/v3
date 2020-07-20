import KTDatatable from '../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
require('../config');

let tableauSlide;

function loadSlideshow() {
    let tableSlide = $("#loadSlideTable").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/slideshow/list',
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

        search: {
            input: $('#generalSearch'),
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
                field: 'linkImages',
                title: "Images",
                width: 250,
                sortable: false,
                autoHide: false,
                template: function (row) {
                    return `<img src="/storage/slideshow/${row.id}.png" width="300" class="img-fluid" />`
                }
            },
            {
                field: 'actions',
                title: "Action",
                sortable: false,
                autoHide: false,
                width: 100,
                template: function (row) {
                    return `
                    <a href="/administrator/slideshow/${row.id}/delete" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Supprimer le slide"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des slides...',
                noRecords: 'Aucun slide',
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

    tableauSlide = tableSlide;
}
function formSubmitSlide() {

}

loadSlideshow()
