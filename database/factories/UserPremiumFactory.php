<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Account\UserPremium::class, function (Faker $faker) {
    return [
        "user_id" => 1,
        "premium" => 1,
        "premium_start" => now(),
        "premium_end" => now()->addYear()
    ];
});
