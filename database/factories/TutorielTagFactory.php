<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Tutoriel\TutorielTag::class, function (Faker $faker) {
    $title = $faker->word;
    return [
        "tutoriel_id" => 1,
        "name" => $title,
        "slug" => $title
    ];
});
