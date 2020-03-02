<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "blog", "namespace" => "Api\Blog"], function () {
    Route::get('latest', "BlogController@latest");
});

Route::group(["prefix" => "route", 'namespace' => "Api\Route"], function () {
    Route::get('{route_id}', 'RouteController@get');
    Route::get('{route_id}/versions', 'RouteController@listVersions');
    Route::get('{route_id}/version/{version_id}', 'RouteController@loadVersion');
    Route::get('{route_id}/version/{version_id}/loadGares', 'RouteController@loadGares');

    Route::get('{route_id}/loadGalleries', 'RouteController@loadGalleries');
    Route::get('{route_id}/loadGalleries/{category_id}', 'RouteController@loadGalleriesCategory');

    Route::get('{route_id}/loadTaskTodo', 'RouteController@loadTaskTodo');
    Route::get('{route_id}/loadTaskProgress', 'RouteController@loadTaskProgress');
    Route::get('{route_id}/loadTaskFinished', 'RouteController@loadTaskFinished');

    Route::get('{route_id}/download/{download_id}', 'RouteController@getDownload');
});

Route::group(["prefix" => "download", "namespace" => "Api\Download"], function () {
    Route::get('latest', 'DownloadController@latest');
    Route::get('{asset_id}/loadMesh', 'DownloadController@loadMesh');
});

Route::group(["prefix" => "tutoriel", "namespace" => "Api\Tutoriel"], function () {
    Route::get('latest', 'TutorielController@latest');
    Route::get('{sub_id}/listTutoriel', 'TutorielController@listTutoriel');
    Route::get('{tutoriel_id}', 'TutorielController@tutoriel');
    Route::get('{tutoriel_id}/viewLater', 'TutorielController@viewLater');
    Route::get('{tutoriel_id}/view', 'TutorielController@view');
});

Route::group(["prefix" => "wiki", "namespace" => "Api\Wiki"], function () {
    Route::get('search', 'WikiController@search');
});

Route::group(["prefix" => "admin", "namespace" => "Api\Admin"], function () {
    Route::get('loadSignalement', 'AdminController@loadSignalement');

    Route::group(["prefix" => "blog", "namespace" => "Blog"], function () {
        Route::get('latest', 'BlogController@loadLatest');
        Route::get('comment/latest', 'BlogController@loadCommentLatest');

        Route::group(["prefix" => "category"], function () {
            Route::post('liste', 'BlogCategoryController@list');
            Route::post('create', 'BlogCategoryController@create');
        });

        Route::group(["prefix" => "article"], function (){
            Route::post('liste', 'BlogArticleController@list');
            Route::post('create', 'BlogArticleController@create');
            Route::get('{article_id}', 'BlogArticleController@get');
            Route::get('{article_id}/verifPublish', 'BlogArticleController@verifPublish');
            Route::get('{article_id}/publish', 'BlogArticleController@publish');
            Route::get('{article_id}/unpublish', 'BlogArticleController@unpublish');
            Route::put('{article_id}/editInfo', 'BlogArticleController@editInfo');
            Route::put('{article_id}/editThumbnail', 'BlogArticleController@editThumbnail');
            Route::put('{article_id}/textTwitter', 'BlogArticleController@textTwitter');
            Route::put('{article_id}/editDescription', 'BlogArticleController@editDescription');

            Route::post('{article_id}/comment/load', 'BlogCommentController@loadComments');
            Route::get('{article_id}/comment/{comment_id}/publish', 'BlogCommentController@publish');
            Route::get('{article_id}/comment/{comment_id}/unpublish', 'BlogCommentController@unpublish');

            Route::post('{article_id}/tag', 'BlogTagController@store');
            Route::post('{article_id}/tag/load', 'BlogTagController@load');
            Route::get('{article_id}/tag/{tag_id}/delete', 'BlogTagController@delete');
        });
    });

    Route::group(["prefix" => "route", "namespace" => "Route"], function (){
        Route::get('list', 'RouteController@list');
        Route::post('create', 'RouteController@store');
        Route::put('{route_id}/editDescription', 'RouteController@editDescription');
        Route::get('searchGare', 'RouteController@searchGare');

        Route::get('{route_id}/publish', 'RouteController@publish');
        Route::get('{route_id}/unpublish', 'RouteController@unpublish');

        Route::group(["prefix" => "{route_id}/version"], function (){
            Route::post('loadGares', 'RouteVersionController@loadGares');
            Route::post('/', 'RouteVersionController@store');
            Route::put('{version_id}/editDescription', 'RouteVersionController@editDescription');
            Route::put('{version_id}/editThumbnail', 'RouteVersionController@editThumbnail');
            Route::get('{version_id}/delete', 'RouteVersionController@deleteVersion');

            Route::group(["prefix" => "{version_id}/gare"], function () {
                Route::post('/', 'RouteVersionController@createGare');
                Route::get('{gare_id}/delete', 'RouteVersionController@deleteGare');
            });
        });
    });

    Route::group(["prefix" => "tutoriel"], function () {
        Route::get('/latest', 'TutorielController@loadLatest');
    });
});

Route::get('search', 'SearchController@search');
