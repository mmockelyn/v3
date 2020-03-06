<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteRepository;
use App\Repository\Route\RouteVersionRepository;

class RouteVersionController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;
    /**
     * @var RouteVersionRepository
     */
    private $versionRepository;

    /**
     * RouteVersionController constructor.
     * @param RouteRepository $routeRepository
     * @param RouteVersionRepository $versionRepository
     */
    public function __construct(RouteRepository $routeRepository, RouteVersionRepository $versionRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->versionRepository = $versionRepository;
    }

    public function index($route_id)
    {
        return view("admin.route.version.index", [
            "route" => $this->routeRepository->get($route_id),
            "versions" => $this->versionRepository->allFromRoute($route_id)
        ]);
    }
}
