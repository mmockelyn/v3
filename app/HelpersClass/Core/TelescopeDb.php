<?php


namespace App\HelpersClass\Core;


use Illuminate\Support\Facades\DB;

class TelescopeDb
{
    public static function countException()
    {
        return DB::table('telescope_entries')->where('type', 'exception')->count();
    }
}
