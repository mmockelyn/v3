import summernote from 'summernote'

require('../config');

let route = $("#route");
let route_id = route.attr('data-id');

function submitEditDescription() {
    let form = $("#formEditDescription");

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
                    toastr.success("La description de la version à été mise à jour", "succès");
                    setTimeout(function () {
                        window.location.reload()
                    }, 1200)
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de validation")
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de la modification de la description", "Erreur Système 500");
                    console.error(jqxhr)
                }
            }
        })
    })
}
function formWidget() {
    $(".summernote").summernote();
    $("#depart, #arrive, #name_gare").selectpicker()
    //let avatar = KTAvatar('kt_user_avatar_1')
}
function loadLatLngField() {
    let field = document.querySelector('#name_gare');

    field.addEventListener('change', function (e) {
        KTApp.block($("#addGare"));
        $.get('/api/admin/route/searchGare', {q: field.value})
            .done((data) => {
                KTApp.unblock($("#addGare"));
                $("#latitude").val(data.data.lat);
                $("#longitude").val(data.data.long);
                console.log(data.data.lat, data.data.long)
            })
    })

}
function formAddVersion() {
    let form = $("#formAddVersion");

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
                    toastr.success("La version nommée <strong>" + data.data.name + "</strong> à été créer avec succès", "Succès");
                    setTimeout(function () {
                        window.location.reload()
                    }, 1200)
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de validation")
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de la création de la version", "Erreur Système 500");
                    console.error(jqxhr)
                }
            }
        })
    })
}
function formAddGare() {
    let form = $("#formAddGare");

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
            success: function (data) {
                KTApp.unprogress(btn);
                toastr.success(`La gare <strong>${data.data.name_gare}</strong> à été ajouté à la version <strong>${data.data.route_version_id}</strong> avec succès`, "Succès");
                setTimeout(() => {
                    window.location.reload()
                }, 1500)
            },
            error: function (jqxhr) {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de l'ajout de la gare", "Erreur Système 500");
                console.error(jqxhr)
            }
        })
    })
}
function dropVideo() {
    $(".dropzone").dropzone({
        url: '/api/admin/route/'+route_id+'/version/uploadVideo',
        paramName: 'video',
        addRemoveLinks: true,
        acceptedFiles: "video/*",
        timeout: '60000',
        success: function (data) {
            toastr.success("Le fichier <strong>" + data.name + "</strong> à été uploader")
        }
    })
}

formWidget();
submitEditDescription();
formAddVersion();
loadLatLngField();
formAddGare();
dropVideo();
