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

Route::group(["prefix" => "download", "namespace" => "Api\Download"], function () {
    Route::get('latest', 'DownloadController@latest');
});

Route::group(["prefix" => "tutoriel", "namespace" => "Api\Tutoriel"], function () {
    Route::get('latest', 'TutorielController@latest');
});

Route::get('search', 'SearchController@search');
