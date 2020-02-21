<?php
namespace App\Repository\Route\Version;

use App\Model\Route\RouteVersionGare;

class VersionGareRepository
{
    /**
     * @var RouteVersionGare
     */
    private $routeVersionGare;

    /**
     * VersionGareRepository constructor.
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

