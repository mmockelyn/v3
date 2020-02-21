<?php
namespace App\Repository\Route\Version;

use App\Model\Route\RouteVersion;

class VersionRepository
{
    /**
     * @var RouteVersion
     */
    private $routeVersion;

    /**
     * VersionRepository constructor.
     * @param RouteVersion $routeVersion
     */

    public function __construct(RouteVersion $routeVersion)
    {
        $this->routeVersion = $routeVersion;
    }

    public function get($version_id)
    {
        return $this->routeVersion->newQuery()
            ->find($version_id)
            ->load('gares');
    }

}

