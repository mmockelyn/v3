<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteTimeline::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "version" => 1,
        "description" => $faker->text()
    ];
});
