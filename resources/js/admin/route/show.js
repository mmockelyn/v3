import summernote from 'summernote'

let route = $("#route")
let route_id = route.attr('data-id')
let route_published = route.attr('data-published')

function submitDescriptionForm() {
    let form = $("#formEditDescription")

    form.on('submit', function (e) {
        e.preventDefault()
        let btn = form.find('button')
        let data = form.serializeArray()
        let url = form.attr('action')

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn)
                    toastr.success("La description à été mis à jour avec succès", "Succès")
                    setTimeout(() => {
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
                    toastr.error("Erreur lors de la modification de la description", "Erreur Système")
                    console.error(jqxhr)
                }
            }
        })
    })
}

function formFormat() {
    $(".summernote").summernote({
        height: 200
    })
}

function btnPublish() {
    let btn = $("#btnPublish")

    btn.on('click', function (e) {
        e.preventDefault()

        KTApp.progress(btn)

        $.get('/api/admin/route/'+route_id+'/publish')
            .done((data) => {
                KTApp.unprogress(btn)
                toastr.success("La route à été publier", "Succès")
                setTimeout(() => {
                    window.location.reload()
                }, 1200)
            })
            .fail((jqxhr) => {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors de la publication", "Erreur Système")
                console.error(jqxhr)
            })
    })
}

function btnUnpublish() {
    let btn = $("#btnUnpublish")

    btn.on('click', function (e) {
        e.preventDefault()

        KTApp.progress(btn)

        $.get('/api/admin/route/'+route_id+'/unpublish')
            .done((data) => {
                KTApp.unprogress(btn)
                toastr.success("La route à été dépublier", "Succès")
                setTimeout(() => {
                    window.location.reload()
                }, 1200)
            })
            .fail((jqxhr) => {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors de la dépublication", "Erreur Système")
                console.error(jqxhr)
            })
    })
}

if(route_published == 1) {
    btnUnpublish()
}else if(route_published == 0) {
    btnPublish()
}else{
    console.log("Erreur")
}


formFormat()
submitDescriptionForm()
