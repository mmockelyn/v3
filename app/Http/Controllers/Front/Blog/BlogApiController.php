<?php

namespace App\Http\Controllers\Front\Blog;

use App\HelpersClass\Blog\BlogHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Notifications\Blog\PostNewComment;
use App\Notifications\Blog\PostNewCommentOther;
use App\Repository\Blog\BlogCommentRepository;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogApiController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;
    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;

    /**
     * BlogApiController constructor.
     * @param BlogRepository $blogRepository
     * @param BlogCommentRepository $blogCommentRepository
     */
    public function __construct(BlogRepository $blogRepository, BlogCommentRepository $blogCommentRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
    }

    public function loadCarousel()
    {
        $datas = $this->blogRepository->allWithLimit(5);
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
        <div>
            <div class="card animate">
                <a href="<?= route('Front.Blog.show', $data->slug) ?>">
                    <?php if (file_exists('/storage/blog/' . $data->id . '.png')): ?>
                        <img src="/storage/blog/<?= $data->id ?>.png" class="card-img-top" alt="...">
                    <?php else: ?>
                        <img src="/storage/blog/news.png" class="card-img-top" alt="...">
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="card-title"><?= $data->title; ?></h3>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Affichage du carousel");
    }

    public function loadNews()
    {
        $datas = $this->blogRepository->allWithPublish();
        ob_start();
        ?>
        <?php if(count($datas) == 0): ?>

        <?php else: ?>
            <?php foreach ($datas as $data): ?>
            <div class="tz-blog__lists">
                <a class="card mb-3" href="<?= route('Front.Blog.show', $data->slug) ?>">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <?php if(file_exists('/storage/blog/'.$data->id.'.png')): ?>
                                <img src="/storage/blog/<?= $data->id; ?>.png" class="card-img" alt="...">
                            <?php else: ?>
                                <img src="/storage/blog/news.png" class="card-img" alt="...">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data->title; ?></h5>
                                <p class="card-text"><?= $data->short_content; ?></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="card-text"><small class="text-muted"><i class="la la-calendar"></i>  Posté <?= $data->published_at->diffForHumans(); ?></small> </p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p class="card-text text-muted"><i class="la la-comments"></i> <?= BlogHelper::countCommentWithArticle($data->id) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Liste des news");
    }

    public function postComment($blog_id, Request $request)
    {
        $validator = \Validator::make($request->all(), [
            "comment" => "required|min:5"
        ]);

        if($validator->fails()){
            return $this->sendError("Erreur Validation", ["errors" => $validator->errors()->all()], 203);
        }

        try {
            $data = $this->blogCommentRepository->create($blog_id, auth()->user()->id, $request->comment);
            $blog = $this->blogRepository->get($blog_id);

            auth()->user()->notify(new PostNewComment($blog));
            foreach ($blog->comments as $comment) {
                $comment->user->notify(new PostNewCommentOther($blog));
            }
            return $this->sendResponse($data, "Post d'un commentaire");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteComment(Request $request, $blog_id, $comment_id)
    {
        try {
            $this->blogCommentRepository->delete($comment_id);

            return $this->sendResponse("Done", "Suppression du commentaire");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur de suppression d'un commentaire", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
