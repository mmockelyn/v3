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

    public function allFromTutoriel($tutoriel_id)
    {
        return $this->tutorielRequis->newQuery()
            ->where('tutoriel_id', $tutoriel_id)
            ->get();
    }

    public function create($tutoriel_id, $value)
    {
        return $this->tutorielRequis->newQuery()
            ->create([
                "tutoriel_id" => $tutoriel_id,
                "requis" => $value
            ]);
    }

    public function delete($tag_id)
    {
        return $this->tutorielRequis->newQuery()
            ->find($tag_id)
            ->delete();
    }

}

