<?php
namespace App\Repository\Route;

use App\Model\Route\RouteTimeline;

class RouteTimelineRepository
{
    /**
     * @var RouteTimeline
     */
    private $routeTimeline;

    /**
     * RouteTimelineRepository constructor.
     * @param RouteTimeline $routeTimeline
     */

    public function __construct(RouteTimeline $routeTimeline)
    {
        $this->routeTimeline = $routeTimeline;
    }

}

