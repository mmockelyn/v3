<?php

namespace App\Http\Controllers\Api\Admin\Wiki;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Wiki\WikiArticleContentRepository;
use App\Repository\Wiki\WikiArticleSommaireRepository;
use App\Repository\Wiki\WikiRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WikiArticleController extends BaseController
{
    /**
     * @var WikiRepository
     */
    private $wikiRepository;
    /**
     * @var Datatable
     */
    private $datatable;
    /**
     * @var WikiArticleSommaireRepository
     */
    private $articleSommaireRepository;
    /**
     * @var WikiArticleContentRepository
     */
    private $articleContentRepository;

    /**
     * WikiArticleController constructor.
     * @param WikiRepository $wikiRepository
     * @param Datatable $datatable
     * @param WikiArticleSommaireRepository $articleSommaireRepository
     * @param WikiArticleContentRepository $articleContentRepository
     */
    public function __construct(WikiRepository $wikiRepository, Datatable $datatable, WikiArticleSommaireRepository $articleSommaireRepository, WikiArticleContentRepository $articleContentRepository)
    {
        $this->wikiRepository = $wikiRepository;
        $this->datatable = $datatable;
        $this->articleSommaireRepository = $articleSommaireRepository;
        $this->articleContentRepository = $articleContentRepository;
    }

    public function latest(Request $request)
    {
        $datas = $this->wikiRepository->allWL(5);
        $ars = collect();

        foreach ($datas as $data) {

            if (Storage::disk('public')->exists('wiki/' . $data->id . '.png') == true) {
                $img = 'storage/wiki/' . $data->id . '.png';
            } else {
                $img = 'storage/wiki/wiki.png';
            }

            $ars->push([
                "id" => $data->id,
                "category" => $data->category->name . ' - ' . $data->subcategory->name,
                "title" => $data->title,
                "published" => $data->published,
                "img" => $img
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des articles");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function list(Request $request)
    {
        $datas = $this->wikiRepository->allWL();
        $ars = collect();

        foreach ($datas as $data) {

            if (Storage::disk('public')->exists('wiki/' . $data->id . '.png') == true) {
                $img = 'storage/wiki/' . $data->id . '.png';
            } else {
                $img = 'storage/wiki/wiki.png';
            }

            $ars->push([
                "id" => $data->id,
                "category" => $data->category->name . ' - ' . $data->subcategory->name,
                "title" => $data->title,
                "published" => $data->published,
                "img" => $img
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des articles");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de Validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }

        try {
            $this->wikiRepository->store(
                $request->category_id,
                $request->subcategory_id,
                $request->title
            );

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editInfo(Request $request, $article_id)
    {
        if ($request->exists('published') == true) {
            $published = 1;
        } else {
            $published = 0;
        }
        if ($request->exists('published') == true) {
            $published_at = now();
        } else {
            $published_at = null;
        }

        try {
            $this->wikiRepository->updateInfo(
                $article_id,
                $request->title,
                $published,
                $published_at
            );

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function addContent(Request $request, $article_id)
    {
        try {
            $sommaire = $this->articleSommaireRepository->create($article_id, $request->title);
            try {
                $content = $this->articleContentRepository->create($article_id, $sommaire->id, $request->contents);
                return $this->sendResponse(null, null);
            } catch (Exception $exception) {
                return $this->sendError("Erreur Système", [
                    "errors" => $exception->getMessage()
                ]);
            }
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function publish($article_id)
    {
        try {
            $this->wikiRepository->publish($article_id);
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError(null, null);
        }
    }

    public function unpublish($article_id)
    {
        try {
            $this->wikiRepository->unpublish($article_id);
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError(null, null);
        }
    }
}
