<?php

use Illuminate\Database\Seeder;

class AssetCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Asset\AssetCategory::create(["name" => "Matériels Roulants"]);
        \App\Model\Asset\AssetCategory::create(["name" => "Métro"]);
        \App\Model\Asset\AssetCategory::create(["name" => "Objets"]);
    }
}
