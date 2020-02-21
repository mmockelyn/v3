<?php
namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\TutorielCategory;

class TutorielCategoryRepository
{
    /**
     * @var TutorielCategory
     */
    private $tutorielCategory;

    /**
     * TutorielCategoryRepository constructor.
     * @param TutorielCategory $tutorielCategory
     */

    public function __construct(TutorielCategory $tutorielCategory)
    {
        $this->tutorielCategory = $tutorielCategory;
    }

    public function all()
    {
        return $this->tutorielCategory->newQuery()
            ->get()->load('subcategories');
    }

}

