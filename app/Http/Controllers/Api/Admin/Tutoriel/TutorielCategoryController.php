<?php

namespace App\Http\Controllers\Api\Admin\Tutoriel;

use App\HelpersClass\Account\AdminHelper;
use App\HelpersClass\Core\Datatable;
use App\HelpersClass\Tutoriel\TutorielHelper;
use App\Http\Controllers\Api\BaseController;
use App\Notifications\Admin\AdminNotification;
use App\Repository\Tutoriel\TutorielCategoryRepository;
use Exception;
use Illuminate\Http\Request;

class TutorielCategoryController extends BaseController
{
    /**
     * @var TutorielCategoryRepository
     */
    private $tutorielCategoryRepository;
    /**
     * @var Datatable
     */
    private $datatable;

    /**
     * TutorielCategoryController constructor.
     * @param TutorielCategoryRepository $tutorielCategoryRepository
     * @param Datatable $datatable
     */
    public function __construct(TutorielCategoryRepository $tutorielCategoryRepository, Datatable $datatable)
    {
        $this->tutorielCategoryRepository = $tutorielCategoryRepository;
        $this->datatable = $datatable;
    }

    public function store(Request $request)
    {
        try {
            $category = $this->tutorielCategoryRepository->create($request->name);

            AdminHelper::adminsNotification(new AdminNotification('la la-youtube-play', 'success', 2, "Création d'une catégorie: " . $category->name));
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            AdminHelper::adminsNotification(new AdminNotification('la la-youtube-play', 'error', 0, "Erreur lors de la création d'une catégorie"));
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function list(Request $request)
    {
        $datas = $this->tutorielCategoryRepository->all();
        $ars = collect();

        foreach ($datas as $data) {
            $ars->push([
                "id" => $data->id,
                "name" => $data->name,
                "count" => TutorielHelper::countAllTutorielFromCategory($data->id)
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des catégories");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }
}
