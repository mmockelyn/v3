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
                            <span class="iconify" data-inline="false" data-icon="emojione-v1:newspaper" style="font-size: 230px;"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="tz-blog__title">BLOG</div>
                            <div id="slickCarousel"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/blog/index.js') }}"></script>
@endsection
