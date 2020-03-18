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

    public function all()
    {
        return $this->tutorielSubCategory->newQuery()
            ->get();
    }

    public function create($category_id, $name, $short)
    {
        return $this->tutorielSubCategory->newQuery()
            ->create([
                "tutoriel_category_id" => $category_id,
                "name" => $name,
                "short" => $short
            ]);
    }

    public function delete($subcategory_id)
    {
        return $this->tutorielSubCategory->newQuery()
            ->find($subcategory_id)
            ->delete();
    }

    public function allFromCategory($category_id)
    {
        return $this->tutorielSubCategory->newQuery()
            ->where('tutoriel_category_id', $category_id)
            ->get();
    }

}

