<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Tutoriel\TutorielCategory;
use Faker\Generator as Faker;

$factory->define(TutorielCategory::class, function (Faker $faker) {
    return [
        "name"  => "Test d'une catégorie"
    ];
});
