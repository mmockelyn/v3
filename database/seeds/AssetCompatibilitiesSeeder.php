<?php

use Illuminate\Database\Seeder;

class AssetCompatibilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assets = \App\Model\Asset\Asset::get();
        $builds = \App\Model\Core\TrainzBuild::get();

        foreach ($assets as $asset) {
            foreach ($builds as $build) {
                \App\Model\Asset\AssetCompatibility::create([
                    "asset_id"  => $asset->id,
                    "trainz_build_id" => $build->id,
                    "state"         => rand(0,2)
                ]);
            }
        }
    }
}
