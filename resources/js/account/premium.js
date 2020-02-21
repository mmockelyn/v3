import * as $ from "jquery";
import modal from 'bootstrap'

function subscribeCheck() {
    let btns = document.querySelectorAll('#btnCheck')

    Array.from(btns).forEach((btn) => {
        btn.addEventListener('click', function (e) {
            e.preventDefault()

            KTApp.progress(btn)

            $.get('/account/api/verifCarte')
                .done((data) => {
                    if (data.data === false) {
                        $.noConflict();
                        $("#addPaymentCarte").modal('show')
                        $("#plan").val(btn.dataset.plan)
                    } else {
                        subscribe(btn)
                    }
                })
        })
    })
}

function subscribe(btn) {
    let plan = btn.dataset.plan
    console.log(plan)
}


(($) => {
    subscribeCheck()

    $("#formAddPayment").on('submit', function (e) {
        e.preventDefault()
        let form = $(this)
        let btn = $("#btnSubmit")
        let url = form.attr('action')
        let data = form.serializeArray()

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function (data) {
                let alert = document.querySelector('#alertFormError')
                alert.style.display = 'none'
                KTApp.unprogress(btn)

                swal.fire({
                    title: "Souscription effectuer",
                    text: "Votre compte est premium jusqu'au "+data.data,
                    type: 'success'
                }).then(() => {
                    $("#addPaymentCarte").modal('hide')
                })
            },
            error: function (jqxhr) {
                let alert = document.querySelector('#alertFormError')
                alert.style.display = 'block'
                alert.innerHTML = "Erreur Système. Consulter les Logs"
                KTApp.unprogress(btn)
                console.log(jqxhr.responseJSON.message)
            }
        })
    })

})(jQuery)
