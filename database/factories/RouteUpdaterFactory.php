<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteUpdater::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "version" => 1,
        "build" => $faker->numberBetween(1000,15820),
        "latest" => 0,
        "linkRelease" => "https://download.trainznation.eu/route/1/version/840af302-5d55-11ea-bc55-0242ac130003.zip"
    ];
});
