<?php

use Illuminate\Database\Seeder;

class UserPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::get()->load('premium');

        foreach ($users as $user) {
            $modes = ["Visa", "Mastercard", "Carte Bleu"];
            if($user->premium->premium == 1) {
                \App\Model\Account\UserPayment::create([
                    "user_id"   => $user->id,
                    "stripe_id" => \Illuminate\Support\Str::random(6),
                    "card_brand"    => array_rand($modes),
                    "card_last_four" => rand(1000,9999)
                ]);
            } else {
                \App\Model\Account\UserPayment::create([
                    "user_id"   => $user->id,
                ]);
            }
        }
    }
}
