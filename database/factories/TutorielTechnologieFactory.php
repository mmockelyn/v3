<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        "tutoriel_id" => 1,
        "name" => "Technologie utiliser"
    ];
});
