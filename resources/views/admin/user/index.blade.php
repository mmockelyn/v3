@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Tableau de Bord </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.User.index') }}" class="kt-subheader__breadcrumbs-link">Utilisateurs </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tableau de Bord</span>
                </div>
            </div>
            <!--<div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="" class="btn btn-info"><i class="la la-plus"></i> Créer un nouvelle article</a>
                </div>
            </div>-->
        </div>
    </div>
@endsection

@section("content")
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="kt-nav">
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.User.index')) }}">
                            <a href="{{ route('Back.User.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                <span class="kt-nav__link-text">Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.User.Gestion.index')) }}">
                            <a href="{{ route('Back.User.Gestion.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon-users-1"></i>
                                <span class="kt-nav__link-text">Utilisateurs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h4>Nombre Total d'utilisateurs</h4>
                            <h1 class="kt-font-bolder">{{ \App\HelpersClass\Account\AccountHelper::countAllAccount() }}</h1>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>Nombre d'utilisateur premium</h4>
                            <h1 class="kt-font-bolder">{{ \App\HelpersClass\Account\AccountHelper::countPremiumAccount() }}</h1>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>Nombre d'utilisateur actif</h4>
                            <h1 class="kt-font-bolder">{{ \App\HelpersClass\Account\AccountHelper::countActifUser() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="la la-users"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Derniers Inscrits
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="latestSubscribe" class="kt-datatable"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="la la-power-off"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Dernieres Connexions
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="latestLogin" class="kt-datatable"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/user/index.js') }}"></script>
@endsection
