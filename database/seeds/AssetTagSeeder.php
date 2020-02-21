<?php

use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $assets = \App\Model\Asset\Asset::get();
        $rand = rand(1, 5);

        foreach ($assets as $asset) {
            for ($i = 0; $i < $rand; $i++) {
                $name = $faker->word();
                \App\Model\Asset\AssetTag::create([
                    "asset_id"  => $asset->id,
                    "name"      => $name,
                    "slug"      => Str::slug($name)
                ]);
            }
        }
    }
}
