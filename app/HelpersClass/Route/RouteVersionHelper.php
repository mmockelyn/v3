<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 01/03/2020
 * Time: 18:41
 */

namespace App\HelpersClass\Route;


use App\Model\Core\Gare;

class RouteVersionHelper
{
    public static function typeGareBadge($type)
    {
        switch ($type) {
            case 0: return 'kt-badge--dark';
            case 1: return 'kt-badge--danger';
            case 2: return 'kt-badge--success';
            default: return 'kt-badge--primary';
        }
    }

    public static function typeGareText($type)
    {
        switch ($type) {
            case 0: return 'Gare simple';
            case 1: return 'Gare départ/terminus';
            case 2: return 'Grande Gare';
            default: return 'Inconnue';
        }
    }

    public static function listeGares()
    {
        $gare = new Gare;
        $gares = $gare->newQuery()->orderBy('name', 'asc')->get();

        return $gares;
    }
}
