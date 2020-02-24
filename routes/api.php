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
});

Route::group(["prefix" => "download", "namespace" => "Api\Download"], function () {
    Route::get('latest', 'DownloadController@latest');
});

Route::group(["prefix" => "tutoriel", "namespace" => "Api\Tutoriel"], function () {
    Route::get('latest', 'TutorielController@latest');
});

Route::get('search', 'SearchController@search');
