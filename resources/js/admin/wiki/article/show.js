let article = $("#article");
let article_id = article.attr('data-id');

function formAddContent() {
    let form = $("#formAddContent");

    form.on('submit', function (e) {
        e.preventDefault();
        let btn = form.find('button');
        let url = form.attr('action');
        let data = form.serializeArray();

        KTApp.progress(btn);

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("Un contenue à été ajouté avec succès", "Succès")
                    /*setTimeout(function () {
                        window.location.reload()
                    }, 1200)*/
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((err) => {
                        toastr.warning(err, "Validation")
                    })
                },
                500: function (data) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de l'execution du script", "Erreur Système 500")
                }
            }
        })
    })
}


$("#btnPublishArticle").on('click', function (e) {
    e.preventDefault();
    let btn = $(this);
    KTApp.progress(btn);

    $.get('/api/admin/wiki/article/' + article_id + '/publish')
        .done((data) => {
            KTApp.unprogress(btn);
            toastr.success("L'article à été publier", "Succès");
            setTimeout(function () {
                window.location.reload()
            }, 1200)
        })
        .fail((err) => {
            KTApp.unprogress(btn);
            toastr.error(err, "Erreur Système 500")
        })
});
$("#btnUnpublishArticle").on('click', function (e) {
    e.preventDefault();
    let btn = $(this);
    KTApp.progress(btn);

    $.get('/api/admin/wiki/article/' + article_id + '/unpublish')
        .done((data) => {
            KTApp.unprogress(btn);
            toastr.success("L'article à été dépublier", "Succès");
            setTimeout(function () {
                window.location.reload()
            }, 1200)
        })
        .fail((err) => {
            KTApp.unprogress(btn);
            toastr.error(err, "Erreur Système 500")
        })
});

formAddContent();

$("#content").summernote();
