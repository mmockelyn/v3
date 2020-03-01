import summernote from 'summernote'

let route = $("#route")
let route_id = route.attr('data-id')

function submitEditDescription() {
    let form = $("#formEditDescription")

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
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn)
                    toastr.success("La description de la version à été mise à jour", "succès")
                    setTimeout(function () {
                        window.location.reload()
                    }, 1200)
                },
                203: function (data) {
                    KTApp.unprogress(btn)
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de validation")
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn)
                    toastr.error("Erreur lors de la modification de la description", "Erreur Système 500")
                    console.error(jqxhr)
                }
            }
        })
    })
}

function formWidget() {
    $(".summernote").summernote()
    $("#depart, #arrive, #name_gare").selectpicker()

}

function loadLatLngField() {
    let field = document.querySelector('#name_gare')

    field.addEventListener('change', function (e) {
        $.get('/api/admin/route/searchGare', {q: field.value})
            .done((data) => {
                $("#latitude").val(data.data.lat)
                $("#longitude").val(data.data.long)
                console.log(data.data.lat, data.data.long)
            })
    })

}

function formAddVersion() {
    let form = $("#formAddVersion")

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
                    toastr.success("La version nommée <strong>"+data.data.name+"</strong> à été créer avec succès", "Succès");
                    setTimeout(function () {
                        window.location.reload()
                    }, 1200)
                },
                203: function (data) {
                    KTApp.unprogress(btn)
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de validation")
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn)
                    toastr.error("Erreur lors de la création de la version", "Erreur Système 500")
                    console.error(jqxhr)
                }
            }
        })
    })
}
formWidget()
submitEditDescription()
formAddVersion()
loadLatLngField()
