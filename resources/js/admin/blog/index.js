import {blockElement, unblockElement} from '../../core'
import * as $ from "jquery";

function loadLastComment() {
    let div = document.querySelector('#loadLatestComment')

    blockElement(div, 'Chargement des commentaires...')

    $.get('/api/admin/blog/comment/latest')
        .done((data) => {
            unblockElement(div)
            div.innerHTML = data.data
        })

}

function loadLastBlog() {
    let div = document.querySelector('#loadLatestBlog')

    blockElement(div, 'Chargement des Articles...')

    $.get('/api/admin/blog/latest')
        .done((data) => {
            unblockElement(div)
            div.innerHTML = data.data
        })

}

loadLastComment()
loadLastBlog()
