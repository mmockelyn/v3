<?php

use Illuminate\Database\Seeder;

class RouteCompatibilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $builds = \App\Model\Core\TrainzBuild::get();

        foreach ($builds as $build) {
            \App\Model\Route\RouteCompatibility::create([
                "route_id"  => 1,
                "trainz_build_id"   => $build->id,
                "version"   => 1
            ]);
        }
    }
}
