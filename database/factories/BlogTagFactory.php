<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Blog\BlogTag::class, function (Faker $faker) {
    $text = $faker->word;
    return [
        "blog_id" => 1,
        "name" => $text,
        "slug" => $text
    ];
});
