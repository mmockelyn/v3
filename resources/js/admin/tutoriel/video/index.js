import KTDatatable from '../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
require('../../config');

let table;

function listeTutoriel() {
    table = $("#listeTutoriel").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/tutoriel/video/list`,
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
            input: $('#tutorielSearch'),
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
                field: 'img',
                title: "Images",
                sortable: 'asc',
                template: function (row) {
                    return `<img src=${row.img} width="120" class="img-fluid"/>`
                }
            },
            {
                field: 'category',
                title: "Catégorie",
                sortable: 'asc'
            },
            {
                field: 'title',
                title: "Titre",
                sortable: 'asc'
            },
            {
                field: 'count',
                title: "Nb de commentaire",
                sortable: 'asc'
            },
            {
                field: 'published',
                title: "Publier",
                sortable: 'asc',
                template: function (row) {
                    if (row.published === 0) {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--danger"><i class="la la-times-circle"></i> Non Publier</span>`
                    }
                    if (row.published === 1) {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--success"><i class="la la-check-circle"></i> Publier</span><br>Publier ${row.published_at}`
                    }
                    if (row.published === 2) {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--warning"><i class="la la-clock-o"></i> En attente</span><br>Publier ${row.published_at}`
                    }
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
                    <a href="/administrator/tutoriel/video/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                    <a href="/administrator/tutoriel/video/${row.id}/edit" class="btn btn-icon btn-sm btn-info"><i class="la la-edit"></i> </a>
                    <a href="/administrator/tutoriel/video/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                    } else {
                        return `
                    <a href="/administrator/tutoriel/video/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                    `;
                    }
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des tutoriels...',
                noRecords: 'Aucun tutoriel',
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

    $('#kt_form_publish').on('change', function () {
        table.search($(this).val().toLowerCase(), 'Publish');
    });
}

function loadSubcategory() {
    let category_field = $("#category_id");
    let subfield = $("#subcategory_field");

    category_field.on('change', function (e) {
        e.preventDefault();
        KTApp.block($(".modal"));

        $.get('/api/admin/tutoriel/subcategory/' + category_field.val() + '/list')
            .done((data) => {
                KTApp.unblock($(".modal"));
                subfield.html(data.data);
                $(".selectpicker").selectpicker()
            })
    })
}

function formAddTutoriel() {
    let form = $("#formAddTutoriel");

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
                    toastr.success(`Le tutoriel ${data.data.title} à été ajouter avec succès`, "Succès");
                    $(".modal").modal('hide');
                    table.reload()
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


$("#addTutoriel").on('shown.bs.modal', function () {
    let category_field = $("#category_id");
    let subfield = $("#subcategory_field");

    $.get('/api/admin/tutoriel/subcategory/' + category_field.val() + '/list')
        .done((data) => {
            KTApp.unblock($(".modal"));
            subfield.html(data.data);
            $(".selectpicker").selectpicker()
        })
});

$(".selectpicker").selectpicker();
$(".summernote").summernote();
listeTutoriel();
loadSubcategory();
formAddTutoriel();
