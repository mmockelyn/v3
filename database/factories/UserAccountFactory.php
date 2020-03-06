<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Account\UserAccount::class, function (Faker $faker) {
    return [
        "user_id" => 1,
        "customer_id" => "cus_GmIxhfgu8GW77S"
    ];
});
