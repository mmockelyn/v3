<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Route\RouteTypeDownload;
use Faker\Generator as Faker;

$factory->define(RouteTypeDownload::class, function (Faker $faker) {
    return [
        "id" => 1,
        "name" => "Map"
    ];
});
