<?php

namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\TutorielTag;

class TutorielTagRepository
{
    /**
     * @var TutorielTag
     */
    private $tutorielTag;

    /**
     * TutorielTagRepository constructor.
     * @param TutorielTag $tutorielTag
     */

    public function __construct(TutorielTag $tutorielTag)
    {
        $this->tutorielTag = $tutorielTag;
    }

    public function allFromTutoriel($tutoriel_id)
    {
        return $this->tutorielTag->newQuery()
            ->where('tutoriel_id', $tutoriel_id)
            ->get();
    }

    public function create($tutoriel_id, $value)
    {
        return $this->tutorielTag->newQuery()
            ->create([
                "tutoriel_id" => $tutoriel_id,
                "name" => $value,
                "slug" => $value
            ]);
    }

    public function delete($tag_id)
    {
        return $this->tutorielTag->newQuery()
            ->find($tag_id)
            ->delete();
    }

}

