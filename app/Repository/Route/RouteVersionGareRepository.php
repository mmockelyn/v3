<?php
namespace App\Repository\Route;

use App\Model\Route\RouteVersionGare;

class RouteVersionGareRepository
{
    /**
     * @var RouteVersionGare
     */
    private $routeVersionGare;

    /**
     * RouteVersionGareRepository constructor.
     * @param RouteVersionGare $routeVersionGare
     */

    public function __construct(RouteVersionGare $routeVersionGare)
    {
        $this->routeVersionGare = $routeVersionGare;
    }

    public function getFromVersion($version_id)
    {
        return $this->routeVersionGare->newQuery()
            ->where('route_version_id', $version_id)
            ->get();
    }

}

