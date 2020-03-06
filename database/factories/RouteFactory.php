<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Route\Route::class, function (Faker $faker) {
    return [
        "name" => "Route Test",
        "description" => $faker->text(),
        "published" => rand(0,1)
    ];
});
