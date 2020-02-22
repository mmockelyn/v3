<?php

namespace App\HelpersClass\Route;

use App\Model\Route\Route;
use App\Model\Route\RouteBuild;
use App\Model\Route\RouteDownload;
use Illuminate\Support\Str;

class RouteHelpers
{
    public static function imgLatestBuild($route_id)
    {
        $download = new RouteDownload();
        $data = $download->newQuery()->where('route_id', $route_id)->get()->last();

        return Str::lower($data->typeRelease->name);
    }

    public static function labelBuild($build)
    {
        switch ($build) {
            case 1:
                return 'badge bg-red-500';
            case 2:
                return 'badge bg-purple-500';
            case 3:
                return 'badge bg-indigo-500';
            case 4:
                return 'badge bg-amber-500';
            case 5:
                return 'badge bg-teal-500';
            default:
                return null;
        }
    }

    public static function getInfoRoute($route_id, $field = null)
    {
        $route = new Route();
        $data = $route->newQuery()->find($route_id);

        return $data->$field;
    }

}

