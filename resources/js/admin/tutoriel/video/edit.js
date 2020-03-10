const moment = require('moment');

let tutoriel = $("#tutoriel");
let tutoriel_id = tutoriel.attr('data-id');

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
                    toastr.success("Les informations du tutoriel ont été editer avec succès", "Succès");
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

function editBackground() {
    // set the dropzone container id
    var id = '#fileBackground';

    // set the preview element template
    var previewNode = $(id + " .dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parent('.dropzone-items').html();
    previewNode.remove();

    var myDropzone5 = new Dropzone(id, { // Make the whole body a dropzone
        url: "/api/admin/tutoriel/video/" + tutoriel_id + "/editBackground", // Set the url for your upload script location
        parallelUploads: 20,
        maxFiles: 1,
        maxFilesize: 3, // Max filesize in MB
        paramName: 'file',
        previewTemplate: previewTemplate,
        previewsContainer: id + " .dropzone-items", // Define the container to display the previews
        clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
    });

    myDropzone5.on("addedfile", function (file) {
        // Hookup the start button
        $(document).find(id + ' .dropzone-item').css('display', '');
    });

    // Update the total progress bar
    myDropzone5.on("totaluploadprogress", function (progress) {
        $(id + " .progress-bar").css('width', progress + "%");
    });

    myDropzone5.on("sending", function (file) {
        // Show the total progress bar when upload starts
        $(id + " .progress-bar").css('opacity', "1");
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone5.on("complete", function (progress) {
        var thisProgressBar = id + " .dz-complete";
        setTimeout(function () {
            $(thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
        }, 300)
    });
}

function editBanner() {
    // set the dropzone container id
    var id = '#fileBanner';

    // set the preview element template
    var previewNode = $(id + " .dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parent('.dropzone-items').html();
    previewNode.remove();

    var myDropzone5 = new Dropzone(id, { // Make the whole body a dropzone
        url: "/api/admin/tutoriel/video/" + tutoriel_id + "/editBanner", // Set the url for your upload script location
        parallelUploads: 20,
        maxFiles: 1,
        maxFilesize: 3, // Max filesize in MB
        paramName: 'file',
        previewTemplate: previewTemplate,
        previewsContainer: id + " .dropzone-items", // Define the container to display the previews
        clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
    });

    myDropzone5.on("addedfile", function (file) {
        // Hookup the start button
        $(document).find(id + ' .dropzone-item').css('display', '');
    });

    // Update the total progress bar
    myDropzone5.on("totaluploadprogress", function (progress) {
        $(id + " .progress-bar").css('width', progress + "%");
    });

    myDropzone5.on("sending", function (file) {
        // Show the total progress bar when upload starts
        $(id + " .progress-bar").css('opacity', "1");
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone5.on("complete", function (progress) {
        var thisProgressBar = id + " .dz-complete";
        setTimeout(function () {
            $(thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
        }, 300)
    });
}

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
                    toastr.success("La description du tutoriel à été mise à jours", "Succès")
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

function demoCheck() {
    let checkbox = document.getElementById('input_demo');
    let div = document.getElementById('demo');

    checkbox.addEventListener('change', function (e) {
        if (checkbox.checked === true) {
            console.log('checked');
            div.style.display = 'block'
        } else {
            console.log('None');
            div.style.display = 'none'
        }
    })
}

function publishedCheck() {
    let checkbox = document.getElementById('input_published');
    let div = document.getElementById('published_at_field');

    checkbox.addEventListener('change', function (e) {
        if (checkbox.checked === true) {
            console.log('checked');
            div.style.display = 'block'
        } else {
            console.log('None');
            div.style.display = 'none'
        }
    })
}

demoCheck();
publishedCheck();
formEditDescription();
formEditInfo();
editBackground();
editBanner();

$(".summernote").summernote();
$('#published_at').datetimepicker({
    todayHighlight: true,
    autoclose: true,
    format: 'yyyy-mm-dd hh:ii',
    language: moment.locale('fr')
});
