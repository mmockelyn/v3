<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class TutorielCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        $tutos = \App\Model\Tutoriel\Tutoriel::get();
        $user = \App\User::count();

        foreach ($tutos as $tuto) {
            for ($i = 0; $i < rand(0, 10); $i++) {
                $published = rand(0,1);
                if($published == 1){$published_at = now()->subDays(rand(0,720));}else{$published_at = null;}

                \App\Model\Tutoriel\TutorielComment::create([
                    "tutoriel_id"   => $tuto->id,
                    "user_id"   => rand(1, $user),
                    "content"   => $faker->realText(rand(50, 2000)),
                    "published" => $published,
                    "published_at" => $published_at
                ]);
            }
        }
    }
}
