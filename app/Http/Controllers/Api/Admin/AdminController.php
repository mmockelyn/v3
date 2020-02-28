<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Account\InvoiceRepository;
use App\Repository\Asset\AssetRepository;
use App\Repository\Blog\BlogCommentRepository;
use App\Repository\Blog\BlogRepository;
use App\Repository\Tutoriel\TutorielCommentRepository;
use App\Repository\Tutoriel\TutorielRepository;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends BaseController
{
    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;
    /**
     * @var AssetRepository
     */
    private $assetRepository;
    /**
     * @var BlogRepository
     */
    private $blogRepository;
    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;
    /**
     * @var TutorielCommentRepository
     */
    private $tutorielCommentRepository;

    /**
     * AdminController constructor.
     * @param InvoiceRepository $invoiceRepository
     * @param AssetRepository $assetRepository
     * @param BlogRepository $blogRepository
     * @param BlogCommentRepository $blogCommentRepository
     * @param TutorielRepository $tutorielRepository
     * @param TutorielCommentRepository $tutorielCommentRepository
     */
    public function __construct(
        InvoiceRepository $invoiceRepository,
        AssetRepository $assetRepository,
        BlogRepository $blogRepository,
        BlogCommentRepository $blogCommentRepository,
        TutorielRepository $tutorielRepository, TutorielCommentRepository $tutorielCommentRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->assetRepository = $assetRepository;
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
        $this->tutorielRepository = $tutorielRepository;
        $this->tutorielCommentRepository = $tutorielCommentRepository;
    }

    public function loadSignalement()
    {
        ob_start();
        ?>
        <?= $this->signAsset(); ?>
        <?= $this->signBlog(); ?>
        <?= $this->signBlogComment(); ?>
        <?= $this->signTutoriel(); ?>
        <?= $this->signTutorielComment(); ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Contenue");
    }

    private function signAsset()
    {
        $datas = $this->assetRepository->allWithLimit(null);
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
            <?php if($data->downloadLink == null): ?>
            <tr class="table-warning">
                <td>Objet</td>
                <td><?= $data->designation; ?></td>
                <td>Cette objet n'à pas de lien de téléchargement</td>
                <td class="text-right">
                    <a href=""><i class="la la-eye"></i> </a>
                </td>
            </tr>
            <?php endif; ?>
        <?php if($data->published == 0): ?>
            <tr class="table-warning">
                <td>Objet</td>
                <td><?= $data->designation; ?></td>
                <td>Cette objet n'est pas publier</td>
                <td class="text-right">
                    <a href=""><i class="la la-eye"></i> </a>
                </td>
            </tr>
        <?php endif; ?>
        <?php if($data->pricing == 1 && $data->price == null): ?>
            <tr class="table-danger">
                <td>Objet</td>
                <td><?= $data->designation; ?></td>
                <td>Cette objet à activer le prix mais le prix est innexistant !</td>
                <td class="text-right">
                    <a href=""><i class="la la-eye"></i> </a>
                </td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $content;
    }

    private function signBlog() {
        $datas = $this->blogRepository->list();
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
            <?php if($data->twitter == 1 && $data->twitterText == null): ?>
                <tr class="table-warning">
                    <td>Blog</td>
                    <td><?= $data->title; ?></td>
                    <td>Cette article doit être poster sur twitter mais n'à aucun texte de définie</td>
                    <td class="text-right">
                        <a href=""><i class="la la-eye"></i> </a>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if(count($data->tags) == 0): ?>
                <tr class="table-info">
                    <td>Blog</td>
                    <td><?= $data->title; ?></td>
                    <td>Cette article n'à aucun tags de définie</td>
                    <td class="text-right">
                        <a href=""><i class="la la-eye"></i> </a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $content;
    }

    private function signBlogComment() {
        $datas = $this->blogCommentRepository->all();
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
            <?php if($data->state == 0): ?>
                <tr class="table-danger">
                    <td>Commentaire / Blog</td>
                    <td><?= $data->blog->title; ?><br>
                        <i>Commentaire: <?= $data->id; ?></i>
                    </td>
                    <td>Ce commentaire n'est pas poster</td>
                    <td class="text-right">
                        <a href=""><i class="la la-eye"></i> </a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $content;
    }

    private function signTutoriel()
    {
        $datas = $this->tutorielRepository->all();
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
        <?php if($data->published == 0): ?>
            <tr class="table-warning">
                <td>Tutoriel</td>
                <td><?= $data->title; ?></td>
                <td>Ce tutoriel n'est pas publier</td>
                <td class="text-right">
                    <a href=""><i class="la la-eye"></i> </a>
                </td>
            </tr>
        <?php endif; ?>
        <?php if($data->pathVideo == null): ?>
            <tr class="table-warning">
                <td>Tutoriel</td>
                <td><?= $data->title; ?></td>
                <td>Ce tutoriel n'à pas de lien vidéo</td>
                <td class="text-right">
                    <a href=""><i class="la la-eye"></i> </a>
                </td>
            </tr>
        <?php endif; ?>
        <?php if($data->source == 1 && Storage::disk('sftp')->exists('video/tutoriel/'.$data->id.'/source.zip') == false): ?>
            <tr class="table-danger">
                <td>Tutoriel</td>
                <td><?= $data->title; ?></td>
                <td>Ce tutoriel n'à pas de source disponible</td>
                <td class="text-right">
                    <a href=""><i class="la la-eye"></i> </a>
                </td>
            </tr>
        <?php endif; ?>
        <?php if($data->demo == 1 && $data->linkDemo == null): ?>
            <tr class="table-danger">
                <td>Tutoriel</td>
                <td><?= $data->title; ?></td>
                <td>Ce tutoriel n'à pas de lien de démo disponible</td>
                <td class="text-right">
                    <a href=""><i class="la la-eye"></i> </a>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $content;
    }

    private function signTutorielComment() {
        $datas = $this->tutorielCommentRepository->all();
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
            <?php if($data->published == 0): ?>
                <tr class="table-danger">
                    <td>Commentaire / Tutoriel</td>
                    <td><?= $data->tutoriel->title; ?><br>
                        <i>Commentaire: <?= $data->id; ?></i>
                    </td>
                    <td>Ce commentaire n'est pas poster</td>
                    <td class="text-right">
                        <a href=""><i class="la la-eye"></i> </a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $content;
    }
}
