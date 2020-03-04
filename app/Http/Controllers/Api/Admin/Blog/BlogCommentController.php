<?php

namespace App\Http\Controllers\Api\Admin\Blog;

use App\HelpersClass\Generator;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Blog\BlogCommentRepository;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class BlogCommentController extends BaseController
{
    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;

    /**
     * BlogCommentController constructor.
     * @param BlogCommentRepository $blogCommentRepository
     */
    public function __construct(BlogCommentRepository $blogCommentRepository)
    {
        $this->blogCommentRepository = $blogCommentRepository;
    }

    public function loadComments($article_id)
    {
        $datas = $this->blogCommentRepository->allFromArticle($article_id);

        $arr = [];
        foreach ($datas as $data) {
            if (Gravatar::exists($data->user->email) == true) {
                $img = '<a class="kt-media kt-media--circle"><img src="' . Gravatar::src($data->user->email) . '"></a>';
            } else {
                $img = '<a href="#" class="kt-media kt-media--circle kt-media--info">
                            <span>' . Generator::firsLetter($data->user->name, 2) . '</span>
                        </a>';
            }

            $arr[] = [
                "id" => $data->id,
                "user" => [
                    "name" => $data->user->name,
                    "email" => $data->user->email
                ],
                "comment" => $data->comment,
                "state" => $data->state,
                "updated_at" => $data->updated_at->format('d/m/Y à H:i'),
                "img" => $img
            ];
        }

        return $this->sendResponse($arr, "ARR");
    }

    public function publish($article_id, $comment_id)
    {
        try {
            $this->blogCommentRepository->publish($comment_id);
            return redirect()->back()->with('success', "Le commentaire à été publier");
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la publication du commentaire");
        }
    }

    public function unpublish($article_id, $comment_id)
    {
        try {
            $this->blogCommentRepository->unpublish($comment_id);
            return redirect()->back()->with('success', "Le commentaire à été dépublier");
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la dépublication du commentaire");
        }
    }


}
