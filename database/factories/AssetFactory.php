<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Asset\Asset::class, function (Faker $faker) {
    $category = 1;
    $subcategory = 1;
    $pricing = rand(0,1);
    $published = rand(0,1);
    $uuid = $faker->uuid;
    if($pricing == 1){$price = rand(5,20);}else{$price = null;}
    if($published == 1){$published_at = now();}else{$published_at = null;}

    return [
        "asset_category_id" => $category,
        "asset_sub_category_id" => $subcategory,
        "designation" => "Test Objet ".$faker->numberBetween(1,1000),
        "short_description" => $faker->text(190),
        "description" => $faker->text(1000),
        "kuid"  => "kuid:400722:".$faker->numberBetween(1,1520100),
        "downloadLink" => "https://download.trainznation.eu/assets/".$subcategory."/".$uuid.".zip",
        "social" => rand(0,1),
        "published" => $published,
        "mesh" => rand(0,1),
        "config" => rand(0,1),
        "pricing" => $pricing,
        "price" => $price,
        "published_at" => $published_at,
        "uuid" => $uuid
    ];
});
