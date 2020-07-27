@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/route.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-portlet" id="route" data-id="{{ $route->id }}">
        <div class="kt-portlet__body">
            <div class="tz-blog">
                <div class="tz-blog__head">
                    <div class="row">
                        <div class="col-md-4 tz-blog__icons">
                            <span class="iconify" data-inline="false" data-icon="vaadin:road-branches" style="font-size: 230px; color: white"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="tz-blog__title">Ligne: {{ $route->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <ul class="nav nav-tabs nav-fill nav-tabs-line kt-bg-dark" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-white-50 active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" data-toggle="tab" href="#version" role="tab">Version</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" data-toggle="tab" href="#gallery" role="tab">Gallerie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" data-toggle="tab" href="#avancement" role="tab">Avancement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" data-toggle="tab" href="#download" role="tab">Téléchargement</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="description" role="tabpanel">
                    <div class="tz-route__description">
                        <div class="tz-route__head_img" style="background-image: url(/storage/route/<?= $route->id; ?>/route.png)"></div>
                        <div class="tz-route__stat">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="kt-media kt-media--xxl kt-media--circle kt-media--info">
                                        <span>A</span>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Version Actuel:</td>
                                                <td class="text-right">{{ $route->build->version }}</td>
                                            </tr>
                                            <tr>
                                                <td>Build Actuel:</td>
                                                <td class="text-right">{{ $route->build->build }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                        </div>
                        <div class="tz-route__description">
                            {!! $route->description !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="version" role="tabpanel">
                    @foreach($route->versions as $version)
                        <button id="btnVersions" data-id="{{ $version->id }}" class="btn btn-sm btn-primary">Version {{ $version->version }}</button>
                    @endforeach

                    <div id="loadVersion" class="m-5"></div>
                </div>
                <div class="tab-pane" id="gallery" role="tabpanel">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="kt-portlet">
                                <div class="kt-portlet__body">
                                    <ul class="kt-nav kt-nav--bold kt-nav--lg-space kt-nav--lg-font">
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link js-gallery" data-category="all">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">Tous</span>
                                            </a>
                                        </li>
                                        @foreach($categories as $category)
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link js-gallery" data-category="{{ $category->id }}">
                                                <i class="kt-nav__link-icon la la-circle"></i>
                                                <span class="kt-nav__link-text">{{ $category->name }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id="js-show-gallery"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="avancement" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3" style="border-right: 2px solid #9c9c9c">
                                    <h4 class="text-center kt-font-bold">Avancement</h4>
                                    <h1 class="tz-route__percent_text {{ \App\HelpersClass\Route\RouteHelpers::colorPercentLab($route->id) }}">{{ \App\HelpersClass\Route\RouteHelpers::PercentLab($route->id) }} %</h1>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="text-center kt-font-bold">Version</h4>
                                            <h1 class="tz-route__percent_text">{{ $route->build->version }}</h1>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-center kt-font-bold">Build</h4>
                                            <h1 class="tz-route__percent_text">{{ $route->build->build }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header kt-bg-danger text-center">
                                    A Faire
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled js-tree-todo"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header kt-bg-warning text-center">
                                    En Cours
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled js-tree-progress"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header kt-bg-success text-center">
                                    Terminer
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled js-tree-finish"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="download" role="tabpanel">
                    <div class="alert alert-custom alert-primary" role="alert">
                        <div class="alert-icon">
                            <i class="flaticon-information"></i>
                        </div>
                        <div class="alert-text">Un Launcher est à votre disposition afin de bénéficier des dernieres avancées des lignes.<br>Vous pouvez le télécharger <a href="https://download.trainznation.eu/v3/route/1/download/Xsolla_launcher_installer.exe">ICI</a> (Version 1.0.5)</div>
                    </div>
                    <div class="card mb-3">
                        <div class="row no-gutters" style="border-radius: 15px">
                            <div class="col-md-4">
                                <img src="/storage/route/{{ $route->id }}/route.png" class="card-img" alt="...">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h3 class="title">Dernières Version</h3>
                                    <table class="tz-route__table" style="width: 100%">
                                        <tr>
                                            <td class="kt-font-bolder">Version</td>
                                            <td class="text-right">{{ \App\HelpersClass\Route\RouteDownloadHelpers::getLatestDownload($route->id, 'version') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="kt-font-bolder">Build</td>
                                            <td class="text-right">{{ \App\HelpersClass\Route\RouteDownloadHelpers::getLatestDownload($route->id, 'build') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="kt-font-bolder">Type</td>
                                            <td class="text-right">{{ \App\HelpersClass\Route\RouteDownloadHelpers::getRouteTypeReleaseText(\App\HelpersClass\Route\RouteDownloadHelpers::getLatestDownload($route->id, 'route_type_release_id')) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a class="col-md-2 kt-bg-info text-center" style="cursor: pointer" href="{{ \App\HelpersClass\Route\RouteDownloadHelpers::getLatestDownload($route->id, 'linkDownload') }}">
                                <span class="iconify" data-inline="false" data-icon="whh:circledownload" style="font-size: 72px; color: white; margin-top: 35%;"></span>
                            </a>
                        </div>
                    </div>
                    <div class="card mb-3 mt-lg-9">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="/storage/route/map.png" class="card-img" alt="Map">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Map</h5>
                                    @foreach(\App\HelpersClass\Route\RouteDownloadHelpers::getDownloadMapList($route->id) as $download)
                                        <div class="card" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.25);">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                V{{ $download->version }}:{{ $download->build }}
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="badge badge-success">{{ $download->typeRelease->name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a  href="{{ $download->linkDownload }}"><span class="iconify kt-font-danger" data-inline="false" data-icon="whh:circledownload" style="font-size: 24px;"></span></a>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a id="btnNotes" data-downloadid="{{ $download->id }}"><span class="iconify kt-font-info" data-inline="false" data-icon="bx:bx-note" style="font-size: 24px;"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 mt-lg-9">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="/storage/route/session.png" class="card-img" alt="Map">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Sessions</h5>
                                    @foreach(\App\HelpersClass\Route\RouteDownloadHelpers::getDownloadSessionList($route->id) as $download)
                                        <div class="card" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.25);">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                V{{ $download->version }}:{{ $download->build }}
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="badge badge-success">{{ $download->typeRelease->name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a  href="{{ $download->linkDownload }}"><span class="iconify kt-font-danger" data-inline="false" data-icon="whh:circledownload" style="font-size: 24px;"></span></a>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a id="btnNotes" data-downloadid="{{ $download->id }}"><span class="iconify kt-font-info" data-inline="false" data-icon="bx:bx-note" style="font-size: 24px;"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="note" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="text-center kt-font-bold">Version</h4>
                                            <h1 id="versionText" class="title text-center"></h1>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-center kt-font-bold">Build</h4>
                                            <h1 id="buildText" class="title text-center"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div id="description"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="https://cdn.jwplayer.com/libraries/3BX5M91M.js"></script>
    <script src="{{ asset('js/route/map.js') }}"></script>
    <script src="{{ asset('js/route/show.js') }}"></script>
@endsection
