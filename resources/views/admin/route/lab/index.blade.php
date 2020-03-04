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
    <div class="kt-portlet" id="portlet_stat_build">

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
                <div class="kt-portlet__head-toolbar">
                    @if(\App\HelpersClass\Route\RouteLabHelper::labPercent($route->id) >= 85)
                    <button data-toggle="modal" data-target="#nextVersion" class="btn btn-lg btn-success"><i class="la la-check-circle"></i> Passer à la version {{ $route->build->version +1 }}</button>
                    @endif
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
                            <a data-toggle="modal" href="#addAnomalie" class="btn btn-icon btn-outline-info kt-hidden-">
                                <i class="la la-plus-square" data-toggle="kt-tooltip" title="Nouvelle anomalie"></i>
                            </a>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            <a data-toggle="modal" href="#nextState" class="btn btn-icon btn-outline-success kt-hidden-">
                                <i class="la la-check-square" data-toggle="kt-tooltip" title="Terminer des anomalie"></i>
                            </a>
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
    <div class="modal fade" id="nextVersion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Passage à la version {{ $route->build->version +1 }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/nextVersion" class="kt-form" id="formNextVersion" method="post">
                    @csrf
                    <input type="hidden" name="version" value="{{ $route->build->version }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description">Description de cette version</label>
                            <textarea name="description" id="description" class="form-control summernote" cols="30" rows="10">
                                <h2>Version {{ $route->build->version }}</h2>
                                <ul>
                                    @foreach(\App\HelpersClass\Route\RouteLabHelper::getFinishedTask($route->id) as $task)
                                        @if(empty($task->anomalie))
                                            <li><strong>Néant:</strong> {{ $task->correction }}</li>
                                        @else
                                            <li><strong>{{ $task->anomalie }}:</strong> {{ $task->correction }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-square"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="nextState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terminer des anomalies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/anomalie/nextState" class="kt-form" id="formNextState" method="post">
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead class="kt-bg-fill-brand">
                            <tr>
                                <th></th>
                                <th>Anomalie</th>
                                <th>Correction</th>
                                <th>State</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\HelpersClass\Route\RouteLabHelper::getOutFinishedTask($route->id) as $task)
                                <tr>
                                    <td>
                                        <div class="kt-checkbox-list">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="anomalie[]" value="{{ $task->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $task->anomalie }}</td>
                                    <td>{{ $task->correction }}</td>
                                    <td><span class="kt-badge {{ \App\HelpersClass\Route\RouteLabHelper::stateBadge($task->state) }} kt-badge--inline kt-badge--pill">{{ \App\HelpersClass\Route\RouteLabHelper::stateText($task->state) }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Changer l'état</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/route/lab.js') }}"></script>
@endsection
