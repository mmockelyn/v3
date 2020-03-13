<?php
namespace App\Repository\Tutoriel;

use App\HelpersClass\Account\AdminHelper;
use App\Model\Tutoriel\TutorielCategory;
use App\Notifications\Core\ErrorSlackNotification;
use Exception;

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

    public function get($id)
    {
        return $this->tutorielCategory->newQuery()
            ->find($id);
    }

    public function delete($category_id)
    {
        try {
            return $this->get($category_id)
                ->delete();
        } catch (Exception $e) {
            AdminHelper::adminsNotification(new ErrorSlackNotification('Tutoriel / Catégory / Suppression', "Impossible de supprimer la catégorie", $e->getMessage()));
        }
    }

    public function create($name)
    {
        return $this->tutorielCategory->newQuery()
            ->create([
                "name" => $name
            ]);
    }

}

