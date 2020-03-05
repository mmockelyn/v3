<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Tutoriel\TutorielCategory::class, function (Faker $faker) {
    return [
        "name" => "Test d'une catégorie"
    ];
});
