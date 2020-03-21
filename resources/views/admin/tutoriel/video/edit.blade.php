@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Edition du tutoriel: {{ $tutoriel->title }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Tutoriel.index') }}" class="kt-subheader__breadcrumbs-link">Tutoriel </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edition du tutoriel: {{ $tutoriel->title }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="tutoriel" data-id="{{ $tutoriel->id }}"></div>
    <div class="row">
        <div class="col-md-9">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Information Général
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form action="/api/admin/tutoriel/video/{{ $tutoriel->id }}/editInfo" class="kt-form"
                          id="formEditInfo" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" id="title" name="title" class="form-control"
                                   value="{{ $tutoriel->title }}">
                        </div>
                        <div class="form-group row">
                            <label for="published" class="col-md-2 col-form-label">Publier</label>
                            <div class="col-md-2">
                                <span class="kt-switch">
                                    <label>
                                        <input id="input_published" type="checkbox"
                                               @if($tutoriel->published == 1) checked="checked" @endif name="published"
                                               value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <label for="published" class="col-md-2 col-form-label">Source</label>
                            <div class="col-md-2">
                                <span class="kt-switch">
                                    <label>
                                        <input type="checkbox" @if($tutoriel->source == 1) checked="checked"
                                               @endif name="source" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <label for="published" class="col-md-2 col-form-label">Premium</label>
                            <div class="col-md-2">
                                <span class="kt-switch">
                                    <label>
                                        <input type="checkbox" @if($tutoriel->premium == 1) checked="checked"
                                               @endif name="premium" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <label for="published" class="col-md-2 col-form-label">Demo</label>
                            <div class="col-md-2">
                                <span class="kt-switch">
                                    <label>
                                        <input id="input_demo" type="checkbox"
                                               @if($tutoriel->demo == 1) checked="checked" @endif name="demo" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div id="published_at_field" class="form-group"
                             @if($tutoriel->published == 0) style="display: none" @else style="display: block" @endif>
                            <label for="published_at">Publier le</label>
                            <input type="text" id="published_at" name="published_at" class="form-control"
                                   value="{{ now() }}">
                        </div>
                        <div id="demo" class="form-group" @if($tutoriel->demo == 1) style="display: block"
                             @else style="display: none" @endif>
                            <label for="linkDemo">Lien Demo</label>
                            <input type="text" id="linkDemo" name="link_demo" class="form-control"
                                   value="{{ $tutoriel->linkDemo }}" placeholder="Lien de démo...">
                        </div>
                        <div class="form-group">
                            <label for="short_content">Courte description</label>
                            <textarea name="short_content" id="short_content" cols="30" rows="10"
                                      class="form-control summernote">{!! $tutoriel->short_content !!}</textarea>
                        </div>
                        <div class="kt-form__actions kt-form__actions--right">
                            <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Background
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form action="/administrator/tutoriel/video/{{ $tutoriel->id }}/editBackground" class="kt-form"
                          id="formEditBackground" method="post">
                        <div class="form-group">
                            @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('tutoriel/'.$tutoriel->id.'/background.png') == false)
                                <img src="https://picsum.photos/300/150" alt width="300" class="img-fluid">
                            @else
                                <img src="/storage/tutoriel/{{ $tutoriel->id }}/background.png" alt width="300"
                                     class="img-fluid">
                            @endif
                            <br>
                            <div class="dropzone dropzone-multi" id="fileBackground">
                                <div class="dropzone-panel">
                                    <a class="dropzone-select btn btn-label-brand btn-bold btn-sm">Envoyer</a>
                                </div>
                                <div class="dropzone-items">
                                    <div class="dropzone-item" style="display:none">
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                <span data-dz-name>some_image_file_name.jpg</span> <strong>(<span
                                                        data-dz-size>340kb</span>)</strong>
                                            </div>
                                            <div class="dropzone-error" data-dz-errormessage></div>
                                        </div>
                                        <div class="dropzone-progress">
                                            <div class="progress">
                                                <div class="progress-bar kt-bg-brand" role="progressbar"
                                                     aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                                                     data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-toolbar">
                                            <span class="dropzone-delete" data-dz-remove><i class="flaticon2-cross"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Banner
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form action="/administrator/tutoriel/video/{{ $tutoriel->id }}/editBanner" class="kt-form"
                          id="formEditBanner" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('tutoriel/'.$tutoriel->id.'/banner.png') == false)
                                <img src="https://picsum.photos/300/150" alt width="300" class="img-fluid">
                            @else
                                <img src="/storage/tutoriel/{{ $tutoriel->id }}/banner.png" alt width="300"
                                     class="img-fluid">
                            @endif
                            <div class="dropzone dropzone-multi" id="fileBanner">
                                <div class="dropzone-panel">
                                    <a class="dropzone-select btn btn-label-brand btn-bold btn-sm">Envoyer</a>
                                </div>
                                <div class="dropzone-items">
                                    <div class="dropzone-item" style="display:none">
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                <span data-dz-name>some_image_file_name.jpg</span> <strong>(<span
                                                        data-dz-size>340kb</span>)</strong>
                                            </div>
                                            <div class="dropzone-error" data-dz-errormessage></div>
                                        </div>
                                        <div class="dropzone-progress">
                                            <div class="progress">
                                                <div class="progress-bar kt-bg-brand" role="progressbar"
                                                     aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                                                     data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-toolbar">
                                            <span class="dropzone-delete" data-dz-remove><i class="flaticon2-cross"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
            <form action="/api/admin/tutoriel/video/{{ $tutoriel->id }}/editDescription" class="kt-form"
                  id="formEditDescription" method="post">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <textarea name="contents" id="contents" cols="30" rows="10"
                              class="form-control summernote">{{ $tutoriel->content }}</textarea>
                </div>
                <div class="kt-form__actions kt-form__actions--right">
                    <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/tutoriel/video/edit.js') }}"></script>
@endsection
