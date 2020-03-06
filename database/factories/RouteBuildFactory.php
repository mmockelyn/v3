<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteBuild::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "version" => 1,
        "build" => $faker->numberBetween(1000,15820)
    ];
});
