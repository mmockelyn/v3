import KTDatatable from '../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
import summernote from 'summernote'

let route = $("#route")
let route_id = route.attr('data-id')
let tableau = '';

function loadTable() {
    let table = $("#listeAnomalie").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/route/' + route_id + '/anomalie/loadAnomalies',
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

        search: {
            input: $('#anomalieSearch'),
        },

        columns: [
            {
                field: 'id',
                title: "#",
                sortable: true,
                width: 30,
                type: 'number',
            },
            {
                field: 'anomalie',
                title: "Anomalie",
                width: 250,
                sortable: false,
                autoHide: false
            },
            {
                field: 'correction',
                title: "Correction",
                width: 250,
                sortable: false,
                autoHide: false
            },
            {
                field: 'lieu',
                title: "Lieu",
                sortable: false,
                autoHide: true
            },
            {
                field: 'state',
                title: "Status",
                sortable: true,
                autoHide: false,
                template: function (row) {
                    let status = {
                        0: {'title': 'Inscrite', 'class': 'kt-badge--danger'},
                        1: {'title': 'En cours', 'class': 'kt-badge--warning'},
                        2: {'title': 'Terminer', 'class': 'kt-badge--success'},
                    };
                    return '<span class="kt-badge ' + status[row.state].class + ' kt-badge--inline kt-badge--pill">' + status[row.state].title + '</span>';
                }
            },
            {
                field: 'actions',
                title: "Action",
                sortable: false,
                autoHide: false,
                width: 100,
                template: function (row) {
                    return `
                    <a href="/administrator/route/${route_id}/lab/${row.id}/edit" class="btn btn-sm btn-icon btn-primary" data-toggle="kt-tooltip" title="Editer l'anomalie"><i class="la la-edit"></i> </a>
                    <a href="/api/admin/route/${route_id}/anomalie/${row.id}/delete" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="supprimer l'anomalie"><i class="la la-trash"></i> </a>
                    `;
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des Anomalies...',
                noRecords: 'Aucune anomalie',
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

    tableau = table


    $('#kt_form_status').on('change', function () {
        table.search($(this).val().toLowerCase(), 'state');
    });

    $('#kt_form_status').selectpicker();
}

function formAddAnomalie() {
    let form = $("#formAddAnomalie")

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
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn)
                    if (data.data.anomalie !== '') {
                        toastr.success("La Correction <strong>" + data.data.correction + "</strong> à été ajoutée", "Succès")
                    } else {
                        toastr.success("L'anomalie <strong>" + data.data.anomalie + "</strong> à été ajoutée", "Succès")
                    }
                    $(".modal").modal('hide')
                    tableau.reload();
                },
                203: function (data) {
                    KTApp.unprogress(btn)
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de validation")
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn)
                    toastr.error("Erreur lors de la soumission du formulaire", "Erreur Système 500")
                }
            }
        })
    })
}

function formNextVersion() {
    let form = $("#formNextVersion")

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
                toastr.success("Passage à la <strong>" + parseInt(data.data.version) + "</strong> réussi", "Succès")
                setTimeout(() => {
                    window.location.reload()
                })
            },
            error: function (err) {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors du passage à la version suivante", "Erreur Système 500")
                console.error(err)
            }
        })
    })
}

function formNextState() {
    let form = $("#formNextState")

    form.on('submit', function (e) {
        e.preventDefault()
        let btn = form.find('button')
        let url = form.attr('action')
        let data = form.serializeArray()

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: 'put',
            data: data,
            success: function (data) {
                KTApp.unprogress(btn)
                toastr.success("Les anomalies selectionner sont passée à <strong>Terminer</strong>", "Succès")
                $(".modal").modal('hide')
                tableau.reload()
                portletStat()
                form[0].reset()
            },
            error: function (err) {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors du passage à un état supérieur pour les anomalies", "Erreur Système 500")
                console.error(err)
            }
        })
    })
}

function portletStat() {
    let portlet = $("#portlet_stat_build")

    KTApp.block(portlet, {
        overlayColor: '#ffffff',
        type: 'Chargement...',
        state: 'success',
        opacity: 0.3,
        size: 'lg'
    })

    $.get('/api/admin/route/'+route_id+'/anomalie/loadStat')
        .done((data) => {
            KTApp.unblock(portlet)
            portlet.html(data.data)
        })
}

$('.summernote').summernote({
    height: '350px'
})

portletStat()
loadTable()
formAddAnomalie()
formNextVersion()
formNextState()
