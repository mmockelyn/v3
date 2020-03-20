function listeContribBlog() {
    let table = $("#listeContribBlog").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/blog/article/comment/load`,
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
                field: 'comment',
                title: 'Commentaire',
                sortable: 'asc',
                autoHide: true,
            },
            {
                field: 'state',
                title: 'Etat',
                sortable: 'asc',
                template: function (row) {
                    if (row.state === 0) {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--danger"><i class="la la-times-circle"></i> Non Publier</span>`
                    } else {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--success"><i class="la la-check-circle"></i> Publier</span>`
                    }
                }
            },
            {
                field: 'created_at',
                title: 'Date de Publication',
                sortable: 'asc',
                autoHide: false,
                width: 230
            },
        ],
        translate: {
            records: {
                processing: 'Chargement des contributions...',
                noRecords: 'Aucune Contribution',
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

function listeContribTutoriel() {
    let table = $("#listeContribTutoriel").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/tutoriel/comment/`,
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
                field: 'comment',
                title: 'Commentaire',
                sortable: 'asc',
                autoHide: true,
            },
            {
                field: 'state',
                title: 'Etat',
                sortable: 'asc',
                template: function (row) {
                    if (row.state === 0) {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--danger"><i class="la la-times-circle"></i> Non Publier</span>`
                    } else {
                        return `<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--success"><i class="la la-check-circle"></i> Publier</span>`
                    }
                }
            },
            {
                field: 'published_at',
                title: 'Date de Publication',
                sortable: 'asc',
                autoHide: false,
                width: 230
            },
        ],
        translate: {
            records: {
                processing: 'Chargement des contributions...',
                noRecords: 'Aucune Contribution',
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

listeContribTutoriel();

listeContribBlog();
