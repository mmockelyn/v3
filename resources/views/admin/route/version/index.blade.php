@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion des Versions </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.index') }}" class="kt-subheader__breadcrumbs-link">Route </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.show', $route->id) }}" class="kt-subheader__breadcrumbs-link">{{ $route->name }} </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Gestion des Versions</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Route.index') }}" class="btn btn-sm btn-default"><i class="la la-arrow-circle-left"></i> Retour</a>
                    <button data-toggle="modal" data-target="#addVersion" class="btn btn-sm btn-outline-primary"><i class="la la-plus-square"></i> Nouvelle Version</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="route" data-id="{{ $route->id }}" data-published="{{ $route->published }}"></div>
<div class="row" data-sticky-container>
    <div class="col-md-3">
        <div class="card sticky" data-sticky="true" data-margin-top="100px" data-sticky-for="1023" data-sticky-class="kt-sticky">
            <div class="card-body">
                <ul class="kt-nav">
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Route.show',$route->id)) }}">
                        <a href="{{ route('Back.Route.show', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-signal"></i>
                            <span class="kt-nav__link-text">Tableau de Bord</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Version.index', $route->id)) }}">
                        <a href="{{ route('Route.Version.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-bars"></i>
                            <span class="kt-nav__link-text">Version</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Gallery.index', $route->id)) }}">
                        <a href="{{ route('Route.Gallery.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-picture-o"></i>
                            <span class="kt-nav__link-text">Gallerie</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Lab.index', $route->id)) }}">
                        <a href="{{ route('Route.Lab.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-flask"></i>
                            <span class="kt-nav__link-text">Avancement</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Download.index', $route->id)) }}">
                        <a href="{{ route('Route.Download.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-download"></i>
                            <span class="kt-nav__link-text">Téléchargement</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Config.index', $route->id)) }}">
                        <a href="{{ route('Route.Config.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-cogs"></i>
                            <span class="kt-nav__link-text">Configuration</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if(count($route->versions) != 0)
        <div class="col-md-9">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success nav-tabs-line-2x" role="tablist">
                            @foreach($versions as $version)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#{{ \Illuminate\Support\Str::slug($version->name) }}" role="tab">
                                        Version {{ $version->version }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        @foreach($versions as $version)
                            <div class="tab-pane" id="{{ \Illuminate\Support\Str::slug($version->name) }}" role="tabpanel">
                                @if($version->linkVideo == null)
                                    <div class="card kt-bg-warning mb-lg-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <i class="la la-warning kt-font-light la-3x"></i>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Attention</h6>
                                                    <p>Veuillez poster une video de présentation pour cette ligne</p>
                                                </div>
                                                <div class="col-md-5 text-right">
                                                    <button data-toggle="modal" data-target="#uploadVideo" class="btn btn-outline-danger">Poster la vidéo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <form action="/api/admin/route/{{ $route->id }}/version/{{ $version->id }}/editThumbnail" class="kt-form" id="formEditImage" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_{{ $version->id }}">
                                                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('route/'.$route->id.'/'.$version->id.'.png') == true)
                                                        <img class="card-img-top" src="/storage/route/{{ $route->id }}/{{ $version->id }}.png" alt="Card image cap">
                                                    @else
                                                        <img class="card-img-top" src="https://via.placeholder.com/300" alt="Card image cap">
                                                    @endif
                                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Changez l'image">
                                                        <i class="fa fa-pen"></i>
                                                        <input type="file" name="images" accept=".png, .jpg, .jpeg">
                                                    </label>
                                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Supprimer l'image">
															<i class="fa fa-times kt-font-danger"></i>
														</span>
                                                    <button type="submit" class="kt-avatar__submit" data-toggle="kt-tooltip" title="" data-original-title="modifier l'image">
                                                        <i class="fa fa-check kt-font-success"></i>
                                                    </button>
                                                </div>
                                            </form>
                                            <div class="card-body">
                                                <h5 class="card-title">Version {{ $version->version }}</h5>
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td class="kt-font-bold">Distance</td>
                                                        <td class="text-right">{{ $version->distance }} Km</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="kt-font-bold">Départ</td>
                                                        <td class="text-right">{{ $version->depart }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="kt-font-bold">Arrivée</td>
                                                        <td class="text-right">{{ $version->arrive }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="/api/admin/route/{{ $route->id }}/version/{{ $version->id }}/delete" class="btn btn-danger btn-icon" data-toggle="kt-tooltip" title="Supprimer la version"><i class="la la-trash"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h2 class="card-title text-center">{{ $version->name }}</h2>
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
                                                {!! $version->description !!}
                                                <hr>
                                                <form action="/api/admin/route/{{ $route->id }}/version/{{ $version->id }}/editDescription" class="kt-form" id="formEditDescription" method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="form-group">
                                                        <textarea name="description" class="form-control summernote" cols="30" rows="10">{!! $version->description !!}</textarea>
                                                    </div>
                                                    <div class="kt-form__actions kt-form__actions--right">
                                                        <button type="submit" class="btn btn-sm btn-success"><i class="la la-check"></i> Editer la description</button>
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
                                                Liste des gares
                                            </h3>
                                        </div>
                                        <div class="kt-portlet__head-toolbar">
                                            <div class="kt-portlet__head-actions">
                                                <button data-toggle="modal" data-target="#addGare" class="btn btn-outline-primary">
                                                    <i class="flaticon2-plus-1"></i> Nouvelle gare
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Gare</th>
                                                <th>Type</th>
                                                <th>Coordonnée</th>
                                                <th>Info</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($version->gares as $gare)
                                                <tr>
                                                    <td>{{ $gare->name_gare }}</td>
                                                    <td><span class="kt-badge {{ \App\HelpersClass\Route\RouteVersionHelper::typeGareBadge($gare->type) }} kt-badge--inline kt-badge--pill kt-badge--rounded">{{ \App\HelpersClass\Route\RouteVersionHelper::typeGareText($gare->type) }}</span> </td>
                                                    <td>
                                                        <strong>Latitude:</strong> {{ $gare->lat }}<br>
                                                        <strong>Longitude:</strong> {{ $gare->long }}
                                                    </td>
                                                    <td>
                                                        @if($gare->ter == 1)
                                                            <img src="/storage/other/pictogramme/ter.png" width="24" alt="">
                                                        @endif
                                                        @if($gare->tgv == 1)
                                                            <img src="/storage/other/pictogramme/tgv.png" width="24" alt="">
                                                        @endif
                                                        @if($gare->metro == 1)
                                                            <img src="/storage/other/pictogramme/metro.png" width="24" alt="">
                                                        @endif
                                                        @if($gare->bus == 1)
                                                            <img src="/storage/other/pictogramme/bus.png" width="24" alt="">
                                                        @endif
                                                        @if($gare->tram == 1)
                                                            <img src="/storage/other/pictogramme/tram.png" width="24" alt="">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/api/admin/route/{{ $route->id }}/version/{{ $version->id }}/gare/{{ $gare->id }}/delete" class="btn btn-sm btn-icon btn-danger"><i class="la la-trash"></i> </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="uploadVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="la la-youtube-play"></i> Poster une vidéo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <form action="" class="kt-form dropzone dropzone-default dropzone-brand" id="formAddImage">
                                            <div class="modal-body">
                                                <input type="hidden" id="version_id" name="version_id" value="{{ $version->id }}">
                                                <div class="dropzone-msg dz-message needsclick">
                                                    <h3 class="dropzone-msg-title">Déposez des fichiers ici ou cliquez pour télécharger.</h3>
                                                    <span class="dropzone-msg-desc">Aucune limitation de taille de fichier</span><br>
                                                    <span class="dropzone-msg-desc">Fichier video uniquement</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addGare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvelle Gare</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="/api/admin/route/{{ $route->id }}/version/{{ $version->id }}/gare" class="kt-form" id="formAddGare" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_gare">Nom de la gare</label>
                                        <select id="name_gare" class="form-control" name="name_gare" data-live-search="true">
                                            @foreach(\App\HelpersClass\Route\RouteVersionHelper::listeGares() as $gare)
                                                <option data-id="{{ $gare->id }}" value="{{ $gare->name }}">{{ $gare->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type_gare">Type de Gare</label>
                                        <select id="type_gare" class="form-control selectpicker" name="type_gare">
                                            <option value=""></option>
                                            <option value="0">Gare Simple</option>
                                            <option value="1">Gare Départ / Terminus</option>
                                            <option value="2">Grande Gare</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lat">Latitude</label>
                                        <input type="text" id="latitude" name="lat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="long">Longitude</label>
                                        <input type="text" id="longitude" name="long" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="kt-checkbox-inline">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="ter" value="1"> <img src="/storage/other/pictogramme/ter.png" width="24" alt="">
                                        <span></span>
                                    </label>
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="tgv" value="1"> <img src="/storage/other/pictogramme/tgv.png" width="24" alt="">
                                        <span></span>
                                    </label>
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="metro" value="1"> <img src="/storage/other/pictogramme/metro.png" width="24" alt="">
                                        <span></span>
                                    </label>
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="bus" value="1"> <img src="/storage/other/pictogramme/bus.png" width="24" alt="">
                                        <span></span>
                                    </label>
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="tram" value="1"> <img src="/storage/other/pictogramme/tram.png" width="24" alt="">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="modal fade" id="addVersion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle version</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/version" class="kt-form" id="formAddVersion" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="version">N° Version</label>
                                    <input type="text" class="form-control" name="version" placeholder="Num">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="name">Nom de la version</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nom de la version">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="distance">Distance</label>
                                    <input type="text" class="form-control" name="distance" placeholder="Distance">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="depart">Gare de Départ</label>
                                    <select class="form-control" id="depart" name="depart" data-live-search="true">
                                        @foreach(\App\HelpersClass\Route\RouteVersionHelper::listeGares() as $gare)
                                            <option value="{{ $gare->name }}">{{ $gare->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="arrive">Gare d'arrivée</label>
                                    <select class="form-control" id="arrive" name="arrive" data-live-search="true">
                                        @foreach(\App\HelpersClass\Route\RouteVersionHelper::listeGares() as $gare)
                                            <option value="{{ $gare->name }}">{{ $gare->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/route/version.js') }}"></script>
    @foreach($versions as $version)
    <script type="text/javascript">
        let avatar<?= $version->id ?> = KTAvatar('kt_user_avatar_<?= $version->id; ?>')
    </script>
    @endforeach
@endsection
