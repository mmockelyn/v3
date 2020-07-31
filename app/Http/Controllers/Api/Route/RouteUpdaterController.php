<?php

namespace App\Http\Controllers\Api\Route;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Route\RouteUpdaterRepository;
use Illuminate\Http\Request;

class RouteUpdaterController extends BaseController
{
    /**
     * @var RouteUpdaterRepository
     */
    private $routeUpdaterRepository;

    /**
     * RouteUpdaterController constructor.
     * @param RouteUpdaterRepository $routeUpdaterRepository
     */
    public function __construct(RouteUpdaterRepository $routeUpdaterRepository)
    {
        $this->routeUpdaterRepository = $routeUpdaterRepository;
    }

    public function listVersions($route_id)
    {
        $datas = $this->routeUpdaterRepository->listForRoute($route_id);

        return $this->sendResponse($datas, "Liste des versions de l'updater");
    }


}
