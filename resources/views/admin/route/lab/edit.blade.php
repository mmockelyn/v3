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
                    <a href="{{ route('Route.Lab.index', $route->id) }}" class="btn btn-sm btn-default"><i class="la la-arrow-circle-left"></i> Retour</a>
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
						<i class="la la-edit"></i>
					</span>
                    <h3 class="kt-portlet__head-title">
                        @if(empty($anomalie->anomalie))
                            Edition de la correction: <strong>{{ $anomalie->correction }}</strong>
                        @else
                            Edition de l'anomalie: <strong>{{ $anomalie->anomalie }}</strong>
                        @endif
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form action="/api/admin/route/{{ $route->id }}/anomalie/{{ $anomalie->id }}/edit" class="kt-form" id="formEditAnomalie" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="anomalie">Anomalie</label>
                        <input name="anomalie" class="form-control" placeholder="Quel est le problème ?" value="{{ $anomalie->anomalie }}">
                    </div>
                    <div class="form-group">
                        <label for="correction">Correction <span class="required">*</span> </label>
                        <input name="correction" class="form-control" placeholder="Quel solution est apporté ?" value="{{ $anomalie->correction }}">
                    </div>
                    <div class="form-group">
                        <label for="lieu">Lieu <span class="required">*</span> </label>
                        <input name="lieu" class="form-control" placeholder="Lieu de l'anomalie (Point de repère)" value="{{ $anomalie->lieu }}">
                    </div>
                    <div class="form-group">
                        <label for="state">Etat </label>
                        <select class="form-control selectpicker bootstrap-select" name="state">
                            <option value="{{ $anomalie->state }}">{{ \App\HelpersClass\Route\RouteLabHelper::stateText($anomalie->state) }}</option>
                            <option value=""><hr></option>
                            <option value="0">Inscrit</option>
                            <option value="1">En Cours</option>
                            <option value="2">Terminer</option>
                        </select>
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
    <script src="{{ asset('js/admin/route/lab_edit.js') }}"></script>
@endsection
