<?php
namespace App\Repository\Route;

use App\Model\Route\Route;

class RouteRepository
{
    /**
     * @var Route
     */
    private $route;

    /**
     * RouteRepository constructor.
     * @param Route $route
     */

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function allPaginate()
    {
        return $this->route->newQuery()
            ->where('published', 1)
            ->paginate(4);
    }

    public function get($id)
    {
        return $this->route->newQuery()
            ->find($id)
            ->load('anomalies', 'builds', 'compatibilities', 'downloads', 'galleries', 'timelines', 'versions');
    }

}

