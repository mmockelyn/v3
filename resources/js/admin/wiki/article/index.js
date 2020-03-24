let article;

function listeArticle() {
    article = $("#listeArticle").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/wiki/article/list`,
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
            input: $('#articleSearch'),
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
                width: 120,
                template: function (row) {
                    return `<img src='${row.img}' alt='${row.title}' class="img-fluid" width="100" />`
                }
            },
            {
                field: 'category',
                title: 'Catégorie',
                sortable: 'asc',
            },
            {
                field: 'title',
                title: 'Titre',
                sortable: 'asc',
            },
            {
                field: 'published',
                title: 'Etat',
                sortable: 'asc',
                template: row => {
                    if (row.published === 0) {
                        return `<span class="kt-badge kt-badge--pill kt-badge--inline kt-badge--danger"><i class="la la-times-circle"></i> Non Publier</span>`
                    } else {
                        return `<span class="kt-badge kt-badge--pill kt-badge--inline kt-badge--success"><i class="la la-check-circle"></i> Publier</span>`
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
                    return `
                    <a href="/administrator/wiki/article/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                    <a href="/administrator/wiki/article/${row.id}/edit" class="btn btn-icon btn-sm btn-info"><i class="la la-edit"></i> </a>
                    <a href="/administrator/wiki/article/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des articles...',
                noRecords: 'Aucun Article',
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

function formAddArticle() {
    let form = $("#formAddArticle");

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
                    toastr.success("L'article à été ajoutée avec succès", "Succès");
                    article.reload()
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

function appearSubcategory() {

    let category = document.querySelector('#category_id');

    category.addEventListener('change', (e) => {
        let field = $("#field_subcategory_id");

        KTApp.block($(".modal"));

        $.post('/api/admin/wiki/subcategory/list', {category_id: category.value})
            .done(function (data) {
                KTApp.unblock($(".modal"));
                field.html(data.data)
            })
    })
}

appearSubcategory();
formAddArticle();
listeArticle();
