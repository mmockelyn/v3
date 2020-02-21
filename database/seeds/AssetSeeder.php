<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $subcategories = \App\Model\Asset\AssetSubCategory::get();
        $rand = rand(0, 10);

        foreach ($subcategories as $subcategory) {
            for ($i = 0; $i < $rand; $i++) {
                $numberObject = rand(1,2000);
                $pricing = rand(0,1);
                $published = rand(0,1);
                if($pricing == 1){$price = \App\HelpersClass\Generator::formatCurrency(rand(1,100));}else{$price = null;}
                if($published == 1){$published_at = now()->subDays(rand(0,180));}else{$published_at = null;}

                \App\Model\Asset\Asset::create([
                    "asset_category_id"         => $subcategory->asset_category_id,
                    "asset_sub_category_id"     => $subcategory->id,
                    "designation"               => "Objet N°".$numberObject,
                    "short_description"         => $faker->text(150),
                    "description"               => $faker->text(rand(150,1500)),
                    "kuid"                      => "<kuid:400722:".$numberObject.">",
                    "downloadLink"              => $faker->url,
                    "pricing"                   => $pricing,
                    "price"                     => $price,
                    "published"                 => $published,
                    "published_at"              => $published_at
                ]);
            }
        }
    }
}
