<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteCompatibility::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "trainz_build_id" => 1,
        "version" => rand(0,9)
    ];
});
