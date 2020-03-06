<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteVersionGare::class, function (Faker $faker) {
    return [
        "route_version_id" => 1,
        "name_gare" => $faker->city,
        "type" => rand(0,2),
        "lat" => $faker->latitude,
        "long" => $faker->longitude,
        "ter" => rand(0,1),
        "tgv" => rand(0,1),
        "metro" => rand(0,1),
        "bus" => rand(0,1),
        "tram" => rand(0,1),
    ];
});
