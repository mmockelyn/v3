import * as $ from "jquery";

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

}

const init = function () {
    let account = new AccountIndex()
    account.getLatestActivity()
    account.getLastInvoice()
}

init();
