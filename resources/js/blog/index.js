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
}


const Init = function () {
    let blogIndex = new BlogIndex()
    blogIndex.loadCarousel()
}

Init()
