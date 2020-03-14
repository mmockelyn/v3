<?php

namespace App\Http\Controllers\Api\Admin\Tutoriel;

use App\HelpersClass\Account\AdminHelper;
use App\HelpersClass\Core\Datatable;
use App\HelpersClass\Tutoriel\TutorielHelper;
use App\Http\Controllers\Api\BaseController;
use App\Notifications\Admin\AdminNotification;
use App\Repository\Tutoriel\TutorielSubCategoryRepository;
use Exception;
use Illuminate\Http\Request;

class TutorielSubCategoryController extends BaseController
{
    /**
     * @var Datatable
     */
    private $datatable;
    /**
     * @var TutorielSubCategoryRepository
     */
    private $tutorielSubCategoryRepository;

    /**
     * TutorielSubCategoryController constructor.
     * @param Datatable $datatable
     * @param TutorielSubCategoryRepository $tutorielSubCategoryRepository
     */
    public function __construct(Datatable $datatable, TutorielSubCategoryRepository $tutorielSubCategoryRepository)
    {
        $this->datatable = $datatable;
        $this->tutorielSubCategoryRepository = $tutorielSubCategoryRepository;
    }

    public function list(Request $request)
    {
        $datas = $this->tutorielSubCategoryRepository->all();
        $ars = collect();
        foreach ($datas as $data) {
            $ars->push([
                "id" => $data->id,
                "name" => $data->category->name . ' - ' . $data->name,
                "count" => TutorielHelper::countAllTutorielFromSubCategory($data->id)
            ]);
        }
        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des sous catégories");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function store(Request $request)
    {
        try {
            $sub = $this->tutorielSubCategoryRepository->create($request->category_id, $request->name, $request->short);

            AdminHelper::adminsNotification(new AdminNotification('la la-youtube-play', 'success', 2, "La sous catégorie <strong>" . $sub->name . "</strong> à été ajouté"));
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            AdminHelper::adminsNotification(new AdminNotification('la la-youtube-play', 'error', 0, "Erreur lors de l'ajout de la sous catégorie"));
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function listSub($category_id)
    {
        $datas = $this->tutorielSubCategoryRepository->allFromCategory($category_id);
        ob_start();
        ?>
        <div class="form-group">
            <label for="subcategory_id">Sous Catégorie</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control selectpicker" data-live-search="true">
                <?php foreach ($datas as $data): ?>
                    <option value="<?= $data->id; ?>"><?= $data->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Liste des sous catégorie");
    }
}
