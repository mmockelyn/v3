import {blockElement, unblockElement} from '../core'
import * as $ from "jquery";

let sub_id = $("#tutorielList").attr('data-id')

function showTutoriel() {
    let div = document.querySelector('#js-show')

    blockElement(div, "Chargement des tutoriels")

    $.ajax({
        url: '/api/tutoriel/' + sub_id + '/listTutoriel',
        success: function (data) {
            unblockElement(div)
            div.innerHTML = data.data
        },
        error: function (jqxhr) {
            unblockElement(div)
            console.error(jqxhr)
        }
    })
}

function filterTutoriel() {
    let div = document.querySelector('#js-show')
    let btnsFilter = document.querySelectorAll("#js-filter")

    Array.from(btnsFilter).forEach((btn) => {
        btn.addEventListener('click', function (event) {
            event.preventDefault()
            blockElement(div, "Chargement des tutoriels...")

            $.ajax({
                url: '/api/tutoriel/' + sub_id + '/listTutoriel?filter=' + btn.dataset.sort,
                success: function (data) {
                    unblockElement(div)
                    div.innerHTML = data.data
                },
                error: function (jqxhr) {
                    unblockElement(div)
                    console.error(jqxhr)
                }
            })
        })
    })
}

showTutoriel()
filterTutoriel()
