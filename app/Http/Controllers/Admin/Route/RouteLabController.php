<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteAnomalieRepository;
use App\Repository\Route\RouteBuildRepository;
use App\Repository\Route\RouteRepository;
use App\Repository\Route\RouteTimelineRepository;

class RouteLabController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;
    /**
     * @var RouteAnomalieRepository
     */
    private $routeAnomalieRepository;
    /**
     * @var RouteBuildRepository
     */
    private $routeBuildRepository;
    /**
     * @var RouteTimelineRepository
     */
    private $routeTimelineRepository;

    /**
     * RouteLabController constructor.
     * @param RouteRepository $routeRepository
     * @param RouteAnomalieRepository $routeAnomalieRepository
     * @param RouteBuildRepository $routeBuildRepository
     * @param RouteTimelineRepository $routeTimelineRepository
     */
    public function __construct(RouteRepository $routeRepository,
                                RouteAnomalieRepository $routeAnomalieRepository,
                                RouteBuildRepository $routeBuildRepository,
                                RouteTimelineRepository $routeTimelineRepository)
    {

        $this->routeRepository = $routeRepository;
        $this->routeAnomalieRepository = $routeAnomalieRepository;
        $this->routeBuildRepository = $routeBuildRepository;
        $this->routeTimelineRepository = $routeTimelineRepository;
    }

    public function index($route_id)
    {
        return view('admin.route.lab.index', [
            "route" => $this->routeRepository->get($route_id)
        ]);
    }

    public function edit($route_id, $anomalie_id)
    {
        return view("admin.route.lab.edit", [
            "route" => $this->routeRepository->get($route_id),
            "anomalie" => $this->routeAnomalieRepository->get($anomalie_id)
        ]);
    }
}
