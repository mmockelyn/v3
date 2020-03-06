<?php

namespace App\Http\Controllers\Front\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteGalleryCategoryRepository;
use App\Repository\Route\RouteRepository;

class RouteController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;
    /**
     * @var RouteGalleryCategoryRepository
     */
    private $galleryCategoryRepository;

    /**
     * RouteController constructor.
     * @param RouteRepository $routeRepository
     * @param RouteGalleryCategoryRepository $galleryCategoryRepository
     */
    public function __construct(RouteRepository $routeRepository, RouteGalleryCategoryRepository $galleryCategoryRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->galleryCategoryRepository = $galleryCategoryRepository;
    }

    public function index()
    {
        return view('front.route.index', [
            "routes" => $this->routeRepository->allPaginate()
        ]);
    }

    public function show($route_id)
    {
        return view("front.route.show", [
            "route" => $this->routeRepository->get($route_id),
            "categories" => $this->galleryCategoryRepository->all()
        ]);
    }
}
