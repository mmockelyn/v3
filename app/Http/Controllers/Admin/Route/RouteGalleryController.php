<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteGalleryCategoryRepository;
use App\Repository\Route\RouteGalleryRepository;
use App\Repository\Route\RouteRepository;

class RouteGalleryController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;
    /**
     * @var RouteGalleryCategoryRepository
     */
    private $routeGalleryCategoryRepository;
    /**
     * @var RouteGalleryRepository
     */
    private $routeGalleryRepository;

    /**
     * RouteGalleryController constructor.
     * @param RouteRepository $routeRepository
     * @param RouteGalleryCategoryRepository $routeGalleryCategoryRepository
     * @param RouteGalleryRepository $routeGalleryRepository
     */
    public function __construct(RouteRepository $routeRepository, RouteGalleryCategoryRepository $routeGalleryCategoryRepository, RouteGalleryRepository $routeGalleryRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->routeGalleryCategoryRepository = $routeGalleryCategoryRepository;
        $this->routeGalleryRepository = $routeGalleryRepository;
    }

    public function index($route_id) {
        return view("admin.route.gallery.index", [
            "route" => $this->routeRepository->get($route_id),
            "categories" => $this->routeGalleryCategoryRepository->allForRoute($route_id),
            "galleries" => $this->routeGalleryRepository->allFromRoute($route_id)
        ]);
    }
}
