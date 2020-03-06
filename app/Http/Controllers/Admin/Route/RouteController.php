<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteRepository;

class RouteController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;

    /**
     * RouteController constructor.
     * @param RouteRepository $routeRepository
     */
    public function __construct(RouteRepository $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    public function index()
    {
        return view("admin.route.index");
    }

    public function show($route_id)
    {
        return view("admin.route.show", [
            "route" => $this->routeRepository->get($route_id)
        ]);
    }
}
