<?php

namespace App\Http\Controllers\Api\Admin\Blog;

use App\Http\Controllers\Api\BaseController;
use App\Repository\Blog\BlogTagRepository;
use Exception;
use Illuminate\Http\Request;
use Validator;

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
        $validator = Validator::make($request->all(), [
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
        } catch (Exception $exception) {
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

            return redirect()->back()->with('success', "Tag Supprimer");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression du tag");
        }
    }
}
