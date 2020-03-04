<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class TutorielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $subcategories = \App\Model\Tutoriel\TutorielSubCategory::get();
        $users = \App\User::count();

        foreach ($subcategories as $subcategory) {
            for($i=0; $i < rand(1,10); $i++) {
                $title = $faker->realText(rand(10,100));
                $short_content = $faker->realText(rand(150,500));
                $published = rand(0,2);
                $source = rand(0,1);
                if($published == 2) {
                    $published_at = now()->addDays(rand(0, 15));
                }elseif($published == 1) {
                    $published_at = now()->subDays(rand(0,720));
                }else{
                    $published_at = null;
                }
                if($published == 1){$time = rand(0,59).":".rand(0,59)." mins";}else{$time = null;}

                \App\Model\Tutoriel\Tutoriel::create([
                    "tutoriel_category_id"  => $subcategory->tutoriel_category_id,
                    "tutoriel_sub_category_id"  => $subcategory->id,
                    "user_id"   => rand(1, $users),
                    "title"     => $title,
                    "slug"      => \Illuminate\Support\Str::slug($title),
                    "short_content" => $short_content,
                    "content"   => "<i>".$short_content."</i><br><br>".$faker->realText(rand(250, 1000)),
                    "published" => $published,
                    "pathVideo" => "/tmp/sending/".rand(0,1000).".mp4",
                    "source"    => $source,
                    "premium"   => rand(0,1),
                    "time"  => $time,
                    "published_at"  => $published_at,
                    "difficulte"    => rand(0,2)
                ]);
            }
        }
    }
}
