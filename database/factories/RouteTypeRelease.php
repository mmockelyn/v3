<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Route\RouteTypeRelease;
use Faker\Generator as Faker;

$factory->define(RouteTypeRelease::class, function (Faker $faker) {
    return [
        "id" => 1,
        "name" => "Correctif"
    ];
});
