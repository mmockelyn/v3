const fancybox = require('fancybox/dist/js/jquery.fancybox')
let route = $("#route")
let route_id = route.attr('data-id')


function uploadFile() {
    $(".dropzone").dropzone({
        url: '/api/admin/route/'+route_id+'/gallery/uploadFile',
        paramName: 'file',
        addRemoveLinks: true,
        acceptedFiles: "image/*",
        success: function (data) {
            toastr.success("Le fichier <strong>"+data.name+"</strong> à été uploader")
        }
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
                toastr.success("La catégorie <strong>"+data.data.name+"</strong> à été ajouté", "Succès");
                setTimeout(() => {
                    window.location.reload()
                }, 1500)
            },
            error: function (error) {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors de la création de la catégorie", "Erreur système 500")
                console.error(error)
            }
        })
    })
}

function formDeleteCategory() {
    let form = $("#formDeleteCategory")

    form.on('submit', function (e) {
        e.preventDefault()
        let btn = form.find('button')
        let url = form.attr('action')
        let data = form.serializeArray()

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: 'DELETE',
            data: data,
            success: function (data) {
                KTApp.unprogress(btn)
                toastr.success("Le ou les catégorie selectionnées ont été supprimer", "Succès")
                setTimeout(() => {
                    window.location.reload()
                }, 1500)
            },
            error: function (jqxhr) {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors de la suppression des catégories", "Erreur système 500")
                console.error(jqxhr)
            }
        })
    })
}

function deleteGallery() {
    let btns = document.querySelectorAll('.kt-avatar__cancel')

    Array.from(btns).forEach((btn) => {
        btn.addEventListener('click', function (event) {
            event.preventDefault()

            KTApp.block(btn.parentNode)

            $.get(btn.getAttribute('href'))
                .done((data) => {
                    btn.parentNode.style.display = 'none'
                    toastr.success("L'image à bien été supprimer", "Succès")
                })
                .fail((jqxhr) => {
                    KTApp.unblock(btn.parentNode)
                    toastr.error("Erreur lors de la suppression de l'image", "Erreur système 500")
                    console.log(jqxhr)
                })
        })
    })
}


$(".modal").on('hidden.bs.modal', function () {
    window.location.reload()
})

uploadFile()
formAddCategory()
formDeleteCategory()
deleteGallery()
