import * as moment from "moment";
import summernote from 'summernote'
import 'bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.fr.js'
require('../../config');

function twitterCheck() {
    let checkbox = document.getElementById('twitterCheck');
    let div = document.getElementById('textTwitter');

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

function formatField() {
    $("#published_at").datetimepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd hh:ii:ss',
        language: moment.locale('fr')
    });

    $(".summernote").summernote({
        height: 400
    });

    let avatar = new KTAvatar('kt_user_avatar_1')
}

function postEditInfo() {
    let form = $("#formEditInfo");

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
                toastr.success("Les information usuel ont été mis à jour", "Succès")
            },
            error: function (jqxhr) {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de la mise à jours des informations usuel", "Erreur système");
                console.error(jqxhr)
            }
        })
    })
}

function postTwitterText() {
    let form = $("#formEditTwitter");

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
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn);
                    toastr.success("Les information de twitter ont été mis à jour", "Succès")
                },
                203: function (data) {
                    KTApp.unprogress(btn);
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de Validation")
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn);
                    toastr.error("Erreur lors de la mise à jours des informations de twitter", "Erreur système");
                    console.error(jqxhr)
                }
            }
        })
    })
}

function postEditContent() {
    let form = $("#formEditDescription");

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
                toastr.success("Les information de contenue ont été mis à jour", "Succès")
            },
            error: function (jqxhr) {
                KTApp.unprogress(btn);
                toastr.error("Erreur lors de la mise à jours des informations de contenue", "Erreur système");
                console.error(jqxhr)
            }
        })
    })
}

formatField();
twitterCheck();
postEditInfo();
postTwitterText();
postEditContent();




