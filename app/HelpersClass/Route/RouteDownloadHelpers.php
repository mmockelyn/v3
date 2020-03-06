<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 24/02/2020
 * Time: 23:28
 */

namespace App\HelpersClass\Route;


use App\Model\Route\RouteDownload;
use App\Model\Route\RouteTypeRelease;

class RouteDownloadHelpers
{
    public static function getLatestDownload($route_id, $field)
    {
        $route = new RouteDownload;

        $data = $route->newQuery()->where('route_id', $route_id)
            ->where('route_type_download_id', 1)
            ->where('published', 1)
            ->get()
            ->last();

        return $data->$field;
    }

    public static function getDownloadMapList($route_id)
    {
        $route = new RouteDownload;

        $data = $route->newQuery()->where('route_id', $route_id)
            ->where('route_type_download_id', 1)
            ->where('published', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        return $data;
    }

    public static function getDownloadSessionList($route_id)
    {
        $route = new RouteDownload;

        $data = $route->newQuery()->where('route_id', $route_id)
            ->where('route_type_download_id', 3)
            ->where('published', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        return $data;
    }

    public static function getDownloadMap($download_id, $field)
    {
        $route = new RouteDownload;

        $data = $route->newQuery()->find($download_id);

        return $data->$field;
    }

    public static function getRouteTypeReleaseText($release_id)
    {
        $route = new RouteTypeRelease;

        $data = $route->newQuery()->find($release_id);

        return $data->name;
    }
}
