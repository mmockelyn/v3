import * as $ from "jquery";
import {reloadNotifBar} from "./../core";

function checkPassword() {
    let password = document.querySelector('#password')
    let confirm_password = document.querySelector('#confirm_password')

    confirm_password.addEventListener('keyUp', function (e) {
        e.preventDefault()
        if(confirm_password.value !== password.value) {
            password.classList.add('is-invalid')
            confirm_password.classList.add('is-invalid')
            $("#feedback").html(`<div class='invalid-feedback'>Les mot de passes ne correspondent pas !</div>`)
        }else{
            password.classList.add('is-valid')
            confirm_password.classList.add('is-valid')
            $("#feedback").html(`<div class='valid-feedback'>Nouveau mot de passe accepter</div>`)
        }
    })
}

function updatePassword() {
    let form = $("#formEditPassword")
    let btn = form.find('button')
    let url = form.attr('action')
    let data = form.serializeArray()

    form.on('submit', function (e) {
        e.preventDefault()

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: "POST",
            data: data,
            statusCode: {
                200: function () {
                    let alert = document.querySelector('#alertFormError')
                    alert.style.display = 'none'
                    toastr.success("Votre mot de passe à été mise à jours avec succès")
                    reloadNotifBar()
                    KTApp.unprogress(btn)
                },
                500: function (jqxhr) {
                    let alert = document.querySelector('#alertFormError')
                    alert.style.display = 'block'
                    alert.innerHTML = "Erreur Système. Consulter les Logs"
                    KTApp.unprogress(btn)
                    console.log(jqxhr.responseJSON.message)
                }
            }
        })
    })
}

$("#formEditInfo").on('submit', function(e) {
    e.preventDefault()
    let form = $(this)
    let btn = form.find('button')
    let url = form.attr('action')
    let data = form.serializeArray()

    KTApp.progress(btn)

    $.ajax({
        url: url,
        method: "POST",
        data: data,
        statusCode: {
            200: function () {
                let alert = document.querySelector('#alertFormError')
                alert.style.display = 'none'
                reloadNotifBar()
                toastr.success("Vos informations ont été mise à jours avec succès")
                KTApp.unprogress(btn)
            },
            203: function (data) {
                let alert = document.querySelector('#alertFormError')
                alert.style.display = 'block'

                Array.from(data.data.errors).forEach((error) => {
                    $("#errors").html('<li>'+error+'</li>')
                })

                KTApp.unprogress(btn)
                console.log(data)
            },
            500: function (jqxhr) {
                let alert = document.querySelector('#alertFormError')
                alert.style.display = 'block'
                alert.innerHTML = "Erreur Système. Consulter les Logs"
                KTApp.unprogress(btn)
                console.log(jqxhr.responseJSON.message)
            }
        }
    })
})

checkPassword()
updatePassword()
