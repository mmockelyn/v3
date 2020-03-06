<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Asset\AssetCategory::class, function (Faker $faker) {
    return [
        "name" => "Catégorie ".$faker->numberBetween(1, 1000)
    ];
});
