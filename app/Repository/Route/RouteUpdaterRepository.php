<?php
namespace App\Repository\Route;

use App\Model\Route\RouteUpdater;

class RouteUpdaterRepository
{
    /**
     * @var RouteUpdater
     */
    private $routeUpdater;

    /**
     * RouteUpdaterRepository constructor.
     * @param RouteUpdater $routeUpdater
     */

    public function __construct(RouteUpdater $routeUpdater)
    {
        $this->routeUpdater = $routeUpdater;
    }

    public function list()
    {
        return $this->routeUpdater->newQuery()
            ->get();
    }


}

