const fancybox = require('fancybox/dist/js/jquery.fancybox')
let route = $("#route")
let route_id = route.attr('data-id')
function uploadFile() {
    $(".dropzone").dropzone({
        url: '/api/admin/route/'+route_id+'/gallery/uploadFile',
        paramName: 'file',
        addRemoveLinks: true,
        acceptedFiles: "image/*",
        success: function (data) {
            toastr.success("Le fichier <strong>"+data.name+"</strong> à été uploader")
        }
    })
}



uploadFile()
