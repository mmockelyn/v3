<?php

namespace App\Http\Controllers\Api\Admin\Tutoriel;

use App\HelpersClass\Account\AccountHelper;
use App\HelpersClass\Core\Datatable;
use App\HelpersClass\Tutoriel\TutorielHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Jobs\Tutoriel\PublishLaterJob;
use App\Notifications\Tutoriel\TutorielPublish;
use App\Repository\Tutoriel\TutorielRepository;
use App\Repository\Tutoriel\TutorielRequisRepository;
use App\Repository\Tutoriel\TutorielTagRepository;
use App\Repository\Tutoriel\TutorielTechnologieRepository;
use Carbon\Carbon;
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
     * @var TutorielTagRepository
     */
    private $tutorielTagRepository;
    /**
     * @var TutorielTechnologieRepository
     */
    private $tutorielTechnologieRepository;
    /**
     * @var TutorielRequisRepository
     */
    private $tutorielRequisRepository;

    /**
     * TutorielVideoController constructor.
     * @param TutorielRepository $tutorielRepository
     * @param Datatable $datatable
     * @param TutorielTagRepository $tutorielTagRepository
     * @param TutorielTechnologieRepository $tutorielTechnologieRepository
     * @param TutorielRequisRepository $tutorielRequisRepository
     */
    public function __construct(
        TutorielRepository $tutorielRepository,
        Datatable $datatable,
        TutorielTagRepository $tutorielTagRepository,
        TutorielTechnologieRepository $tutorielTechnologieRepository,
        TutorielRequisRepository $tutorielRequisRepository)
    {
        $this->tutorielRepository = $tutorielRepository;
        $this->datatable = $datatable;
        $this->tutorielTagRepository = $tutorielTagRepository;
        $this->tutorielTechnologieRepository = $tutorielTechnologieRepository;
        $this->tutorielRequisRepository = $tutorielRequisRepository;
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

    public function publishLater(Request $request, $tutoriel_id)
    {
        try {
            $this->tutorielRepository->publishLater($tutoriel_id, $request->published_at);
            dispatch(new PublishLaterJob($tutoriel_id))->delay(Carbon::createFromTimestamp(strtotime($request->published_at)));

            return $this->sendResponse([
                "day" => Carbon::createFromTimestamp(strtotime($request->published_at))->format("d/m/Y"),
                "hour" => Carbon::createFromTimestamp(strtotime($request->published_at))->format('H:i')
            ], null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function publish($tutoriel_id)
    {
        $tutoriel = $this->tutorielRepository->get($tutoriel_id);
        try {
            $this->tutorielRepository->publish($tutoriel_id);
            $tutoriel->notify(new TutorielPublish($tutoriel));
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function unpublish($tutoriel_id)
    {
        try {
            $this->tutorielRepository->unpublish($tutoriel_id);
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function publishVideo(Request $request, $tutoriel_id)
    {
        $file = $request->file('file');
        $path = 'tutoriel/' . $tutoriel_id . '/';

        if (Storage::disk('sftp')->exists($path . 'video.mp4') == true) {
            try {
                Storage::disk('sftp')->delete($path . 'video.mp4');
                try {
                    $file->storeAs($path, 'video.mp4', 'sftp');
                    try {
                        Storage::disk('sftp')->setVisibility($path . 'video.mp4', 'public');
                        return $this->sendResponse(null, null);
                    } catch (Exception $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "errors" => $exception->getMessage(),
                            "lines" => $exception->getLine(),
                            "stack" => $exception->getTraceAsString()
                        ]);
                    }
                } catch (Exception $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage(),
                        "lines" => $exception->getLine(),
                        "stack" => $exception->getTraceAsString()
                    ]);
                }
            } catch (Exception $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage(),
                    "lines" => $exception->getLine(),
                    "stack" => $exception->getTraceAsString()
                ]);
            }
        } else {
            try {
                $file->storeAs($path, 'video.mp4', 'sftp');
                try {
                    Storage::disk('sftp')->setVisibility($path . 'video.mp4', 'public');
                    return $this->sendResponse(null, null);
                } catch (Exception $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage(),
                        "lines" => $exception->getLine(),
                        "stack" => $exception->getTraceAsString()
                    ]);
                }
            } catch (Exception $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage(),
                    "lines" => $exception->getLine(),
                    "stack" => $exception->getTraceAsString()
                ]);
            }

        }
    }

    public function publishSource(Request $request, $tutoriel_id)
    {
        $file = $request->file('file');
        $path = 'tutoriel/' . $tutoriel_id . '/';

        if (Storage::disk('sftp')->exists($path . 'source.zip') == true) {
            try {
                Storage::disk('sftp')->delete($path . 'source.zip');
                try {
                    $file->storeAs($path, 'source.zip', 'sftp');
                    try {
                        Storage::disk('sftp')->setVisibility($path . 'source.zip', 'public');
                        return $this->sendResponse(null, null);
                    } catch (Exception $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "errors" => $exception->getMessage(),
                            "lines" => $exception->getLine(),
                            "stack" => $exception->getTraceAsString()
                        ]);
                    }
                } catch (Exception $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage(),
                        "lines" => $exception->getLine(),
                        "stack" => $exception->getTraceAsString()
                    ]);
                }
            } catch (Exception $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage(),
                    "lines" => $exception->getLine(),
                    "stack" => $exception->getTraceAsString()
                ]);
            }
        } else {
            try {
                $file->storeAs($path, 'source.zip', 'sftp');
                try {
                    Storage::disk('sftp')->setVisibility($path . 'source.zip', 'public');
                    return $this->sendResponse(null, null);
                } catch (Exception $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage(),
                        "lines" => $exception->getLine(),
                        "stack" => $exception->getTraceAsString()
                    ]);
                }
            } catch (Exception $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage(),
                    "lines" => $exception->getLine(),
                    "stack" => $exception->getTraceAsString()
                ]);
            }

        }
    }

    public function listeTags(Request $request, $tutoriel_id)
    {
        $tags = $this->tutorielTagRepository->allFromTutoriel($tutoriel_id);
        $ars = collect();

        foreach ($tags as $tag) {
            $ars->push([
                "id" => $tag->id,
                "name" => $tag->name
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des Tags");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function listeTechno(Request $request, $tutoriel_id)
    {
        $tags = $this->tutorielTechnologieRepository->allFromTutoriel($tutoriel_id);
        $ars = collect();

        foreach ($tags as $tag) {
            $ars->push([
                "id" => $tag->id,
                "name" => $tag->name
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des Tags");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function listeRequis(Request $request, $tutoriel_id)
    {
        $tags = $this->tutorielRequisRepository->allFromTutoriel($tutoriel_id);
        $ars = collect();

        foreach ($tags as $tag) {
            $ars->push([
                "id" => $tag->id,
                "requis" => $tag->requis
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des Tags");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function storeTag(Request $request, $tutoriel_id)
    {
        $tags = json_decode($request->tags);
        try {
            foreach ($tags as $tag) {
                $this->tutorielTagRepository->create($tutoriel_id, $tag->value);
            }

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteTag($tutoriel_id, $tag_id)
    {
        try {
            $this->tutorielTagRepository->delete($tag_id);

            return redirect()->back();
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function storeTechno(Request $request, $tutoriel_id)
    {
        $tags = json_decode($request->techno);
        try {
            foreach ($tags as $tag) {
                $this->tutorielTechnologieRepository->create($tutoriel_id, $tag->value);
            }

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteTechno($tutoriel_id, $tag_id)
    {
        try {
            $this->tutorielTechnologieRepository->delete($tag_id);

            return redirect()->back();
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function storeRequis(Request $request, $tutoriel_id)
    {
        $tags = json_decode($request->requis);
        try {
            foreach ($tags as $tag) {
                $this->tutorielRequisRepository->create($tutoriel_id, $tag->value);
            }

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteRequis($tutoriel_id, $tag_id)
    {
        try {
            $this->tutorielRequisRepository->delete($tag_id);

            return redirect()->back();
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
