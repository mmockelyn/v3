<?php

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Model\Tutoriel\Tutoriel::class, function (Faker $faker) {
    $titre = "Titre du tutoriel";
    $published = rand(0,1);
    $demo = rand(0,1);
    if($published == 1){$published_at = now();}else{$published_at = null;}
    if($demo == 1){$linkDemo = "https://download.trainznation.eu/tutoriel/1/source.zip";}else{$linkDemo = null;}

    return [
        "tutoriel_category_id" => 1,
        "tutoriel_sub_category_id" => 1,
        "user_id" => 1,
        "title" => $titre,
        "slug" => Str::slug($titre),
        "short_content" => $faker->text(),
        "content" => $faker->text(),
        "published" => $published,
        "pathVideo" => "https://download.trainznation.eu/tutoriel/1/1.mp4", // Dossier Subcategory
        "source" => rand(0, 1),
        "premium" => rand(0, 1),
        "time" => "00:" . rand(0, 59) . ":" . rand(0, 59),
        "published_at" => $published_at,
        "demo" => $demo,
        "linkDemo" => $linkDemo
    ];
});
