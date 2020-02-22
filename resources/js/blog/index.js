import * as $ from "jquery";
const slick = require('slick-carousel/slick/slick.min')

class BlogIndex {
    blogCarousel() {
        let divEl = $("#slickCarousel")
        divEl.slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });

    }

    loadCarousel() {
        let divEl = $("#slickCarousel")

        KTApp.block(divEl)

        $.get('/blog/api/loadCarousel')
            .done((data) => {
                divEl.html(data.data)
                divEl.slick({
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 3
                });
            })
    }

    loadNewsless() {
        let divEl = document.querySelector('#loadNewslesss')

        KTApp.block(divEl, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            size: 'lg',
            message: 'Chargement des news...'
        })

        $.get('/blog/api/loadNews')
            .done((data) => {
                KTApp.unblock(divEl)
                divEl.innerHTML = data.data
            })
    }
}


const Init = function () {
    let blogIndex = new BlogIndex()
    blogIndex.loadCarousel()
    blogIndex.loadNewsless()
}

Init()
