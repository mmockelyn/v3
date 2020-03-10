<?php

namespace App\Http\Controllers\Api\Admin\Tutoriel;

use App\HelpersClass\Core\Datatable;
use App\HelpersClass\Tutoriel\TutorielHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Tutoriel\TutorielRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class TutorielVideoController extends BaseController
{
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;
    /**
     * @var Datatable
     */
    private $datatable;

    /**
     * TutorielVideoController constructor.
     * @param TutorielRepository $tutorielRepository
     * @param Datatable $datatable
     */
    public function __construct(TutorielRepository $tutorielRepository, Datatable $datatable)
    {
        $this->tutorielRepository = $tutorielRepository;
        $this->datatable = $datatable;
    }

    public function list(Request $request)
    {
        $datas = $this->tutorielRepository->all();
        $ars = collect();

        foreach ($datas as $data) {
            if ($data->published == 1 || $data->published == 2) {
                $published_at = $data->published_at->diffForHumans();
            } else {
                $published_at = null;
            }
            if (Storage::disk('public')->exists('tutoriel/' . $data->id . '/banner.png') == true) {
                $img = 'storage/tutoriel/' . $data->id . '/banner.png';
            } else {
                $img = 'storage/tutoriel/tutoriel.png';
            }
            $ars->push([
                "id" => $data->id,
                "img" => $img,
                "category" => $data->category->name . ' - ' . $data->subcategory->name,
                "title" => $data->title,
                "published" => $data->published,
                "published_at" => $published_at,
                "count" => TutorielHelper::countCommentFromTutoriel($data->id)
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des Tutoriels");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "category_id" => "required",
            "subcategory_id" => "required",
            "short_content" => "required|min:2"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            $tutoriel = $this->tutorielRepository->create($request);

            return $this->sendResponse($tutoriel, "Création d'un tutoriel");
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editBackground(Request $request, $tutoriel_id)
    {
        $data = $this->tutorielRepository->get($tutoriel_id);
        $file = $request->file('file');
        $path = 'tutoriel/' . $tutoriel_id . '/';
        if (Storage::disk('public')->exists($path . 'background.png') == true) {
            try {
                Storage::disk('public')->delete($path . 'background.png');
                try {
                    $file->storeAs($path, 'background.png', 'public');
                    try {
                        Storage::disk('public')->setVisibility($path . 'background.png', 'public');

                        return $this->sendResponse(null, null);
                    } catch (FileException $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "errors" => $exception->getMessage()
                        ]);
                    }
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage()
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage()
                ]);
            }
        } else {
            try {
                $file->storeAs($path, 'background.png', 'public');
                try {
                    Storage::disk('public')->setVisibility($path . 'background.png', 'public');

                    return $this->sendResponse(null, null);
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage()
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }
    }

    public function editBanner(Request $request, $tutoriel_id)
    {
        $data = $this->tutorielRepository->get($tutoriel_id);
        $file = $request->file('file');
        $path = 'tutoriel/' . $tutoriel_id . '/';
        if (Storage::disk('public')->exists($path . 'banner.png') == true) {
            try {
                Storage::disk('public')->delete($path . 'banner.png');
                try {
                    $file->storeAs($path, 'banner.png', 'public');
                    try {
                        Storage::disk('public')->setVisibility($path . 'banner.png', 'public');

                        return $this->sendResponse(null, null);
                    } catch (FileException $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "errors" => $exception->getMessage()
                        ]);
                    }
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage()
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage()
                ]);
            }
        } else {
            try {
                $file->storeAs($path, 'banner.png', 'public');
                try {
                    Storage::disk('public')->setVisibility($path . 'banner.png', 'public');

                    return $this->sendResponse(null, null);
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage()
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }
    }

    public function editDescription(Request $request, $tutoriel_id)
    {
        try {
            $this->tutorielRepository->updateDescription($tutoriel_id, $request->contents);

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editInfo(Request $request, $tutoriel_id)
    {
        //dd($request->all());
        if ($request->exists('published') == true) {
            if ($request->published_at >= now()->addMinutes(3)) {
                $published = 2;
                $published_at = $request->published_at;
            } else {
                $published = 1;
                $published_at = now();
            }
        } else {
            $published = 0;
            $published_at = null;
        }
        if ($request->exists('source') == true) {
            $source = 1;
        } else {
            $source = 0;
        }
        if ($request->exists('premium') == true) {
            $premium = 1;
        } else {
            $premium = 0;
        }
        if ($request->exists('demo') == true) {
            $demo = 1;
        } else {
            $demo = 0;
        }

        try {
            $this->tutorielRepository->updateInfo(
                $tutoriel_id,
                $request->title,
                $request->short_content,
                $published,
                $source,
                $premium,
                $published_at,
                $demo,
                $request->linkDemo
            );

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
