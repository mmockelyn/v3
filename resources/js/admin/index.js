import * as $ from "jquery";
import {blockElement, unblockElement} from '../core'

function loadSignalement() {
    let el = document.querySelector('#signalement')

    //blockElement(el, 'Chargements des signalement...')

    $.get('/api/admin/loadSignalement')
        .done((data) => {
            unblockElement(el)
            el.innerHTML = data.data
        })
}

function loadLatestArticle() {
    let el = document.querySelector('#loadLatestBlog')

    blockElement(el, "Chargement des derniers articles...")

    $.get('/api/admin/blog/latest')
        .done((data) => {
            unblockElement(el)
            el.innerHTML = data.data
        })
}

function loadLatestTutoriel() {
    let el = document.querySelector('#loadLatestTutoriel')

    blockElement(el, "Chargement des derniers tutoriels...")

    $.get('/api/admin/tutoriel/latest')
        .done((data) => {
            unblockElement(el)
            el.innerHTML = data.data
        })
}

loadSignalement()
loadLatestArticle()
loadLatestTutoriel()
