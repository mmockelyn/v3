<?php
namespace App\Repository\Route;

use App\Model\Route\RouteBuild;

class RouteBuildRepository
{
    /**
     * @var RouteBuild
     */
    private $routeBuild;

    /**
     * RouteBuildRepository constructor.
     * @param RouteBuild $routeBuild
     */

    public function __construct(RouteBuild $routeBuild)
    {
        $this->routeBuild = $routeBuild;
    }

    public function updateVersion($route_id, $version)
    {
        $bl =  $this->routeBuild->newQuery()
            ->where('route_id', $route_id)
            ->first()
            ->update([
                "version" => $version +1
            ]);
        return $this->routeBuild->newQuery()
            ->where('route_id', $route_id)
            ->first();
    }

    public function updateBuild($route_id, $newBuild)
    {
        return $this->routeBuild->newQuery()
            ->where('route_id', $route_id)
            ->first()
            ->update([
                "build" => $newBuild
            ]);
    }

}

