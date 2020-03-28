<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Asset\AssetSubCategory::class, function (Faker $faker) {
    return [
        "asset_category_id" => 1,
        "name" => "Sous Catégorie ".rand(1,1000)
    ];
});
