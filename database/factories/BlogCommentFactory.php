<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Blog\BlogComment::class, function (Faker $faker) {
    return [
        "blog_id" => 1,
        "user_id" => 1,
        "comment" => $faker->text()
    ];
});
