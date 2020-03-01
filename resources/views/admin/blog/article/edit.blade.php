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

                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edition de l'article: {{ $article->title }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Blog.Article.show', $article->id) }}" class="btn btn-sm btn-default"><i class="la la-arrow-circle-left"></i> Retour</a>
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
                <form action="/api/admin/blog/article/{{ $article->id }}/editInfo" class="kt-form" id="formEditInfo" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Titre de l'article</label>
                                <input type="text" id="title" class="form-control" name="title" value="{{ $article->title }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Titre de l'article</label>
                                <input type="text" id="slug" class="form-control" name="slug" value="{{ $article->slug }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Catégorie</label>
                                <select name="category_id" id="category" class="form-control selectpicker">
                                    <option value="{{ $article->categorie_id }}">{{ $article->category->name }}</option>
                                    <option value="" readonly="">&nbsp;</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-marginless">
                                <label for="published_at">Date de Publication</label>
                                <div class="input-group">
                                    <input type="text" id="published_at" name="published_at" class="form-control" value="{{ $article->published_at }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Publier</label>
                        <div class="col-2">
							<span class="kt-switch kt-switch--icon">
								<label>
									<input type="checkbox" @if($article->published == 1) checked="checked" @endif name="published" value="1">
									<span></span>
								</label>
							</span>
                        </div>
                        <label class="col-2 col-form-label">Twitter</label>
                        <div class="col-2">
							<span class="kt-switch kt-switch--icon">
								<label>
									<input id="twitterCheck" type="checkbox" @if($article->twitter == 1) checked="checked" @endif name="twitter">
									<span></span>
								</label>
							</span>
                        </div>
                        <label class="col-2 col-form-label">Facebook</label>
                        <div class="col-2">
							<span class="kt-switch kt-switch--icon">
								<label>
									<input id="facebookCheck" type="checkbox" @if($article->facebook == 1) checked="checked" @endif name="facebook">
									<span></span>
								</label>
							</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_content">Courte description</label>
                        <textarea name="short_content" class="form-control summernote" style="height: 120px;">{!! $article->short_content !!}</textarea>
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
                <form action="/api/admin/blog/article/{{ $article->id }}/editThumbnail" class="kt-form" id="formEditThumb" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Thumbnail</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('blog/'.$article->id.'.png') == false)
                                    <div class="kt-avatar__holder" style="background-image: url(/storage/blog/news.png)"></div>
                                @else
                                    <div class="kt-avatar__holder" style="background-image: url(/storage/blog/<?= $article->id ?>.png)"></div>
                                @endif
                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Changez l'image">
                                    <i class="fa fa-pen"></i>
                                    <input type="file" name="images" accept=".png, .jpg, .jpeg">
                                </label>
                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Supprimer l'image">
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
        <div id="textTwitter" style="display: none;">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Texte à publier sur twitter
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form action="/api/admin/blog/article/{{ $article->id }}/textTwitter" class="kt-form" id="formEditTwitter" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <textarea name="twitterText" class="form-control" rows="10">{{ $article->twitterText }}</textarea>
                        </div>
                        <div class="kt-form__actions kt-form__actions--right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="la la-check"></i> Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Description
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <form action="/api/admin/blog/article/{{ $article->id }}/editDescription" class="kt-form" id="formEditDescription" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea name="content" class="form-control summernote" cols="30" rows="10">{!! $article->content !!}</textarea>
            </div>
            <div class="kt-form__actions kt-form__actions--right">
                <button type="submit" class="btn btn-sm btn-success"><i class="la la-check"></i> Valider</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section("script")
    @toastr_render
    <script src="{{ asset('js/admin/blog/article/edit.js') }}"></script>
@endsection
