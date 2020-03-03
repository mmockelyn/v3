<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Tutoriel\TutorielSubCategory::class, function (Faker $faker) {
    return [
        "tutoriel_category_id" => 1,
        "name" => "Test d'une sous categorie",
        "short" => "sub"
    ];
});
