<?php
namespace App\Repository\Route;

use App\Model\Route\RouteVersion;

class RouteVersionRepository
{
    /**
     * @var RouteVersion
     */
    private $routeVersion;

    /**
     * RouteVersionRepository constructor.
     * @param RouteVersion $routeVersion
     */

    public function __construct(RouteVersion $routeVersion)
    {
        $this->routeVersion = $routeVersion;
    }

    public function get($version_id)
    {
        return $this->routeVersion->newQuery()
            ->find($version_id);
    }

    public function allFromRoute($route_id)
    {
        return $this->routeVersion->newQuery()
            ->where('route_id', $route_id)
            ->get();
    }

    public function updateDescription($version_id, $description)
    {
        return $this->routeVersion->newQuery()
            ->find($version_id)
            ->update([
                "description" => $description
            ]);
    }

    public function create($route_id, $version, $name, $distance, $depart, $arrive, $linkVideo)
    {
        return $this->routeVersion->newQuery()
            ->create([
                "route_id" => $route_id,
                "version" => $version,
                "name" => $name,
                "distance" => $distance,
                "depart" => $depart,
                "arrive" => $arrive,
                "linkVideo" => $linkVideo
            ]);
    }

    public function delete($version_id)
    {
        $this->routeVersion->newQuery()
            ->find($version_id)
            ->delete();
        return null;
    }

}

