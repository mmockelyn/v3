<?php

namespace App\Http\Controllers\Admin\Objet;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCategoryRepository;
use App\Repository\Asset\AssetCompatibilityRepository;
use App\Repository\Asset\AssetRepository;
use App\Repository\Asset\AssetTagRepository;
use App\Repository\Core\TrainzBuildRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ObjetObjetController extends Controller
{
    /**
     * @var AssetCategoryRepository
     */
    private $assetCategoryRepository;
    /**
     * @var AssetRepository
     */
    private $assetRepository;
    /**
     * @var TrainzBuildRepository
     */
    private $trainzBuildRepository;
    /**
     * @var AssetCompatibilityRepository
     */
    private $assetCompatibilityRepository;
    /**
     * @var AssetTagRepository
     */
    private $assetTagRepository;

    /**
     * ObjetObjetController constructor.
     * @param AssetCategoryRepository $assetCategoryRepository
     * @param AssetRepository $assetRepository
     * @param TrainzBuildRepository $trainzBuildRepository
     * @param AssetCompatibilityRepository $assetCompatibilityRepository
     * @param AssetTagRepository $assetTagRepository
     */
    public function __construct(
        AssetCategoryRepository $assetCategoryRepository,
        AssetRepository $assetRepository,
        TrainzBuildRepository $trainzBuildRepository,
        AssetCompatibilityRepository $assetCompatibilityRepository,
        AssetTagRepository $assetTagRepository)
    {
        $this->assetCategoryRepository = $assetCategoryRepository;
        $this->assetRepository = $assetRepository;
        $this->trainzBuildRepository = $trainzBuildRepository;
        $this->assetCompatibilityRepository = $assetCompatibilityRepository;
        $this->assetTagRepository = $assetTagRepository;
    }


    public function index()
    {
        return view("admin.objet.objet.index", [
            "categories" => $this->assetCategoryRepository->all()
        ]);
    }

    public function show($objet_id)
    {
        return view("admin.objet.objet.show", [
            "asset" => $this->assetRepository->get($objet_id),
            "builds" => $this->trainzBuildRepository->all()
        ]);
    }

    public function edit($objet_id)
    {
        $objet = $this->assetRepository->get($objet_id);
        if ($objet->published == 1) {

            Log::warning("Tentative de modification à un objet publier", [
                "user" => auth()->user()->name,
                "objet" => $objet
            ]);
            return redirect()->back()->with('warning', "Cette objet à été publier, l'édition est impossible");
        }
        return view("admin.objet.objet.edit", [
            "asset" => $this->assetRepository->get($objet_id)
        ]);
    }

    public function deleteTag($asset_id, $tag_id)
    {
        try {
            $this->assetTagRepository->delete($tag_id);

            Log::info("Suppression d'un tag d'un objet");
            return redirect()->back()->with('success', "Le tag à été supprimer avec succès");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression du tag.<br><i>" . $exception->getMessage() . "</i>");
        }
    }

    public function deleteCompatibility($asset_id, $compatibility_id)
    {
        try {
            $this->assetCompatibilityRepository->delete($compatibility_id);

            Log::info("Suppression d'une compatibilité d'un objet");
            return redirect()->back()->with('success', "La compatibilité à été supprimer avec succès");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression de la compatibilité.<br><i>" . $exception->getMessage() . "</i>");
        }
    }

    public function editThumb(Request $request, $asset_id)
    {
        try {
            if (Storage::disk('public')->exists('download/' . $asset_id . '.png') == false) {
                Storage::disk('public')->delete('download/' . $asset_id . '.png');
                $request->file('images')->storeAs('download/', $asset_id . '.png', 'public');
                Storage::disk('public')->setVisibility('download/' . $asset_id . '.png', 'public');
            } else {
                $request->file('images')->storeAs('download/', $asset_id . '.png', 'public');
                Storage::disk('public')->setVisibility('download/' . $asset_id . '.png', 'public');
            }
            Log::info("L'image de présentation d'un objet à été mise à jours");
            return redirect()->back()->with('success', "L'image de l'objet à été mise à jours");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function delete($asset_id)
    {
        $asset = $this->assetRepository->find($asset_id);
        // Suppression de l'image
        if (Storage::disk('public')->exists('download/' . $asset_id . '.png') == false) {
            try {
                Storage::disk('public')->delete('download/' . $asset_id . '.png');
            }catch (FileException $e) {
                Log::error($e->getMessage());
                return redirect()->back()->with('error', "Erreur lors de la suppression de l'image de l'objet: ".$asset->designation);
            }
        } else {
            null;
        }

        // Suppression des campatibilités et des tags

        try {
            $this->assetCompatibilityRepository->deleteForAsset($asset_id);
        }catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', "Erreur lors de la suppression de la liste des compatibilités de l'objet: ".$asset->designation);
        }
        try {
            $this->assetTagRepository->deleteForAsset($asset_id);
        }catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', "Erreur lors de la suppression de la liste des tags de l'objet: ".$asset->designation);
        }

        // Suppression de l'objet dans la zone de téléchargement
        if (Storage::disk('sftp')->exists('download/' . $asset->id . '/' . $asset->uuid . '.zip') == true) {
            try {
                Storage::disk('sftp')->delete('download/' . $asset->id . '/' . $asset->uuid . '.zip');
            }catch (FileException $e) {
                Log::error($e->getMessage());
                return redirect()->back()->with('error', "Erreur lors de la suppression du fichier de l'objet: ".$asset->designation);
            }
        } else {
            null;
        }

        // Suppression de l'objet dans la table
        try {
            $this->assetRepository->delete($asset_id);
            return redirect()->back()->with('success', "L'objet à été supprimer avec succès.");
        }catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', "Erreur lors de la suppression de l'objet: ".$asset->designation);
        }
    }


}
