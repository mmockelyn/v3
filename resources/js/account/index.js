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

    reloadContrib() {
        let btns = document.querySelectorAll('#btnReloadContrib')

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (event) {
                event.preventDefault()
                let action = btn.dataset.action
                let account = new AccountIndex()

                if(action === 'blog') {
                    account.getLoadContribBlog()
                }else{
                    account.getLoadContribTutoriel()
                }
            })
        })
    }

    getLoadContribBlog() {
        let div = document.querySelector('#loadContribBlog')

        KTApp.block(div,{
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

        KTApp.block(div,{
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

}

const init = function () {
    let account = new AccountIndex()
    account.getLatestActivity()
    account.getLastInvoice()
    account.getLoadContribBlog()
    account.getLoadContribTutoriel()
    account.reloadContrib()
}

init();
