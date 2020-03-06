let table;
let sub;

function loadListeCategories() {
    table = $("#listeObjectCategories").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/objet/category/list',
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
                type: 'number',
                autoHide: false,
                selector: false
            },
            {
                field: 'name',
                title: 'designation',
                sortable: true,
                autoHide: false,
            },
            {
                field: 'actions',
                title: "Action",
                sortable: false,
                autoHide: false,
                template: function (row) {
                    return `
                    <a href="/administrator/objet/category/${row.id}/delete" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Supprimer l'objet"><i class="la la-trash"></i> </a>
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
    })
}
function formAddCategory() {
    let form = $("#formAddCategory")

    form.on('submit', function (e) {
        e.preventDefault()
        let btn = form.find('button')
        let url = form.attr('action')
        let data = form.serializeArray()

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            success: function (data) {
                KTApp.unprogress(btn)
                toastr.success("La catégorie à été ajouté avec succès", "Succès");
                $(".modal").modal('hide')
                table.reload()
            },
            error: function (err) {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors de l'ajout de la catégorie", "Erreur Système 500")
                console.error(err)
            }
        })
    })
}
function loadListeSubCategories() {
    sub = $("#listeObjectSubCategories").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/objet/subcategory/list',
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
                type: 'number',
                autoHide: false,
                selector: false
            },
            {
                field: 'category',
                title: 'Catégorie',
                sortable: true,
                autoHide: false,
            },
            {
                field: 'name',
                title: 'designation',
                sortable: true,
                autoHide: false,
            },
            {
                field: 'actions',
                title: "Action",
                sortable: false,
                autoHide: false,
                template: function (row) {
                    return `
                    <a href="/administrator/objet/subcategory/${row.id}/delete" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Supprimer l'objet"><i class="la la-trash"></i> </a>
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
    })
}
function formAddSubCategory() {
    let form = $("#formAddSubCategory")

    form.on('submit', function (e) {
        e.preventDefault()
        let btn = form.find('button')
        let url = form.attr('action')
        let data = form.serializeArray()

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            success: function (data) {
                KTApp.unprogress(btn)
                toastr.success("La sous catégorie à été ajouté avec succès", "Succès");
                $(".modal").modal('hide')
                sub.reload()
            },
            error: function (err) {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors de l'ajout de la sous catégorie", "Erreur Système 500")
                console.error(err)
            }
        })
    })
}

loadListeCategories()
formAddCategory()
loadListeSubCategories()
formAddSubCategory()
