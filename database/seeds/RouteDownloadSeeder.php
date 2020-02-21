<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class RouteDownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        for ($i = 0; $i < rand(1, 30), $i++;){
            \App\Model\Route\RouteDownload::create([
                "route_id"  => 1,
                "version"   => rand(1,9),
                "build"     => rand(1000,999999),
                "route_type_download_id" => rand(1,3),
                "route_type_release_id" => rand(1,5),
                "linkDownload" => $faker->url,
                "note"  => $faker->text(rand(200, 1000)),
                "published" => rand(0,1)
            ]);
        }
    }
}
