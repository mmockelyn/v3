<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Model\Tutoriel\TutorielSubCategory;
use Faker\Generator as Faker;

$factory->define(TutorielSubCategory::class, function (Faker $faker) {
    return [
        "tutoriel_category_id" => 1,
        "name"  => "Test d'une sous catégorie"
    ];
});
