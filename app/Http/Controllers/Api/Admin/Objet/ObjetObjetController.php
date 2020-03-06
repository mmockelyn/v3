<?php

namespace App\Http\Controllers\Api\Admin\Objet;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Webpatser\Uuid\Uuid;

class ObjetObjetController extends BaseController
{
    /**
     * @var AssetRepository
     */
    private $assetRepository;
    /**
     * @var Datatable
     */
    private $datatable;

    /**
     * ObjetObjetController constructor.
     * @param AssetRepository $assetRepository
     * @param Datatable $datatable
     */
    public function __construct(AssetRepository $assetRepository, Datatable $datatable)
    {
        $this->assetRepository = $assetRepository;
        $this->datatable = $datatable;
    }

    public function list(Request $request)
    {
        $datas = $this->assetRepository->all();
        $ars = collect();

        foreach ($datas as $data) {
            if (Storage::disk('public')->exists('download/' . $data->id . '.png') == true) {
                $img = '<img src="/storage/download/' . $data->id . '.png" width="80" class="img-fluid" alt="' . $data->name . '">';
            } else {
                $img = '<img src="/storage/download/download.png" width="80" class="img-fluid" alt="' . $data->name . '">';
            }
            $ars->push([
                "id" => $data->id,
                "img" => $img,
                "designation" => $data->designation,
                "short_description" => $data->short_description,
                "published" => $data->published,
                "pricing" => $data->pricing,
                "price" => $data->price,
                "social" => $data->social
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars->toArray(), "Liste des objets");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "category_id" => "required",
            "subcategory_id" => "required",
            "designation" => "required",
            "short_description" => "required|max:191"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }

        try {
            $asset = $this->assetRepository->create(
                $request->category_id,
                $request->subcategory_id,
                $request->designation,
                $request->short_description,
                Uuid::generate()->string
            );

            return $this->sendResponse($asset, 'ok');
        } catch (Exception $exception) {
            return $this->sendError("Erreur", $exception->getMessage());
        }
    }

    public function get($asset_id)
    {
        $data = $this->assetRepository->get($asset_id);
        return $this->sendResponse($data, "ok");
    }
}
