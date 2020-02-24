import * as $ from "jquery";
const fancybox = require('fancybox/dist/js/jquery.fancybox')
const map = require('./map.js')

let route = $("#route")
let route_id = route.attr('data-id')
let div = document.querySelector('#js-show-gallery')

class RouteShow {
    loadVersion() {
        let btns = document.querySelectorAll('#btnVersions')
        let div = document.querySelector('#loadVersion')

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (event) {
                event.preventDefault()
                let version_id = btn.dataset.id
                let route_id = $("#route").attr('data-id')

                KTApp.block(div, {
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    size: 'lg',
                    message: 'Chargement de la version...'
                })

                $.ajax({
                    url: '/api/route/'+route_id+'/version/'+version_id,
                    success: function (data) {
                        KTApp.unblock(div)
                        console.log(data)
                        div.innerHTML = data.data
                        let route = new RouteShow()
                        route.loadVideos()
                        map.loadGare()
                    },
                    error: function (jqxhr) {
                        KTApp.unblock(div)
                    }
                })

            })
        })
    }
    loadVideos() {
        jwplayer("videos").setup({
            width: '100%',
            logo: {
                file: "/storage/logos/logo.png",
                position: 'top-left',
                margin: '20',
                width: '200',
                link: "https://animeki.fr"
            },
            autostart: false,
            playlist:[
                {file: "https://download.trainznation.eu/video/intro.mp4", mediaid: 0}
            ]
        })
    }

    loadGallery() {
        let links = document.querySelectorAll('.js-gallery')
        let div = document.querySelector('#js-show-gallery')

        KTApp.block(div,{
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement de la gallerie...'
        })

        Array.from(links).forEach((link) => {
            link.addEventListener('click', function (event) {
                event.preventDefault()
                let id = link.dataset.category
                let uri = null

                if(id === 'all'){
                    uri = '/api/route/'+route_id+'/loadGalleries'
                }else{
                    uri = '/api/route/'+route_id+'/loadGalleries/'+id
                }

                $.ajax({
                    url: uri,
                    success: function (data) {
                        KTApp.unblock(div)
                        div.innerHTML = data.data
                    }

                })
            })
        })
    }

    loadTodoTask() {
        let tree = document.querySelector('js-tree-todo')

        KTApp.block(tree, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des taches...'
        })

        $.get('/api/route/'+route_id+'/loadTaskTodo')
    }
}

const Init = function () {
    let route = new RouteShow()
    route.loadVersion()
    route.loadGallery()

    KTApp.block(div,{
        overlayColor: '#000000',
        type: 'v2',
        state: 'success',
        size: 'lg',
        message: 'Chargement de la gallerie...'
    })

    $.ajax({
        url: '/api/route/'+route_id+'/loadGalleries',
        success: function (data) {
            KTApp.unblock(div)
            div.innerHTML = data.data
        }

    })
}

Init()
