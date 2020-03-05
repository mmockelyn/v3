<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Wiki\WikiSubCategory::class, function (Faker $faker) {
    return [
        "wiki_category_id" => 1,
        "name" => "Sous Catégorie Wiki",
        "description" => $faker->text(),
        "short" => "sub",
        "icon" => "la la-flash"
    ];
});
