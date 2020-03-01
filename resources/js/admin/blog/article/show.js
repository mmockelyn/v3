import KTDatatable from '../../../../demo5/src/assets/js/global/components/base/datatable/core.datatable.js'
import {blockElement, unblockElement} from '../../../core'
import Tagify from '@yaireo/tagify'
const swal = require('sweetalert2')

let article = $("#article")
let article_id = article.attr('data-id')
let article_publish = article.attr('data-publish')

function loadPic() {
    let div = document.querySelector('.kt-widget19__pic')

    blockElement(div, "Chargement...")

    $.get('/api/admin/blog/article/'+article_id)
        .done((data) => {
            unblockElement(div)
            div.style.minHeight = "300px"
            div.style.background = `url(${data.data.img})`
            let element = $('.kt-widget19__pic')
            element.find('.kt-widget19__title').html(data.data.data.title)
            let label = element.find('.kt-widget19__labels')
            label.find('.btn').removeClass('btn-label-light-o2')

            if(data.data.data.published === 1) {
                label.find('.btn').addClass('btn-label-success')
                label.find('.btn').html('Publier')
            } else {
                label.find('.btn').addClass('btn-label-danger')
                label.find('.btn').html('Non publier')
            }

            $(".kt-widget19__username").html(data.data.category)
            $(".kt-widget19__number").html(data.data.countComment)
            $(".kt-widget19__text").html(data.data.data.short_content)

            let action = $(".kt-widget19__action")
            if(data.data.data.published === 1) {
                action.find('a').attr('href', '/blog/'+data.data.data.slug).attr('target', '_blank').html('Voir sur le site').addClass('btn btn-outline-info btn-sm btn-block')
            }else{
                action.find('a').remove()
            }
        })

}

function publish() {
    let btn = document.querySelector('#btnArticlePublish')

    btn.addEventListener('click', function (e) {
        e.preventDefault()

        KTApp.progress(btn)

        $.get('/api/admin/blog/article/'+article_id+'/verifPublish')
            .done((data) => {
                if(data.data.result === 'false') {
                    swal.fire({
                        title: "Impossible de publier l'article",
                        type: 'error',
                        html: `<div class="text-left"><ul>${data.data.content}</ul></div>`
                    })
                } else {
                    $.get('/api/admin/blog/article/'+article_id+'/publish')
                        .done((data) => {
                            KTApp.unprogress(btn)
                            toastr.success("L'article à été publier", "Succès")
                            setTimeout(function (e) {
                                window.location.reload()
                            }, 1200)
                        })
                        .fail((jqxhr) => {
                            KTApp.unprogress(btn)
                            toastr.error("Erreur lors de la publication de l'article", "Erreur Système")
                        })
                }
            })
    })
}

function unpublish() {
    let btn = document.querySelector('#btnArticleUnpublish')

    btn.addEventListener('click', function (e) {
        e.preventDefault()

        KTApp.progress(btn)

        $.get('/api/admin/blog/article/'+article_id+'/unpublish')
            .done((data) => {
                KTApp.unprogress(btn)
                toastr.success("L'article à été dépublier", "Succès")
                setTimeout(function (e) {
                    window.location.reload()
                }, 1200)
            })
            .fail((jqxhr) => {
                KTApp.unprogress(btn)
                toastr.error("Erreur lors de la dépublication de l'article", "Erreur Système")
            })
    })
}

