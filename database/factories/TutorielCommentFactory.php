<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Tutoriel\TutorielComment::class, function (Faker $faker) {
    return [
        "tutoriel_id" => 1,
        "user_id" => 1,
        "content" => $faker->text(),
    ];
});
