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

Route::group(["prefix" => "wiki", "namespace" => "Api\Wiki"], function (){
    Route::get('search', 'WikiController@search');
});

Route::group(["prefix" => "admin", "namespace" => "Api\Admin"], function (){
    Route::get('loadSignalement', 'AdminController@loadSignalement');

    Route::group(["prefix" => "blog"], function (){
        Route::get('latest', 'BlogController@loadLatest');
        Route::get('comment/latest', 'BlogController@loadCommentLatest');
    });

    Route::group(["prefix" => "tutoriel"], function (){
        Route::get('/latest', 'TutorielController@loadLatest');
    });
});

Route::get('search', 'SearchController@search');
