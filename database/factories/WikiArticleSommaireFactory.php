<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Wiki\WikiArticleSommaire::class, function (Faker $faker) {
    return [
        "wiki_id" => 1,
        "Test d'un sommaire"
    ];
});
