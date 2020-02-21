<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Tutoriel\Tutoriel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tutoriel::class, function (Faker $faker) {
    return [
        "tutoriel_category_id" => 1,
        "tutoriel_sub_category_id" => 1,
        "user_id" => 1,
        "title" => "Test d'un tutoriel",
        "slug" => Str::slug("Test d'un tutoriel"),
        "short_content" => $faker->realText(150),
        "content" => $faker->realText()
    ];
});
