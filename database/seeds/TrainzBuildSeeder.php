<?php

use Illuminate\Database\Seeder;

class TrainzBuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Core\TrainzBuild::create(["build" => "3.1", "trainz_version_name" => "TS2009"]);
        \App\Model\Core\TrainzBuild::create(["build" => "3.4", "trainz_version_name" => "TS2010"]);
        \App\Model\Core\TrainzBuild::create(["build" => "3.7", "trainz_version_name" => "TS2012"]);
        \App\Model\Core\TrainzBuild::create(["build" => "4.2", "trainz_version_name" => "T:ANE"]);
        \App\Model\Core\TrainzBuild::create(["build" => "4.5", "trainz_version_name" => "T:ANE SP3"]);
        \App\Model\Core\TrainzBuild::create(["build" => "4.6", "trainz_version_name" => "TRS19"]);
    }
}
