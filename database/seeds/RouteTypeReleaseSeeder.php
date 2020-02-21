<?php

use Illuminate\Database\Seeder;

class RouteTypeReleaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Route\RouteTypeRelease::create(["name" => "Correctif"]);
        \App\Model\Route\RouteTypeRelease::create(["name" => "Alpha"]);
        \App\Model\Route\RouteTypeRelease::create(["name" => "Beta"]);
        \App\Model\Route\RouteTypeRelease::create(["name" => "RC"]);
        \App\Model\Route\RouteTypeRelease::create(["name" => "Final"]);
    }
}
