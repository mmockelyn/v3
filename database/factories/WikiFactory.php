<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Wiki\Wiki::class, function (Faker $faker) {
    return [
        "wiki_category_id" => 1,
        "wiki_sub_category_id" => 1,
        "title" => "Titre du Wiki",
        "content" => $faker->text(),
        "published" => 1,
        "published_at" => now()
    ];
});
