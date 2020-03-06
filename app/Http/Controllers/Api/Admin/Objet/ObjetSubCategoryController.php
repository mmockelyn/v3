<?php

namespace App\Http\Controllers\Api\Admin\Objet;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Asset\AssetSubCategoryRepository;
use Exception;
use Illuminate\Http\Request;

class ObjetSubCategoryController extends BaseController
{
    /**
     * @var AssetSubCategoryRepository
     */
    private $assetSubCategoryRepository;
    /**
     * @var Datatable
     */
    private $datatable;

    /**
     * ObjetSubCategoryController constructor.
     * @param AssetSubCategoryRepository $assetSubCategoryRepository
     * @param Datatable $datatable
     */
    public function __construct(AssetSubCategoryRepository $assetSubCategoryRepository, Datatable $datatable)
    {
        $this->assetSubCategoryRepository = $assetSubCategoryRepository;
        $this->datatable = $datatable;
    }

    public function list(Request $request)
    {
        $arrs = collect();
        $datas = $this->assetSubCategoryRepository->all();
        foreach ($datas as $data) {
            $arrs->push([
                "id" => $data->id,
                "category" => $data->category->name,
                "name" => $data->name
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($arrs, "Liste des sous catégories");
        } else {
            return $this->datatable->loadDatatable($request, $arrs->toArray());
        }
    }

    public function store(Request $request)
    {
        try {
            $this->assetSubCategoryRepository->create(
                $request->category_id,
                $request->name
            );

            return $this->sendResponse("ok", "ok");
        } catch (Exception $exception) {
            return $this->sendError("Erreur système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function listSub($category_id)
    {
        $datas = $this->assetSubCategoryRepository->allFromCategory($category_id);
        ob_start();
        ?>
        <div class="form-group">
            <label for="subcategory_id">Sous Catégorie</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control selectpicker">
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
