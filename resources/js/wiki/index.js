import * as $ from "jquery";

function searchSuggestion() {
    let input = document.querySelector('#search')
    let div = document.querySelector('#suggestions')

    div.style.display = 'none'

    input.addEventListener('keyup', function (e) {
        e.preventDefault()
        KTApp.progress(div)

        $.ajax({
            url: '/api/wiki/search',
            data: {
                search: input.value
            },
            success: function (data) {
                KTApp.unprogress(div)
                console.log(data)
                div.style.display = 'block'
                div.innerHTML = data.data
            },
            error: function (jqxhr) {
                KTApp.unprogress(div)
                toastr.error("Erreur lors de la recherche", "Erreur Système")
                console.error(jqxhr)
            }
        })
    })
}

searchSuggestion()
