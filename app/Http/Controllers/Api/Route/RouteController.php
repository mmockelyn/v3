<?php

namespace App\Http\Controllers\Api\Route;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Route\RouteUpdaterRepository;
use Illuminate\Http\Request;

class RouteController extends BaseController
{
    /**
     * @var RouteUpdaterRepository
     */
    private $routeUpdaterRepository;

    /**
     * RouteController constructor.
     * @param RouteUpdaterRepository $routeUpdaterRepository
     */
    public function __construct(RouteUpdaterRepository $routeUpdaterRepository)
    {
        $this->routeUpdaterRepository = $routeUpdaterRepository;
    }

    public function updaters()
    {
        $datas = $this->routeUpdaterRepository->list();

        return $this->sendResponse($datas->toArray(), "Liste des mises à jours");
    }
}
