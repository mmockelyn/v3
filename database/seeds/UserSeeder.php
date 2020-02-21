<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env("APP_ENV") == 'local') {
            factory(\App\User::class, 100)->create();
        }
    }
}
