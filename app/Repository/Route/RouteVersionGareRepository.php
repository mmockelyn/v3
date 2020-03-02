<?php
namespace App\Repository\Route;

use App\Model\Route\RouteVersionGare;

class RouteVersionGareRepository
{
    /**
     * @var RouteVersionGare
     */
    private $routeVersionGare;

    /**
     * RouteVersionGareRepository constructor.
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

    public function create($version_id, $name_gare, $type_gare, $lat, $long, $ter, $tgv, $metro, $bus, $tram)
    {
        return $this->routeVersionGare->newQuery()
            ->create([
                "route_version_id"  => $version_id,
                "name_gare" => $name_gare,
                "type" => $type_gare,
                "lat" => $lat,
                "long" => $long,
                "ter" => $ter,
                "tgv" => $tgv,
                "metro" => $metro,
                "bus" => $bus,
                "tram" => $tram
            ]);
    }

    public function get($gare_id)
    {
        return $this->routeVersionGare->newQuery()
            ->find($gare_id);
    }

    public function delete($gare_id)
    {
        return $this->get($gare_id)->delete();
    }

}

