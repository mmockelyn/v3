import * as $ from "jquery";

function getLatestBlog() {
    let div = document.querySelector('#latestBlog')
    KTApp.block(div, {
        overlayColor: '#000000',
        type: 'v2',
        state: 'success',
        size: 'lg',
        message: 'Chargement des news...'
    })
    $.ajax({
        url: '/api/blog/latest',
        success: function (data) {
            KTApp.unblock(div)
            div.innerHTML = data.data
        },
    })
}

function getLatestDownload() {
    let div = document.querySelector('#latestDownload')
    KTApp.block(div, {
        overlayColor: '#000000',
        type: 'v2',
        state: 'success',
        size: 'lg',
        message: 'Chargement des Objets...'
    })
    $.ajax({
        url: '/api/download/latest',
        success: function (data) {
            KTApp.unblock(div)
            div.innerHTML = data.data
        },
    })
}

function getLatestTutoriel() {
    let div = document.querySelector('#latestTutoriel')
    KTApp.block(div, {
        overlayColor: '#000000',
        type: 'v2',
        state: 'success',
        size: 'lg',
        message: 'Chargement des Tutoriels...'
    })
    $.ajax({
        url: '/api/tutoriel/latest',
        success: function (data) {
            KTApp.unblock(div)
            div.innerHTML = data.data
        },
    })
}

export function redirectBlog() {
    let portlets = document.querySelectorAll('#portletsBlog')

    Array.from(portlets).forEach((item) => {
        item.addEventListener('click', function (event) {
            console.log('click')
            window.location.href='/blog/'+item.dataset.slug
        })
    })
}

getLatestBlog()
getLatestDownload()
getLatestTutoriel()
redirectBlog()
