<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["namespace" => "Front"], function () {
    Route::get('/', ["as" => "Front.index", "uses" => "HomeController@index"]);

    Route::group(["prefix" => "blog", "namespace" => "Blog"], function () {
        Route::get('/', ["as" => "Front.Blog.index", "uses" => "BlogController@index"]);
        Route::get('{slug}', ["as" => "Front.Blog.show", "uses" => "BlogController@show"]);

        Route::group(["prefix" => "api"], function () {
            Route::get('loadCarousel', 'BlogApiController@loadCarousel');
            Route::get('loadNews', 'BlogApiController@loadNews');

            Route::post('{article_id}/comments', ["as" => "Blog.Comment.post", "uses" => "BlogApiController@postComment"]);
            Route::get('{article_id}/comment/{comment_id}', ["as" => "Blog.Comment.delete", "uses" => "BlogApiController@deleteComment"]);
        });
    });

    Route::group(["prefix" => "route", "namespace" => "Route"], function () {
        Route::get('/', ["as" => "Front.Route.index", "uses" => "RouteController@index"]);
        Route::get('{id}', ["as" => "Front.Route.show", "uses" => "RouteController@show"]);
        Route::get('{id}/gallery', ["as" => "Front.Route.gallery", "uses" => "RouteController@gallery"]);
        Route::get('{id}/labs', ["as" => "Front.Route.labs", "uses" => "RouteController@labs"]);
        Route::get('{id}/download', ["as" => "Front.Route.download", "uses" => "RouteController@download"]);
        Route::group(["prefix" => "{id}/version", "namespace" => "Version"], function () {
            Route::get('{version_id}', ["as" => 'Route.Version.info', "uses" => "VersionController@info"]);
        });
    });

    Route::group(["prefix" => "download", "namespace" => "Download"], function () {
        Route::get('/', ["as" => "Front.Download.index", "uses" => "DownloadController@index"]);
        Route::get('{category_id}', ["as" => "Front.Download.category", "uses" => "DownloadController@category"]);
        Route::get('{category_id}/{subcategory_id}', ["as" => "Front.Download.list", "uses" => "DownloadController@list"]);
        Route::get('{category_id}/{subcategory_id}/{asset_id}', ["as" => "Front.Download.show", "uses" => "DownloadController@show"]);
        Route::get('{category_id}/{subcategory_id}/{asset_id}/mesh', ["as" => "Front.Download.mesh", "uses" => "DownloadController@mesh"]);
        Route::get('{category_id}/{subcategory_id}/{asset_id}/config', ["as" => "Front.Download.config", "uses" => "DownloadController@config"]);
        Route::get('{category_id}/{subcategory_id}/{asset_id}/download', ["as" => "Front.Download.download", "uses" => "DownloadController@download"]);
    });

    Route::group(["prefix" => "tutoriel", "namespace" => "Tutoriel"], function () {
        Route::get('/', ["as" => "Front.Tutoriel.index", "uses" => "TutorielController@index"]);
        Route::get('{subcategory_id}', ["as" => "Front.Tutoriel.list", "uses" => "TutorielController@list"]);
        Route::get('{subcategory_id}/{tutoriel_id}', ["as" => "Front.Tutoriel.show", "uses" => "TutorielController@show"]);
        Route::get('{subcategory_id}/{tutoriel_id}/video', ["as" => "Front.Tutoriel.video", "uses" => "TutorielController@video"]);
        Route::get('{subcategory_id}/{tutoriel_id}/source', ["as" => "Front.Tutoriel.source", "uses" => "TutorielController@source"]);



        Route::group(["prefix" => "api"], function (){
            Route::get('{tutoriel_id}/viewLater', 'TutorielApiController@viewLater');
            Route::get('{tutoriel_id}/view', 'TutorielApiController@view');

            Route::post('{tutoriel_id}/comments', ["as" => "Tutoriel.Comment.post", "uses" => "TutorielApiController@postComment"]);
            Route::get('{tutoriel_id}/comment/{comment_id}', ["as" => "Tutoriel.Comment.delete", "uses" => "TutorielApiController@deleteComment"]);
        });
    });

    Route::group(["prefix" => "wiki", "namespace" => "Wiki"], function () {
        Route::get('/', ["as" => "Front.Wiki.index", "uses" => "WikiController@index"]);
        Route::get('{category_id}', ["as" => "Front.Wiki.sub", "uses" => "WikiController@sub"]);
        Route::get('{category_id}/{sub_id}', ["as" => "Front.Wiki.list", "uses" => "WikiController@list"]);
        Route::get('{category_id}/{sub_id}/{wiki_id}', ["as" => "Front.Wiki.show", "uses" => "WikiController@show"]);

        Route::post('/', ["as" => "Front.Wiki.postSearch", "uses" => "WikiController@postSearch"]);
    });
});

