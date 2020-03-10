//import * as $ from "jquery";
import KTDatatable from '../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'

const slugify = require('slugify');

function loadTable() {
    let table = $("#listeArticle").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/blog/article/liste',
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
                field: 'img',
                title: 'Thumbnail',
                sortable: false,
                template: function (row) {
                    return `<img src="${row.img}" width="80" class="img-fluid" />`
                }
            },
            {
                field: 'title',
                title: 'Title',
                sortable: 'asc',
                template: function (row) {
                    return `${row.title}<br><strong>Catégorie:</strong> ${row.category}`
                }
            },
            {
                field: 'published',
                title: 'Publication',
                sortable: 'asc',
                template: function (row) {
                    let published = {
                        0: {'title': 'Non Publier', 'class': 'kt-badge--danger'},
                        1: {'title': 'Publier', 'class': 'kt-badge--success'},
                    };
                    if (row.published === 0) {
                        return `<span class="kt-badge ${published[row.published].class} kt-badge--inline kt-badge--pill">${published[row.published].title}</span>`
                    } else {
                        return `<span class="kt-badge ${published[row.published].class} kt-badge--inline kt-badge--pill">${published[row.published].title}</span><br><strong>Date de Publication</strong>: ${row.published_at}`
                    }
                }
            },
            {
                field: 'twitter',
                title: "Twitter",
                sortable: false,
                textAlign: 'center',
                template: function (row) {
                    if (row.twitter === 0) {
                        return `<i class="la la-twitter-square" data-toggle="kt-tooltip" title="Non Publier sur twitter"></i>`
                    } else {
                        return `<i class="la la-twitter-square kt-font-twitter" data-toggle="kt-tooltip" title="Publier sur twitter"></i>`
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
                            <a href="/administrator/blog/article/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                            <a href="/administrator/blog/article/${row.id}/edit" class="btn btn-icon btn-sm btn-info"><i class="la la-edit"></i> </a>
                            <a href="/administrator/blog/article/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                        `;
                    } else {
                        return `
                            <a href="/administrator/blog/article/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                        `;
                    }
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des articles...',
                noRecords: 'Aucun article',
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
    let form = $('#formAddArticle');

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

function slugInput() {
    let input_title = document.querySelector('#title');
    let input_slug = document.querySelector('#slug');

    input_title.addEventListener('keyup', function (e) {
        e.preventDefault();
        input_slug.value = slugify(input_title.value, '-')
    })
}


loadTable();
submitForm();
slugInput();

$(".selectpicker").selectpicker();
$(".summernote").summernote({
    height: 300
});

