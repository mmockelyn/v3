<?php
namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\TutorielRequis;

class TutorielRequisRepository
{
    /**
     * @var TutorielRequis
     */
    private $tutorielRequis;

    /**
     * TutorielRequisRepository constructor.
     * @param TutorielRequis $tutorielRequis
     */

    public function __construct(TutorielRequis $tutorielRequis)
    {
        $this->tutorielRequis = $tutorielRequis;
    }

}

