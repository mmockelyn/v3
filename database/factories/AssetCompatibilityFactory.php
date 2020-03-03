<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Asset\AssetCompatibility::class, function (Faker $faker) {
    return [
        "asset_id" => 1,
        "trainz_build_id" => 1,
        "state" => 0
    ];
});
