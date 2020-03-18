<?php

namespace App\Http\Controllers\Api\Admin\Objet;

use App\HelpersClass\Asset\AssetHelper;
use App\HelpersClass\Core\Datatable;
use App\HelpersClass\Core\ZipFile;
use App\Http\Controllers\Api\BaseController;
use App\Notifications\Asset\AssetPublish;
use App\Repository\Asset\AssetCompatibilityRepository;
use App\Repository\Asset\AssetRepository;
use App\Repository\Asset\AssetTagRepository;
use App\User;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
            if (Storage::disk('sftp')->exists('download/' . $data->id . '/fbx/lod0n.FBX') == false) {
                $errors->push([
                    "<li>Le système prend en charge un visuel 3D mais le fichier est inexistant sur le serveur de partage</li>"
                ]);
            }
        }

        if ($data->config == 1) {
            if (Storage::disk('sftp')->exists('download/' . $data->id . '/config/config.txt') == false) {
                $errors->push([
                    "<li>Le système prend en charge un visuel 3D mais le fichier est inexistant sur le serveur de partage</li>"
                ]);
            }
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
        $asset = $this->assetRepository->find($asset_id);
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new AssetPublish($asset));
        }
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

    public function uploadDownloadFile(Request $request, $asset_id)
    {
        $data = $this->assetRepository->get($asset_id);
        $file = $request->file('file');
        $path = 'download/' . $asset_id . '/';
        if (Storage::disk('sftp')->exists($path . $data->uuid . '.zip') == true) {
            try {
                Storage::disk('sftp')->delete($path . $data->uuid . '.zip');
                try {
                    $file->storeAs($path, $data->uuid . '.zip', 'sftp');
                    try {
                        Storage::disk('sftp')->setVisibility($path . $data->uuid . '.zip', 'public');
                        try {
                            $this->assetRepository->updateLinkDownload($asset_id, "https://download.trainznation.eu/v3/download/" . $asset_id . "/" . $data->uuid . ".zip");

                            return $this->sendResponse(null, null);
                        } catch (Exception $exception) {
                            return $this->sendError("Erreur Système", [
                                "error" => "Création en base échoué"
                            ]);
                        }
                    } catch (FileException $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "error" => "Impossible de modifier la visibilité du fichier"
                        ]);
                    }
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "error" => "Transfère du fichier sur le serveur Echoué"
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "error" => "Impossible de supprimer le fichier précédent"
                ]);
            }
        } else {
            try {
                $file->storeAs($path, $data->uuid . '.zip', 'sftp');
                try {
                    Storage::disk('sftp')->setVisibility($path . $data->uuid . '.zip', 'public');
                    try {
                        $this->assetRepository->updateLinkDownload($asset_id, "https://download.trainznation.eu/v3/download/" . $asset_id . "/" . $data->uuid . ".zip");
                        return $this->sendResponse(null, null);
                    } catch (Exception $exception) {
                        return $this->sendError("Erreur Système", [
                            "error" => "Création en base échoué"
                        ]);
                    }
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "error" => "Impossible de modifier la visibilité du fichier"
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "error" => "Transfère du fichier sur le serveur Echoué"
                ]);
            }
        }
    }

    public function uploadFbx(Request $request, $asset_id)
    {
        $data = $this->assetRepository->get($asset_id);
        $file = $request->file('file');
        $path = 'download/' . $asset_id . '/fbx/';
        if (Storage::disk('sftp')->exists($path . $data->uuid . '.zip') == true) {
            try {
                Storage::disk('sftp')->delete($path . $data->uuid . '.zip');
                try {
                    $file->storeAs($path, $data->uuid . '.zip', 'sftp');
                    try {
                        Storage::disk('sftp')->setVisibility($path . $data->uuid . '.zip', 'public');
                        ZipFile::fileFbx(Storage::disk('sftp')->get('download/' . $asset_id . '/fbx/' . $data->uuid . '.zip'), $asset_id);
                        return $this->sendResponse(null, null);
                    } catch (FileException $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "error" => "Impossible de modifier la visibilité du fichier"
                        ]);
                    } catch (FileNotFoundException $e) {
                        return $this->sendError("Erreur Fichier", [
                            "error" => "Le Fichier n'existe pas sur le serveur"
                        ]);
                    }
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "error" => "Transfère du fichier sur le serveur Echoué"
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "error" => "Impossible de supprimer le fichier précédent"
                ]);
            }
        } else {
            try {
                $file->storeAs($path, $data->uuid . '.zip', 'sftp');
                try {
                    Storage::disk('sftp')->setVisibility($path . $data->uuid . '.zip', 'public');
                    ZipFile::fileFbx(Storage::disk('sftp')->get('download/' . $asset_id . '/fbx/' . $data->uuid . '.zip'), $asset_id);
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "error" => "Impossible de modifier la visibilité du fichier"
                    ]);
                } catch (FileNotFoundException $e) {
                    return $this->sendError("Erreur Fichier", [
                        "error" => "Le Fichier n'existe pas sur le serveur"
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "error" => "Transfère du fichier sur le serveur Echoué"
                ]);
            }
        }
        return null;
    }

    public function uploadConfigFile(Request $request, $asset_id)
    {
        $data = $this->assetRepository->get($asset_id);
        $file = $request->file('file');
        $path = 'download/' . $asset_id . '/config/';
        if (Storage::disk('sftp')->exists($path . $file->getClientOriginalName()) == true) {
            try {
                Storage::disk('sftp')->delete($path . $file->getClientOriginalName());
                try {
                    $file->storeAs($path, 'config.txt', 'sftp');
                    try {
                        Storage::disk('sftp')->setVisibility($path . 'config.txt', 'public');

                        return $this->sendResponse(null, null);
                    } catch (FileException $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "error" => "Impossible de modifier la visibilité du fichier"
                        ]);
                    }
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "error" => "Transfère du fichier sur le serveur Echoué"
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "error" => "Impossible de supprimer le fichier précédent"
                ]);
            }
        } else {
            try {
                $file->storeAs($path, 'config.txt', 'sftp');
                try {
                    Storage::disk('sftp')->setVisibility($path . 'config.txt', 'public');
                    return $this->sendResponse(null, null);
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "error" => "Impossible de modifier la visibilité du fichier"
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "error" => "Transfère du fichier sur le serveur Echoué"
                ]);
            }
        }
    }

    public function editPrice(Request $request, $asset_id)
    {
        $asset = $this->assetRepository->get($asset_id);
        if ($asset->pricing == 0) {
            return $this->sendError("Erreur Structurelle", [
                "error" => "Veuillez changer la prise en charge de prix en payant avant de modifier le montant !"
            ], 202);
        }

        try {
            $this->assetRepository->updatePrice($asset_id, $request->price);

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editInfo(Request $request, $asset_id)
    {
        if ($request->exists('published') == true) {
            $published = 1;
            $published_at = now();
            $this->publish($asset_id);
        } else {
            $published = 0;
            $published_at = null;
        }
        if ($request->exists('social') == true) {
            $social = 1;
        } else {
            $social = 0;
        }
        if ($request->exists('mesh') == true) {
            $mesh = 1;
        } else {
            $mesh = 0;
        }
        if ($request->exists('config') == true) {
            $config = 1;
        } else {
            $config = 0;
        }
        if ($request->exists('pricing') == true) {
            $pricing = 1;
        } else {
            $pricing = 0;
        }

        try {
            $this->assetRepository->updateInfo(
                $asset_id,
                $request->designation,
                $request->kuid,
                $published,
                $published_at,
                $social,
                $mesh,
                $config,
                $pricing,
                $request->short_description
            );

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editDescription(Request $request, $asset_id)
    {
        try {
            $this->assetRepository->updateDescription(
                $asset_id,
                $request->description
            );

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

}
