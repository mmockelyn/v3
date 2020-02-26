import {blockElement,unblockElement, addPremium, countdown} from '../core'
import * as $ from "jquery";

function loadLatestTutoriel() {
    let div = document.querySelector('#loadLatestTutoriel')

    blockElement(div, 'Chargement des tutoriels...')

    $.ajax({
        url: '/api/tutoriel/latest',
        success: function (data) {
            unblockElement(div)
            div.innerHTML = data.data
        }
    })
}


loadLatestTutoriel()
addPremium()
