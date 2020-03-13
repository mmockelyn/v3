@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $tutoriel->title }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Tutoriel.index') }}" class="kt-subheader__breadcrumbs-link">Tutoriel </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $tutoriel->title }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Tutoriel.Video.index') }}" class="btn btn-sm btn-default"><i
                            class="la la-arrow-circle-left"></i> Retour</a>
                    @if($tutoriel->published == 0)
                        <a href="{{ route('Back.Tutoriel.Video.edit', $tutoriel->id) }}"
                           class="btn btn-sm btn-outline-info"><i class="la la-edit"></i> Editer</a>
                        <a href="{{ route('Back.Tutoriel.Video.delete', $tutoriel->id) }}"
                           class="btn btn-sm btn-outline-danger"><i class="la la-trash"></i> Supprimer</a>
                        <button data-toggle="modal" data-target="#btnPublishLater"
                                class="btn btn-sm btn-outline-warning"><i class="la la-clock-o"></i> Planifier
                        </button>
                        <button id="btnPublish" class="btn btn-sm btn-outline-success"><i class="la la-check"></i>
                            Publier
                        </button>
                    @elseif($tutoriel->published == 2)
                        <a href="{{ route('Back.Tutoriel.Video.edit', $tutoriel->id) }}"
                           class="btn btn-sm btn-outline-info"><i class="la la-edit"></i> Editer</a>
                        <a href="{{ route('Back.Tutoriel.Video.delete', $tutoriel->id) }}"
                           class="btn btn-sm btn-outline-danger"><i class="la la-trash"></i> Supprimer</a>
                        <button id="btnUnpublish" class="btn btn-sm btn-outline-danger"><i class="la la-time"></i>
                            Dépublier
                        </button>
                        <button id="btnPublish" class="btn btn-sm btn-outline-success"><i class="la la-check"></i>
                            Publier
                        </button>
                    @else
                        <button id="btnUnpublish" class="btn btn-sm btn-outline-danger"><i class="la la-times"></i>
                            Dépublier
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="tutoriel" data-id="{{ $tutoriel->id }}"></div>
    @if(\Illuminate\Support\Facades\Storage::disk('sftp')->exists('tutoriel/'.$tutoriel->id.'/video.mp4') == false ||
\Illuminate\Support\Facades\Storage::disk('public')->exists('tutoriel/'.$tutoriel->id.'/background.png') == false ||
\Illuminate\Support\Facades\Storage::disk('public')->exists('tutoriel/'.$tutoriel->id.'/banner.png') == false ||
$tutoriel->demo == 1 && $tutoriel->linkDemo == null ||
$tutoriel->source == 1 && \Illuminate\Support\Facades\Storage::disk('public')->exists('tutoriel/'.$tutoriel->id.'/source.zip') == false ||
$tutoriel->short_content == $tutoriel->content ||
$tutoriel->content == null ||
count($tutoriel->requis) == 0 ||
count($tutoriel->technologies) == 0 ||
count($tutoriel->tags) == 0)
        <div class="kt-portlet">
            <div class="kt-portlet__head kt-bg-warning">
                <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="fa fa-tasks"></i>
					</span>
                    <h3 class="kt-portlet__head-title">
                        Liste des taches de ce tutoriel
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget4">
                    @if(\Illuminate\Support\Facades\Storage::disk('sftp')->exists('tutoriel/'.$tutoriel->id.'/video.mp4') == false)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-times-circle kt-font-danger la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Fichier Vidéo
                                </a>
                                <p class="kt-widget4__text">
                                    Le fichier vidéo n'est pas disponible sur le serveur.<br>Veuillez envoyer le
                                    fichier
                                </p>
                            </div>
                            <a data-toggle="modal" data-target="#addVideo" class="btn btn-sm btn-label-danger btn-bold">Envoyer</a>
                        </div>
                    @endif
                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('tutoriel/'.$tutoriel->id.'/background.png') == false)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-times-circle kt-font-danger la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Images de Fond
                                </a>
                                <p class="kt-widget4__text">
                                    Aucune images de fond (Background) n'à été définie.
                                </p>
                            </div>
                            <a href="{{ route('Back.Tutoriel.Video.edit', $tutoriel->id) }}"
                               class="btn btn-sm btn-label-danger btn-bold">Editer</a>
                        </div>
                    @endif
                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('tutoriel/'.$tutoriel->id.'/banner.png') == false)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-times-circle kt-font-danger la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Images de tutoriel
                                </a>
                                <p class="kt-widget4__text">
                                    Aucune images de tutoriel (Banner) n'à été définie.
                                </p>
                            </div>
                            <a href="{{ route('Back.Tutoriel.Video.edit', $tutoriel->id) }}"
                               class="btn btn-sm btn-label-danger btn-bold">Editer</a>
                        </div>
                    @endif
                    @if($tutoriel->demo == 1 && $tutoriel->linkDemo == null)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-times-circle kt-font-danger la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Lien de démonstration
                                </a>
                                <p class="kt-widget4__text">
                                    Le lien de démonstration est activer mais aucun lien de demo n'à été renseigner.<br>
                                    Veuillez renseigner le lien de démo.
                                </p>
                            </div>
                            <a href="{{ route('Back.Tutoriel.Video.edit', $tutoriel->id) }}"
                               class="btn btn-sm btn-label-danger btn-bold">Editer</a>
                        </div>
                    @endif
                    @if($tutoriel->source == 1 && \Illuminate\Support\Facades\Storage::disk('sftp')->exists('tutoriel/'.$tutoriel->id.'/source.zip') == false)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-times-circle kt-font-danger la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Fichier Source
                                </a>
                                <p class="kt-widget4__text">
                                    La prise en charge de fichier source est activer mais aucun fichier n'est disponible
                                    sur le serveur.<br>
                                    Veuillez envoyer le fichier source.
                                </p>
                            </div>
                            <a data-toggle="modal" data-target="#addSource"
                               class="btn btn-sm btn-label-danger btn-bold">envoyer</a>
                        </div>
                    @endif
                    @if($tutoriel->short_content == $tutoriel->content)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-warning kt-font-warning la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Description
                                </a>
                                <p class="kt-widget4__text">
                                    La description courte est exactement la même que la description.<br>
                                    Veuillez editer la description.
                                </p>
                            </div>
                            <a href="{{ route('Back.Tutoriel.Video.edit', $tutoriel->id) }}"
                               class="btn btn-sm btn-label-warning btn-bold">Editer</a>
                        </div>
                    @endif
                    @if($tutoriel->content == null)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-warning kt-font-warning la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Description
                                </a>
                                <p class="kt-widget4__text">
                                    La description est vide.<br>
                                    Veuillez editer la description.
                                </p>
                            </div>
                            <a href="{{ route('Back.Tutoriel.Video.edit', $tutoriel->id) }}"
                               class="btn btn-sm btn-label-warning btn-bold">Editer</a>
                        </div>
                    @endif
                    @if(count($tutoriel->requis) == 0)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-warning kt-font-warning la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Requis
                                </a>
                                <p class="kt-widget4__text">
                                    Aucun requis n'est indiquer dans ce tutoriel
                                </p>
                            </div>
                        </div>
                    @endif
                    @if(count($tutoriel->technologies) == 0)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-warning kt-font-warning la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Technologie
                                </a>
                                <p class="kt-widget4__text">
                                    Aucune technologies n'est indiquer dans ce tutoriel
                                </p>
                            </div>
                        </div>
                    @endif
                    @if(count($tutoriel->tags) == 0)
                        <div class="kt-widget4__item">
                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                <i class="la la-warning kt-font-warning la-2x"></i>
                            </div>
                            <div class="kt-widget4__info">
                                <a href="#" class="kt-widget4__username">
                                    Tags
                                </a>
                                <p class="kt-widget4__text">
                                    Aucun tags n'est indiquer dans ce tutoriel
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
                            @if(\Illuminate\Support\Facades\Storage::disk('public')->exists("tutoriel/$tutoriel->id/banner.png") == false)
                                <img src="/storage/tutoriel/tutoriel.png" alt="">
                            @else
                                <img src="/storage/tutoriel/{{ $tutoriel->id }}/banner.png" alt="">
                            @endif
                            <div class="kt-widget27__btn">
                                <a href="https://v3.trainznation.io/tutoriel/{{ $tutoriel->subcategory->short }}/{{ $tutoriel->id }}"
                                   class="btn btn-pill btn-light btn-elevate btn-bold">Voir sur le frontend</a>
                            </div>
                        </div>
                        <div id="asset_block" class="kt-widget27__container kt-portlet__space-x" style="">
                            <div class="text-center mb-5">
                                <h3 id="asset_title" class="kt-font-bold">{{ $tutoriel->title }}</h3>
                            </div>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="kt-font-bold">Catégorie:</td>
                                    <td id="asset_category" class="text-right">{{ $tutoriel->category->name }}
                                        - {{ $tutoriel->subcategory->name }}</td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Auteur:</td>
                                    <td id="asset_category" class="text-right">
                                        {{ $tutoriel->user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Publier:</td>
                                    <td id="asset_category" class="text-right">
                                        @if($tutoriel->published == 0)
                                            <span class="kt-badge kt-badge--pill kt-badge--inline kt-badge--danger"><i
                                                    class="la la-times-circle"></i> Non Publier</span>
                                        @elseif($tutoriel->published == 2)
                                            <span class="kt-badge kt-badge--pill kt-badge--inline kt-badge--warning"><i
                                                    class="la la-clock-o"></i> Bientôt</span><br>
                                            {{ $tutoriel->published_at->diffForHumans() }}
                                        @else
                                            <span class="kt-badge kt-badge--pill kt-badge--inline kt-badge--success"><i
                                                    class="la la-check-circle"></i> En Ligne</span><br>
                                            {{ $tutoriel->published_at->diffForHumans() }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Durée:</td>
                                    <td id="asset_category" class="text-right">
                                        @if($tutoriel->time != null)
                                            <i class="fa fa-clock"></i> {{ $tutoriel->time }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        @if($tutoriel->source == 0)
                                            <i class="la la-file-zip-o la-2x"></i>
                                        @else
                                            <i class="la la-file-zip-o la-2x kt-font-skype"></i>
                                        @endif

                                        @if($tutoriel->premium == 0)
                                            <i class="la la-certificate la-2x"></i>
                                        @else
                                            <i class="la la-certificate la-2x kt-font-skype"></i>
                                        @endif

                                        @if($tutoriel->demo == 0)
                                            <i class="la la-globe la-2x"></i>
                                        @else
                                            <i class="la la-globe la-2x kt-font-skype"></i>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
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
                                    <i class="la la-edit"></i> Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#comments" role="tab">
                                    <i class="la la-comments"></i> Commentaires
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tags" role="tab">
                                    <i class="la la-tags"></i> Tags
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#technos" role="tab">
                                    <i class="la la-laptop"></i> Technologies
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#requis" role="tab">
                                    <i class="la la-list-alt"></i> Requis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#stat" role="tab">
                                    <i class="la la-line-chart"></i> Statistiques
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description" role="tabpanel">
                            {!! $tutoriel->content !!}
                        </div>
                        <div class="tab-pane" id="comments" role="tabpanel">
                            <div id="listeComments" class="kt-datatable"></div>
                        </div>
                        <div class="tab-pane" id="tags" role="tabpanel">
                            <div class="row">
                                <div class="col-md-9">&nbsp;</div>
                                <div class="col-md-3 text-right">
                                    <button data-toggle="modal" data-target="#addTag" class="btn btn-outline-info"><i
                                            class="la la-plus"></i> Nouveau Tags
                                    </button>
                                </div>
                            </div>
                            <div id="listeTags" class="kt-datatable"></div>
                        </div>
                        <div class="tab-pane" id="technos" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">&nbsp;</div>
                                <div class="col-md-4 text-right">
                                    <button data-toggle="modal" data-target="#addTechno" class="btn btn-outline-info"><i
                                            class="la la-plus"></i> Nouvelle technologie
                                    </button>
                                </div>
                            </div>
                            <div id="listeTechnos" class="kt-datatable"></div>
                        </div>
                        <div class="tab-pane" id="requis" role="tabpanel">
                            <div class="row">
                                <div class="col-md-9">&nbsp;</div>
                                <div class="col-md-3 text-right">
                                    <button data-toggle="modal" data-target="#addRequis" class="btn btn-outline-info"><i
                                            class="la la-plus"></i> Nouveau requis
                                    </button>
                                </div>
                            </div>
                            <div id="listeRequis" class="kt-datatable"></div>
                        </div>
                        <div class="tab-pane" id="stat" role="tabpanel">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="btnPublishLater" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-clock-o"></i> Planification de la
                        publication</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/tutoriel/video/{{ $tutoriel->id }}/publishLater" class="kt-form"
                      id="formPublishLater" method="post">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="published_at">Quand publier le tutoriel:</label>
                            <input type="text" id="published_at" class="form-control" name="published_at">
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
    <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-video-camera"></i> Envoie de la vidéo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="" class="kt-form dropzone dropzone-default dropzone-brand" id="formAddVideo"
                      method="post">
                    <div class="modal-body">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Déposez des fichiers ici ou cliquez pour télécharger.</h3>
                            <span class="dropzone-msg-desc">Aucune limitation de taille de fichier</span><br>
                            <span class="dropzone-msg-desc">Fichier Vidéo uniquement</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-video-camera"></i> Envoie des
                        fichiers sources</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="" class="kt-form dropzone dropzone-default dropzone-brand" id="formAddSource"
                      method="post">
                    <div class="modal-body">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Déposez des fichiers ici ou cliquez pour télécharger.</h3>
                            <span class="dropzone-msg-desc">Aucune limitation de taille de fichier</span><br>
                            <span class="dropzone-msg-desc">Fichier zip uniquement</span>
                        </div>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouveau Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/tutoriel/video/{{ $tutoriel->id }}/tag" class="kt-form" id="formAddTag"
                      method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="tag" class="form-control form-tag" name="tags"
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
    <div class="modal fade" id="addTechno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouvelle
                        technologie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/tutoriel/{{ $tutoriel->id }}/techno" class="kt-form" id="formAddTechno"
                      method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="techno" class="form-control form-tag" name="techno"
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
    <div class="modal fade" id="addRequis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouveau requis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/tutoriel/{{ $tutoriel->id }}/requis" class="kt-form" id="formAddRequis"
                      method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="requi" class="form-control form-tag" name="requis"
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
@endsection

@section("script")
    <script src="{{ asset('js/admin/tutoriel/video/show.js') }}"></script>
@endsection
