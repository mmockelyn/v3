import KTDatatable from '../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
require('../config');

let route = $("#route");
let route_id = route.attr('data-id');
let tableauTypeDownload = '';
let tableauTypeRelease = '';

function loadTableTypeDownload() {
    let tableTypeDownload = $("#listeTypeDownload").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/route/config/loadTypeDownload',
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
                    <a href="/api/admin/route/config/type/${row.id}" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Supprimer le type"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des type de téléchargement...',
                noRecords: 'Aucune type de téléchargement',
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

    tableauTypeDownload = tableTypeDownload
}
function loadTableTypeRelease() {
    let tableTypeRelease = $("#listeTypeRelease").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/route/config/loadTypeRelease',
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
                    <a href="/api/admin/route/config/release/${row.id}" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Supprimer le type"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des type de release..',
                noRecords: 'Aucune type de release',
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

    tableauTypeRelease = tableTypeRelease
}
function formAddTypeDownload() {
    let form = $("#formAddTypeDownload");

    form.on('submit', function (e) {
        e.preventDefault();
        let btn = form.find('button');
        let url = form.attr('action');
        let data = form.serializeArray();

        KTApp.progress(btn);

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            success: function (data) {
                KTApp.unprogress(btn);
                toastr.success("Le type de téléchargement à été ajouté avec succès", "Succès");
                $(".modal").modal('hide');
                tableauTypeDownload.reload()
            },
            error: function (err) {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de l'ajout du type de téléchargement", "Erreur système 500");
                console.error(err)
            }
        })
    })
}
function formAddTypeRelease() {
    let form = $("#formAddTypeRelease");

    form.on('submit', function (e) {
        e.preventDefault();
        let btn = form.find('button');
        let url = form.attr('action');
        let data = form.serializeArray();

        KTApp.progress(btn);

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            success: function (data) {
                KTApp.unprogress(btn);
                toastr.success("Le type de release à été ajouté avec succès", "Succès");
                $(".modal").modal('hide');
                tableauTypeRelease.reload()
            },
            error: function (err) {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de l'ajout du type de release", "Erreur système 500");
                console.error(err)
            }
        })
    })
}

loadTableTypeDownload();
loadTableTypeRelease();
formAddTypeDownload();
formAddTypeRelease();