function loadComment() {
    let table = $("#listeArticle").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/blog/article/'+article_id+'/comment/load',
                    // sample custom headers
                    // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                    map: function (raw) {
                        // sample data mapping
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },
        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#searchComment'),
        },
        columns: [
            {
                field: 'id',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                textAlign: 'center',
                autoHide: false
            },
            {
                field: 'user',
                title: "Auteur",
                sortable: 'asc',
                autoHide: false,
                width: 400,
                template: function (row) {
                    return `
<div class="row">
    <div class="col-md-2">${row.img}</div>
    <div class="col-md-10">
        <strong>${row.user.name}</strong><br>
        <i>${row.user.email}</i>
    </div>
</div>`
                }
            },
            {
                field: 'state',
                title: 'Etat',
                sortable: false,
                width: 50,
                textAlign: 'center',
                autoHide: false,
                template: function (row) {

                    if(row.state === 0) {
                        return `<i class="la la-circle la-lg kt-font-danger"></i>`
                    }else {
                        return `<i class="la la-circle la-lg kt-font-success"></i>`
                    }
                }
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                textAlign: 'right',
                autoHide: false,
                template: function (row) {
                    if(row.state === 0) {
                        return `<a href="/api/admin/blog/article/${article_id}/comment/${row.id}/publish" class="btn btn-sm btn-icon btn-success" data-toggle="kt-tooltip" title="Publier le commentaire"><i class="la la-check-circle"></i> </a>`
                    } else {
                        return `<a href="/api/admin/blog/article/${article_id}/comment/${row.id}/unpublish" class="btn btn-sm btn-icon btn-danger" data-toggle="kt-tooltip" title="Dépublier le commentaire"><i class="la la-times-circle"></i> </a>`
                    }
                }
            },
            {
                field: 'comment',
                title: 'Commentaire',
                autoHide: true,
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des commentaires...',
                noRecords: 'Aucun commentaire',
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'Premier',
                            prev: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier',
                            more: 'Plus',
                            input: 'Numéro de page',
                            select: 'Sélectionnez la taille de la page',
                        },
                        info: "Affichage de l'élément {{start}} à {{end}} sur {{total}} éléments",
                        infoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément"
                    },
                },
            },
        },
    });
}

function loadTag() {
    let table = $("#listeTag").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/admin/blog/article/'+article_id+'/tag/load',
                    // sample custom headers
                    // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                    map: function (raw) {
                        // sample data mapping
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },
        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#searchComment'),
        },
        columns: [
            {
                field: 'id',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                textAlign: 'center',
                autoHide: false
            },
            {
                field: 'name',
                title: "Tag",
                autoHide: false
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                textAlign: 'right',
                autoHide: false,
                template: function (row) {
                    return `<a href="/api/admin/blog/article/${article_id}/tag/${row.id}/delete" class="btn btn-icon btn-sm btn-danger" data-toggle="kt-tooltip" title="Supprimer le tag"><i class="la la-trash"></i> </a>`
                }
            }
        ],
        translate: {
            records: {
                processing: 'Chargement des Tags...',
                noRecords: 'Aucun tag',
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'Premier',
                            prev: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier',
                            more: 'Plus',
                            input: 'Numéro de page',
                            select: 'Sélectionnez la taille de la page',
                        },
                        info: "Affichage de l'élément {{start}} à {{end}} sur {{total}} éléments",
                        infoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément"
                    },
                },
            },
        },
    });
}

function postTags() {
    let form = $("#formAddTags")

    form.on('submit', function (e) {
        e.preventDefault()
        let btn = form.find('button')
        let url = form.attr('action')
        let data = form.serializeArray()

        KTApp.progress(btn)

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: function (data) {
                    KTApp.unprogress(btn)
                    toastr.success("Le ou les tags ont été ajoutés avec succès", "Succès")
                    /*setTimeout(function () {
                        window.location.reload()
                    }, 1200)*/
                },
                203: function (data) {
                    KTApp.unprogress(btn)
                    Array.from(data.data.errors).forEach((error) => {
                        toastr.warning(error, "Erreur de validation")
                    })
                },
                500: function (jqxhr) {
                    KTApp.unprogress(btn)
                    toastr.error("Erreur lors de l'ajout de tag à l'article", "Erreur Système")
                    console.error(jqxhr)
                }
            }
        })
    })
}

loadPic()
loadComment()
loadTag()
postTags()
if(article_publish === '1') {
    unpublish()
} else if(article_publish === '0') {
    publish()
}else{

}

let input = document.querySelector('#tag');
new Tagify(input)

