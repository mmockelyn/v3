@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Edition: {{ $asset->designation }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Objet.index') }}" class="kt-subheader__breadcrumbs-link">Objet </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edition {{ $asset->designation }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Objet.Objet.show', $asset->id) }}" class="btn btn-sm btn-default"><i
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
                    <form action="/api/admin/objet/objet/{{ $asset->id }}/editInfo" class="kt-form" id="formEditInfo"
                          method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="designation">Désignation</label>
                            <input type="text" name="designation" class="form-control"
                                   value="{{ $asset->designation }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kuid">Kuid</label>
                                    <input type="text" name="kuid" class="form-control" value="{{ $asset->kuid }}"
                                           placeholder="<kuid:xxxx:xxx>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uuid">Uuid</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="uuid" value="{{ $asset->uuid }}"
                                               readonly disabled="disabled">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2" data-toggle="kt-tooltip"
                                                  title="Cette information est automatiquement attribuer à l'objet">
                                                <i class="fa fa-info-circle kt-font-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="downloadLink">Lien de téléchargement</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="downloadLink"
                                       value="{{ $asset->downloadLink }}" readonly disabled="disabled">
                                <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2" data-toggle="kt-tooltip"
                                                  title="Le lien est automatiquement mise à jours lors de l'envoie du fichier sur le serveur">
                                                <i class="fa fa-info-circle kt-font-info"></i>
                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Publier</label>
                            <div class="col-2">
                                <span class="kt-switch kt-switch--icon">
                                    <label>
                                        <input type="checkbox" @if($asset->published == 1) checked="checked"
                                               @endif name="published" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <label class="col-2 col-form-label">Social</label>
                            <div class="col-2">
                                <span class="kt-switch kt-switch--icon">
                                    <label>
                                        <input type="checkbox" @if($asset->social == 1) checked="checked"
                                               @endif name="social" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <label class="col-2 col-form-label">Mesh 3D</label>
                            <div class="col-2">
                                <span class="kt-switch kt-switch--icon">
                                    <label>
                                        <input type="checkbox" @if($asset->mesh == 1) checked="checked"
                                               @endif name="mesh" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <label class="col-2 col-form-label">Fichier de configuration</label>
                            <div class="col-2">
                                <span class="kt-switch kt-switch--icon">
                                    <label>
                                        <input type="checkbox" @if($asset->config == 1) checked="checked"
                                               @endif name="config" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <label class="col-2 col-form-label">Prix</label>
                            <div class="col-2">
                                <span class="kt-switch kt-switch--icon">
                                    <label>
                                        <input type="checkbox" id="pricingCheck"
                                               @if($asset->pricing == 1) checked="checked" @endif name="pricing"
                                               value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Courte description</label>
                            <textarea name="short_description" id="short_description" cols="30" rows="10"
                                      class="form-control summernote">{!! $asset->short_description !!}</textarea>
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
                    <form action="{{ route('Back.Objet.Objet.editThumb', $asset->id) }}" class="kt-form"
                          id="formEditThumb" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Thumbnail</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('download/'.$asset->id.'.png') == false)
                                        <div class="kt-avatar__holder"
                                             style="background-image: url(/storage/download/download.png)"></div>
                                    @else
                                        <div class="kt-avatar__holder"
                                             style="background-image: url(/storage/download/<?= $asset->id ?>.png)"></div>
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
            <div id="pricing" style="display: none;">
                <div class="form-group">
                    <label for="pricing">Prix de l'objet</label>
                    <input id="input_pricing" type="text" name="price" class="form-control" value="{{ $asset->price }}"
                           placeholder="Entrez le montant">
                    <span class="form-text text-muted">Veuillez entrer le montant en centimes (ex: 12,00 / 1200)</span>
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
            <form action="/api/admin/objet/objet/{{ $asset->id }}/editDescription" class="kt-form"
                  id="formEditDescription" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <textarea name="description" class="form-control summernote" cols="30"
                              rows="10">{!! $asset->description !!}</textarea>
                </div>
                <div class="kt-form__actions kt-form__actions--right">
                    <button type="submit" class="btn btn-sm btn-success"><i class="la la-check"></i> Valider</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/objet/objet/edit.js') }}"></script>
@endsection
