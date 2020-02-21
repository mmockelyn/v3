<?php

use Illuminate\Database\Seeder;

class UserSocialSeeder extends Seeder
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
            \App\Model\Account\UserSocial::create([
                "user_id"   => $user->id
            ]);
        }
    }
}
