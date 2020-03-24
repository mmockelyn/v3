import Tagify from "@yaireo/tagify";

require('../../config');
let tutoriel = $("#tutoriel");
let tutoriel_id = tutoriel.attr('data-id');
let comments;
let tags;
let technos;
let requis;

function formPublishLater() {
    let form = $("#formPublishLater");

    form.on('submit', function (e) {
        e.preventDefault();
        let btn = form.find('button');
        let url = form.attr('action');
        let data = form.serializeArray();

        KTApp.progress(btn);

        $.ajax({
            url: url,
            method: 'put',
            data: data,
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("Le tutoriel à été planifier pour le " + data.data.day + " à " + data.data.hour);
                    setTimeout(function () {
                        window.location.reload()
                    }, 1200)
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

function listeComments() {
    comments = $("#listeComments").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/tutoriel/video/${tutoriel_id}/listeComments`,
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
                field: 'user',
                title: 'Auteur',
            },
            {
                field: 'content',
                title: 'Commentaire',
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
                        return `<a href="/administrator/tutoriel/${tutoriel_id}/comment/${row.id}/publish" class="btn btn-icon btn-sm btn-success"><i class="la la-check"></i> </a>`
                    } else {
                        return `<a href="/administrator/tutoriel/${tutoriel_id}/comment/${row.id}/unpublish" class="btn btn-icon btn-sm btn-danger"><i class="la la-times"></i> </a>`
                    }
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des commentaires...',
                noRecords: 'Aucun commentaire',
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

function listeTags() {
    tags = $("#listeTags").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/tutoriel/video/${tutoriel_id}/listeTags`,
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
                title: 'Tag',
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
                    <a id="btnDeleteTag" href="/api/admin/tutoriel/${tutoriel_id}/tag/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des tags...',
                noRecords: 'Aucun Tag',
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

    tags.on('kt-datatable--on-layout-updated', function (e) {
        e.preventDefault();
        let btns = document.querySelectorAll('#btnDeleteTag');

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                let url = btn.getAttribute('href');

                KTApp.progress(btn);

                $.get(url)
                    .done((data) => {
                        KTApp.unprogress(btn);
                        toastr.success("Le tag à été supprimer");
                        tags.reload()
                    })
            })
        })
    })
}

function listeTechnos() {
    technos = $("#listeTechnos").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/tutoriel/video/${tutoriel_id}/listeTechno`,
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
                title: 'Technologie',
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
                    <a href="/api/admin/tutoriel/${tutoriel_id}/techno/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des technologies...',
                noRecords: 'Aucune technologie',
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

    technos.on('kt-datatable--on-layout-updated', function (e) {
        e.preventDefault();
        let btns = document.querySelectorAll('#btnDeleteTechno');

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                let url = btn.getAttribute('href');

                KTApp.progress(btn);

                $.get(url)
                    .done((data) => {
                        KTApp.unprogress(btn);
                        toastr.success("La technologie à été supprimer");
                        tags.reload()
                    })
            })
        })
    })
}

function listeRequis() {
    requis = $("#listeRequis").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/admin/tutoriel/video/${tutoriel_id}/listeRequis`,
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
                field: 'requis',
                title: 'Requis',
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
                    <a href="/administrator/tutoriel/${tutoriel_id}/requis/${row.id}/delete" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash-o"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des requis...',
                noRecords: 'Aucun requis',
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

function formAddTag() {
    let form = $("#formAddTag");

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
                    toastr.success("Le ou les tags ont été ajoutés avec succès", "Succès");
                    tags.reload()
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

function formAddTechno() {
    let form = $("#formAddTechno");

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
                    toastr.success("La ou les technologies ont été ajoutés avec succès", "Succès");
                    technos.reload()
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

function formAddRequis() {
    let form = $("#formAddRequis");

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
                    toastr.success("Le ou les requis ont été ajoutés avec succès", "Succès");
                    requis.reload()
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

listeRequis();
listeTechnos();
listeTags();
listeComments();
formPublishLater();
formAddTag();
formAddTechno();
formAddRequis();

let input = document.querySelector('#tag');
new Tagify(input);

let input2 = document.querySelector('#techno');
new Tagify(input2);

let input3 = document.querySelector('#requi');
new Tagify(input3);

$('#published_at').datetimepicker({
    todayHighlight: true,
    autoclose: true,
    format: 'yyyy-mm-dd hh:ii',
    language: moment.locale('fr')
});
$("#btnPublish").on('click', function (e) {
    e.preventDefault();
    let btn = $(this);
    KTApp.progress(btn);

    $.get("/api/admin/tutoriel/video/" + tutoriel_id + "/publish")
        .done((data) => {
            KTApp.unprogress(btn);
            toastr.success("Le tutoriel à été publier", "Succès");
            setTimeout(() => {
                window.location.reload()
            }, 1200)
        })
        .fail((err) => {
            KTApp.unprogress(btn);
            toastr.error("Erreur lors de la publication du tutoriel", "Erreur Système 500");
            console.error(err)
        })
});
$("#btnUnpublish").on('click', function (e) {
    e.preventDefault();
    let btn = $(this);
    KTApp.progress(btn);

    $.get("/api/admin/tutoriel/video/" + tutoriel_id + "/unpublish")
        .done((data) => {
            KTApp.unprogress(btn);
            toastr.success("Le tutoriel à été dépublier", "Succès");
            setTimeout(() => {
                window.location.reload()
            }, 1200)
        })
        .fail((err) => {
            KTApp.unprogress(btn);
            toastr.error("Erreur lors de la dépublication du tutoriel", "Erreur Système 500");
            console.error(err)
        })
});
$("#formAddVideo").dropzone({
    url: '/api/admin/tutoriel/video/' + tutoriel_id + '/publishVideo',
    paramName: 'file',
    addRemoveLinks: true,
    acceptedFiles: "video/*",
    success: function (data) {
        toastr.success("Le fichier <strong>" + data.name + "</strong> à été uploader")
    }
});
$("#formAddSource").dropzone({
    url: '/api/admin/tutoriel/video/' + tutoriel_id + '/publishSource',
    paramName: 'file',
    addRemoveLinks: true,
    success: function (data) {
        toastr.success("Le fichier <strong>" + data.name + "</strong> à été uploader")
    }
});
