<?php

namespace App\Http\Controllers\Api\Admin;

use App\HelpersClass\Blog\BlogHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCommentRepository;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends BaseController
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
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     * @param BlogCommentRepository $blogCommentRepository
     */
    public function __construct(BlogRepository $blogRepository, BlogCommentRepository $blogCommentRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
    }

    public function loadLatest()
    {
        $datas = $this->blogRepository->listForLimit(5);
        ob_start();
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Etat</th>
                    <th>Twitter</th>
                    <th>Nb commentaires</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datas as $data): ?>
                <tr>
                    <td class="text-center"><?= $data->id; ?></td>
                    <td><?= $data->title; ?></td>
                    <td class="text-center"><i class="la la-circle la-2x <?= BlogHelper::publishArticle($data->published); ?>"></i> </td>
                    <td class="text-center">
                        <?php if($data->twitter == 1): ?>
                        <i class="la la-twitter-square la-2x kt-font-primary"></i>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= BlogHelper::countCommentWithArticle($data->id); ?></td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm btn-icon btn-outline-brand"><i class="la la-eye"></i> </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Derniers article");
    }

    public function loadCommentLatest()
    {
        $datas = $this->blogCommentRepository->all(5);
        ob_start();
        ?>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Etat</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($datas as $data): ?>
                <tr>
                    <td class="text-center"><?= $data->id; ?></td>
                    <td>
                        <strong><?= $data->blog->title ?></strong><br>
                        <i>Commentaire: N° <?= $data->id; ?></i>
                    </td>
                    <td class="text-center"><i class="la la-circle la-2x <?= BlogHelper::publishArticle($data->state); ?>"></i> </td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm btn-icon btn-outline-brand"><i class="la la-eye"></i> </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Derniers Commentaire");
    }
}
