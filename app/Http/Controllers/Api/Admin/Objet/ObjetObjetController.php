<?php

namespace App\Http\Controllers\Api\Admin\Objet;

use App\HelpersClass\Asset\AssetHelper;
use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCompatibilityRepository;
use App\Repository\Asset\AssetRepository;
use App\Repository\Asset\AssetTagRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
     * @var AssetTagRepository
     */
    private $assetTagRepository;
    /**
     * @var AssetCompatibilityRepository
     */
    private $assetCompatibilityRepository;

    /**
     * ObjetObjetController constructor.
     * @param AssetRepository $assetRepository
     * @param Datatable $datatable
     * @param AssetTagRepository $assetTagRepository
     * @param AssetCompatibilityRepository $assetCompatibilityRepository
     */
    public function __construct(
        AssetRepository $assetRepository,
        Datatable $datatable,
        AssetTagRepository $assetTagRepository, AssetCompatibilityRepository $assetCompatibilityRepository)
    {
        $this->assetRepository = $assetRepository;
        $this->datatable = $datatable;
        $this->assetTagRepository = $assetTagRepository;
        $this->assetCompatibilityRepository = $assetCompatibilityRepository;
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

    public function verifPublish($asset_id)
    {
        $data = $this->assetRepository->get($asset_id);
        $errors = collect();

        if ($data->short_description == $data->description) {
            $errors->push([
                "<li>Aucune différence entre la description courte et la description longue.<br>Veuillez Emmettre une description longue différente de la description courte</li>"
            ]);
        }

        if (Storage::disk('public')->exists('download/' . $data->id . '.png') == false) {
            $errors->push([
                "<li>L'image de l'article n'est pas définie</li>"
            ]);
        }

        if (Storage::disk('sftp')->exists('download/' . $data->id . '/' . $data->uuid . '.zip') == false) {
            $errors->push([
                "<li>L'objet n'est pas envoyer sur le serveur de partage</li>"
            ]);
        }

        if ($data->mesh == 1) {
            if (Storage::disk('sftp')->exists('download/' . $data->id . '/fbx/*.fbx') == false) {
                $errors->push([
                    "<li>Le système prend en charge un visuel 3D mais le fichier est inexistant sur le serveur de partage</li>"
                ]);
            }
        }

        if ($data->mesh == 1) {
            if (Storage::disk('sftp')->exists('download/' . $data->id . '/config/config.txt') == false) {
                $errors->push([
                    "<li>Le système prend en charge un visuel 3D mais le fichier est inexistant sur le serveur de partage</li>"
                ]);
            }
        }

        if (count($data->tags) == 0) {
            $errors->push([
                "<li>Aucun tags de définie</li>"
            ]);
        }

        if (count($errors) == 0) {
            return $this->sendResponse([
                "result" => 'true'
            ], "OK");
        } else {
            return $this->sendResponse([
                "result" => 'false',
                "content" => $errors
            ], "OK");
        }
    }

    public function publish($asset_id)
    {
        $this->assetRepository->updateState($asset_id, 1);
        return $this->sendResponse('ok', 'ok');
    }

    public function unpublish($asset_id)
    {
        $this->assetRepository->updateState($asset_id, 0);
        return $this->sendResponse('ok', 'ok');
    }

    public function postTag(Request $request, $asset_id)
    {
        $tags = json_decode($request->tags);
        $validator = Validator::make($request->all(), [
            "tags" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de Validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            foreach ($tags as $tag) {
                $this->assetTagRepository->create($asset_id, $tag->value);
            }

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function postCompatibility(Request $request, $asset_id)
    {
        $validator = Validator::make($request->all(), [
            "trainz_build_id" => "required",
            "state" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            $this->assetCompatibilityRepository->create(
                $asset_id,
                $request->trainz_build_id,
                $request->state
            );

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function compatibilitiesList(Request $request, $asset_id)
    {
        $datas = $this->assetCompatibilityRepository->allFormAsset($asset_id);
        $ars = collect();

        foreach ($datas as $data) {
            $ars->push([
                "id" => $data->id,
                "version" => '<span class="kt-media kt-media--circle kt-media--' . AssetHelper::stateClassCompatibility($data->state) . ' kt-margin-r-5 kt-margin-t-5"><span>' . $data->trainzBuild->build . '</span></span>',
                "trainz_build_id" => $data->trainz_build_id
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars->toArray(), "Liste des objets");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function tagList(Request $request, $asset_id)
    {
        $datas = $this->assetTagRepository->allFormAsset($asset_id);

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($datas->toArray(), "Liste des objets");
        } else {
            return $this->datatable->loadDatatable($request, $datas->toArray());
        }
    }

}
