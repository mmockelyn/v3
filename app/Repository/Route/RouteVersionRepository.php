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

}

