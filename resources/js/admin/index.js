//import * as $ from "jquery";
import KTDatatable from '../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
import {blockElement, unblockElement} from '../core'

function loadSignalement() {
    let table = $("#signalement").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/loadSignalement',
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
                field: 'state',
                sortable: 'asc',
                width: 30,
                textAlign: 'center',
                template: function (row) {
                    let status = {
                        'info':{'title': 'Information', 'icon': 'flaticon-information', 'class': 'kt-font-info'},
                        'warning':{'title': 'Attention', 'icon': 'flaticon2-warning', 'class': 'kt-font-warning'},
                        'danger':{'title': 'Erreur', 'icon': 'flaticon2-cross', 'class': 'kt-font-danger'},
                    };
                    $('[data-toggle="kt-tooltip"]').tooltip()
                    return `<i class="${status[row.state].icon} ${status[row.state].class}" style="font-size: 25px;" data-toggle="kt-tooltip" title="${status[row.state].title}"></i>`
                }
            },
            {
                field: 'sector',
                title: 'Secteur',
                sortable: true,
            },
            {
                field: 'titre',
                title: "Titre",
                sortable: false,
            },
            {
                field: 'message',
                title: "Message",
                sortable: false,
                autoHide: false
            },
            {
                field: 'action',
                title: "Actions",
                sortable: false,
                autoHide: false,
                textAlign: 'center',
                template: function (row) {
                    if(row.action.btn === 'view'){return `<a href="" class="btn btn-icon btn-sm btn-primary" data-toggle="kt-tooltip" title="Voir"><i class="la la-eye"></i> </a>`}
                    if(row.action.btn === 'publish'){return `<a href="" class="btn btn-icon btn-sm btn-success" data-toggle="kt-tooltip" title="Publier"><i class="la la-check"></i> </a>`}
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des Signalements...',
                noRecords: 'Aucun signalement',
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

    $('#kt_form_state').on('change', function () {
        table.search($(this).val().toLowerCase(), 'fd');
    });

    $("#kt_form_state").selectpicker()

}

function loadLatestArticle() {
    let el = document.querySelector('#loadLatestBlog')

    blockElement(el, "Chargement des derniers articles...")

    $.get('/api/admin/blog/latest')
        .done((data) => {
            unblockElement(el)
            el.innerHTML = data.data
        })
}

function loadLatestTutoriel() {
    let el = document.querySelector('#loadLatestTutoriel')

    blockElement(el, "Chargement des derniers tutoriels...")

    $.get('/api/admin/tutoriel/latest')
        .done((data) => {
            unblockElement(el)
            el.innerHTML = data.data
        })
}

loadSignalement()
loadLatestArticle()
loadLatestTutoriel()
