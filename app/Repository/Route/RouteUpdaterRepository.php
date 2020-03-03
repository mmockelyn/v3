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
            ->orderBy('id', 'desc')
            ->get();
    }

    public function create($route_id, $version, $build, $latest, $linkRelease)
    {
        return $this->routeUpdater->newQuery()
            ->create([
                "route_id" => $route_id,
                "version" => $version,
                "build" => $build,
                "latest" => $latest,
                "linkRelease" => $linkRelease
            ]);
    }

    public function listForRoute($route_id)
    {
        return $this->routeUpdater->newQuery()
            ->where('route_id', $route_id)
            ->get();
    }

    public function get($id)
    {
        return $this->routeUpdater->newQuery()
            ->find($id);
    }

    public function updateLatestNone($id)
    {
        return $this->get($id)
            ->update([
                "latest" => 0
            ]);
    }


}

