@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item kt-bg-light" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $article->title }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Wiki.index') }}" class="kt-subheader__breadcrumbs-link">Wiki </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $article->title }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Wiki.Article.index') }}" class="btn btn-sm btn-default"><i
                            class="la la-arrow-circle-left"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")

@endsection

@section("script")
    <script src="{{ asset('js/admin/wiki/article/show.js') }}"></script>
@endsection
