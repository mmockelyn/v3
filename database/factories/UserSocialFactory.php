<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Account\UserSocial::class, function (Faker $faker) {
    return [
        "user_id" => 1,
    ];
});
