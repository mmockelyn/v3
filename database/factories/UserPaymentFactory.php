<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Account\UserPayment::class, function (Faker $faker) {
    return [
        "user_id" => 1,
        "stripe_id" => "pm_1GEkLVIBUODygnhZOoVDTNJq",
        "card_brand" => "visa",
        "card_last_four" => "4242"
    ];
});
