@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item kt-bg-light" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $asset->designation }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Objet.index') }}" class="kt-subheader__breadcrumbs-link">Objet </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $asset->designation }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Objet.Objet.index') }}" class="btn btn-sm btn-default"><i
                            class="la la-arrow-circle-left"></i> Retour</a>
                    @if($asset->published == 0)
                        <a href="{{ route('Back.Objet.Objet.edit', $asset->id) }}"
                           class="btn btn-sm btn-outline-info"><i class="la la-edit"></i> Editer</a>
                        <a href="{{ route('Back.Objet.Objet.delete', $asset->id) }}"
                           class="btn btn-sm btn-outline-danger"><i class="la la-trash"></i> Supprimer</a>
                        <button id="btnPublishAsset" class="btn btn-sm btn-icon btn-outline-success"
                                data-toggle="kt-tooltip"
                                title="Publier l'objet"><i class="la la-check"></i></button>
                    @else
                        <button id="btnUnpublishAsset" class="btn btn-sm btn-icon btn-outline-danger"
                                data-toggle="kt-tooltip"
                                title="Dépublier l'objet"><i class="la la-times"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="asset" data-id="{{ $asset->id }}"></div>
    @if(\Illuminate\Support\Facades\Storage::disk('sftp')->exists('download/'.$asset->id.'/'.$asset->uuid.'.zip') == false ||
\Illuminate\Support\Facades\Storage::disk('sftp')->exists('download/'.$asset->id.'/fbx/lod0n.FBX') == false ||
\Illuminate\Support\Facades\Storage::disk('sftp')->exists('download/'.$asset->id.'/config/config.txt') == false ||
\Illuminate\Support\Facades\Storage::disk('public')->exists('download/'.$asset->id.'.png') == false ||
$asset->short_description == $asset->description || $asset->short_description == null || $asset->description == null ||
count($asset->tags) == 0 ||
count($asset->compatibilities) == 0)
        <div class="kt-portlet">
            <div class="kt-portlet__head kt-bg-warning">
                <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-tasks"></i>
					</span>
                    <h3 class="kt-portlet__head-title">
                        Liste des taches de cette objet
                    </h3>
                </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-widget4">
                @if(\Illuminate\Support\Facades\Storage::disk('sftp')->exists('download/'.$asset->id.'/'.$asset->uuid.'.zip') == false)
                    <div class="kt-widget4__item">
                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                            <i class="la la-times-circle kt-font-danger la-2x"></i>
                        </div>
                        <div class="kt-widget4__info">
                            <a href="#" class="kt-widget4__username">
                                Fichier CDP
                            </a>
                            <p class="kt-widget4__text">
                                Le fichier à télécharger n'est pas disponible sur le serveur.<br>Veuillez envoyer le
                                fichier
                            </p>
                        </div>
                        <a data-toggle="modal" data-target="#downloadFile" class="btn btn-sm btn-label-danger btn-bold">Envoyer</a>
                    </div>
                @endif
                @if($asset->mesh == 1)
                    @if(\Illuminate\Support\Facades\Storage::disk('sftp')->exists('download/'.$asset->id.'/fbx/lod0n.FBX') == false)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-times-circle kt-font-danger la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Fichier FBX
                                </a>
                                <p class="kt-widget4__text">
                                    La prise en charge de fichier FBX est instruite sur <strong>on</strong> pour cette
                                    objet mais aucun fichier n'est disponible sur le serveur.
                                </p>
                            </div>
                            <a data-toggle="modal" data-target="#uploadFbx"
                               class="btn btn-sm btn-label-danger btn-bold">Envoyer</a>
                        </div>
                    @endif
                @endif
                @if($asset->config == 1)
                    @if(\Illuminate\Support\Facades\Storage::disk('sftp')->exists('download/'.$asset->id.'/config/config.txt') == false)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-times-circle kt-font-danger la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Fichier Config
                                </a>
                                <p class="kt-widget4__text">
                                    La prise en charge de fichier Config est instruite sur <strong>on</strong> pour
                                    cette objet mais aucun fichier n'est disponible sur le serveur.
                                </p>
                            </div>
                            <a data-toggle="modal" data-target="#uploadConfigFile"
                               class="btn btn-sm btn-label-danger btn-bold">Envoyer</a>
                        </div>
                    @endif
                @endif
                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('download/'.$asset->id.'.png') == false)
                    <div class="kt-widget4__item">
                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                            <i class="la la-times-circle kt-font-danger la-2x"></i>
                        </div>
                        <div class="kt-widget4__info">
                            <a href="#" class="kt-widget4__username">
                                Image de l'objet
                            </a>
                            <p class="kt-widget4__text">
                                L'image de présentation de l'objets n'est pas présente.<br>Veuillez la définir
                            </p>
                        </div>
                        <a href="{{ route('Back.Objet.Objet.edit', $asset->id) }}"
                           class="btn btn-sm btn-label-danger btn-bold">Editer</a>
                    </div>
                @endif
                @if($asset->short_description == $asset->description || $asset->short_description == null || $asset->description == null)

                @endif
                @if($asset->description == null)
                    <div class="kt-widget4__item">
                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                            <i class="la la-warning kt-font-warning la-2x"></i>
                        </div>
                        <div class="kt-widget4__info">
                            <a href="#" class="kt-widget4__username">
                                Description de l'objet
                            </a>
                            <p class="kt-widget4__text">
                                La description n'est pas définie.<br>Veuillez changer la description
                            </p>
                        </div>
                        <a href="{{ route('Back.Objet.Objet.edit', $asset->id) }}"
                           class="btn btn-sm btn-label-warning btn-bold">Editer</a>
                    </div>
                @endif
                @if($asset->short_description == null)
                    <div class="kt-widget4__item">
                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                            <i class="la la-warning kt-font-warning la-2x"></i>
                        </div>
                        <div class="kt-widget4__info">
                            <a href="#" class="kt-widget4__username">
                                Description de l'objet
                            </a>
                            <p class="kt-widget4__text">
                                La description courte n'est pas définie.<br>Veuillez changer la description courte
                            </p>
                        </div>
                        <a href="{{ route('Back.Objet.Objet.edit', $asset->id) }}"
                           class="btn btn-sm btn-label-warning btn-bold">Editer</a>
                    </div>
                @endif
                @if(count($asset->tags) == 0)
                    <div class="kt-widget4__item">
                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                            <i class="la la-warning kt-font-warning la-2x"></i>
                        </div>
                        <div class="kt-widget4__info">
                            <a href="#" class="kt-widget4__username">
                                Tag
                            </a>
                            <p class="kt-widget4__text">
                                Aucun tag n'à été définie pour cette objet.<br>Cela peut nuire à l'indexaction de la
                                zone de recherche
                            </p>
                        </div>
                    </div>
                @endif
                @if(count($asset->compatibilities) == 0)
                    <div class="kt-widget4__item">
                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                            <i class="la la-warning kt-font-warning la-2x"></i>
                        </div>
                        <div class="kt-widget4__info">
                            <a href="#" class="kt-widget4__username">
                                Compatibilité
                            </a>
                            <p class="kt-widget4__text">
                                Aucune information de compatibilité n'ont été définie pour cette objet.<br>Cela peut
                                induire les utilisateur en erreur lors du téléchargement de l'objet
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div
                class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__space-x">

                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget27">
                        <div class="kt-widget27__visual">
                            @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('download/'.$asset->id.'.png') == true)
                                <img src="/storage/download/{{ $asset->id }}.png" alt="">
                            @else
                                <img src="/storage/download/download.png" alt="">
                            @endif
                            <div class="kt-widget27__btn">
                                <a href="{{ route('Front.Download.show', [$asset->category->id, $asset->subcategory->id, $asset->id]) }}"
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
                                    <td id="asset_category" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Kuid:</td>
                                    <td id="asset_kuid" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Publier:</td>
                                    <td id="asset_publish" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Prix:</td>
                                    <td id="asset_price" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Nombre de téléchargement:</td>
                                    <td id="asset_downloaded" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <span id="asset_social" class="iconify" data-inline="false"
                                              data-icon="brandico:facebook-rect" style="font-size: 39px;"></span>
                                        <span id="asset_mesh" class="iconify" data-inline="false"
                                              data-icon="mdi:video-3d" style="font-size: 39px;"></span>
                                        <span id="asset_config" class="iconify" data-inline="false"
                                              data-icon="ant-design:setting-filled" style="font-size: 39px;"></span>
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
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">
                                    <i class="la la-file"></i> Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#compatibilite" role="tab">
                                    <i class="la la-code-fork"></i> Compatibilité
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tags" role="tab">
                                    <i class="la la-tags"></i> Tags
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    {!! $asset->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="compatibilite" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Liste des compatibilités
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-actions">
                                            <button data-toggle="modal" data-target="#addCompatibility"
                                                    class="btn btn-sm btn-outline-info"><i class="la la-plus"></i>
                                                Nouvelle compatibilité
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div id="listeCompatibilities" class="kt-datatable"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tags" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Liste des tags
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-actions">
                                            <button data-toggle="modal" data-target="#addTag"
                                                    class="btn btn-sm btn-outline-info"><i class="la la-plus"></i>
                                                Nouveau tag
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div id="listeTag" class="kt-datatable"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCompatibility" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouvelle
                        compatibilité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/objet/objet/{{ $asset->id }}/compatibility" class="kt-form"
                      id="formAddCompatibility" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="trainz_build_id">Trainz Build</label>
                            <select class="form-control selectpicker" id="trainz_build_id" name="trainz_build_id">
                                <option value=""></option>
                                @foreach($builds as $build)
                                    <option value="{{ $build->id }}">{{ $build->trainz_version_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">Etat de compatibilite</label>
                            <select class="form-control selectpicker" id="state" name="state">
                                <option value=""></option>
                                <option value="0">Non compatible</option>
                                <option value="1">Compatibilité restreinte</option>
                                <option value="2">Compatible</option>
                            </select>
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
    <div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouveau tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/objet/objet/{{ $asset->id }}/tag" class="kt-form" id="formAddTag"
                      method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="tag" class="form-control" name="tags"
                                   placeholder="Tapez les tags à ajouter">
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
    <div class="modal fade" id="downloadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout du fichier de téléchargement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="" class="kt-form dropzone dropzone-default dropzone-brand" id="formDownloadFile">
                    <div class="modal-body">
                        <input type="hidden" id="asset_id" name="id" value="{{ $asset->id }}">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Déposez des fichiers ici ou cliquez pour télécharger.</h3>
                            <span class="dropzone-msg-desc">Aucune limitation de taille de fichier</span><br>
                            <span class="dropzone-msg-desc">Fichier cdp uniquement (jpg,jpeg,png,bmp,etc...)</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadFbx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout du fichier de modèle 3D</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="" class="kt-form dropzone dropzone-default dropzone-brand" id="formUploadFbx">
                    <div class="alert alert-info fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                        <div class="alert-text">
                            Veillez à envoyer un zip contenant:
                            <ul>
                                <li>Le fichier FBX</li>
                                <li>Tous les images au format TGA</li>
                            </ul>
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="asset_id" name="id" value="{{ $asset->id }}">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Déposez des fichiers ici ou cliquez pour télécharger.</h3>
                            <span class="dropzone-msg-desc">Aucune limitation de taille de fichier</span><br>
                            <span class="dropzone-msg-desc">Fichier zip uniquement (jpg,jpeg,png,bmp,etc...)</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadConfigFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout du fichier de configuration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="" class="kt-form dropzone dropzone-default dropzone-brand" id="formUploadConfig">
                    <div class="modal-body">
                        <input type="hidden" id="asset_id" name="id" value="{{ $asset->id }}">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Déposez des fichiers ici ou cliquez pour télécharger.</h3>
                            <span class="dropzone-msg-desc">Aucune limitation de taille de fichier</span><br>
                            <span class="dropzone-msg-desc">Fichier txt uniquement</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/objet/objet/show.js') }}"></script>
@endsection
