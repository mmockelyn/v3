<?php

namespace App\Http\Controllers\Admin\Tutoriel;

use App\HelpersClass\Account\AdminHelper;
use App\Http\Controllers\Controller;
use App\Notifications\Core\ErrorSlackNotification;
use App\Repository\Tutoriel\TutorielCategoryRepository;
use Exception;
use Illuminate\Http\Request;

class TutorielCategoryController extends Controller
{
    /**
     * @var TutorielCategoryRepository
     */
    private $tutorielCategoryRepository;

    /**
     * TutorielCategoryController constructor.
     * @param TutorielCategoryRepository $tutorielCategoryRepository
     */
    public function __construct(TutorielCategoryRepository $tutorielCategoryRepository)
    {

        $this->tutorielCategoryRepository = $tutorielCategoryRepository;
    }

    public function index()
    {
        return view("admin.tutoriel.category.index", [
            "categories" => $this->tutorielCategoryRepository->all()
        ]);
    }

    public function delete($category_id)
    {
        try {
            $this->tutorielCategoryRepository->delete($category_id);

            return redirect()->back()->with('success', "La catégorie à été supprimer");
        } catch (Exception $exception) {
            AdminHelper::adminsNotification(new ErrorSlackNotification('Tutoriel-catégorie', "Suppression Impossible", $exception->getMessage()));
            return redirect()->back()->with('error', "Erreur lors de la suppression de la catégorie");
        }
    }

}
