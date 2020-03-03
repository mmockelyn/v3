<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Blog\BlogCategory::class, function (Faker $faker) {
    return [
        "name" => "Catégorie de blog"
    ];
});
