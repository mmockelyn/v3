let users;

function listeUser() {
    users = $("#listeUser").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/user`,
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
            input: $('#userSearch'),
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
                title: 'Identité',
                sortable: 'asc',
            },
            {
                field: 'email',
                title: 'Adresse Mail',
                sortable: 'asc',
            },
            {
                field: 'group',
                title: 'Groupe',
                sortable: 'asc',
                autoHide: true,
                template: function (row) {
                    if (row.group === 0) {
                        return `<span class="kt-badge kt-badge--pill kt-badge--inline kt-badge--info">Utilisateur</span>`
                    } else {
                        return `<span class="kt-badge kt-badge--pill kt-badge--inline kt-badge--danger">Administrateur</span>`
                    }
                }
            },
            {
                field: 'created_at',
                title: 'Date de création',
                sortable: 'asc',
                autoHide: true,
            },
            {
                field: 'last_login',
                title: 'Dernière connexion',
                sortable: 'asc',
                autoHide: true,
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 160,
                autoHide: false,
                textAlign: 'right',
                template: function (row) {
                    if (row.state === 0) {
                        return `
                    <a href="/administrator/user/gestion/${row.id}/unban" class="btn btn-icon btn-sm btn-success" data-toggle="kt-tooltip" title="Débloqué"><i class="la la-unlock"></i> </a>
                    <a href="/administrator/user/gestion/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                    <a href="/administrator/user/gestion/${row.id}/edit" class="btn btn-icon btn-sm btn-info"><i class="la la-edit"></i> </a>
                    <a href="/administrator/user/gestion/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                    } else {
                        return `
                    <a href="/administrator/user/gestion/${row.id}/ban" class="btn btn-icon btn-sm btn-danger" data-toggle="kt-tooltip" title="Bloqué"><i class="la la-lock"></i> </a>
                    <a href="/administrator/user/gestion/${row.id}" class="btn btn-icon btn-sm btn-default"><i class="la la-eye"></i> </a>
                    <a href="/administrator/user/gestion/${row.id}/edit" class="btn btn-icon btn-sm btn-info"><i class="la la-edit"></i> </a>
                    <a href="/administrator/user/gestion/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                    }
                }
            }
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

function formAddUser() {
    let form = $("#formAddUser");

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
                    toastr.success("L'utilisateur à été créer.", "Succès");
                    toastr.success("Un email avec son mot de passe à été envoyé à l'utilisateur.", "Succès");
                    $(".modal").modal('hide');
                    users.reload()
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

formAddUser();
listeUser();
