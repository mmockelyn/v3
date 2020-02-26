@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutoriel.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-portlet" id="tutorielList" data-id="{{ $sub->id }}">
        <div class="kt-portlet__body">
            <div class="tz-blog">
                <div class="tz-blog__head">
                    <div class="row">
                        <div class="col-md-4 tz-blog__icons">
                            <!--<span class="iconify" data-inline="false" data-icon="dashicons:welcome-learn-more" style="font-size: 230px; color: white;"></span>-->
                            <img src="/storage/tutoriel/categorie/{{ $sub->short }}.png" class="img-fluid" width="230" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="tz-blog__title">{{ $sub->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Tutoriels
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <div class="dropdown">
                        <button class="btn btn-outline-info dropdown-toggle" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="la la-sort-asc"></i> Trier par</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <a id="js-filter" data-sort="all" class="dropdown-item">Tous</a>
                            <a id="js-filter" data-sort="asc" class="dropdown-item">Date Ascendant</a>
                            <a id="js-filter" data-sort="desc" class="dropdown-item">Date Descendant</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row" id="js-show"></div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/tutoriel/list.js') }}"></script>
@endsection
