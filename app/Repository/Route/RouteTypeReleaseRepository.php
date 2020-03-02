<?php
namespace App\Repository\Route;

use App\Model\Route\RouteTypeRelease;

class RouteTypeReleaseRepository
{
    /**
     * @var RouteTypeRelease
     */
    private $routeTypeRelease;

    /**
     * RouteTypeReleaseRepository constructor.
     * @param RouteTypeRelease $routeTypeRelease
     */

    public function __construct(RouteTypeRelease $routeTypeRelease)
    {
        $this->routeTypeRelease = $routeTypeRelease;
    }

    public function all()
    {
        return $this->routeTypeRelease->newQuery()
            ->get();
    }

}

