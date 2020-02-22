import * as $ from "jquery";
import modal from 'bootstrap'
import summernote from 'summernote'
import swal from 'sweetalert2'

class BlogShow {
    checkNewComment() {
        let btn = document.querySelector('#btnNewComment')

        btn.addEventListener('click', function (event) {
            event.preventDefault()
            KTApp.progress(btn)

            $.ajax({
                url: '/account/api/connect',
                statusCode: {
                    200: function (data) {
                        KTApp.unprogress(btn)
                        $("#modalNewComment").modal('show')
                    },
                    401: function (jqxhr) {
                        KTApp.unprogress(btn)
                        swal.fire({
                            title: "L'ajout de commentaire est impossible",
                            text: "Veuillez vous connecter afin de poster un commentaire !",
                            type: 'error',
                            confirmButtonText: 'Me connecter'
                        }).then((result) => {
                            if(result.value) {
                                window.location.href='/login'
                            }
                        })
                    }
                }
            })
        })
    }
    postComment() {
        let form = $("#formAddComment")

        form.on('submit', function (e) {
            e.preventDefault()
            let url = form.attr('action')
            let btn = $("#btnSubmitComment")
            let data = form.serializeArray()

            KTApp.progress(btn)

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                statusCode: {
                    200: function (data) {
                        KTApp.unprogress(btn)
                        let alert = document.querySelector('#alertFormError')
                        alert.style.display = 'none'
                        toastr.success("Votre commentaire à été poster avec succès", "succès")
                        setTimeout(function () {
                            window.location.reload()
                        }, 1200)
                    },
                    203: function (data) {
                        KTApp.unprogress(btn)
                        let alert = document.querySelector('#alertFormError')
                        alert.style.display = 'block'

                        Array.from(data.data.errors).forEach((error) => {
                            $("#errors").html('<li>' + error + '</li>')
                        })
                    },
                    500: function (jqxhr) {
                        KTApp.unprogress(btn)
                        let alert = document.querySelector('#alertFormError')
                        alert.style.display = 'block'
                        alert.innerHTML = "Erreur Système. Consulter les Logs"
                        console.error(jqxhr)
                    }
                }
            })
        })
    }
    deleteComment() {
        let btns = document.querySelectorAll("#btnDeleteComment")

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (event) {
                event.preventDefault()
                let blog_id = btn.dataset.blogid
                let comment_id = btn.dataset.id
                console.log(btn.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode)

                KTApp.progress(btn)

                $.ajax({
                    url: '/blog/api/'+blog_id+'/comment/'+comment_id,
                    method: "GET",
                    success: function (data) {
                        KTApp.unprogress(btn)
                        btn.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.remove()
                        toastr.success("Le commentaire à été supprimer avec succès", "Succès")
                    },
                    error: function (jqxhr) {
                        KTApp.unprogress(btn)
                        toastr.error("Erreur lors de la suppression du commentaire", "Erreur Système")
                        console.error(jqxhr)
                    }
                })
            })
        })
    }
}

const Init = function () {
    let blogShow = new BlogShow()
    blogShow.checkNewComment()
    blogShow.postComment()
    blogShow.deleteComment()

    $("#comment").summernote()
}

Init();
