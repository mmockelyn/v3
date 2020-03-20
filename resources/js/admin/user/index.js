function latestSubscribe() {
    let table = $("#latestSubscribe").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/user/latestSubscribe`,
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
                field: 'name',
                title: 'Identité',
                sortable: 'desc',
            },
            {
                field: 'email',
                title: 'Adresse Mail',
                sortable: 'desc',
            },
            {
                field: 'created_at',
                title: 'Date de création',
                sortable: 'desc',
            },
        ],
        translate: {
            records: {
                processing: 'Chargement des utilisateurs...',
                noRecords: 'Aucun Utilisateur',
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

function latestLogin() {
    let table = $("#latestLogin").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/user/latestLogin`,
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
                sortable: 'desc',
                width: 30,
                type: 'number',
                textAlign: 'center'
            },
            {
                field: 'name',
                title: 'Identité',
                sortable: 'desc',
            },
            {
                field: 'ip',
                title: 'Dernière IP connue',
                sortable: 'desc',
            },
            {
                field: 'last_login',
                title: 'Dernière connexion',
                sortable: 'desc',
            },
        ],
        translate: {
            records: {
                processing: 'Chargement du relever de connexion...',
                noRecords: 'Aucune connexion récente',
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

latestLogin();
latestSubscribe();
