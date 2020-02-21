<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        \App\Model\Route\Route::create([
            "name"          => "Pays de la Loire",
            "description"   => $faker->text(rand(200,800)),
            "published"     => rand(0,1)
        ]);
    }
}