Route::group(["prefix" => "administrator", "namespace" => "Admin", "middleware" => ["web"]], function (){
    Route::get('/', ["as" => "Back.dashboard", "uses" => "HomeController@dashboard"]);

    Route::group(["prefix" => "blog", "namespace" => "Blog"], function (){
        Route::get('/', ["as" => "Back.Blog.index", "uses" => "BlogController@index"]);

        Route::group(["prefix" => "category"], function (){
            Route::get('/', ["as" => "Back.Blog.Category.index", "uses" => "BlogCategoryController@index"]);
            Route::get('{category_id}/edit', ["as" => "Back.Blog.Category.edit", "uses" => "BlogCategoryController@edit"]);
            Route::put('{category_id}/edit', ["as" => "Back.Blog.Category.update", "uses" => "BlogCategoryController@update"]);
            Route::get('{category_id}/delete', ["as" => "Back.Blog.Category.delete", "uses" => "BlogCategoryController@delete"]);
        });

        Route::group(["prefix" => "article"], function (){
            Route::get('/', ["as" => "Back.Blog.Article.index", "uses" => "BlogArticleController@article"]);
            Route::get('{article_id}', ["as" => "Back.Blog.Article.show", "uses" => "BlogArticleController@show"]);
            Route::get('{article_id}/edit', ["as" => "Back.Blog.Article.edit", "uses" => "BlogArticleController@edit"]);
            Route::put('{article_id}/edit', ["as" => "Back.Blog.Article.update", "uses" => "BlogArticleController@update"]);
            Route::get('{article_id}/delete', ["as" => "Back.Blog.Article.delete", "uses" => "BlogArticleController@delete"]);
        });
    });

    Route::group(["prefix" => "route", "namespace" => "Route"], function (){
        Route::get('/', ["as" => "Back.Route.index", "uses" => "RouteController@index"]);
        Route::get('{route_id}', ["as" => "Back.Route.show", "uses" => "RouteController@show"]);

        Route::group(["prefix" => "{route_id}/version"], function (){
            Route::get('/', ["as" => "Route.Version.index", "uses" => "RouteVersionController@index"]);
        });

        Route::group(["prefix" => "{route_id}/gallery"], function (){
            Route::get('/', ["as" => "Route.Gallery.index", "uses" => "RouteGalleryController@index"]);
        });

        Route::group(["prefix" => "{route_id}/lab"], function (){
            Route::get('/', ["as" => "Route.Lab.index", "uses" => "RouteLabController@index"]);
            Route::get('{anomalie_id}/edit', ["as" => "Route.Lab.edit", "uses" => "RouteLabController@edit"]);
        });

        Route::group(["prefix" => "{route_id}/download"], function (){
            Route::get('/', ["as" => "Route.Download.index", "uses" => "RouteDownloadController@index"]);
            Route::get('{download_id}/edit', ["as" => "Route.Download.edit", "uses" => "RouteDownloadController@editDownload"]);
            Route::get('updater/{updater_id}/edit', ["as" => "Route.Download.editd", "uses" => "RouteDownloadController@editUpdater"]);
        });

        Route::group(["prefix" => "{route_id}/config"], function (){
            Route::get('/', ["as" => "Route.Config.index", "uses" => "RouteConfigController@index"]);
        });
    });

    Route::group(["prefix" => "objet", "namespace" => "Objet"], function (){
        Route::get('/', ["as" => "Back.Objet.index", "uses" => "ObjetController@index"]);

        Route::group(["prefix" => "category"], function (){
            Route::get('/', ["as" => "Back.Objet.Category.index", "uses" => "ObjetCategoryController@index"]);
            Route::get('{category_id}/delete', 'ObjetCategoryController@delete');
        });

        Route::group(["prefix" => "subcategory"], function (){
            Route::get('{subcategory_id}/delete', 'ObjetSubCategoryController@delete');
        });

        Route::group(["prefix" => "objet"], function () {
            Route::get('/', ["as" => "Back.Objet.Objet.index", "uses" => "ObjetObjetController@index"]);
            Route::get('{objet_id}', ["as" => "Back.Objet.Objet.show", "uses" => 'ObjetObjetController@show']);
            Route::get('{objet_id}/edit', ["as" => "Back.Objet.Objet.edit", "uses" => 'ObjetObjetController@edit']);
            Route::get('{objet_id}/delete', ["as" => "Back.Objet.Objet.delete", "uses" => 'ObjetObjetController@delete']);

            Route::put('{objet_id}/editThumb', ["as" => "Back.Objet.Objet.editThumb", "uses" => "ObjetObjetController@editThumb"]);

            Route::group(["prefix" => "{objet_id}/compatibility"], function () {
                Route::get('{compatibility_id}/delete', 'ObjetObjetController@deleteCompatibility');
            });

            Route::group(["prefix" => "{objet_id}/tag"], function () {
                Route::get('{tag_id}/delete', 'ObjetObjetController@deleteTag');
            });
        });
    });


    Route::group(["prefix" => "tutoriel", "namespace" => "Tutoriel"], function (){
        Route::get('/', ["as" => "Back.Tutoriel.index", "uses" => "TutorielController@index"]);

        Route::group(["prefix" => "category"], function () {
            Route::get('/', 'TutorielCategoryController@index')->name('Back.Tutoriel.Category.index');
            Route::get('{category_id}/delete', 'TutorielCategoryController@delete');
        });

        Route::group(["prefix" => "subcategory"], function () {
            Route::get('{subcategory_id}/delete', 'TutorielSubCategoryController@delete');
        });

        Route::group(["prefix" => "video"], function () {
            Route::get('/', 'TutorielVideoController@index')->name('Back.Tutoriel.Video.index');
            Route::get('{video_id}', 'TutorielVideoController@show')->name('Back.Tutoriel.Video.show');
            Route::get('{video_id}/edit', 'TutorielVideoController@edit')->name('Back.Tutoriel.Video.edit');
            Route::get('{video_id}/delete', 'TutorielVideoController@delete')->name('Back.Tutoriel.Video.delete');
        });

        Route::group(["prefix" => "{video_id}/comment"], function () {
            Route::get('{comment_id}/publish', 'TutorielCommentController@publish');
            Route::get('{comment_id}/unpublish', 'TutorielCommentController@unpublish');
        });

        Route::group(["prefix" => "{video_id}/tags"], function () {
            Route::get('{tag_id}/delete', 'TutorielVideoController@deleteTag');
        });

        Route::group(["prefix" => "{video_id}/techno"], function () {

        });

        Route::group(["prefix" => "{video_id}/requis"], function () {

        });
    });

    Route::group(["prefix" => "wiki", "namespace" => "Wiki"], function (){
        Route::get('/', ["as" => "Back.Wiki.index", "uses" => "WikiController@index"]);

        Route::group(["prefix" => "category"], function () {
            Route::get('/', ["as" => "Back.Wiki.Category.index", "uses" => "WikiCategoryController@index"]);
            Route::get('{category_id}/delete', ["as" => "Back.Wiki.Category.delete", "uses" => "WikiCategoryController@deleteCategory"]);
        });

        Route::group(["prefix" => "subcategory"], function () {
            Route::get('{sub_id}/delete', ["as" => "Back.Wiki.Sub.index", "uses" => "WikiCategoryController@deleteSubCategory"]);
        });

        Route::group(["prefix" => "article"], function () {
            Route::get('/', ["as" => "Back.Wiki.Article.index", "uses" => "WikiArticleController@index"]);
            Route::get('{article_id}', ["as" => "Back.Wiki.Article.show", "uses" => "WikiArticleController@show"]);
            Route::get('{article_id}/edit', ["as" => "Back.Wiki.Article.edit", "uses" => "WikiArticleController@edit"]);
            Route::put('{article_id}/editThumb', ["as" => "Back.Wiki.Article.editThumb", "uses" => "WikiArticleController@editThumb"]);
            Route::get('{article_id}/delete', ["as" => "Back.Wiki.Article.delete", "uses" => "WikiArticleController@delete"]);
            Route::get('{article_id}/{sommaire_id}/delete', 'WikiArticleController@deleteSommaire');
        });
    });

    Route::group(["prefix" => "user", "namespace" => "User"], function (){
        Route::get('/', ["as" => "Back.User.index", "uses" => "UserController@index"]);
    });

    Route::group(["prefix" => "slideshow", "namespace" => "Slideshow"], function (){
        Route::get('/', ["as" => "Back.Slideshow.index", "uses" => "SlideshowController@index"]);
    });

    Route::group(["prefix" => "commerce", "namespace" => "Commerce"], function (){
        Route::get('/', ["as" => "Back.Commerce.index", "uses" => "CommerceController@index"]);
    });

    Route::group(["prefix" => "inbox", "namespace" => "Inbox"], function (){
        Route::get('/', ["as" => "Back.Inbox.index", "uses" => "InboxController@index"]);
    });
});

