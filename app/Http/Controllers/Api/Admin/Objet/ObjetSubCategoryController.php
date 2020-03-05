<?php

namespace App\Http\Controllers\Api\Admin\Objet;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Asset\AssetSubCategoryRepository;
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
        }catch (\Exception $exception) {
            return $this->sendError("Erreur système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
