@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion des catégories d'objets </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Blog.index') }}" class="kt-subheader__breadcrumbs-link">Objet </a>

                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Gestion des catégories d'objets</span>
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
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Objet.index')) }}">
                            <a href="{{ route('Back.Objet.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                <span class="kt-nav__link-text">Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Objet.Category.index')) }}">
                            <a href="{{ route('Back.Objet.Category.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-circle-vol-2"></i>
                                <span class="kt-nav__link-text">Catégories</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Objet.Objet.index')) }}">
                            <a href="{{ route('Back.Objet.Objet.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon la la-cubes"></i>
                                <span class="kt-nav__link-text">Objets</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-calendar-2"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Liste des catégories
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                &nbsp;
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a data-toggle="modal" href="#addCategory" class="btn btn-default kt-hidden-">
                                    <i class="la la-plus-circle"></i> Nouvelle Catégorie
                                </a>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div id="listeObjectCategories" class="kt-datatable"></div>
                </div>
            </div>
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-calendar-2"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Liste des sous-catégories
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                &nbsp;
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a data-toggle="modal" href="#addSubCategory" class="btn btn-default kt-hidden-">
                                    <i class="la la-plus-circle"></i> Nouvelle sous catégorie
                                </a>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div id="listeObjectSubCategories" class="kt-datatable"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouvelle catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/objet/category" class="kt-form" id="formAddCategory" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom de la catégorie</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-circle"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSubCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouvelle catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/objet/subcategory" class="kt-form" id="formAddSubCategory" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_id">Catégorie Parente</label>
                            <select name="category_id" id="category_id" class="form-control selectpicker">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Nom de la sous catégorie</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check-circle"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/objet/category/index.js') }}"></script>
@endsection
