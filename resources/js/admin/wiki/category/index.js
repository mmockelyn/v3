let category;
let sub;

function listeCategory() {
    category = $("#listeCategory").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/wiki/category/list`,
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
                width: 50,
                type: 'number',
                textAlign: 'center'
            },
            {
                field: 'name',
                title: 'Désignation',
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
                    <a href="/administrator/wiki/category/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des catégories...',
                noRecords: 'Aucune catégories',
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

function listeSubCategory() {
    sub = $("#listeSubCategory").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/wiki/subcategory/list`,
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
                width: 50,
                type: 'number',
                textAlign: 'center',
                autoHide: false
            },
            {
                field: 'category',
                title: 'Catégorie Parente',
                sortable: 'asc',
                autoHide: false,
                width: 300,
            },
            {
                field: 'name',
                title: 'Catégorie',
                sortable: 'asc',
                autoHide: false,
                width: 300,
            },
            {
                field: 'description',
                title: 'Description',
                sortable: 'asc',
                autoHide: true
            },
            {
                field: 'icon',
                title: 'Icone',
                sortable: 'asc',
                autoHide: true,
                template: function (row) {
                    return `<i class="${row.icon}"></i>`
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
                    <a href="/administrator/wiki/subcategory/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des sous catégories...',
                noRecords: 'Aucune sous catégorie',
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

function formAddCategory() {
    let form = $("#formAddCategory");

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
                    toastr.success("La catégorie à été ajouté", "Succès");
                    $(".modal").modal('hide');
                    category.reload()
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

function formAddSubCategory() {
    let form = $("#formAddSubCategory");

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
                    toastr.success("La sous catégorie à été ajouté", "Succès");
                    $(".modal").modal('hide');
                    sub.reload()
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

formAddSubCategory();
formAddCategory();

listeSubCategory();
listeCategory();

