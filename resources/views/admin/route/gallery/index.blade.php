@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Gestion de la gallerie </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.index') }}" class="kt-subheader__breadcrumbs-link">Route </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Route.show', $route->id) }}" class="kt-subheader__breadcrumbs-link">{{ $route->name }} </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Gestion de la gallerie</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Route.index') }}" class="btn btn-sm btn-default"><i class="la la-arrow-circle-left"></i> Retour</a>
                    <button data-toggle="modal" data-target="#addCategory" class="btn btn-outline-brand"><i class="la la-plus-circle"></i> Nouvelle catégorie de gallerie</button>
                    <button data-toggle="modal" data-target="#deleteCategory" class="btn btn-icon btn-outline-danger"><i class="la la-times-circle" data-toggle="kt-tooltip" title="Supprimer une catégorie"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="route" data-id="{{ $route->id }}" data-published="{{ $route->published }}"></div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <ul class="kt-nav">
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Route.show',$route->id)) }}">
                        <a href="{{ route('Back.Route.show', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-signal"></i>
                            <span class="kt-nav__link-text">Tableau de Bord</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Version.index', $route->id)) }}">
                        <a href="{{ route('Route.Version.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-bars"></i>
                            <span class="kt-nav__link-text">Version</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Gallery.index', $route->id)) }}">
                        <a href="{{ route('Route.Gallery.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-picture-o"></i>
                            <span class="kt-nav__link-text">Gallerie</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Lab.index', $route->id)) }}">
                        <a href="{{ route('Route.Lab.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-flask"></i>
                            <span class="kt-nav__link-text">Avancement</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Download.index', $route->id)) }}">
                        <a href="{{ route('Route.Download.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-download"></i>
                            <span class="kt-nav__link-text">Téléchargement</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Route.Config.index', $route->id)) }}">
                        <a href="{{ route('Route.Config.index', $route->id) }}" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-cogs"></i>
                            <span class="kt-nav__link-text">Configuration</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success nav-tabs-line-2x" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#all" role="tab">
                                Tous ({{ count($galleries) }} {{ \App\HelpersClass\Generator::formatPlural('image', count($galleries)) }})
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#{{ \Illuminate\Support\Str::slug($category->name) }}" role="tab">
                                    {{ $category->name }} ({{ count($category->galleries) }} {{ \App\HelpersClass\Generator::formatPlural('image', count($category->galleries)) }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="all" role="tabpanel">
                        <div class="row">
                            @foreach($galleries as $gallery)
                                <div class="col-md-4 mb-lg-3">
                                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('route/'.$route->id.'/gallery/'.$gallery->filename) == true)
                                        <a href="/storage/route/{{ $route->id }}/gallery/{{ $gallery->filename }}" class="fancybox">
                                            <img src="/storage/route/{{ $route->id }}/gallery/{{ $gallery->filename }}" class="img-fluid" alt="">
                                        </a>
                                        <a href="/api/admin/route/{{ $route->id }}/gallery/{{ $gallery->id }}/delete" class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Supprimer l'images">
                                            <i class="fa fa-times kt-font-danger"></i>
                                        </a>
                                    @else
                                        <img src="https://via.placeholder.com/300" class="img-fluid" alt="">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach($categories as $category)
                        <div class="tab-pane" id="{{ \Illuminate\Support\Str::slug($category->name) }}" role="tabpanel">
                            <div class="text-right">
                                <button data-toggle="modal" data-target="#addImage_{{ $category->id }}" class="btn btn-outline-info"><i class="la la-plus"></i> Ajouter des images</button>
                            </div>
                            <div class="row">
                                @foreach($category->galleries as $gallery)
                                    <div class="col-md-4 mb-lg-3">
                                        @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('route/'.$route->id.'/gallery/'.$gallery->filename) == true)
                                            <a href="/storage/route/{{ $route->id }}/gallery/{{ $gallery->filename }}" class="fancybox"><img src="/storage/route/{{ $route->id }}/gallery/{{ $gallery->filename }}" class="img-fluid" alt=""></a>
                                        @else
                                            <img src="https://via.placeholder.com/300" class="img-fluid" alt="">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    @foreach($categories as $category)
    <div class="modal fade" id="addImage_{{ $category->id }}" data-category="{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'images à la gallerie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="" class="kt-form dropzone dropzone-default dropzone-brand" id="formAddImage">
                    <div class="modal-body">
                        <input type="hidden" id="category_id" name="cat" value="{{ $category->id }}">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Déposez des fichiers ici ou cliquez pour télécharger.</h3>
                            <span class="dropzone-msg-desc">Aucune limitation de taille de fichier</span><br>
                            <span class="dropzone-msg-desc">Fichier images uniquement (jpg,jpeg,png,bmp,etc...)</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/gallery/addCategory" class="kt-form" id="formAddCategory" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom de la catégorie</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="la la-check"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer une catégorie </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/api/admin/route/{{ $route->id }}/gallery/deleteCategory" class="kt-form" id="formDeleteCategory" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Selectionnez la ou les catégories à supprimer</p>
                            <div class="kt-checkbox-list">
                                @foreach($categories as $category)
                                <label class="kt-checkbox">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"> {{ $category->name }}
                                    <span></span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Supprimer les catégories</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @toastr_render
    <script src="{{ asset('js/admin/route/gallery.js') }}"></script>
@endsection
