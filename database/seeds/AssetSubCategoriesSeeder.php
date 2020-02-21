<?php

use Illuminate\Database\Seeder;

class AssetSubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Locomotive Diesel"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Locomotive Electrique"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Locomotive Vapeur"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "TGV"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Autorail/Automotrice Diesel"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Autorail/Automotrice Electrique"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "RIO/RIB"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Métro"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Tramway"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Voiture Voyageurs"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Wagon Marchandise"
        ]);

        //------------------------------------------------//

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 2,
            "name" => "Gare/Station"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Signalisation"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 1,
            "name" => "Voie"
        ]);

        //---------------------------------------------//

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Animaux"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Décors"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Gare Fonctionnel"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Gare Non Fonctionnel"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Industrie"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Marchandise"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Objets de Gare"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Objets de Voie"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Pont"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Tunnel"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Voie"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Batiment"
        ]);

        \App\Model\Asset\AssetSubCategory::create([
            "asset_category_id" => 3,
            "name" => "Autre"
        ]);
    }
}
