<?php
namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\TutorielTechnologie;

class TutorielTechnologieRepository
{
    /**
     * @var TutorielTechnologie
     */
    private $tutorielTechnologie;

    /**
     * TutorielTechnologieRepository constructor.
     * @param TutorielTechnologie $tutorielTechnologie
     */

    public function __construct(TutorielTechnologie $tutorielTechnologie)
    {
        $this->tutorielTechnologie = $tutorielTechnologie;
    }

    public function allFromTutoriel($tutoriel_id)
    {
        return $this->tutorielTechnologie->newQuery()
            ->where('tutoriel_id', $tutoriel_id)
            ->get();
    }

    public function create($tutoriel_id, $value)
    {
        return $this->tutorielTechnologie->newQuery()
            ->create([
                "tutoriel_id" => $tutoriel_id,
                "name" => $value
            ]);
    }

    public function delete($tag_id)
    {
        return $this->tutorielTechnologie->newQuery()
            ->find($tag_id)
            ->delete();
    }

}

