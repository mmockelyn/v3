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
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Tutoriel.index') }}" class="kt-subheader__breadcrumbs-link">Tutoriel </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Gestion des catégories</span>
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
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Tutoriel.index')) }}">
                            <a href="{{ route('Back.Tutoriel.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                <span class="kt-nav__link-text">Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Tutoriel.Category.index')) }}">
                            <a href="{{ route('Back.Tutoriel.Category.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-circle-vol-2"></i>
                                <span class="kt-nav__link-text">Catégories</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Tutoriel.Video.index')) }}">
                            <a href="{{ route('Back.Tutoriel.Video.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon la la-youtube-play"></i>
                                <span class="kt-nav__link-text">Tutoriel</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Liste des catégories
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile kt-hidden">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Search..."
                                                   id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile kt-hidden">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_status">
                                                    <option value="">All</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Delivered</option>
                                                    <option value="3">Canceled</option>
                                                    <option value="4">Success</option>
                                                    <option value="5">Info</option>
                                                    <option value="6">Danger</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile kt-hidden">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Type:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_type">
                                                    <option value="">All</option>
                                                    <option value="1">Online</option>
                                                    <option value="2">Retail</option>
                                                    <option value="3">Direct</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a data-toggle="modal" href="#addCategory" class="btn btn-default kt-hidden-">
                                    <i class="la la-cart-plus"></i> Nouvelle catégorie
                                </a>
                                <div
                                    class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">

                    <!--begin: Datatable -->
                    <div class="kt-datatable" id="listeCategory"></div>

                    <!--end: Datatable -->
                </div>
            </div>
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Liste des Sous catégorie
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile kt-hidden">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Search..."
                                                   id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile kt-hidden">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_status">
                                                    <option value="">All</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Delivered</option>
                                                    <option value="3">Canceled</option>
                                                    <option value="4">Success</option>
                                                    <option value="5">Info</option>
                                                    <option value="6">Danger</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile kt-hidden">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Type:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_type">
                                                    <option value="">All</option>
                                                    <option value="1">Online</option>
                                                    <option value="2">Retail</option>
                                                    <option value="3">Direct</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a data-toggle="modal" href="#addSubCategory" class="btn btn-default kt-hidden-">
                                    <i class="la la-cart-plus"></i> Nouvelle sous catégorie
                                </a>
                                <div
                                    class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">

                    <!--begin: Datatable -->
                    <div class="kt-datatable" id="listeSubCategory"></div>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouvelle catégorie
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/tutoriel/category" class="kt-form" id="formAddCategory" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom de la catégorie</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-circle"></i> Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSubCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouvelle sous
                        catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/tutoriel/subcategory" class="kt-form" id="formAddSubCategory" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_id">Catégorie</label>
                            <select name="category_id" id="category_id">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Nom de la catégorie</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="short">Nom court</label>
                            <input type="text" name="short" id="short" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-circle"></i> Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/tutoriel/category/index.js') }}"></script>
@endsection
