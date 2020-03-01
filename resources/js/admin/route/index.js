import {blockElement,unblockElement} from '../../core'
import * as $ from "jquery";
import summernote from 'summernote'

function loadRoute() {
    let div = document.querySelector('#listeRoute')

    blockElement(div, "Chargement des routes");

    $.get('/api/admin/route/list')
        .done((data) => {
            div.innerHTML = data.data
        })
        .fail((jqxhr) => {

        })
}

function searchRoute() {
    let input = document.querySelector('#routeSearch')
    let div = document.querySelector('#listeRoute')

    input.addEventListener('keyup', function (e) {
        e.preventDefault()
        blockElement(div, "Chargement des routes...")
        $.get('/api/admin/route/list', {q: input.value})
            .done((data) => {
                div.innerHTML = data.data
            })
    })
}

function loadFormElement() {
    $(".summernote").summernote()
    let images = KTAvatar('kt_user_avatar_1')
}

loadRoute()
searchRoute()
loadFormElement()

