<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteGalleryCategory::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "name" => "Catégorie de gallerie"
    ];
});
