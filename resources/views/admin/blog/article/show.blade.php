@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item kt-bg-light" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion des Articles </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Blog.index') }}" class="kt-subheader__breadcrumbs-link">Blog </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Blog.Article.index') }}" class="kt-subheader__breadcrumbs-link">Article </a>

                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Fiche d'un article</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Blog.Article.index') }}" class="btn btn-sm btn-default"><i class="la la-arrow-circle-left"></i> Retour</a>
                    @if($article->published == 0)
                        <a href="{{ route('Back.Blog.Article.edit', $article->id) }}" class="btn btn-sm btn-outline-brand"><i class="la la-edit"></i> Editer</a>
                        <a href="{{ route('Back.Blog.Article.delete', $article->id) }}" class="btn btn-sm btn-outline-danger"><i class="la la-trash"></i> Supprimer</a>
                        <button id="btnArticlePublish" class="btn btn-sm btn-outline-success"><i class="la la-check-circle"></i> Publier</button>
                    @else
                        <button id="btnArticleUnpublish" class="btn btn-sm btn-outline-danger"><i class="la la-times-circle"></i> Dépublier</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="article" data-id="{{ $article_id }}" data-publish="{{ $article->published }}"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                    <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides">
                        <h3 class="kt-widget19__title kt-font-light">

                        </h3>
                        <div class="kt-widget19__shadow"></div>
                        <div class="kt-widget19__labels">
                            <a href="#" class="btn btn-label-light-o2 btn-bold "></a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget19__wrapper">
                        <div class="kt-widget19__content">
                            <div class="kt-widget19__info">
                                <a href="#" class="kt-widget19__username">

                                </a>
                            </div>
                            <div class="kt-widget19__stats">
														<span class="kt-widget19__number kt-font-brand">

														</span>
                                <a href="#" class="kt-widget19__comment">
                                    Commentaires
                                </a>
                            </div>
                        </div>
                        <div class="kt-widget19__text">

                        </div>
                    </div>
                    <div class="kt-widget19__action">
                        <a href=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#comments" role="tab">
                                    <i class="fa fa-comments" aria-hidden="true"></i> {{ \App\HelpersClass\Blog\BlogHelper::countCommentWithArticle($article->id) }} Commentaires
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tags" role="tab">
                                    <i class="fa fa-tags" aria-hidden="true"></i>Tags
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="comments" role="tabpanel">
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" placeholder="Recherche..." id="searchComment">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                        <a data-toggle="modal" data-target="#addArticle" class="btn btn-default kt-hidden">
                                            <i class="la la-plus"></i> Nouvelle articles
                                        </a>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                    </div>
                                </div>
                            </div>

                            <div id="listeArticle"></div>
                        </div>
                        <div class="tab-pane" id="tags" role="tabpanel">
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" placeholder="Recherche..." id="searchTag">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                        <a data-toggle="modal" data-target="#addTag" class="btn btn-default kt-hidden-">
                                            <i class="la la-plus"></i> Nouveau Tag
                                        </a>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                    </div>
                                </div>
                            </div>

                            <div id="listeTag"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formAddTags" action="/api/admin/blog/article/{{ $article->id }}/tag" class="kt-form" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="tag" class="form-control" name="tags" placeholder="Tapez les tags à ajouté">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/blog/article/show.js') }}"></script>
@endsection
