<?php
namespace App\Repository\Route;

use App\Model\Route\RouteCompatibility;

class RouteCompatibilityRepository
{
    /**
     * @var RouteCompatibility
     */
    private $routeCompatibility;

    /**
     * RouteCompatibilityRepository constructor.
     * @param RouteCompatibility $routeCompatibility
     */

    public function __construct(RouteCompatibility $routeCompatibility)
    {
        $this->routeCompatibility = $routeCompatibility;
    }

}

