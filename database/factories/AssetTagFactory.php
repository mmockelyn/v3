<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Asset\AssetTag::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        "asset_id" => 1,
        "name" => $name,
        "slug" => $name
    ];
});
