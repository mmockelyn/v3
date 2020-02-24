import * as $ from "jquery";
import modal from 'bootstrap'
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
        let tree = document.querySelector('.js-tree-todo')

        KTApp.block(tree, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des taches...'
        })

        $.get('/api/route/'+route_id+'/loadTaskTodo')
            .done((data) => {
                tree.innerHTML = data.data
            })
    }

    loadTodoProgress() {
        let tree = document.querySelector('.js-tree-progress')

        KTApp.block(tree, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des taches...'
        })

        $.get('/api/route/'+route_id+'/loadTaskProgress')
            .done((data) => {
                tree.innerHTML = data.data
            })
    }

    loadTodoFinished() {
        let tree = document.querySelector('.js-tree-finish')

        KTApp.block(tree, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des taches...'
        })

        $.get('/api/route/'+route_id+'/loadTaskFinished')
            .done((data) => {
                tree.innerHTML = data.data
            })
    }

    showNote() {
        let btns = document.querySelectorAll('#btnNotes')

        Array.from(btns).forEach((btn) => {
            btn.addEventListener('click', function (e) {
                e.preventDefault()
                let download_id = btn.dataset.downloadid

                $.get('/api/route/'+route_id+'/download/'+download_id)
                    .done((data) => {
                        let modal = $("#note")
                        let title = modal.find('.modal-title')
                        let content = modal.find('.modal-body')
                        title.html(`Note de version V${data.data.version}:${data.data.build}`)
                        content.find('img').attr('src', '/storage/route/'+data.data.route_id+'/v_'+data.data.version+'.png')
                        content.find('#versionText').html(data.data.version)
                        content.find('#buildText').html(data.data.build)
                        content.find('#description').html(data.data.note)

                        modal.modal('show')

                        console.log(data)
                    })
            })
        })
    }
}

const Init = function () {
    let route = new RouteShow()
    route.loadVersion()
    route.loadGallery()
    route.loadTodoTask()
    route.loadTodoProgress()
    route.loadTodoFinished()
    route.showNote()

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
