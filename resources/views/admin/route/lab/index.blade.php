@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion du laboratoire </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.index') }}" class="kt-subheader__breadcrumbs-link">Route </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.show', $route->id) }}" class="kt-subheader__breadcrumbs-link">{{ $route->name }} </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Gestion du laboratoire</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Route.show', $route->id) }}" class="btn btn-sm btn-default"><i class="la la-arrow-circle-left"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="route" data-id="{{ $route->id }}" data-published="{{ $route->published }}"></div>
    <div class="kt-portlet">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg">
                <div class="col-md-6">
                    <!--begin::Total Profit-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title">
                                    Build Actuel
                                </h4>
                                <span class="kt-widget24__desc">
					            Version {{ $route->build->version }}
					        </span>
                            </div>

                            <span class="kt-widget24__stats kt-font-brand">
					        {{ $route->build->build }}
					    </span>
                        </div>

                        <div class="progress progress--sm">
                            {!! \App\HelpersClass\Route\RouteLabHelper::getProgressLab($route->id) !!}
                        </div>

                        <div class="kt-widget24__action">
						<span class="kt-widget24__change">
							Avancement
						</span>
                            <span class="kt-widget24__number">
							{{ \App\HelpersClass\Route\RouteLabHelper::labPercent($route->id) }}%
					    </span>
                        </div>
                    </div>
                    <!--end::Total Profit-->
                </div>
                <div class="col-md-6">
                    <div class="kt-widget1">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__danger">
                                <h3 class="kt-widget1__title">Inscrites</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-danger">{{ \App\HelpersClass\Route\RouteLabHelper::countTask($route->id, 0) }}</span>
                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__warning">
                                <h3 class="kt-widget1__title">En Cours</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-warning">{{ \App\HelpersClass\Route\RouteLabHelper::countTask($route->id, 1) }}</span>
                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__success">
                                <h3 class="kt-widget1__title">Terminées</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-success">{{ \App\HelpersClass\Route\RouteLabHelper::countTask($route->id, 2) }}</span>
                        </div>

                        <div class="kt-widget1__item" style="border-top: 2px solid">
                            <div class="kt-widget1__success">
                                <h3 class="kt-widget1__title">Total de tache</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-brand">{{ \App\HelpersClass\Route\RouteLabHelper::countTaskTotal($route->id) }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
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
						<i class="la la-flask"></i>
					</span>
                    <h3 class="kt-portlet__head-title">
                        Laboratoire
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
                                        <input type="text" class="form-control" placeholder="Recherche..." id="anomalieSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                    </div>
                                </div>
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Status:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_status">
                                                <option value="">Tous</option>
                                                <option value="0">Inscrite</option>
                                                <option value="1">En cours</option>
                                                <option value="2">Terminer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                            <a data-toggle="modal" href="#addAnomalie" class="btn btn-default kt-hidden-">
                                <i class="la la-plus-square"></i> Nouvelle anomalie
                            </a>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                        </div>
                    </div>
                </div>

                <!--end: Search Form -->
            </div>
            <div class="kt-portlet__body">
                <div id="listeAnomalie" class="kt-datatable"></div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="addAnomalie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle anomalie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/anomalie" class="kt-form" id="formAddAnomalie" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="anomalie">Anomalie</label>
                            <input name="anomalie" class="form-control" placeholder="Quel est le problème ?">
                        </div>
                        <div class="form-group">
                            <label for="correction">Correction <span class="required">*</span> </label>
                            <input name="correction" class="form-control" placeholder="Quel solution est apporté ?">
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu <span class="required">*</span> </label>
                            <input name="lieu" class="form-control" placeholder="Lieu de l'anomalie (Point de repère)">
                        </div>
                        <div class="form-group">
                            <label for="state">Etat </label>
                            <select class="form-control selectpicker bootstrap-select" name="state">
                                <option value="0">Inscrit</option>
                                <option value="1">En Cours</option>
                                <option value="2">Terminer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-square"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editAnomalie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/anomalie" class="kt-form" id="formEditAnomalie" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="anomalie">Anomalie</label>
                            <input name="anomalie" class="form-control" placeholder="Quel est le problème ?">
                        </div>
                        <div class="form-group">
                            <label for="correction">Correction <span class="required">*</span> </label>
                            <input name="correction" class="form-control" placeholder="Quel solution est apporté ?">
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu <span class="required">*</span> </label>
                            <input name="lieu" class="form-control" placeholder="Lieu de l'anomalie (Point de repère)">
                        </div>
                        <div class="form-group">
                            <label for="state">Etat </label>
                            <select class="form-control selectpicker bootstrap-select" name="state">
                                <option value="0">Inscrit</option>
                                <option value="1">En Cours</option>
                                <option value="2">Terminer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-square"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @toastr_render
    <script src="{{ asset('js/admin/route/lab.js') }}"></script>
@endsection
