<?php

use Illuminate\Database\Seeder;

class TutorielCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Tutoriel\TutorielCategory::create(["name" => "Trainz en général"]);
        \App\Model\Tutoriel\TutorielCategory::create(["name" => "Création de contenue"]);
    }
}
