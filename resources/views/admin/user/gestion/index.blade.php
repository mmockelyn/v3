@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Liste des utilisateurs </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.User.index') }}" class="kt-subheader__breadcrumbs-link">Utilisateurs </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Liste des utilisateurs</span>
                </div>
            </div>
            <!--<div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="" class="btn btn-info"><i class="la la-plus"></i> Créer un nouvelle article</a>
                </div>
            </div>-->
        </div>
    </div>
@endsection

@section("content")
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="kt-nav">
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.User.index')) }}">
                            <a href="{{ route('Back.User.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                <span class="kt-nav__link-text">Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.User.Gestion.index')) }}">
                            <a href="{{ route('Back.User.Gestion.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon-users-1"></i>
                                <span class="kt-nav__link-text">Utilisateurs</span>
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
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon-users-1"></i>
						</span>
                        <h3 class="kt-portlet__head-title">
                            Liste des utilisateurs
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
                                                   id="userSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
												<span><i class="la la-search"></i></span>
											</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a data-toggle="modal" href="#addUser" class="btn btn-default kt-hidden-">
                                    <i class="la la-plus-circle"></i> Nouvelle utilisateur
                                </a>
                                <div
                                    class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">

                    <!--begin: Datatable -->
                    <div class="kt-datatable" id="listeUser"></div>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-plus-circle"></i> Nouvelle
                        utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/user/create" class="kt-form" id="formAddUser" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom & Prénom</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="Nom & Prénom de l'utilisateur..." required>
                        </div>
                        <div class="form-group">
                            <label for="name">Adresse Mail</label>
                            <input type="email" class="form-control" name="email"
                                   placeholder="Adresse Mail de l'utilisateur..." required>
                        </div>
                        <div class="form-group">
                            <label for="name">Groupe</label>
                            <select class="form-control" name="group" required>
                                <option value="0">Utilisateur</option>
                                <option value="1">Administrateur</option>
                            </select>
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
    <script src="{{ asset('js/admin/user/gestion/index.js') }}"></script>
@endsection
