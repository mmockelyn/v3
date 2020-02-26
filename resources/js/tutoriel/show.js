import * as $ from "jquery";
import modal from 'bootstrap'
import summernote from 'summernote'
import swal from 'sweetalert2'
import {ago} from '../plugins/ago'

let tutoriel_id = $("#tutorielShow").attr('data-id')

function loadBackground() {
    let header = $('#js-header')
    header.attr('style', "background: url('/storage/tutoriel/"+tutoriel_id+"/background.png')")
}

function loadVideos() {
    if ($("#tutorielVideo")) {
        $.get('/api/tutoriel/' + tutoriel_id)
            .done((data) => {
                jwplayer("tutorielVideo").setup({
                    width: '100%',
                    logo: {
                        file: "/storage/logos/logo.png",
                        position: 'top-left',
                        margin: '20',
                        width: '200',
                        link: "/tutoriel/" + data.data.tutoriel_sub_category_id + '/' + data.data.id
                    },
                    autostart: false,
                    playlist: [
                        {file: "https://download.trainznation.eu/video/intro.mp4", mediaid: 0},
                        {
                            file: "https://download.trainznation.eu/video/" + data.data.tutoriel_sub_category_id + '/' + data.data.id + '.mp4',
                            mediaid: 1
                        }
                    ]
                })
            })
    }

}

function loadCountDown() {
    if ($("#tutorielCountDown")) {
        ago()
    }
}

function clickBtn() {
    let btnVideo = document.querySelector('#btnDownloadVideo')
    let btnSource = document.querySelector('#btnDownloadSource')
    let btnDemo = document.querySelector('#btnView')
    let btnLater = document.querySelector('#btnWatchLater')
    let btnWatches = document.querySelector('#btnWatch')

    btnVideo.addEventListener('click', function (e) {
        window.location.href=btnVideo.dataset.link
    })

    btnSource.addEventListener('click', function (e) {
        window.location.href=btnSource.dataset.link
    })

    btnLater.addEventListener('click', function (e) {

        KTApp.progress(btnLater)

        $.ajax({
            url: '/tutoriel/api/'+tutoriel_id+'/viewLater',
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btnLater)
                    toastr.success("Cette vidéo à été ajouter à votre liste 'A regarder plus tard'")
                },
                203: function (data) {
                    KTApp.unprogress(btnLater)
                    toastr.error("Cette vidéo à déjà été ajouter à votre liste 'A regarder plus tard'")
                }
            }
        })
    })

    btnWatches.addEventListener('click', function (e) {

        KTApp.progress(btnWatches)

        $.ajax({
            url: '/tutoriel/api/'+tutoriel_id+'/view',
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btnWatches)
                    toastr.success("Cette vidéo à été ajouter à votre liste 'Vue'")
                },
                203: function (data) {
                    KTApp.unprogress(btnWatches)
                    toastr.error("Cette vidéo à déjà été ajouter à votre liste 'Vue'")
                }
            }
        })
    })
    btnDemo.addEventListener('click', function (e) {
        window.location.href=btnDemo.dataset.link
    })
}

function checkNewComment() {
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
function postComment() {
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
function deleteComment() {
    let btns = document.querySelectorAll("#btnDeleteComment")

    Array.from(btns).forEach((btn) => {
        btn.addEventListener('click', function (event) {
            event.preventDefault()
            let blog_id = btn.dataset.tutorielid
            let comment_id = btn.dataset.id
            console.log(btn.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode)

            KTApp.progress(btn)

            $.ajax({
                url: '/tutoriel/api/'+blog_id+'/comment/'+comment_id,
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

$("#comment").summernote()

loadBackground()
checkNewComment()
postComment()
deleteComment()
clickBtn()
loadVideos()
loadCountDown()

