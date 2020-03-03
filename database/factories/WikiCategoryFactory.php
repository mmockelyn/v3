<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Wiki\WikiCategory::class, function (Faker $faker) {
    return [
        "name" => "Catégorie d'un wiki"
    ];
});
