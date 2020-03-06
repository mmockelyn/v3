<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Tutoriel\TutorielSource::class, function (Faker $faker) {
    return [
        "tutoriel_id" => 1,
        "pathSource" => "https://download.trainznation.eu/tutoriel/sources/1.zip"
    ];
});
