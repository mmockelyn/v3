@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/download.css') }}">
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
                            <!--<span class="iconify" data-inline="false" data-icon="cil:3d" style="font-size: 230px; color: white;"></span>-->
                            <img src="/storage/download/category/{{ $category->id }}.png" class="img-fluid" width="230" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="tz-blog__title">{{ $category->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="row">
                @foreach($category->subcategories as $subcategory)
                    <div class="col-md-6">
                        <a href="{{ route('Front.Download.list', [$category->id, $subcategory->id]) }}" class="card mt-lg-5">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="/storage/download/subcategory/{{ $subcategory->id }}.png" width="150" class="img-fluid" />
                                    <h3 class="pt-lg-5">{{ $subcategory->name }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/download/index.js') }}"></script>
@endsection
