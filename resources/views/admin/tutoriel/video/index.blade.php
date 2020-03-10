@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion des vidéos </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Tutoriel.index') }}" class="kt-subheader__breadcrumbs-link">Tutoriel </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Gestion des vidéos</span>
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
                            Liste des tutoriels
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Recherche..."
                                                   id="tutorielSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
												<span><i class="la la-search"></i></span>
											</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Publier:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select selectpicker"
                                                        id="kt_form_publish">
                                                    <option value="">Tous les états</option>
                                                    <option value="0">Non Publier</option>
                                                    <option value="1">Publier</option>
                                                    <option value="2">En attente de publication</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline kt-hidden">
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
                                <a data-toggle="modal" href="#addTutoriel" class="btn btn-default kt-hidden-">
                                    <i class="la la-cart-plus"></i> Nouveau tutoriel
                                </a>
                                <div
                                    class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">

                    <!--begin: Datatable -->
                    <div class="kt-datatable" id="listeTutoriel"></div>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTutoriel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouveau tutoriel
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/tutoriel/video" class="kt-form" id="formAddTutoriel" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" id="title" name="title" class="form-control form-control-lg"
                                   placeholder="Titre du tutoriel" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Catégorie</label>
                                    <select name="category_id" id="category_id" class="form-control selectpicker"
                                            data-live-search="true">
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="subcategory_field">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="short_content">Courte description</label>
                            <textarea name="short_content" id="short_content" cols="30" rows="10"
                                      class="summernote"></textarea>
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
    <script src="{{ asset('js/admin/tutoriel/video/index.js') }}"></script>
@endsection
