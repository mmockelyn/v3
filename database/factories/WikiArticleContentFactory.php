<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Wiki\WikiArticleContent::class, function (Faker $faker) {
    return [
        "wiki_id" => 1,
        "sommaire_id" => 1,
        "content" => $faker->text()
    ];
});
