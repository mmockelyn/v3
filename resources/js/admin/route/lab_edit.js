require('../config');

function formEditAnomalie() {
    let form = $("#formEditAnomalie");

    form.on('submit', function (e) {
        e.preventDefault();
        let btn = form.find('button');
        let url = form.attr('action');
        let data = form.serializeArray();

        KTApp.progress(btn);

        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            success: function (data) {
                KTApp.unprogress(btn);
                toastr.success("L'anomalie à été mise à jours", "Succès");
                $(".modal").modal('hide')
            },
            error: function (err) {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de la mise à jour de l'anomalie", "Erreur Système 500");
                console.error(err)
            }
        })
    })
}

formEditAnomalie();
