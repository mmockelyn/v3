import * as $ from "jquery";
require('datatables.net-bs4');
require('datatables.net-buttons-bs4');
import modal from 'bootstrap'

class AccountIndex {

    getLatestActivity() {
        let div = document.querySelector('#latestActivity')

        KTApp.block(div, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des activitées...'
        })

        $.ajax({
            url: '/account/api/latestActivity',
            success: function (data) {
                KTApp.unblock(div)
                div.innerHTML = data.data
            }
        })
    }

    getLastInvoice() {
        let div = document.querySelector('#listLatestInvoice')

        KTApp.block(div, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des activitées...'
        })

        $.get('/account/api/latestInvoice')
            .done((data) => {
                KTApp.unblock(div)
                div.innerHTML = data.data
            })
    }

    reloadContrib() {
        let btns = document.querySelectorAll('#btnReloadContrib')

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (event) {
                event.preventDefault()
                let action = btn.dataset.action
                let account = new AccountIndex()

                if (action === 'blog') {
                    account.getLoadContribBlog()
                } else {
                    account.getLoadContribTutoriel()
                }
            })
        })
    }

    reloadInvoices() {
        let btn = document.querySelector('#btnReloadInvoices')

        btn.addEventListener('click', function (event) {
            event.preventDefault()
            let account = new AccountIndex()
            account.getListInvoices()

        })
    }

    getLoadContribBlog() {
        let div = document.querySelector('#loadContribBlog')

        KTApp.block(div, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des Contributions...'
        })

        $.ajax({
            url: '/account/api/contrib/blog',
            success: function (data) {
                KTApp.unblock(div)
                div.innerHTML = data.data
            },
            error: function (jqxhr) {
                KTApp.unblock(div)
                toastr.error("Erreur lors du chargement des contribution: Blog", "Erreur Système")
                console.error(jqxhr.responseText)
            }
        })
    }

    getLoadContribTutoriel() {
        let div = document.querySelector('#loadContribTutoriel')

        KTApp.block(div, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des Contributions...'
        })

        $.ajax({
            url: '/account/api/contrib/tutoriel',
            success: function (data) {
                KTApp.unblock(div)
                div.innerHTML = data.data
            },
            error: function (jqxhr) {
                KTApp.unblock(div)
                toastr.error("Erreur lors du chargement des contribution: Tutoriel", "Erreur Système")
                console.error(jqxhr.responseText)
            }
        })
    }

    getListInvoices() {
        let div = document.querySelector('#listingInvoices')

        KTApp.block(div, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des factures...'
        })

        $.ajax({
            url: '/account/api/invoices',
            success: function (data) {
                KTApp.unblock(div)
                div.innerHTML = data.data

                let invoice = new Invoice()
                invoice.viewInvoice()
            },
            error: function (jqxhr) {
                KTApp.unblock(div)
                toastr.error("Erreur lors du chargement des factures", "Erreur système")
                console.error(jqxhr.responseText)
            }
        })
    }

}

class Invoice {
    viewInvoice() {
        let btns = document.querySelectorAll('#btnViewInvoice')

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function() {
                let id = btn.dataset.id
                window.location.href='/account/invoice/'+id
            })
        })
    }

    loadSearch() {
        let searchInp = document.querySelector('#generalSearch')
        let div = document.querySelector('#listingInvoices')

        searchInp.addEventListener('keyup', function (e) {
            e.preventDefault()

            KTApp.block(div, {
                overlayColor: '#000000',
                type: 'v2',
                state: 'success',
                size: 'lg',
                message: 'Chargement des factures...'
            })

            $.ajax({
                url: '/account/api/invoices',
                data: {
                    state: 'search',
                    q: $(this).val()
                },
                success: function (data) {
                    KTApp.unblock(div)
                    div.innerHTML = data.data
                },
                error: function (jqxhr) {
                    KTApp.unblock(div)
                    toastr.error("Erreur lors du chargement des factures", "Erreur système")
                    console.error(jqxhr.responseText)
                }
            })
        })
    }
}

class PaymentMethod {
    getListMethod() {
        let div = document.querySelector('#listingModePayments')

        KTApp.block(div, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des moyens de paiements...'
        })

        $.ajax({
            url: '/account/api/loadPayments',
            success: function (data) {
                KTApp.unblock(div)
                div.innerHTML = data.data

                let payment = new PaymentMethod()
                payment.deleteMethodPayment()
            },
            error: function (jqxhr) {
                KTApp.unblock(div)
                toastr.error("Erreur lors du chargement des moyens de paiements", "Erreur système")
                console.error(jqxhr.responseText)
            }
        })
    }

    createMethodPayment() {
        let form = $("#formCreatePaymentMethod")


        form.on('submit', function (e) {
            e.preventDefault()
            let url = form.attr('action')
            let btn = form.find('#btnSubmit')
            let data = form.serializeArray()
            KTApp.progress(btn)

            $.ajax({
                url: url,
                method: "POST",
                data: data,
                statusCode: {
                    200: function (data) {
                        KTApp.unprogress(btn)
                        $("#listingModePayments").prepend(data.data)
                        $("#addPaymentMethod").modal('hide')
                        console.log(data)
                    },
                    203: function (data) {
                        KTApp.unprogress(btn)
                        let alertEl = document.querySelector('#alertFormError')
                        alertEl.style.display = 'block'
                        let errorsEl = $('#errors')
                        Array.from(data.data.errors).forEach((item) => {
                            errorsEl.html(`<li>${item}</li>`)
                        })
                        console.error(data)
                    },
                    500: function (jqxhr) {
                        KTApp.unprogress(btn)
                        toastr.error("Erreur Traitement", "Erreur Système")
                        console.error(jqxhr)
                    }
                }
            })
        })
    }

    deleteMethodPayment() {
        let btns = document.querySelectorAll('#btnDeleteMethod')

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (event) {
                event.preventDefault()
                KTApp.progress(btn)

                let pm_id = btn.dataset.id

                $.ajax({
                    url: '/account/api/deletePayment/'+pm_id,
                    statusCode: {
                        200: function (data) {
                            KTApp.unprogress(btn)
                            toastr.success("Le mode de paiement à été supprimer avec succès !", "Succès")
                            setTimeout(function () {
                                window.location.reload()
                            }, 1200)
                        },
                        500: function (jqxhr) {
                            KTApp.unprogress(btn)
                            toastr.error("Erreur lors de la suppression du mode de paiement !", "Erreur Système")
                            console.error(jqxhr.responseJSON)
                        }
                    }
                })
            })
        })
    }

    reloadPaymentMethod() {
        let btn = document.querySelector('#btnReloadMethod')

        btn.addEventListener('click', function (event) {
            event.preventDefault()
            let payment = new PaymentMethod()
            payment.getListMethod()

        })
    }
}

const init = function () {
    let account = new AccountIndex()
    account.getLatestActivity()
    account.getLastInvoice()
    account.getLoadContribBlog()
    account.getLoadContribTutoriel()
    account.reloadContrib()
    account.getListInvoices()
    account.reloadInvoices()

    let invoice = new Invoice()
    invoice.loadSearch()

    let payment = new PaymentMethod()
    payment.getListMethod()
    payment.createMethodPayment()
    payment.deleteMethodPayment()
    payment.reloadPaymentMethod()
}

init();
