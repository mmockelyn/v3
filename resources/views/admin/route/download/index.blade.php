@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion des téléchargement </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.index') }}" class="kt-subheader__breadcrumbs-link">Route </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.show', $route->id) }}" class="kt-subheader__breadcrumbs-link">{{ $route->name }} </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Gestion des téléchargement</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Route.index') }}" class="btn btn-sm btn-default"><i class="la la-arrow-circle-left"></i> Retour</a>
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
        <div class="col-md-9">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-download"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Téléchargement
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <!--begin: Search Form -->
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Recherche..." id="downloadSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Type de téléchargement:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_type">
                                                    <option value="">Tous</option>
                                                    @foreach($typeDownloads as $typeDownload)
                                                    <option value="{{ $typeDownload->id }}">{{ $typeDownload->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Type release:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_release">
                                                    <option value="">Tous</option>
                                                    @foreach($typeReleases as $release)
                                                    <option value="{{ $release->id }}">{{ $release->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a data-toggle="modal" href="#addDownload" class="btn btn-icon btn-outline-info kt-hidden-">
                                    <i class="la la-plus-square" data-toggle="kt-tooltip" title="Nouveau Téléchargement"></i>
                                </a>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>

                    <!--end: Search Form -->
                </div>
                <div class="kt-portlet__body">
                    <div id="listeDownload" class="kt-datatable"></div>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-upload"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Système de Mise à jours
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <!--begin: Search Form -->
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Recherche..." id="updaterSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a data-toggle="modal" href="#addUpdater" class="btn btn-icon btn-outline-info kt-hidden-">
                                    <i class="la la-plus-square" data-toggle="kt-tooltip" title="Nouvelle Mise à jour"></i>
                                </a>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>

                    <!--end: Search Form -->
                </div>
                <div class="kt-portlet__body">
                    <div id="listeUpdater" class="kt-datatable"></div>
                </div>
            </div>
        </div>
</div>
    <div class="modal fade" id="addDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'un nouveau téléchargement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/download/storeDownload" class="kt-form" id="formAddDownload" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version">Version</label>
                                    <input type="text" class="form-control" name="version" value="{{ $route->build->version }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="build">Build</label>
                                    <input type="text" class="form-control" name="build" value="{{ $route->build->build }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type_download">Type de téléchargement</label>
                                    <select id="type_download" class="form-control bootstrap-select" name="type_download">
                                        <option value=""></option>
                                        @foreach($typeDownloads as $typeDownload)
                                            <option value="{{ $typeDownload->id }}">{{ $typeDownload->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type_release">Type de Release</label>
                                    <select id="type_release" class="form-control bootstrap-select" name="type_release">
                                        <option value=""></option>
                                        @foreach($typeReleases as $typeRelease)
                                            <option value="{{ $typeRelease->id }}">{{ $typeRelease->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="linkDownload">Lien de téléchargement</label>
                            <input type="text" class="form-control" name="linkDownload" value="https://download.trainznation.eu/v3/route/{{ $route->id }}/download/">
                        </div>
                        <div class="form-group">
                            <label for="note">Note de téléchargement</label>
                            <textarea name="note" id="note" class="form-control summernote" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="published">Ce téléchargement est-il publier ?</label><br>
                            <span class="kt-switch">
								<label>
									<input type="checkbox" checked="checked" name="published">
									<span></span>
								</label>
							</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addUpdater" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'une nouvelle mise à jour</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/download/storeUpdater" class="kt-form" id="formAddUpdater" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version">Version</label>
                                    <input type="text" class="form-control" name="version" value="{{ $route->build->version }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="build">Build</label>
                                    <input type="text" class="form-control" name="build" value="{{ $route->build->build }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="linkRelease">Lien de la release</label>
                                    <input type="text" class="form-control" name="linkRelease" value="https://download.trainznation.eu/v3/route/{{ $route->id }}/patcher/">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="latest">Dernière mise à jour ?</label><br>
                                <span class="kt-switch">
								<label>
									<input type="checkbox" name="latest">
									<span></span>
								</label>
							</span>
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
@endsection

@section("script")
    <script src="{{ asset('js/admin/route/download.js') }}"></script>
@endsection
