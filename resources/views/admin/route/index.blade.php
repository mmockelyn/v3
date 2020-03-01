@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion des Routes </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.index') }}" class="kt-subheader__breadcrumbs-link">Route </a>

                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tableau de Bord</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-road"></i>
					</span>
                <h3 class="kt-portlet__head-title">
                    Liste des routes
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
                                    <input type="text" class="form-control" placeholder="Recherche..." id="routeSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a data-toggle="modal" data-target="#addRoute" class="btn btn-default kt-hidden-">
                            <i class="la la-plus"></i> Nouvelle route
                        </a>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div id="listeRoute"></div>
        </div>
    </div>
    <div class="modal fade" id="addRoute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle route</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/create" class="kt-form" id="formAddRoute" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom de la Route</label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Tapez le nom de la route...">
                        </div>
                        <div class="form-group">
                            <label for="description">Description de la route</label>
                            <textarea name="description" class="form-control summernote"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="images">Thumbnail</label>
                            <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                <div class="kt-avatar__holder" style="background-image: url(/storage/route/map.png)"></div>
                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Changez l'image">
                                    <i class="fa fa-pen"></i>
                                    <input type="file" name="images" accept=".png, .jpg, .jpeg">
                                </label>
                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Supprimer l'image">
															<i class="fa fa-times"></i>
														</span>
                            </div>
                            <span class="form-text text-muted">Fichier autorisé: png, jpg, jpeg.</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @toastr_render
    <script src="{{ asset('js/admin/route/index.js') }}"></script>
@endsection
