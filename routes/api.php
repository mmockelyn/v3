<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', 'BlogController@all');
    Route::post('/', 'BlogController@allWithLimit');
});

Route::group(["prefix" => "route", 'namespace' => "Api\Route"], function () {
    Route::get('/', 'RouteController@all');
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

    Route::get('{route_id}/updaters', 'RouteUpdaterController@listVersions');

    Route::get('{route_id}/loadInfoVersion/{version}/{build}', 'RouteController@loadInfoVersion');
});

Route::group(["prefix" => "download", "namespace" => "Api\Download"], function () {
    Route::get('/', 'DownloadController@all');
    Route::get('latest', 'DownloadController@latest');
    Route::get('{asset_id}/loadMesh', 'DownloadController@loadMesh');
    Route::get('{asset_id}/loadConfig', 'DownloadController@loadConfig');
});

Route::group(["prefix" => "tutoriel", "namespace" => "Api\Tutoriel"], function () {
    Route::get('/', 'TutorielController@all');
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
    Route::post('loadSignalement', 'AdminController@loadSignalement');
    Route::get('cache', "AdminController@cache");

    Route::group(["prefix" => "blog", "namespace" => "Blog"], function () {
        Route::get('latest', 'BlogController@loadLatest');
        Route::get('comment/latest', 'BlogController@loadCommentLatest');

        Route::group(["prefix" => "category"], function () {
            Route::post('liste', 'BlogCategoryController@list');
            Route::post('create', 'BlogCategoryController@create');
        });

        Route::group(["prefix" => "article"], function () {
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

            Route::post('comment/load', 'BlogCommentController@loadAllComments');
            Route::post('{article_id}/comment/load', 'BlogCommentController@loadComments');
            Route::get('{article_id}/comment/{comment_id}/publish', 'BlogCommentController@publish');
            Route::get('{article_id}/comment/{comment_id}/unpublish', 'BlogCommentController@unpublish');

            Route::post('{article_id}/tag', 'BlogTagController@store');
            Route::post('{article_id}/tag/load', 'BlogTagController@load');
            Route::get('{article_id}/tag/{tag_id}/delete', 'BlogTagController@delete');
        });
    });

    Route::group(["prefix" => "route", "namespace" => "Route"], function () {
        Route::get('list', 'RouteController@list');
        Route::post('create', 'RouteController@store');
        Route::put('{route_id}/editDescription', 'RouteController@editDescription');
        Route::get('searchGare', 'RouteController@searchGare');
        Route::post('{route_id}/nextVersion', 'RouteController@nextVersion');

        Route::get('{route_id}/publish', 'RouteController@publish');
        Route::get('{route_id}/unpublish', 'RouteController@unpublish');

        Route::group(["prefix" => "{route_id}/version"], function () {
            Route::post('loadGares', 'RouteVersionController@loadGares');
            Route::post('/', 'RouteVersionController@store');
            Route::put('{version_id}/editDescription', 'RouteVersionController@editDescription');
            Route::put('{version_id}/editThumbnail', 'RouteVersionController@editThumbnail');
            Route::get('{version_id}/delete', 'RouteVersionController@deleteVersion');
            Route::post('uploadVideo', 'RouteVersionController@uploadVideo');

            Route::group(["prefix" => "{version_id}/gare"], function () {
                Route::post('/', 'RouteVersionController@createGare');
                Route::get('{gare_id}/delete', 'RouteVersionController@deleteGare');
            });
        });

        Route::group(["prefix" => "{route_id}/gallery"], function () {
            Route::post('addCategory', 'RouteGalleryController@addCategory');
            Route::post('uploadFile', 'RouteGalleryController@uploadFile');
            Route::delete('deleteCategory', 'RouteGalleryController@deleteCategory');
            Route::get('{gallery_id}/delete', 'RouteGalleryController@deleteGallery');
        });

        Route::group(["prefix" => "{route_id}/anomalie"], function () {
            Route::get('loadStat', 'RouteLabController@loadState');
            Route::post('/', 'RouteLabController@store');
            Route::post('loadAnomalies', "RouteLabController@loadAnomalies");
            Route::put('nextState', 'RouteLabController@nextState');
            Route::put('{anomalie_id}/edit', 'RouteLabController@updateAnomalie');
            Route::get('{anomalie_id}/delete', 'RouteLabController@deleteAnomalie');
        });

        Route::group(["prefix" => '{route_id}/download'], function () {
            Route::post('loadDownload', 'RouteDownloadController@loadDownload');
            Route::post('loadUpdater', 'RouteDownloadController@loadUpdater');
            Route::post('storeDownload', 'RouteDownloadController@storeDownload');
            Route::post('storeUpdater', 'RouteDownloadController@storeUpdater');

            Route::put('{download_id}/edit', 'RouteDownloadController@updateDownload');
            Route::get('{download_id}/delete', 'RouteDownloadController@deleteDownload');
            Route::put('/updater/{updater_id}/edit', 'RouteDownloadController@updateUpdater');
            Route::get('/updater/{updater_id}/delete', 'RouteDownloadController@deleteUpdater');
        });

        Route::group(["prefix" => "config"], function () {
            Route::post('loadTypeDownload', 'RouteConfigController@loadTypeDownload');
            Route::post('loadTypeRelease', 'RouteConfigController@loadTypeRelease');
            Route::get('type/{type_id}', 'RouteConfigController@deleteType');
            Route::get('release/{release_id}', 'RouteConfigController@deleteTypeRelease');
            Route::post('type', 'RouteConfigController@store');
            Route::post('release', 'RouteConfigController@storeRelease');
        });
    });

    Route::group(["prefix" => "objet", "namespace" => "Objet"], function () {
        Route::post('loadLatestCategories', 'ObjetController@loadLatestCategories');
        Route::post('loadLatestObjets', 'ObjetController@loadLatestObjets');

        Route::group(["prefix" => "category"], function () {
            Route::post('list', 'ObjetCategoryController@list');
            Route::post('/', 'ObjetCategoryController@store');
        });

        Route::group(["prefix" => "subcategory"], function () {
            Route::post('list', 'ObjetSubCategoryController@list');
            Route::post('/', 'ObjetSubCategoryController@store');
            Route::get('{category_id}/list', 'ObjetSubCategoryController@listSub');
        });

        Route::group(["prefix" => "objet"], function () {
            Route::post('list', 'ObjetObjetController@list');
            Route::post('', 'ObjetObjetController@store');
            Route::get('{objet_id}', 'ObjetObjetController@get');
            Route::put('{objet_id}', 'ObjetObjetController@update');
            Route::get('{objet_id}/verifPublish', 'ObjetObjetController@verifPublish');
            Route::get('{objet_id}/publish', 'ObjetObjetController@publish');
            Route::get('{objet_id}/unpublish', 'ObjetObjetController@unpublish');
            Route::post('{objet_id}/tag', 'ObjetObjetController@postTag');
            Route::post('{objet_id}/compatibility', 'ObjetObjetController@postCompatibility');
            Route::post('{objet_id}/uploadDownloadFile', 'ObjetObjetController@uploadDownloadFile');
            Route::post('{objet_id}/uploadFbx', 'ObjetObjetController@uploadFbx');
            Route::post('{objet_id}/uploadConfigFile', 'ObjetObjetController@uploadConfigFile');
            Route::put('{objet_id}/editPrice', 'ObjetObjetController@editPrice');
            Route::put('{objet_id}/editInfo', 'ObjetObjetController@editInfo');
            Route::put('{objet_id}/editDescription', 'ObjetObjetController@editDescription');

            Route::group(["prefix" => "{asset_id}/compatibility"], function () {
                Route::post('/list', 'ObjetObjetController@compatibilitiesList');
            });

            Route::group(["prefix" => "{asset_id}/tag"], function () {
                Route::post('/list', 'ObjetObjetController@tagList');
            });
        });
    });

    Route::group(["prefix" => "tutoriel", "namespace" => "Tutoriel"], function () {
        Route::get('/latest', 'TutorielController@loadLatest');

        Route::group(["prefix" => "category"], function () {
            Route::post('/', 'TutorielCategoryController@store');
            Route::post('list', 'TutorielCategoryController@list');
        });

        Route::group(["prefix" => "subcategory"], function () {
            Route::post('/', 'TutorielSubCategoryController@store');
            Route::post('list', 'TutorielSubCategoryController@list');
            Route::get('{category_id}/list', 'TutorielSubCategoryController@listSub');
        });

        Route::group(["prefix" => "video"], function () {
            Route::post('/', 'TutorielVideoController@store');
            Route::post('/list', 'TutorielVideoController@list');
            Route::put('{tutoriel_id}/editInfo', 'TutorielVideoController@editInfo');
            Route::post('{tutoriel_id}/editBackground', 'TutorielVideoController@editBackground');
            Route::post('{tutoriel_id}/editBanner', 'TutorielVideoController@editBanner');
            Route::put('{tutoriel_id}/editDescription', 'TutorielVideoController@editDescription');

            Route::put('{tutoriel_id}/publishLater', 'TutorielVideoController@publishLater');
            Route::get('{tutoriel_id}/publish', 'TutorielVideoController@publish');
            Route::get('{tutoriel_id}/unpublish', 'TutorielVideoController@unpublish');
            Route::post('{tutoriel_id}/publishVideo', 'TutorielVideoController@publishVideo');
            Route::post('{tutoriel_id}/publishSource', 'TutorielVideoController@publishSource');
            Route::post('{tutoriel_id}/listeComments', 'TutorielCommentController@listeComments');
            Route::post('{tutoriel_id}/listeTags', 'TutorielVideoController@listeTags');
            Route::post('{tutoriel_id}/listeTechno', 'TutorielVideoController@listeTechno');
            Route::post('{tutoriel_id}/listeRequis', 'TutorielVideoController@listeRequis');

        });

        Route::group(["prefix" => "comment"], function () {
            Route::get('/latest', 'TutorielCommentController@latest');
            Route::post('/', 'TutorielCommentController@load');
        });

        Route::group(["prefix" => "{tutoriel_id}/tag"], function () {
            Route::post('/', 'TutorielVideoController@storeTag');
            Route::get('{tag_id}/delete', 'TutorielVideoController@deleteTag');
        });

        Route::group(["prefix" => "{tutoriel_id}/techno"], function () {
            Route::post('/', 'TutorielVideoController@storeTechno');
            Route::get('{techno_id}/delete', 'TutorielVideoController@deleteTechno');
        });

        Route::group(["prefix" => "{tutoriel_id}/requis"], function () {
            Route::post('/', 'TutorielVideoController@storeRequis');
            Route::get('{requis_id}/delete', 'TutorielVideoController@deleteRequis');
        });
    });

    Route::group(["prefix" => "wiki", "namespace" => "Wiki"], function () {

        Route::group(["prefix" => "category"], function () {
            Route::post('list', 'WikiCategoryController@list');
            Route::post('', 'WikiCategoryController@store');
        });

        Route::group(["prefix" => "subcategory"], function () {
            Route::post('list', 'WikiCategoryController@listSub');
            Route::post('list', 'WikiCategoryController@listSubByCategory');
            Route::post('', 'WikiCategoryController@storeSub');
        });

        Route::group(["prefix" => "article"], function () {
            Route::post('latest', 'WikiArticleController@latest');
            Route::post('list', 'WikiArticleController@list');
            Route::post('/', 'WikiArticleController@store');
            Route::put('{article_id}/editInfo', 'WikiArticleController@editInfo');
            Route::post('{article_id}/addContent', 'WikiArticleController@addContent');
            Route::get('{article_id}/publish', 'WikiArticleController@publish');
            Route::get('{article_id}/unpublish', 'WikiArticleController@unpublish');
        });
    });

    Route::group(["prefix" => "user", "namespace" => "User"], function () {
        Route::post('/', 'UserController@listeUser');
        Route::post('create', 'UserController@store');
        Route::post('latestSubscribe', 'UserController@latestSubscribe');
        Route::post('latestLogin', 'UserController@latestLogin');
        Route::put('{user_id}/update', 'UserController@update');
    });

    Route::group(["prefix" => "slideshow", "namespace" => "Slideshow"], function () {
        Route::post('list', 'SlideshowController@list');
        Route::post('store', 'SlideshowController@store');
    });
});

Route::group(["prefix" => "account", "namespace" => "Api\Account"], function () {
    Route::post('login', "AccountController@login");
    Route::post('register', "AccountController@register");
});

Route::get('search', 'SearchController@search');
