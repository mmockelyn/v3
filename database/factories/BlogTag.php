<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Blog\BlogTag;
use Faker\Generator as Faker;

$factory->define(BlogTag::class, function (Faker $faker) {
    return [
        "blog_id"   => 1,
        "name"      => "test".rand(0,200),
        "slug"      => "test".rand(0,200)
    ];
});
