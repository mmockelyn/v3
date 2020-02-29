@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Tableau de Bord </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Blog.index') }}" class="kt-subheader__breadcrumbs-link">Blog </a>

                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tableau de Bord</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="" class="btn btn-info"><i class="la la-plus"></i> Créer un nouvelle article</a>
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
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Blog.index')) }}">
                            <a href="{{ route('Back.Blog.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                <span class="kt-nav__link-text">Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Blog.Category.index')) }}">
                            <a href="{{ route('Back.Blog.Category.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-circle-vol-2"></i>
                                <span class="kt-nav__link-text">Catégories</span>
                            </a>
                        </li>
                        <li class="kt-nav__item {{ \App\HelpersClass\Generator::currentRouteBack(route('Back.Blog.Article.index')) }}">
                            <a href="{{ route('Back.Blog.Article.index') }}" class="kt-nav__link">
                                <i class="kt-nav__link-icon la la-newspaper-o"></i>
                                <span class="kt-nav__link-text">Articles</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h4>Nombre d'article</h4>
                            <h1 class="kt-font-bolder">{{ \App\HelpersClass\Blog\BlogHelper::countArticle() }}</h1>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>Nombre de commentaire par article (moyenne)</h4>
                            <h1 class="kt-font-bolder">{{ \App\HelpersClass\Blog\BlogHelper::moyCommentArticle() }}</h1>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>Nombre de commentaire total</h4>
                            <h1 class="kt-font-bolder">{{ \App\HelpersClass\Blog\BlogHelper::countCommentaires() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="flaticon2-comment"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Derniers Commentaires
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body" id="loadLatestComment">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-newspaper-o"></i>
					</span>
                                <h3 class="kt-portlet__head-title">
                                    Derniers Articles
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">

                            </div>
                        </div>
                        <div class="kt-portlet__body" id="loadLatestBlog">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/blog/index.js') }}"></script>
@endsection
