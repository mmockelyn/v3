<?php

namespace App\Http\Controllers\Front\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteRepository;
use Illuminate\Http\Request;

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
        return view('front.route.index', [
            "routes" => $this->routeRepository->allPaginate()
        ]);
    }
}
