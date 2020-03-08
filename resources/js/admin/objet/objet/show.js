import KTDatatable from '../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
import {formatDate} from '../../../core'
import Tagify from '@yaireo/tagify'

const swal = require('sweetalert2');

let asset = $("#asset");
let asset_id = asset.attr('data-id');
let assetBase;

async function showInfo() {
    let asset_title = document.querySelector('#asset_title');
    let asset_block = document.querySelector('#asset_block');
    let asset_category = document.querySelector('#asset_category');
    let asset_publish = document.querySelector('#asset_publish');
    let asset_kuid = document.querySelector('#asset_kuid');
    let asset_price = document.querySelector('#asset_price');
    let asset_social = document.querySelector('#asset_social');
    let asset_downloaded = document.querySelector('#asset_downloaded');
    let asset_mesh = document.querySelector('#asset_mesh');
    let asset_config = document.querySelector('#asset_config');
    KTApp.block(asset_block);

    await getAsset()
        .then((response) => {
            KTApp.unblock(asset_block);
            asset_title.innerHTML = response.designation;
            asset_category.innerHTML = response.category.name + ' - ' + response.subcategory.name;
            asset_kuid.innerHTML = response.kuid;
            asset_downloaded.innerHTML = response.countDownload;
            if (response.published === 0) {
                asset_publish.innerHTML = `<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill"><i class="la la-times"></i> Non Publier</span>`
            } else {
                if (response.published_at !== null) {
                    asset_publish.innerHTML = `<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill"><i class="la la-check"></i> Publier</span><br>Publié le ${formatDate(response.published_at, 'LLLL')}`
                }
            }
            if (response.pricing === 0) {
                asset_price.innerHTML = `<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Gratuit</span>`
            } else {
                asset_social.setAttribute('data-toggle', 'kt-tooltip');
                asset_social.setAttribute('title', 'Désactivé');
                asset_price.innerHTML = `<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">${response.price}</span>`
            }
            if (response.social === 0) {
                asset_social.style.color = '#6b6b6b';
                asset_social.setAttribute('data-toggle', 'kt-tooltip');
                asset_social.setAttribute('title', 'Désactivé')
            } else {
                asset_social.setAttribute('data-toggle', 'kt-tooltip');
                asset_social.setAttribute('title', 'Activé');
                asset_social.style.color = '#235ebf'
            }
            if (response.mesh === 0) {
                asset_social.style.color = '#6b6b6b';
                asset_mesh.setAttribute('data-toggle', 'kt-tooltip');
                asset_mesh.setAttribute('title', 'Désactivé')
            } else {
                asset_social.style.color = '#235ebf';
                asset_mesh.setAttribute('data-toggle', 'kt-tooltip');
                asset_mesh.setAttribute('title', 'Activé')
            }
            if (response.config === 0) {
                asset_social.style.color = '#6b6b6b';
                asset_config.setAttribute('data-toggle', 'kt-tooltip');
                asset_config.setAttribute('title', 'Désactivé')
            } else {
                asset_social.style.color = '#235ebf';
                asset_config.setAttribute('data-toggle', 'kt-tooltip');
                asset_config.setAttribute('title', 'Activé')
            }
        })
}

function publishAsset() {
    let btn = $("#btnPublishAsset");

    btn.on('click', function (e) {
        e.preventDefault();
        KTApp.progress(btn);

        $.get('/api/admin/objet/objet/' + asset_id + '/verifPublish')
            .done((data) => {
                if (data.data.result === 'false') {
                    KTApp.unprogress(btn);
                    swal.fire({
                        title: "Impossible de publier l'objet",
                        type: 'error',
                        html: `<div class="text-left"><ul>${data.data.content}</ul></div>`
                    })
                } else {
                    $.get('/api/admin/objet/objet/' + asset_id + '/publish')
                        .done((data) => {
                            KTApp.unprogress(btn);
                            toastr.success("L'objet à été publier", "Succès");
                            showInfo();
                            btn.removeClass('btn-outline-success')
                                .addClass('btn-outline-danger')
                                .attr('id', 'btnUnpublishAsset')
                                .attr('title', "Dépublier l'objet")
                                .html('<i class="la la-times"></i>')
                        })
                        .fail((err) => {
                            KTApp.unprogress(btn);
                            toastr.error("Erreur lors de la publication de l'objet", "Erreur Système 500");
                            console.error(err)
                        })
                }
            })
            .fail((err) => {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de la vérification de la publication de l'objet", "Erreur Système 500");
                console.error(err)
            })
    })
}

