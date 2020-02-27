<?php

use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User
        $this->CreateUser();
        $this->createRouteTypeDownload();
        $this->createRouteTypeRelease();
        $this->createTrainzBuild();
    }

    private function CreateUser() {
        $customer = new \App\Packages\Stripe\Core\Customer();

        $user = \App\User::create([
            "name" => "Syltheron",
            "email" => "trainznation@gmail.com",
            "password" => bcrypt('1992_Maxime'),
            "group" => 1
        ]);

        $cs = $customer->create($user->email, $user->name);

        $account = \App\Model\Account\UserAccount::create([
            "user_id" => $user->id,
            "customer_id" => $cs->id
        ]);

        $payment = \App\Model\Account\UserPayment::create([
            "user_id" => $user->id
        ]);

        $premium = \App\Model\Account\UserPremium::create([
            "user_id" => $user->id,
            "premium" => 1,
            "premium_start" => now(),
            "premium_end" => now()->addYear(),
        ]);

        $social = \App\Model\Account\UserSocial::create([
            "user_id" => $user->id
        ]);
    }
    private function createRouteTypeDownload()
    {
        $this->call(RouteTypeDownloadSeeder::class);
    }
    private function createRouteTypeRelease()
    {
        $this->call(RouteTypeReleaseSeeder::class);
    }

    private function createTrainzBuild()
    {
        $this->call(TrainzBuildSeeder::class);
    }
}
