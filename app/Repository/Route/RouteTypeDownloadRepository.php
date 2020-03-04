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

    public function all()
    {
        return $this->routeTypeDownload->newQuery()
            ->get();
    }

    public function delete($type_id)
    {
        return $this->routeTypeDownload->newQuery()
            ->find($type_id)
            ->delete();
    }

    public function create($name)
    {
        return $this->routeTypeDownload->newQuery()
            ->create([
                "name" => $name
            ]);
    }

}

