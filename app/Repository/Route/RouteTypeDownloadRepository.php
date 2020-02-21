<?php
namespace App\Repository\Route;

use App\Model\Route\RouteTypeDownload;

class RouteTypeDownloadRepository
{
    /**
     * @var RouteTypeDownload
     */
    private $routeTypeDownload;

    /**
     * RouteTypeDownloadRepository constructor.
     * @param RouteTypeDownload $routeTypeDownload
     */

    public function __construct(RouteTypeDownload $routeTypeDownload)
    {
        $this->routeTypeDownload = $routeTypeDownload;
    }

}

