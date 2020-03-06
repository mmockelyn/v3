<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Core\Slideshow::class, function (Faker $faker) {
    return [
        "linkImages" => '/storage/slideshow/1.png',
        "linkArticle" => '/blog/titre-de-la-news'
    ];
});
