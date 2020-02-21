<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        for ($i=0; $i < 7; $i++) {
            $countArticles = \App\Model\Blog\Blog::count();
            $rand = rand(1, $countArticles);

            \App\Model\Core\Slideshow::create([
                "linkImages"    => $faker->imageUrl(1920, 1080),
                "linkArticle"   => route('Front.Blog.show', $rand)
            ]);
        }
    }
}
