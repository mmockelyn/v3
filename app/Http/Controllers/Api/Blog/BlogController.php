<?php

namespace App\Http\Controllers\Api\Blog;

use App\HelpersClass\Blog\BlogHelper;
use App\HelpersClass\Generator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function latest()
    {
        $datas = $this->blogRepository->allWithLimit(3);
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
        <div class="col-md-4">
            <div class="kt-portlet kt-portlet--height-fluid kt-widget19" id="portletsBlog" data-slug="<?= $data->slug; ?>">
                <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                    <?php if(file_exists('/storage/blog/'.$data->id.'.png')): ?>
                    <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url(/storage/blog/<?= $data->id ?>.png)">
                    <?php else: ?>
                    <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url(/storage/blog/news.png)">
                    <?php endif; ?>
                        <h3 class="kt-widget19__title kt-font-light">
                            <?= $data->title; ?>
                        </h3>
                        <div class="kt-widget19__shadow"></div>
                        <div class="kt-widget19__labels">
                            <a href="<?= route('Front.Blog.show', $data->slug) ?>" class="btn btn-label-light-o2 btn-bold "><?= $data->category->name; ?></a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget19__wrapper">
                        <div class="kt-widget19__content">
                            <div class="kt-widget19__info">
                                <a href="<?= route('Front.Blog.show', $data->slug) ?>" class="kt-widget19__username">
                                    Publié le <?= $data->published_at->format('d/m/Y à H:i') ?>
                                </a>
                            </div>
                            <div class="kt-widget19__stats">
														<span class="kt-widget19__number kt-font-brand">
															<?= BlogHelper::countCommentWithArticle($data->id); ?>
														</span>
                                <a href="#" class="kt-widget19__comment">
                                    <?= Generator::formatPlural('Commentaire', BlogHelper::countCommentWithArticle($data->id)); ?>
                                </a>
                            </div>
                        </div>
                        <div class="kt-widget19__text">
                            <?= $data->short_content; ?>
                        </div>
                    </div>
                    <div class="kt-widget19__action">
                        <a href="<?= route('Front.Blog.show', $data->slug) ?>" class="btn btn-sm btn-label-brand btn-bold">En savoir plus...</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Dernières Nouvelle");
    }
}
