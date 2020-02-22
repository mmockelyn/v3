<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogApiController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * BlogApiController constructor.
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
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
                    <?php if(file_exists('/storage/blog/'.$data->id.'.png')): ?>
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
}
