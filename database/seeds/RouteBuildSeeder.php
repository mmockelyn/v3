<?php

use Illuminate\Database\Seeder;

class RouteBuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Route\RouteBuild::create([
            "route_id"  => 1,
            "version"   => 1,
            "build"     => 9630
        ]);
    }
}
