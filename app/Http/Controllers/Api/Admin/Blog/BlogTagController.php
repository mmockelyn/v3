<?php

namespace App\Http\Controllers\Api\Admin\Blog;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogTagRepository;
use Illuminate\Http\Request;

class BlogTagController extends BaseController
{
    /**
     * @var BlogTagRepository
     */
    private $blogTagRepository;

    /**
     * BlogTagController constructor.
     * @param BlogTagRepository $blogTagRepository
     */
    public function __construct(BlogTagRepository $blogTagRepository)
    {
        $this->blogTagRepository = $blogTagRepository;
    }

    public function store(Request $request, $article_id)
    {
        $tags = json_decode($request->tags);
        $validator = \Validator::make($request->all(), [
            "tags" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreru de validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            foreach ($tags as $tag) {
                $this->blogTagRepository->create($article_id, $tag->value);
            }

            return $this->sendResponse("ok", "ok");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function load($article_id)
    {
        $datas = $this->blogTagRepository->allFromArticle($article_id);

        return $this->sendResponse($datas->toArray(), "Liste Tags");
    }

    public function delete($article_id, $tag_id)
    {
        try {
            $this->blogTagRepository->delete($tag_id);

            toastr()->success("Tag supprimer", "Succès");
            return redirect()->back();
        } catch (\Exception $exception) {
            toastr()->error("Erreur lors de la suppression du tag", "Erreur Système");
            return redirect()->back();
        }
    }
}
