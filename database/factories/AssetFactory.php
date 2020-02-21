<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Asset\Asset;
use Faker\Generator as Faker;

$factory->define(Asset::class, function (Faker $faker) {
    return [
        "asset_category_id" => 1,
        "asset_sub_category_id" => 1,
        "designation" => $faker->text(),
        "short_description" => $faker->text(100),
        "description" => $faker->realText(),
        "kuid" => "<kuid:400722:".rand(1,90000).">"
    ];
});
