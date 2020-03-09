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
                    <a href="{{ route('Back.Tutoriel.index') }}" class="kt-subheader__breadcrumbs-link">Tutoriel </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tableau de Bord</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="" class="btn btn-info"><i class="la la-plus"></i> Créer un nouveeau tutoriel</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="kt-nav">
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Blog.index')) }}">
                            <a href="{{ route('Back.Blog.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                <span class="kt-nav__link-text">Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Blog.Category.index')) }}">
                            <a href="{{ route('Back.Blog.Category.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-circle-vol-2"></i>
                                <span class="kt-nav__link-text">Catégories</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Blog.Article.index')) }}">
                            <a href="{{ route('Back.Blog.Article.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon la la-youtube-play"></i>
                                <span class="kt-nav__link-text">Tutoriel</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Statistique <small>(Vue)</small>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <ul class="nav nav-pills nav-pills-sm" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#jour" role="tab"
                                                   aria-selected="true">
                                                    Journalier
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#mois" role="tab"
                                                   aria-selected="false">
                                                    Mensuel
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#annee" role="tab">
                                                    Annuel
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="jour" role="tabpanel">
                                            {!! $chartJour->container() !!}
                                        </div>
                                        <div class="tab-pane" id="mois" role="tabpanel">
                                            {!! $chartMonth->container() !!}
                                        </div>
                                        <div class="tab-pane " id="annee" role="tabpanel">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting
                                            industry.When an unknown printer took a galley of type and scrambled. Lorem
                                            Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                            an unknown printer took a galley of type and scrambled.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="kt-widget1">
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">Nombre total de tutoriel</h3>
                                    </div>
                                    <span
                                        class="kt-widget1__number kt-font-brand">{{ \App\HelpersClass\Tutoriel\TutorielHelper::countAllTutoriel() }}</span>
                                </div>

                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">Nombre total de tutoriel publier</h3>
                                    </div>
                                    <span
                                        class="kt-widget1__number kt-font-success">{{ \App\HelpersClass\Tutoriel\TutorielHelper::countTutoriel() }}</span>
                                </div>

                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">Nombre total de commentaire</h3>
                                    </div>
                                    <span
                                        class="kt-widget1__number kt-font-brand">{{ \App\HelpersClass\Tutoriel\TutorielHelper::countComment() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Derniers Tutoriels
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body" id="listLatestTutoriel">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Derniers Commentaires
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body" id="listLatestComment">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>
    {{ $chartJour->script() }}
    {{ $chartMonth->script() }}
    <script src="{{ asset('js/admin/tutoriel/index.js') }}"></script>
@endsection
