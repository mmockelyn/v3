<?php

use Illuminate\Database\Seeder;

class TutorielSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 1,
            "name"  => "Mode Concepteur",
            "short" => "concepteur"
        ]);

        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 1,
            "name"  => "Mode Conducteur",
            "short" => "conducteur"
        ]);

        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 1,
            "name"  => "Options & Paramètres",
            "short" => "option"
        ]);

        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 2,
            "name"  => "Modélisation",
            "short" => "modelisation"
        ]);

        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 2,
            "name"  => "Configuration de contenue",
            "short" => "configuration"
        ]);

        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 2,
            "name"  => "Création & Paramétrage de script",
            "short" => "script"
        ]);

        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 2,
            "name"  => "Terminologie",
            "short" => "terminologie"
        ]);

        \App\Model\Tutoriel\TutorielSubCategory::create([
            "tutoriel_category_id"  => 2,
            "name"  => "Validation de contenue",
            "short" => "validation"
        ]);
    }
}
