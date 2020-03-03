<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteVersion::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "version" => 1,
        "name" => "Test Version",
        "description" => $faker->text(),
        "distance" => $faker->randomFloat(2, 10,500),
        "depart" => $faker->city,
        "arrive" => $faker->city,
        "linkVideo" => "https://download.trainznation.eu/route/1/video/1.mp4"
    ];
});
