@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item kt-bg-light" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Edition: {{ $article->title }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Wiki.index') }}" class="kt-subheader__breadcrumbs-link">Wiki </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edition: {{ $article->title }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Wiki.Article.index') }}" class="btn btn-sm btn-default"><i
                            class="la la-arrow-circle-left"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div class="row">
        <div class="col-md-8">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <form action="/api/admin/wiki/article/{{ $article->id }}/editInfo" class="kt-form" id="formEditInfo"
                          method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="title">Titre de l'article</label>
                            <input type="text" id="title" class="form-control" name="title"
                                   value="{{ $article->title }}">
                        </div>
                        <div class="form-group row">
                            <label for="published" class="col-md-2 col-form-label">Publier</label>
                            <div class="col-md-2">
                                <span class="kt-switch">
                                    <label>
                                        <input id="published" type="checkbox"
                                               @if($article->published == 1) checked="checked" @endif name="published"
                                               value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="kt-form__actions kt-form__actions--right">
                            <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <form action="{{ route('Back.Wiki.Article.editThumb', $article->id) }}" class="kt-form"
                          id="formEditThumb" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Thumbnail</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('wiki/'.$article->id.'.png') == false)
                                        <div class="kt-avatar__holder"
                                             style="background-image: url(/storage/wiki/wiki.png)"></div>
                                    @else
                                        <div class="kt-avatar__holder"
                                             style="background-image: url(/storage/wiki/<?= $article->id ?>.png)"></div>
                                    @endif
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                                           data-original-title="Changez l'image">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="images" accept=".png, .jpg, .jpeg">
                                    </label>
                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title=""
                                          data-original-title="Supprimer l'image">
															<i class="fa fa-times"></i>
														</span>
                                </div>
                                <span class="form-text text-muted">Fichier autorisé: png, jpg, jpeg.</span>
                            </div>
                        </div>
                        <div class="kt-form__actions kt-form__actions--right">
                            <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/wiki/article/edit.js') }}"></script>
@endsection
