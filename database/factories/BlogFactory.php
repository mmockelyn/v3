<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Blog\Blog::class, function (Faker $faker) {
    $titre = "Titre de la news";
    $published = rand(0,1);
    $twitter = rand(0,1);
    $facebook = rand(0,1);
    if($published == 1){$published_at = now();}else{$published_at = null;}
    if($twitter == 1){$twitterText = $faker->text(280);}else{$twitterText = null;}

    return [
        "categorie_id" => 1,
        "title" => $titre,
        "slug" => \Illuminate\Support\Str::slug($titre),
        "short_content" => $faker->text(200),
        "content" => $faker->realText(1500),
        "published" => $published,
        "published_at" => $published_at,
        "twitter" => $twitter,
        "twitterText" => $twitterText,
        "facebook" => $facebook
    ];
});
