<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $articles = \App\Model\Blog\Blog::get();
        $rand = rand(1, 5);
        foreach ($articles as $article) {
            for ($i = 0; $i < $rand; $i++) {
                $name = $faker->word();
                \App\Model\Blog\BlogTag::create([
                    "blog_id" => $article->id,
                    "name" => $name,
                    "slug" => \Illuminate\Support\Str::slug($name)
                ]);
            }
        }
    }
}
