<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteDownload::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "version" => 1,
        "build" => $faker->numberBetween(1000,15820),
        "route_type_download_id" => rand(1,3),
        "route_type_release_id" => rand(1,5),
        "linkDownload" => "https://download.trainznation.eu/route/1/version/840af302-5d55-11ea-bc55-0242ac130003.zip",
        "note" => $faker->text(),
        "published" => rand(0,1),
        "uuid" => "840af302-5d55-11ea-bc55-0242ac130003"
    ];
});
