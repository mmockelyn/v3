<?php

use Illuminate\Database\Seeder;

class WikiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        for ($i=0; $i < 25; $i++) {
            $category = rand(1,3);
            $sub = rand(1,3);
            $published = rand(0,1);
            if($published == 1){$published_at = now()->subDays(rand(1,360));}else{$published_at = null;}

            \App\Model\Wiki\Wiki::query()->create([
                "wiki_category_id"  => $category,
                "wiki_sub_category_id" => $sub,
                "title" => $faker->text(191),
                "content" => $faker->text(rand(200,1000)),
                "published" => $published,
                "published_at"  => $published_at
            ]);
        }
    }
}
