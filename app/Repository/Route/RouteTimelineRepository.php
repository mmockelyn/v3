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

    public function create($route_id, $version, $description)
    {
        return $this->routeTimeline->newQuery()
            ->create([
                "route_id" => $route_id,
                "version" => $version,
                "description" => $description
            ]);
    }


}

