@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item kt-bg-light" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $article->title }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Wiki.index') }}" class="kt-subheader__breadcrumbs-link">Wiki </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $article->title }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Wiki.Article.index') }}" class="btn btn-sm btn-default"><i
                            class="la la-arrow-circle-left"></i> Retour</a>
                    @if($article->published == 0)
                        <a href="{{ route('Back.Wiki.Article.edit', $article->id) }}"
                           class="btn btn-sm btn-outline-info"><i class="la la-edit"></i> Editer</a>
                        <a href="{{ route('Back.Wiki.Article.delete', $article->id) }}"
                           class="btn btn-sm btn-outline-danger"><i class="la la-trash"></i> Supprimer</a>
                        <button id="btnPublishArticle" class="btn btn-sm btn-icon btn-outline-success"
                                data-toggle="kt-tooltip"
                                title="Publier l'article"><i class="la la-check"></i></button>
                    @else
                        <button id="btnUnpublishArticle" class="btn btn-sm btn-icon btn-outline-danger"
                                data-toggle="kt-tooltip"
                                title="Dépublier l'article"><i class="la la-times"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="article" data-id="{{ $article->id }}"></div>
    <div class="row">
        <div class="col-md-4">
            <div
                class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__space-x">

                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget27">
                        <div class="kt-widget27__visual">
                            @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('wiki/'.$article->id.'.png') == true)
                                <img src="/storage/wiki/{{ $article->id }}.png" alt="">
                            @else
                                <img src="/storage/wiki/wiki.png" alt="">
                            @endif
                            <div class="kt-widget27__btn">
                                <a href="{{ route('Front.Wiki.show', [$article->category->id, $article->subcategory->id, $article->id]) }}"
                                   class="btn btn-pill btn-light btn-elevate btn-bold">Voir sur le frontend</a>
                            </div>
                        </div>
                        <div id="asset_block" class="kt-widget27__container kt-portlet__space-x">
                            <div class="text-center mb-5">
                                <h3 id="asset_title" class="kt-font-bold"></h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <td class="kt-font-bold">Catégorie:</td>
                                    <td id="asset_category" class="text-right">{{ $article->category->name }}
                                        - {{ $article->subcategory->name }}</td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Publier:</td>
                                    <td id="asset_publish" class="text-right">
                                        @if($article->published == 0)
                                            <span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--danger"><i
                                                    class="la la-times-circle"></i> Non Publier</span>
                                        @else
                                            <span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--success"><i
                                                    class="la la-check-circle"></i> Publier</span><br>
                                            {{ $article->published_at->diffForHumans() }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#vue" role="tab">
                                    <i class="la la-circle-o-notch"></i> Vue
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#config" role="tab">
                                    <i class="la la-cog"></i> Configuration
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="vue" role="tabpanel">
                            <div class="row" data-sticky-container>
                                <div class="col-md-3">
                                    <div class="kt-portlet sticky" data-sticky="true" data-margin-top="100px"
                                         data-sticky-for="1023" data-sticky-class="kt-sticky">
                                        <div class="kt-portlet__body kt-portlet__body--fit">
                                            <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3 kt-margin-t-20 kt-margin-b-20 nav nav-tabs"
                                                role="tablist">
                                                @foreach($article->sommaires as $sommaire)
                                                    <li class="kt-nav__item">
                                                        <a class="kt-nav__link active" data-toggle="tab"
                                                           href="#{{ \Illuminate\Support\Str::slug($sommaire->title) }}"
                                                           role="tab">
                                                            <span
                                                                class="kt-nav__link-text">{{ $sommaire->title }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    @foreach($sommaires as $sommaire)
                                        <div id="{{ \Illuminate\Support\Str::slug($sommaire->title) }}">
                                            {!! \App\HelpersClass\Wiki\WikiHelpers::getContentFromSommaire($sommaire->id, 'content') !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="config" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Configuration
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-actions">
                                            <a data-toggle="modal" href="#addContent"
                                               class="btn btn-clean btn-sm btn-icon btn-icon-md">
                                                <i class="flaticon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td>Sommaire</td>
                                            <td>Contenue</td>
                                            <td>Actions</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($article->sommaires as $sommaire)
                                            <tr>
                                                <td>{{ $sommaire->title }}</td>
                                                <td>
                                                    {!! \App\HelpersClass\Wiki\WikiHelpers::getContentFromSommaire($sommaire->id, 'content') !!}
                                                </td>
                                                <td>
                                                    <a href="/administrator/wiki/article/{{ $article->id }}/{{ $sommaire->id }}/delete"
                                                       class="btn btn-icon btn-danger" data-toggle="kt-tooltip"
                                                       title="Supprimer"><i class="la la-trash-o"></i> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouveau contenue
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/wiki/article/{{ $article->id }}/addContent" class="kt-form" id="formAddContent"
                      method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Titre du sommaire</label>
                            <input type="text" id="title" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="content">Contenue</label>
                            <textarea name="contents" id="content" cols="30" rows="10"
                                      class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-circle"></i> Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/wiki/article/show.js') }}"></script>
@endsection
