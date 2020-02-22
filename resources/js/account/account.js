import * as $ from "jquery";
import {reloadNotifBar} from "./../core";
import * as swal from "sweetalert2";

function checkPassword() {
    let password = document.querySelector('#password')
    let confirm_password = document.querySelector('#confirm_password')

    confirm_password.addEventListener('keyup', function (e) {
        e.preventDefault()
        if (confirm_password.value !== password.value) {
            password.classList.add('is-invalid')
            confirm_password.classList.add('is-invalid')
            $("#feedback").html(`<div class='invalid-feedback'>Les mot de passes ne correspondent pas !</div>`)
        } else {
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

function trashAccount() {
    let btn = document.querySelector('#btnTrashAccount')

    btn.addEventListener('click', function (event) {
        event.preventDefault()
        swal.fire({
            title: 'Etes-vous sur ?',
            text: "Cette opération est irréversible !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, supprimer mon compte!',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch("/account/api/delete")
                    .then(response => {
                        if(!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response
                    })
                    .catch(error => {
                        swal.showValidationMessage(
                            `Erreur: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !swal.isLoading()
        }).then(function(result) {
            if (result.value) {
                swal.fire({
                    title: "Compte Supprimer",
                    text: "Votre compte à été supprimer avec succès",
                    type: "success"
                })
                setTimeout(function (e) {
                    window.location.href='/'
                }, 2500)
            }
        });
    })
}

$("#formEditInfo").on('submit', function (e) {
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
                    $("#errors").html('<li>' + error + '</li>')
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

$("#btnExtendAbo").on('click', function () {
    window.location.href='/account/premium/extends'
})
$("#btnSubscriptionAbo").on('click', function () {
    window.location.href='/account/premium'
})

checkPassword()
updatePassword()
trashAccount()
