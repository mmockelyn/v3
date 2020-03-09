import {blockElement, unblockElement} from '../../core'

function loadLatestTutoriel() {
    let div = $("#listLatestTutoriel");

    blockElement(div, "Chargement des derniers tutoriels...");

    $.get('/api/admin/tutoriel/latest')
        .done((data) => {
            unblockElement(div);
            div.html(data.data)
        })
        .fail((err) => {
            unblockElement(div);
            toastr.error("Impossible d'afficher les derniers tutoriel");
            console.error(err)
        })
}

function loadLatestComment() {
    let div = $("#listLatestComment");

    blockElement(div, "Chargement des derniers commentaires...");

    $.get('/api/admin/tutoriel/comment/latest')
        .done((data) => {
            unblockElement(div);
            div.html(data.data)
        })
        .fail((err) => {
            unblockElement(div);
            toastr.error("Impossible d'afficher les derniers tutoriel");
            console.error(err)
        })
}

loadLatestTutoriel();
loadLatestComment();
