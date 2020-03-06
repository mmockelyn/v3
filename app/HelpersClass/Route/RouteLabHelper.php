<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 02/03/2020
 * Time: 17:23
 */

namespace App\HelpersClass\Route;


use App\Model\Route\RouteAnomalie;
use App\Model\Route\RouteBuild;

class RouteLabHelper
{
    public static function getProgressLab($route_id)
    {
        $percent = self::labPercent($route_id);

        if ($percent <= 33) {
            return '<div class="progress-bar kt-bg-danger" role="progressbar" style="width: ' . $percent . '%;" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100"></div>';
        } elseif ($percent > 33 && $percent <= 66) {
            return '<div class="progress-bar kt-bg-warning" role="progressbar" style="width: ' . $percent . '%;" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100"></div>';
        } else {
            return '<div class="progress-bar kt-bg-success" role="progressbar" style="width: ' . $percent . '%;" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100"></div>';
        }
    }

    public static function labPercent($route_id)
    {
        $anomalie = new RouteAnomalie;
        $countAnomalie = $anomalie->newQuery()->where('route_id', $route_id)->count();
        $countState = $anomalie->newQuery()->where('route_id', $route_id)->where('state', 2)->count();

        if($countAnomalie == 0 || $countState == 0) {
            return 0;
        }else{
            $percent = round($countState * 100 / $countAnomalie, 0);
        }

        return $percent;
    }

    public static function countTask($route_id, $state)
    {
        $anomalie = new RouteAnomalie;
        $count = $anomalie->newQuery()->where('route_id', $route_id)->where('state', $state)->count();

        return $count;
    }

    public static function countTaskTotal($route_id)
    {
        $anomalie = new RouteAnomalie;
        $count = $anomalie->newQuery()->where('route_id', $route_id)->count();

        return $count;
    }

    public static function stateText($state)
    {
        switch ($state) {
            case 0: return 'Inscrit';
            case 1: return 'En cours';
            case 2: return 'Terminer';
        }
    }

    public static function stateBadge($state)
    {
        switch ($state) {
            case 0: return 'kt-badge--danger';
            case 1: return 'kt-badge--warning';
            case 2: return 'kt-badge--success';
        }
    }

    public static function getFinishedTask($route_id)
    {
        $an = new RouteAnomalie;

        return $an->newQuery()->where('route_id', $route_id)->where('state', 2)->get();
    }

    public static function calcNewBuild($route_id) {
        $tasks = self::countTaskTotal($route_id);
        $build = new RouteBuild;
        $dts = $build->newQuery()->where('route_id', $route_id)->first();

        $sum = $dts->build * $tasks / ($tasks-1);

        return round($sum, 0);
    }

    public static function getOutFinishedTask($route_id)
    {
        $an = new RouteAnomalie;

        return $an->newQuery()
            ->where('route_id', $route_id)
            ->where('state', 0)
            ->orWhere('state', 1)
            ->orderBy('state', 'desc')
            ->get();
    }
}
