//import * as $ from "jquery";
import KTDatatable from '../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
require('../../config');

function loadTable() {
    let table = $("#listeCategories").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/blog/category/liste',
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
            input: $('#generalSearch'),
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
                field: 'name',
                title: 'Designation',
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
                    <a href="/administrator/blog/category/${row.id}/edit" class="btn btn-icon btn-sm btn-info"><i class="la la-edit"></i> </a>
                    <a href="/administrator/blog/category/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
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
}

function submitForm() {
    let form = $('#formAddCategory');
    let modal = $('#addCategory');

    form.on('submit', function (e) {
        e.preventDefault();
        let btn = form.find('button');
        let data = form.serializeArray();

        KTApp.progress(btn);

        $.ajax({
            url: form.attr('action'),
            method: 'post',
            data: data,
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn);
                    console.log(data);
                    toastr.success(data.message, "Succès");
                    setTimeout(function () {
                        window.location.reload()
                    }, 1000)
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    console.log(data);
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de Validation");
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn);
                    console.error(jqxhr)
                }
            }
        })
    })

}


loadTable();
submitForm();

