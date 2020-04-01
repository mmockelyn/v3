<?php

namespace App\Http\Controllers\Admin\Tutoriel;

use App\HelpersClass\Account\AdminHelper;
use App\Http\Controllers\Controller;
use App\Notifications\Core\ErrorSlackNotification;
use App\Repository\Tutoriel\TutorielSubCategoryRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class TutorielSubCategoryController extends Controller
{
    /**
     * @var TutorielSubCategoryRepository
     */
    private $tutorielSubCategoryRepository;

    /**
     * TutorielSubCategoryController constructor.
     * @param TutorielSubCategoryRepository $tutorielSubCategoryRepository
     */
    public function __construct(TutorielSubCategoryRepository $tutorielSubCategoryRepository)
    {
        $this->tutorielSubCategoryRepository = $tutorielSubCategoryRepository;
    }

    public function delete($subcategory_id)
    {
        try {
            $this->tutorielSubCategoryRepository->delete($subcategory_id);

            Log::info("Suppression d'une sous catégorie d'un tutoriel");
            return redirect()->back()->with('success', "La sous catégorie à été supprimer");
        } catch (Exception $exception) {
            AdminHelper::adminsNotification(new ErrorSlackNotification('Tutoriel-subcatégorie', "Suppression Impossible", $exception->getMessage()));
            return redirect()->back()->with('error', "Erreur lors de la suppression de la sous catégorie");
        }
    }
}
