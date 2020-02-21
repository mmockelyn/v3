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

}

