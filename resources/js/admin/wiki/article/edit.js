function formEditInfo() {
    let form = $("#formEditInfo");

    form.on('submit', function (e) {
        e.preventDefault();
        let btn = form.find('button');
        let url = form.attr('action');
        let data = form.serializeArray();

        KTApp.progress(btn);

        $.ajax({
            url: url,
            method: 'put',
            data: data,
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("Les information de l'article ont été mise à jours")
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

formEditInfo();

let av = new KTAvatar('kt_user_avatar_1');
