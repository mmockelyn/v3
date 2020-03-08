let asset = $("#asset");
let asset_id = asset.attr('data-id');

function pricingCheck() {
    let checkbox = document.getElementById('pricingCheck');
    let div = document.getElementById('pricing');

    checkbox.addEventListener('change', function (e) {
        if (checkbox.checked == true) {
            console.log('checked');
            div.style.display = 'block'
        } else {
            console.log('None');
            div.style.display = 'none'
        }
    })
}

function pricingUpdate() {
    let input = document.querySelector('#input_pricing');

    input.addEventListener('blur', function (e) {
        e.preventDefault();
        KTApp.block(input);

        $.ajax({
            url: '/api/admin/objet/objet/' + asset_id + "/editPrice",
            method: "PUT",
            data: {'price': input.value},
            statusCode: {
                200: function (data) {
                    KTApp.unblock(input);
                    toastr.success("Le prix de l'objet à été modifier", "Succès")
                },
                202: function (data) {
                    KTApp.unblock(input);
                    toastr.warning(data.data.error, "Attention")
                },
                500: function (err) {
                    KTApp.unblock(input);
                    toastr.error("Erreur lors de la mise à jour du prix de l'objet", "Erreur Système 500");
                    console.error(err)
                }
            }
        })
    })
}

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
                    toastr.success("Les informations de l'objet ont été modifier", "Succès")
                },
                500: function (err) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de l'execution du script", "Erreur Système 500");
                    console.error(err)
                }
            }
        })
    })
}

formEditInfo();

function formEditDescription() {
    let form = $("#formEditDescription");

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
                    toastr.success("La description à été mise à jours", "Succès")
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((err) => {
                        toastr.warning(err, "Validation")
                    })
                },
                500: function (data) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de l'execution du script", "Erreur Système 500");
                    console.error(data)
                }
            }
        })
    })
}

formEditDescription();

pricingCheck();
pricingUpdate();

$(".summernote").summernote();
let av = new KTAvatar('kt_user_avatar_1');
