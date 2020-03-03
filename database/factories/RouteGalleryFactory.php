<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\RouteGallery::class, function (Faker $faker) {
    return [
        "route_id" => 1,
        "route_gallery_category_id" => 1,
        "filename" => "filename.jpg",
    ];
});
