@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="tz-blog">
                <div class="tz-blog__head">
                    <div class="row">
                        <div class="col-md-4 tz-blog__icons">
                            <span class="iconify" data-inline="false" data-icon="vaadin:road-branches" style="font-size: 230px; color: white"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="tz-blog__title">ROUTES</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__body row">
            @foreach($routes as $route)
                <div class="col-md-6">
                    <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                        <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                            <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url(/storage/route/<?= $route->id; ?>/route.png)">
                                <h3 class="kt-widget19__title kt-font-light">
                                    Ligne: {{ $route->name }}
                                </h3>
                                <div class="kt-widget19__shadow"></div>
                                <div class="kt-widget19__labels">
                                    <a href="#" class="btn btn-brand btn-bold ">Build V{{ $route->build->version }}:{{ $route->build->build }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget19__wrapper">
                                <div class="kt-widget19__text">
                                    {!! $route->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <a href="{{ route('Front.Route.show', $route->id) }}" class="btn btn-block btn-label-brand btn-bold">Voir la route</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/route/index.js') }}"></script>
@endsection
