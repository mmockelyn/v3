@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion des catégories </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Blog.index') }}" class="kt-subheader__breadcrumbs-link">Blog </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Blog.Category.index') }}" class="kt-subheader__breadcrumbs-link">Catégorie </a>

                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edition de la catégorie: {{ $category->name }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Edition d'une catégorie
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form action="{{ route('Back.Blog.Category.update', $category->id) }}" class="kt-form" method="POST">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Nom de la catégorie</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                </div>
                <div class="kt-form__actions kt-form__actions--right">
                    <button type="submit" class="btn btn-success"><i class="la la-check"></i> Editer la catégorie</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <!--<script src="{{ asset('js/admin/blog/category/index.js') }}"></script>-->
@endsection
