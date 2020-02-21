<?php

use Illuminate\Database\Seeder;

class UserpremiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::get();

        foreach ($users as $user) {
            $premium = rand(0,1);
            if($premium == 1) {
                $premium_start = now()->subDays(rand(0,30));
                $premium_end = $premium_start->addDays(rand(30,90));
            }else{
                $premium_start = null;
                $premium_end = null;
            }

            \App\Model\Account\UserPremium::create([
                "user_id"   => $user->id,
                "premium"   => $premium,
                "premium_start" => $premium_start,
                "premium_end"   => $premium_end
            ]);
        }
    }
}
