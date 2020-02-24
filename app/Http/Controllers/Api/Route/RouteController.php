<?php

namespace App\Http\Controllers\Api\Route;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Route\RouteGalleryCategoryRepository;
use App\Repository\Route\RouteGalleryRepository;
use App\Repository\Route\RouteUpdaterRepository;
use App\Repository\Route\RouteVersionGareRepository;
use App\Repository\Route\RouteVersionRepository;
use Illuminate\Http\Request;

class RouteController extends BaseController
{
    /**
     * @var RouteUpdaterRepository
     */
    private $routeUpdaterRepository;
    /**
     * @var RouteVersionRepository
     */
    private $versionRepository;
    /**
     * @var RouteVersionGareRepository
     */
    private $routeVersionGareRepository;
    /**
     * @var RouteGalleryCategoryRepository
     */
    private $galleryCategoryRepository;
    /**
     * @var RouteGalleryRepository
     */
    private $routeGalleryRepository;

    /**
     * RouteController constructor.
     * @param RouteUpdaterRepository $routeUpdaterRepository
     * @param RouteVersionRepository $versionRepository
     * @param RouteVersionGareRepository $routeVersionGareRepository
     * @param RouteGalleryCategoryRepository $galleryCategoryRepository
     * @param RouteGalleryRepository $routeGalleryRepository
     */
    public function __construct(
        RouteUpdaterRepository $routeUpdaterRepository,
        RouteVersionRepository $versionRepository,
        RouteVersionGareRepository $routeVersionGareRepository,
        RouteGalleryCategoryRepository $galleryCategoryRepository, RouteGalleryRepository $routeGalleryRepository)
    {
        $this->routeUpdaterRepository = $routeUpdaterRepository;
        $this->versionRepository = $versionRepository;
        $this->routeVersionGareRepository = $routeVersionGareRepository;
        $this->galleryCategoryRepository = $galleryCategoryRepository;
        $this->routeGalleryRepository = $routeGalleryRepository;
    }

    public function updaters()
    {
        $datas = $this->routeUpdaterRepository->list();

        return $this->sendResponse($datas->toArray(), "Liste des mises à jours");
    }

    public function loadVersion($route_id, $version_id)
    {
        $data = $this->versionRepository->get($version_id);
        ob_start();
        ?>
        <div id="freshVersion" data-version-id="<?= $data->id; ?>"></div>
        <div class="card">
            <h2 class="card-body text-center">Version <?= $data->version; ?>: <?= $data->name; ?></h2>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-4">
                <div class="card mt-5 mb-5">
                    <div class="card-body">
                        <div class="media">
                            <img src="/storage/other/icons/km.png" class="mr-3 img-circle" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Distance</h5>
                                <?= $data->distance; ?> Km
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-5 mb-5">
                    <div class="card-body">
                        <div class="media">
                            <img src="/storage/other/icons/start.png" class="mr-3 img-fluid" width="42" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Point de Départ</h5>
                                <?= $data->depart; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-5 mb-5">
                    <div class="card-body">
                        <div class="media">
                            <img src="/storage/other/icons/start.png" class="mr-3 img-fluid" width="42" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Point d'arrivée</h5>
                                <?= $data->arrive; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tz-route__img">
                    <img src="/storage/route/<?= $data->route_id; ?>/v_<?= $data->version; ?>.png" alt=""
                         class="img-fluid">
                </div>
                <div class="tz-route__video">
                    <div id="videos"></div>
                </div>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-3">
                <div class="route-trace"></div>
            </div>
            <div class="col-md-9">
                <div id="map"></div>
            </div>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Info Version");
    }

