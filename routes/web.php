<?php

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
    Route::get('search', ["as" => "Front.search", "uses" => "SearchController@search"]);
    Route::post('search', ["as" => "Front.postSearch", "uses" => "SearchController@postSearch"]);

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

Route::group(["prefix" => "administrator", "namespace" => "Admin", "middleware" => ["auth"]], function (){
    Route::get('/', ["as" => "Back.dashboard", "uses" => "HomeController@dashboard"]);

    Route::group(["prefix" => "blog", "namespace" => "Blog"], function (){
        Route::get('/', ["as" => "Back.Blog.index", "uses" => "BlogController@index"]);

        Route::group(["prefix" => "category"], function (){
            Route::get('/', ["as" => "Back.Blog.Category.index", "uses" => "BlogCategoryController@index"]);
        });

        Route::group(["prefix" => "article"], function (){
            Route::get('/', ["as" => "Back.Blog.Article.index", "uses" => "BlogController@article"]);
        });
    });

    Route::group(["prefix" => "route", "namespace" => "Route"], function (){
        Route::get('/', ["as" => "Back.Route.index", "uses" => "RouteController@index"]);
    });

    Route::group(["prefix" => "objet", "namespace" => "Objet"], function (){
        Route::get('/', ["as" => "Back.Objet.index", "uses" => "ObjetController@index"]);
    });


    Route::group(["prefix" => "tutoriel", "namespace" => "Tutoriel"], function (){
        Route::get('/', ["as" => "Back.Tutoriel.index", "uses" => "TutorielController@index"]);
    });

    Route::group(["prefix" => "wiki", "namespace" => "Wiki"], function (){
        Route::get('/', ["as" => "Back.Wiki.index", "uses" => "WikiController@index"]);
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
});

Route::group(["middleware" => ["auth", "verified"], "prefix" => "account", "namespace" => "Account"], function () {
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

Auth::routes(['verify' => true]);

Route::get('logout', 'Auth\LoginController@logout');
Route::get('/test', 'TestController@test');
