<?php
namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\TutorielSource;

class TutorielSourceRepository
{
    /**
     * @var TutorielSource
     */
    private $tutorielSource;

    /**
     * TutorielSourceRepository constructor.
     * @param TutorielSource $tutorielSource
     */

    public function __construct(TutorielSource $tutorielSource)
    {
        $this->tutorielSource = $tutorielSource;
    }

}

