<?php

use Illuminate\Database\Seeder;

class RouteTypeDownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Route\RouteTypeDownload::create(["name" => "Map"]);
        \App\Model\Route\RouteTypeDownload::create(["name" => "Dépendance"]);
        \App\Model\Route\RouteTypeDownload::create(["name" => "Session"]);
    }
}
