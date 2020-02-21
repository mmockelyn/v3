<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class TutorielTagSeeder extends Seeder
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

        foreach ($tutos as $tuto) {
            for ($i = 0; $i < rand(1, 7); $i++) {
                $name = $faker->word();
                \App\Model\Tutoriel\TutorielTag::create([
                    "tutoriel_id"   => $tuto->id,
                    "name"  => $name,
                    "slug"  => \Illuminate\Support\Str::slug($name)
                ]);
            }
        }
    }
}
