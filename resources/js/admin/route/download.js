import KTDatatable from '../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
import summernote from 'summernote'

let route = $("#route")
let route_id = route.attr('data-id')
let tableauDownload = '';
let tableauUpdater = '';

function loadTableDownload() {
    let tableDownload = $("#listeDownload").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/route/' + route_id + '/download/loadDownload',
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

        search: {
            input: $('#downloadSearch'),
        },

        columns: [
            {
                field: 'id',
                title: "#",
                sortable: true,
                width: 30,
                type: 'number',
            },
            {
                field: 'version',
                title: "Versioning",
                sortable: true,
                width: 90,
                autoHide: false,
                template: function (row) {
                    return 'Version '+row.version+':'+row.build
                }
            },
            {
                field: 'typedownload',
                title: "Type de Téléchargement",
                sortable: true,
                autoHide: false,
                template: function (row) {
                    return `<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">${row.typedownload}</span>`
                }
            },
            {
                field: 'typerelease',
                title: 'Type de Release',
                sortable: true,
                autoHide: false,
                template: function (row) {
                    return `<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">${row.typerelease}</span>`
                }
            },
            {
                field: 'published',
                title: "Publier",
                sortable: true,
                autoHide: false,
                template: function (row) {
                    let published = {
                        0:{'title': 'Non Publier', 'class': 'kt-badge--danger'},
                        1:{'title': 'Publier', 'class': 'kt-badge--success'},
                    };
                    return '<span class="kt-badge ' + published[row.published].class + ' kt-badge--inline kt-badge--pill">' + published[row.published].title + '</span>';
                }
            },
            {
                field: 'linkDownload',
                title: 'Lien de Téléchargement',
                sortable: false,
                autoHide: true,
            },
            {
                field: 'actions',
                title: 'Actions',
                sortable: false,
                autoHide: false,
                width: 60,
                template: function (row) {
                    return `
                    <a href="/administrator/route/${route_id}/download/${row.id}/edit" class="btn btn-sm btn-outline-info btn-icon" data-toggle="kt-tooltip" title="Editer le téléchargement"><i class="la la-edit"></i> </a>
                    <a href="/api/admin/route/${route_id}/download/${row.id}/delete" class="btn btn-sm btn-outline-danger btn-icon" data-toggle="kt-tooltip" title="Supprimer le téléchargement"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des Téléchargements...',
                noRecords: 'Aucune Téléchargements',
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
    })

    tableauDownload = tableDownload


    $('#kt_form_type').on('change', function () {
        tableDownload.search($(this).val().toLowerCase(), 'typedownload');
    });

    $('#kt_form_release').on('change', function () {
        tableDownload.search($(this).val().toLowerCase(), 'typerelease');
    });

    $('#kt_form_type, #kt_form_release').selectpicker();
}
function loadTableUpdater() {
    let tableUpdater = $("#listeUpdater").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/route/' + route_id + '/download/loadUpdater',
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

        search: {
            input: $('#updaterSearch'),
        },

        columns: [
            {
                field: 'id',
                title: "#",
                sortable: true,
                width: 30,
                type: 'number',
            },
            {
                field: 'version',
                title: "Versioning",
                sortable: true,
                width: 90,
                autoHide: false,
                template: function (row) {
                    return 'Version '+row.version+':'+row.build
                }
            },
            {
                field: 'latest',
                title: "Dernière MAJ",
                sortable: true,
                width: 60,
                autoHide: false,
                template: function (row) {
                    let latestes = {
                        0: {'title': 'Non', 'icon': 'la la-times-circle', 'class': 'kt-font-danger'},
                        1: {'title': 'Oui', 'icon': 'la la-check-circle', 'class': 'kt-font-success'},
                    };
                    return `<i class="${latestes[row.latest]} ${latestes[row.class]}" data-toggle="kt-tooltip" title="" data-original-title="${latestes[row.title]}"></i>`
                }
            },
            {
                field: 'actions',
                title: 'Actions',
                sortable: false,
                autoHide: false,
                width: 60,
                template: function (row) {
                    return `
                    <a href="" class="btn btn-sm btn-outline-info btn-icon" data-toggle="kt-tooltip" title="Editer la MAJ"><i class="la la-edit"></i> </a>
                    <a href="" class="btn btn-sm btn-outline-danger btn-icon" data-toggle="kt-tooltip" title="Supprimer la MAJ"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des Mises à jours...',
                noRecords: 'Aucune mises à jours',
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
    })

    tableauUpdater = tableUpdater
}

$('.summernote').summernote({
    height: '350px'
})

loadTableDownload()
loadTableUpdater()

