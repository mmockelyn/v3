@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutoriel.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div id="TutorielIndex"></div>
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="tz-blog">
                <div class="tz-blog__head">
                    <div class="row">
                        <div class="col-md-4 tz-blog__icons">
                            <span class="iconify" data-inline="false" data-icon="dashicons:welcome-learn-more" style="font-size: 230px; color: white;"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="tz-blog__title">Tutoriel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__body text-center">
            @foreach($categories as $category)
                <h3 class="title">{{ $category->name }}</h3>
                <div class="row">
                    @foreach($category->subcategories as $subcategory)
                    <div class="col-md-4">
                        <a href="{{ route('Front.Tutoriel.list', $subcategory->id) }}" class="tz-tutoriel_btn_category">
                            <img src="/storage/tutoriel/categorie/button_{{ $subcategory->short }}.png" class="img-fluid" alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-play-circle"></i>
					</span>
                <h3 class="kt-portlet__head-title">
                    Derniers Tutoriels
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row"  id="loadLatestTutoriel"></div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/tutoriel/index.js') }}"></script>
@endsection
