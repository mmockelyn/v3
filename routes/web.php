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
    });

    Route::group(["prefix" => "route", "namespace" => "Route"], function () {
        Route::get('/', ["as" => "Front.Route.index", "uses" => "RouteController@index"]);
        Route::get('{id}', ["as" => "Front.Route.show", "uses" => "RouteController@show"]);
        Route::get('{id}/gallery', ["as" => "Front.Route.gallery", "uses" => "RouteController@gallery"]);
        Route::get('{id}/labs', ["as" => "Front.Route.labs", "uses" => "RouteController@labs"]);
        Route::get('{id}/download', ["as" => "Front.Route.download", "uses" => "RouteController@download"]);
        Route::group(["prefix" => "{id}/version", "namespace" => "Version"], function (){
            Route::get('{version_id}', ["as" => 'Route.Version.info', "uses" => "VersionController@info"]);
        });
    });

    Route::group(["prefix" => "download", "namespace" => "Download"], function () {
        Route::get('/', ["as" => "Front.Download.index", "uses" => "DownloadController@index"]);
        Route::get('{category_id}', ["as" => "Front.Download.category", "uses" => "DownloadController@category"]);
        Route::get('{category_id}/{subcategory_id}', ["as" => "Front.Download.list", "uses" => "DownloadController@list"]);
        Route::get('{category_id}/{subcategory_id}/{asset_id}', ["as" => "Front.Download.show", "uses" => "DownloadController@show"]);
    });

    Route::group(["prefix" => "tutoriel", "namespace" => "Tutoriel"], function (){
        Route::get('/', ["as" => "Front.Tutoriel.index", "uses" => "TutorielController@index"]);
        Route::get('{subcategory_id}', ["as" => "Front.Tutoriel.list", "uses" => "TutorielController@list"]);
        Route::get('{subcategory_id}/{tutoriel_id}', ["as" => "Front.Tutoriel.show", "uses" => "TutorielController@show"]);
        Route::get('{subcategory_id}/{tutoriel_id}/video', ["as" => "Front.Tutoriel.video", "uses" => "TutorielController@video"]);
        Route::get('{subcategory_id}/{tutoriel_id}/source', ["as" => "Front.Tutoriel.source", "uses" => "TutorielController@source"]);
    });

    Route::group(["prefix" => "wiki", "namespace" => "Wiki"], function (){
        Route::get('/', ["as" => "Front.Wiki.index", "uses" => "WikiController@index"]);
        Route::get('{category_id}', ["as" => "Front.Wiki.sub", "uses" => "WikiController@sub"]);
        Route::get('{category_id}/{sub_id}', ["as" => "Front.Wiki.list", "uses" => "WikiController@list"]);
        Route::get('{category_id}/{sub_id}/{wiki_id}', ["as" => "Front.Wiki.show", "uses" => "WikiController@show"]);

        Route::post('/', ["as" => "Front.Wiki.postSearch", "uses" => "WikiController@postSearch"]);
    });
});

Route::group(["middleware" => ["auth", "verified"], "prefix" => "account", "namespace" => "Account"], function (){
    Route::get('/', ["as" => "Account.index", "uses" => "AccountController@index"]);
    Route::get('premium/subscribe', 'AccountPremiumController@subscribe');

    Route::group(["prefix" => "api"], function () {
        Route::get('latestActivity', 'AccountApiController@loadLatestActivity');
        Route::get('latestInvoice', 'AccountApiController@loadLatestInvoice');

        Route::post('update', ["as" => "Account.update", "uses" => "AccountApiController@update"]);
        Route::post('updatePass', ["as" => "Account.updatePass", "uses" => "AccountApiController@updatePass"]);

        Route::post('social/disconnect', 'AccountApiController@disconnect');
    });
});

Route::group(["prefix" => "provider", "namespace" => "Provider"], function () {
    Route::get('redirect/{provider}', 'ProviderController@redirect');
    Route::get('callback/{provider}', 'ProviderController@callback');
});

Auth::routes(['verify' => true]);

Route::get('logout', 'Auth\LoginController@logout');