function unpublishAsset() {
    let btn = $("#btnUnpublishAsset");

    btn.on('click', function (e) {
        e.preventDefault();
        KTApp.progress(btn);

        $.get('/api/admin/objet/objet/' + asset_id + '/unpublish')
            .done((data) => {
                KTApp.unprogress(btn);
                toastr.success("L'objet à été dépublier", "Succès");
                showInfo();
                btn.removeClass('btn-outline-danger')
                    .addClass('btn-outline-success')
                    .attr('id', 'btnPublishAsset')
                    .attr('title', "Publier l'objet")
                    .html('<i class="la la-check"></i>')
            })
            .fail((err) => {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de la dépublication de l'objet", "Erreur Système 500");
                console.error(err)
            })
    })
}

function formAddCompatibility() {
    let form = $("#formAddCompatibility");

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
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("La compatibilité à été ajouté", "Succès");
                    $('.modal').modal('hide')
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((err) => {
                        toastr.warning(err, "Validation")
                    })
                },
                500: function (data) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de l'execution du script", "Erreur Système 500")
                }
            }
        })
    })
}

formAddCompatibility();

function formAddTag() {
    let form = $("#formAddTag");

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
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("Le ou les tags ont été ajoutés avec succès", "Succès");
                    $(".modal").modal('hide')
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((err) => {
                        toastr.warning(err, "Validation")
                    })
                },
                500: function (data) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de l'execution du script", "Erreur Système 500")
                }
            }
        })
    })
}

formAddTag();

function listeCompatibilities() {
    let table = $("#listeCompatibilities").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/objet/objet/${asset_id}/compatibility/list`,
                    // sample custom headers
                    // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                    map: function (raw) {
                        // sample data mapping
                        var dataSet = raw;
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
            input: $('#compatibilitySearch'),
        },
        columns: [
            {
                field: 'id',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                textAlign: 'center'
            },
            {
                field: 'version',
                title: "Version",
                sortable: 'asc',

            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                autoHide: false,
                textAlign: 'right',
                template: function (row) {
                    return `
                    <a href="/administrator/objet/objet/${asset_id}/compatibility/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des compatibilités...',
                noRecords: 'Aucun enregistrement',
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
}

listeCompatibilities();

function listeTag() {
    let table = $("#listeTag").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/objet/objet/${asset_id}/tag/list`,
                    // sample custom headers
                    // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                    map: function (raw) {
                        // sample data mapping
                        var dataSet = raw;
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
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                textAlign: 'center'
            },
            {
                field: 'name',
                title: 'Tag',
                sortable: 'asc',
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                autoHide: false,
                textAlign: 'right',
                template: function (row) {
                    return `
                    <a href="/administrator/objet/objet/${asset_id}/tag/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des tags...',
                noRecords: 'Aucun tag',
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
}

listeTag();

function getAsset() {
    return new Promise((resolve, reject) => {
        $.get('/api/admin/objet/objet/' + asset_id)
            .done((data) => {
                resolve(data.data)
            })
            .fail((err) => {
                reject(err)
            })
    })
}

$("#formDownloadFile").dropzone({
    url: '/api/admin/objet/objet/' + asset_id + '/uploadDownloadFile',
    paramName: 'file',
    addRemoveLinks: true,
    acceptedFiles: ".cdp",
    success: function (data) {
        toastr.success("Le fichier <strong>" + data.name + "</strong> à été uploader")
    },
    error: function (data) {
        toastr.error("Erreur: " + data.data.error, "Erreur")
    }
});
$("#formUploadFbx").dropzone({
    url: '/api/admin/objet/objet/' + asset_id + '/uploadFbx',
    paramName: 'file',
    addRemoveLinks: true,
    acceptedFiles: ".zip",
    success: function (data) {
        toastr.success("Le fichier <strong>" + data.name + "</strong> à été uploader")
    },
    error: function (data) {
        toastr.error("Erreur: " + data.data.error, "Erreur")
    }
});

$("#formUploadConfig").dropzone({
    url: '/api/admin/objet/objet/' + asset_id + '/uploadConfigFile',
    paramName: 'file',
    addRemoveLinks: true,
    acceptedFiles: ".txt",
    success: function (data) {
        toastr.success("Le fichier <strong>" + data.name + "</strong> à été uploader")
    },
    error: function (data) {
        toastr.error("Erreur: " + data.data.error, "Erreur")
    }
});

$("#downloadFile").on('hide.bs.modal', function () {
    window.location.reload()
});

$("#uploadFbx").on('hide.bs.modal', function () {
    window.location.reload()
});

$("#uploadConfigFile").on('hide.bs.modal', function () {
    window.location.reload()
});

showInfo();
publishAsset();
unpublishAsset();

let input = document.querySelector('#tag');
new Tagify(input);
$(".selectpicker").selectpicker();

