import KTDatatable from '../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
import mediumZoom from 'medium-zoom'
require('../../config');

let table;

function loadTable() {
    table = $("#listeObjet").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/objet/objet/list',
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
            input: $('#objetSearch'),
        },
        columns: [
            {
                field: 'id',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                textAlign: 'center',
                autoHide: false,
            },
            {
                field: 'img',
                title: 'Images',
                sortable: false,
                textAlign: 'center',
                autoHide: false
            },
            {
                field: 'designation',
                title: 'Designation',
                width: 300,
                sortable: false,
                autoHide: false
            },
            {
                field: 'short_description',
                title: 'Description',
                sortable: false,
                autoHide: true,
                width: '100%'
            },
            {
                field: 'published',
                title: 'Publier',
                sortable: 'asc',
                autoHide: false,
                template: function (row) {
                    let published = {
                        0: {'title': 'Non Publier', 'class': 'kt-badge--danger'},
                        1: {'title': 'Publier', 'class': 'kt-badge--success'},
                    };
                    return `<span class="kt-badge ${published[row.published].class} kt-badge--inline kt-badge--pill">${published[row.published].title}</span>`
                }
            },
            {
                field: 'price',
                title: "Prix",
                sortable: 'asc',
                autoHide: true,
                width: '100%',
                template: function (row) {
                    if (row.pricing === 0) {
                        return `<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Gratuit</span>`
                    } else {
                        return `<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">${row.price}</span>`
                    }
                }
            },
            {
                field: 'social',
                title: 'Social',
                sortable: 'asc',
                autoHide: true,
                width: '100%',
                template: function (row) {
                    let social = {
                        0: {'title': 'Non Publier', 'class': 'kt-badge--danger'},
                        1: {'title': 'Publier', 'class': 'kt-badge--success'},
                    };
                    return `<span class="kt-badge ${social[row.published].class} kt-badge--inline kt-badge--pill">${social[row.published].title}</span>`
                }
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                autoHide: false,
                textAlign: 'right',
                template: function (row) {
                    if (row.published === 0) {
                        return `
                        <a href="/administrator/objet/objet/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                        <a href="/administrator/objet/objet/${row.id}/edit" class="btn btn-icon btn-sm btn-info"><i class="la la-edit"></i> </a>
                        <a href="/administrator/objet/objet/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                    } else {
                        return `
                        <a href="/administrator/objet/objet/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                    `;
                    }
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des objets...',
                noRecords: 'Aucun objet',
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
    table.on('kt-datatable--on-layout-updated', function (e) {
        let imgs = document.querySelectorAll('img');
        Array.from(imgs).forEach((img) => {
            img.addEventListener('click', function (e) {
                mediumZoom(img)
            })
        })
    })
}

function loadFormSubcategoryField() {
    let category_field = document.querySelector('#category_id');
    let subfield = document.querySelector('#subcategory');

    category_field.addEventListener('change', function () {
        KTApp.block($(".modal"));

        $.get('/api/admin/objet/subcategory/' + category_field.value + '/list')
            .done((data) => {
                KTApp.unblock($(".modal"));
                subfield.innerHTML = data.data;
                $(".selectpicker").selectpicker();
            })
    })
}

function formAddObjet() {
    let form = $("#formAddObjet");

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
                    toastr.success("L'objet <strong>" + data.data.designation + "</strong> à été ajouter avec succès", "Succès");
                    $(".modal").modal('hide');
                    table.reload()
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((err) => {
                        toastr.warning(err, "Validation")
                    })
                },
                404: function (err) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de l'execution du script", "Erreur Système 500");
                    console.error(err)
                },
                500: function (err) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de l'execution du script", "Erreur Système 500");
                    console.log(err)
                }
            }
        })
    })
}

formAddObjet();

loadTable();
loadFormSubcategoryField();

$(".selectpicker").selectpicker();
$("#short_description").summernote({
    height: 200
});
