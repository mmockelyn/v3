<?php

namespace App\Http\Controllers\Api\Admin\Objet;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Asset\AssetCategoryRepository;
use Exception;
use Illuminate\Http\Request;

class ObjetCategoryController extends BaseController
{
    /**
     * @var AssetCategoryRepository
     */
    private $assetCategoryRepository;
    /**
     * @var Datatable
     */
    private $datatable;

    /**
     * ObjetCategoryController constructor.
     * @param AssetCategoryRepository $assetCategoryRepository
     * @param Datatable $datatable
     */
    public function __construct(AssetCategoryRepository $assetCategoryRepository, Datatable $datatable)
    {
        $this->assetCategoryRepository = $assetCategoryRepository;
        $this->datatable = $datatable;
    }

    public function list(Request $request)
    {
        if ($request->get('type') == 'plain') {
            $datas = $this->assetCategoryRepository->all()->toArray();

            return $this->sendResponse($datas, "Liste des catégories");
        } else {
            return $this->datatable->loadDatatable($request, $this->assetCategoryRepository->all()->toArray());
        }
    }

    public function store(Request $request)
    {
        try {
            $this->assetCategoryRepository->create($request->name);

            return $this->sendResponse('ok', 'ok');
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

}
