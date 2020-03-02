<?php
namespace App\Repository\Route;

use App\Model\Route\RouteDownload;

class RouteDownloadRepository
{
    /**
     * @var RouteDownload
     */
    private $routeDownload;

    /**
     * RouteDownloadRepository constructor.
     * @param RouteDownload $routeDownload
     */

    public function __construct(RouteDownload $routeDownload)
    {
        $this->routeDownload = $routeDownload;
    }

    public function getLatesFromRoute($route_id)
    {
        return $this->routeDownload->newQuery()
            ->where('route_id', $route_id)
            ->where('published', 1)
            ->get()
            ->last();
    }

    public function listFromPublish($route_id)
    {
        return $this->routeDownload->newQuery()
            ->where('route_id', $route_id)
            ->where('published', 1)
            ->orderByDesc('updated_at')
            ->get();
    }

    public function getVersion($version_id)
    {
        return $this->routeDownload->newQuery()
            ->find($version_id);
    }

    public function listAllFromRoute($route_id)
    {
        return $this->routeDownload->newQuery()
            ->where('route_id', $route_id)
            ->get();
    }

}