    public function loadGares($route_id, $version_id)
    {
        $datas = $this->routeVersionGareRepository->getFromVersion($version_id);
        ob_start();
        ?>
        <div class="card">
            <div class="card-body">
                <div class="kt-list-timeline">
                    <div class="kt-list-timeline__items">
                        <?php foreach ($datas as $data): ?>
                            <?php if ($data->type == 0): ?>
                                <div class="kt-list-timeline__item js-marker" data-lat="<?= $data->lat; ?>"
                                     data-lng="<?= $data->long; ?>"
                                     data-icon="<img src='/storage/other/icons/gare-dark.png' width='20'>">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--dark"></span>
                                    <span class="kt-list-timeline__text"><?= $data->name_gare; ?></span>
                                </div>
                            <?php elseif ($data->type == 1): ?>
                                <div class="kt-list-timeline__item js-marker" data-lat="<?= $data->lat; ?>"
                                     data-lng="<?= $data->long; ?>"
                                     data-icon="<img src='/storage/other/icons/gare-green.png' width='20'>">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>
                                    <span class="kt-list-timeline__text">
                                        <strong><?= $data->name_gare; ?></strong><br>
                                        <?php if ($data->ter == 1): ?>
                                            <img src="/storage/other/pictogramme/ter.png" width="24"
                                                 class="responsive-img" data-toggle="tooltip" alt="" data-position="top"
                                                 title="TER">
                                        <?php endif; ?>
                                        <?php if ($data->tgv == 1): ?>
                                            <img src="/storage/other/pictogramme/tgv.png" width="24"
                                                 class="responsive-img" data-toggle="tooltip" alt="" data-position="top"
                                                 title="TGV">
                                        <?php endif; ?>
                                        <?php if ($data->metro == 1): ?>
                                            <img src="/storage/other/pictogramme/metro.png" width="24"
                                                 class="responsive-img" data-toggle="tooltip" alt="" data-position="top"
                                                 title="METRO">
                                        <?php endif; ?>
                                        <?php if ($data->bus == 1): ?>
                                            <img src="/storage/other/pictogramme/bus.png" width="24"
                                                 class="responsive-img" data-toggle="tooltip" alt="" data-position="top"
                                                 title="BUS">
                                        <?php endif; ?>
                                        <?php if ($data->tram == 1): ?>
                                            <img src="/storage/other/pictogramme/tram.png" width="24"
                                                 class="responsive-img" data-toggle="tooltip" alt="" data-position="top"
                                                 title="TRAM">
                                        <?php endif; ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="kt-list-timeline__item js-marker" data-lat="<?= $data->lat; ?>"
                                     data-lng="<?= $data->long; ?>"
                                     data-icon="<img src='/storage/other/icons/gare-red.png' width='20'>">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                                    <span class="kt-list-timeline__text">
                                        <strong><?= $data->name_gare; ?></strong><br>
                                        <?php if ($data->ter == 1): ?>
                                            <img src="/storage/other/pictogramme/ter.png" width="24"
                                                 class="responsive-img tooltipped" alt="" data-position="top"
                                                 data-tooltip="TER">
                                        <?php endif; ?>
                                        <?php if ($data->tgv == 1): ?>
                                            <img src="/storage/other/pictogramme/tgv.png" width="24"
                                                 class="responsive-img tooltipped" alt="" data-position="top"
                                                 data-tooltip="TGV">
                                        <?php endif; ?>
                                        <?php if ($data->metro == 1): ?>
                                            <img src="/storage/other/pictogramme/metro.png" width="24"
                                                 class="responsive-img tooltipped" alt="" data-position="top"
                                                 data-tooltip="METRO">
                                        <?php endif; ?>
                                        <?php if ($data->bus == 1): ?>
                                            <img src="/storage/other/pictogramme/bus.png" width="24"
                                                 class="responsive-img tooltipped" alt="" data-position="top"
                                                 data-tooltip="BUS">
                                        <?php endif; ?>
                                        <?php if ($data->tram == 1): ?>
                                            <img src="/storage/other/pictogramme/tram.png" width="24"
                                                 class="responsive-img tooltipped" alt="" data-position="top"
                                                 data-tooltip="TRAM">
                                        <?php endif; ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        return $this->sendResponse([
            "content" => $content,
            "gares" => $datas->toArray()
        ], "Success");
    }

    public function loadGalleries($route_id)
    {
        $datas = $this->routeGalleryRepository->allFromRoute($route_id);
        ob_start();
        ?>
        <div class="row">
            <?php foreach ($datas as $data): ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="/storage/route/<?= $route_id; ?>/gallery/<?= $data->filename; ?>" class="fancybox"><img src="/storage/route/<?= $data->filename; ?>" class="img-fluid" /></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Gallerie");
    }

    public function loadGalleriesCategory($route_id, $category_id)
    {
        $datas = $this->routeGalleryRepository->allFromCategory($route_id, $category_id);
        ob_start();
        ?>
        <div class="row">
            <?php foreach ($datas as $data): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="/storage/route/<?= $route_id; ?>/gallery/<?= $data->filename; ?>" class="fancybox"><img src="/storage/route/<?= $data->filename; ?>" class="img-fluid" /></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Gallerie");
    }
}
