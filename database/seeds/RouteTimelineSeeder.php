<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class RouteTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $builds = \App\Model\Route\RouteBuild::get();

        foreach ($builds as $build) {
            \App\Model\Route\RouteTimeline::create([
                "route_id"  => 1,
                "version"   => $build->version,
                "description" => $faker->text(rand(200,10000)),
                "release_at"    => now()->subDays(rand(0,720))
            ]);
        }
    }
}