Route::group(["middleware" => ["web", "verified"], "prefix" => "account", "namespace" => "Account"], function () {
    Route::get('/', ["as" => "Account.index", "uses" => "AccountController@index"]);
    Route::get('/invoice/{invoice_id}', ["as" => "Account.Invoice.show", "uses" => "AccountController@invoiceShow"]);

    Route::group(["prefix" => "premium"], function () {
        route::get('/', ["as" => "Account.Premium.index", "uses" => "AccountPremiumController@index"]);
        route::post('/', ["as" => "Account.Premium.subscribe", "uses" => "AccountPremiumController@subscribe"]);

        Route::get('/extends', ["as" => "Account.Premium.extends", "uses" => "AccountPremiumController@extends"]);
        Route::post('/extends', ["as" => "Account.Premium.updateAbo", "uses" => "AccountPremiumController@updateAbo"]);
    });

    Route::group(["prefix" => "api"], function () {
        Route::get('latestActivity', 'AccountApiController@loadLatestActivity');
        Route::get('latestInvoice', 'AccountApiController@loadLatestInvoice');
        Route::get('delete', 'AccountApiController@delete');
        Route::get('verifCarte', 'AccountApiController@verifCarte');
        Route::get('invoices', 'AccountApiController@invoices');
        Route::get('loadPayments', 'AccountApiController@loadPayments');
        Route::get('/invoice/{invoice_id}', 'accountApiController@invoice');
        Route::get('contrib/blog', 'AccountApiController@loadContribBlog');
        Route::get('contrib/tutoriel', 'AccountApiController@loadContribTutoriel');
        Route::get('connect', 'AccountApiController@connect');
        Route::get('isPremium', 'AccountApiController@isPremium');

        Route::get('/deletePayment/{pm_id}', 'AccountApiController@deletePayment');

        Route::post('update', ["as" => "Account.update", "uses" => "AccountApiController@update"]);
        Route::post('updatePass', ["as" => "Account.updatePass", "uses" => "AccountApiController@updatePass"]);
        Route::post('addMethodPayment', ["as" => "Account.addMethodPayment", "uses" => "AccountApiController@addMethodPayment"]);
        Route::post('createMethodPayment', ["as" => "Account.createMethodPayment", "uses" => "AccountApiController@createMethodPayment"]);
        Route::post('social/disconnect', 'AccountApiController@disconnect');


    });
});

Route::group(["prefix" => "provider", "namespace" => "Provider"], function () {
    Route::get('redirect/{provider}', 'ProviderController@redirect');
    Route::get('callback/{provider}', 'ProviderController@callback');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');
Route::get('/test', 'TestController@test');
Route::get('/linter', 'HomeController@linter');
