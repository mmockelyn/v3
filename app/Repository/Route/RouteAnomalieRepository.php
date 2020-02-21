<?php
namespace App\Repository\Route;

use App\Model\Route\RouteAnomalie;

class RouteAnomalieRepository
{
    /**
     * @var RouteAnomalie
     */
    private $routeAnomalie;

    /**
     * RouteAnomalieRepository constructor.
     * @param RouteAnomalie $routeAnomalie
     */

    public function __construct(RouteAnomalie $routeAnomalie)
    {
        $this->routeAnomalie = $routeAnomalie;
    }

    public function getOnTodo($route_id)
    {
        return $this->routeAnomalie->newQuery()
            ->where('route_id', $route_id)
            ->where('state', 0)
            ->get();
    }

    public function getOnProgress($route_id)
    {
        return $this->routeAnomalie->newQuery()
            ->where('route_id', $route_id)
            ->where('state', 1)
            ->get();
    }

    public function getOnFinished($route_id)
    {
        return $this->routeAnomalie->newQuery()
            ->where('route_id', $route_id)
            ->where('state', 2)
            ->get();
    }

}

