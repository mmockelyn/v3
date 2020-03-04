<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteRepository;
use Illuminate\Http\Request;

class RouteConfigController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;

    /**
     * RouteConfigController constructor.
     * @param RouteRepository $routeRepository
     */
    public function __construct(RouteRepository $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    public function index($route_id)
    {
        return view('admin.route.config.index', [
            "route" => $this->routeRepository->get($route_id)
        ]);
    }
}
