<?php
namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\TutorielSubCategory;

class TutorielSubCategoryRepository
{
    /**
     * @var TutorielSubCategory
     */
    private $tutorielSubCategory;

    /**
     * TutorielSubCategoryRepository constructor.
     * @param TutorielSubCategory $tutorielSubCategory
     */

    public function __construct(TutorielSubCategory $tutorielSubCategory)
    {
        $this->tutorielSubCategory = $tutorielSubCategory;
    }

    public function get($subcategory_id)
    {
        return $this->tutorielSubCategory->newQuery()
            ->find($subcategory_id)->load('tutoriels');
    }

}

