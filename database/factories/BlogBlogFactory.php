<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Blog\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $number = rand(1,25000);
    return [
        "categorie_id"  => rand(1,4),
        "title"         => "Test d'un article ".$number,
        "slug"          => "test-d-un-article-".$number,
        "short_content" => $faker->text(280),
        "content"       => $faker->text(1250),
        "published"     => 1,
        "published_at"  => now()->subDays(rand(0,100)),
        "twitter"       => 0,
        "twitterText"   => null
    ];
});
