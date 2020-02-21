<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class RouteGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $categories = \App\Model\Route\RouteGalleryCategory::get();

        foreach ($categories as $category) {
            for ($i = 0; $i < 2; $i++) {
                \App\Model\Route\RouteGallery::create([
                    "route_id"  => 1,
                    "route_gallery_category_id"    => $category->id,
                    "filename"      => $category->id.'_'.$i.'.png'
                ]);
            }
        }
    }
}
