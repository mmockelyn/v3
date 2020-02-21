<?php

use Illuminate\Database\Seeder;

class TutorielSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tutos = \App\Model\Tutoriel\Tutoriel::get();

        foreach ($tutos as $tuto) {
            if($tuto->source == 1) {
                \App\Model\Tutoriel\TutorielSource::create([
                    "tutoriel_id"   => $tuto->id,
                    "pathSource"    => "/storage/tutoriel/source/".$tuto->id.".zip",
                ]);
            }
        }
    }
}
