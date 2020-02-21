<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class RouteAnomalieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $routes = \App\Model\Route\Route::get();

        foreach ($routes as $route) {
            for ($i = 0; $i < rand(0, 60); $i++) {
                \App\Model\Route\RouteAnomalie::create([
                    "route_id" => $route->id,
                    "anomalie" => $faker->realText(rand(15,250)),
                    "correction" => $faker->realText(rand(15, 250)),
                    "lieu"      => $faker->city,
                    "state"     => rand(0,2)
                ]);
            }
        }
    }
}
