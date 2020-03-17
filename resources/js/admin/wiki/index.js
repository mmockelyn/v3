function latestWiki() {
    let table = $("#latestWiki").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/wiki/article/latest`,
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
                width: 40,
                type: 'number',
                textAlign: 'center'
            },
            {
                field: 'img',
                title: 'Thumbnail',
                sortable: 'asc',
                width: 110,
                template: function (row) {
                    return `<img src="${row.img}" alt="${row.title}" width="100" class="img-fluid"/>`
                }
            },
            {
                field: 'category',
                title: 'Catégorie',
                sortable: 'asc',
                width: 110,
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
                template: function (row) {
                    if (row.published === 0) {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--danger"><i class="fa fa-times"></i> Non Publier</span>`;
                    } else {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--success"><i class="fa fa-check"></i> Publier</span>`;
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
                processing: 'Chargement des derniers articles...',
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

latestWiki();
