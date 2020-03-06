<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteAnomalie::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "anomalie" => $faker->text(),
        "correction" => $faker->text(),
        "lieu" => $faker->city,
        "state" => 0
    ];
});
