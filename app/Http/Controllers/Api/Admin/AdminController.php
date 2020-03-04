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

    public function loadSignalement(Request $request)
    {
        $arrs = collect();
        $assets = $this->assetRepository->allWithLimit(null);
        foreach ($assets as $asset) {
            if ($asset->downloadLink == null) {
                $arrs->push([
                    "state" => 'warning',
                    "sector" => "Objets",
                    "titre" => $asset->designation,
                    "message" => "Cette objet n'à pas de lien de téléchargement",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ]
                ]);
            }
            if ($asset->published == 0) {
                $arrs->push([
                    "state" => 'warning',
                    "sector" => "Objets",
                    "titre" => $asset->designation,
                    "message" => "Cette objet n'est pas publier",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ], [
                        "btn" => "publish",
                        "route" => ""
                    ]
                ]);
            }
            if($asset->pricing == 1 && $asset->price == null) {
                $arrs->push([
                    "state" => 'danger',
                    "sector" => "Objets",
                    "titre" => $asset->designation,
                    "message" => "Cette objet à activer le prix mais le prix est innexistant !",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ]
                ]);
            }
        }

        $blogs = $this->blogRepository->list();
        foreach ($blogs as $blog) {
            if($blog->twitter == 1 && $blog->twitterText == null) {
                $arrs->push([
                    "state" => 'warning',
                    "sector" => "Blog",
                    "titre" => $blog->title,
                    "message" => "Cette article doit être poster sur twitter mais n'à aucun texte de définie",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ]
                ]);
            }
            if(count($blog->tags) == 0) {
                $arrs->push([
                    "state" => 'info',
                    "sector" => "Blog",
                    "titre" => $blog->title,
                    "message" => "Cette article n'à aucun tags de définie",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ]
                ]);
            }
        }

        $blogComments = $this->blogCommentRepository->all();
        foreach ($blogComments as $comment) {
            if($comment->state == 0) {
                $arrs->push([
                    "state" => 'danger',
                    "sector" => "Blog | Commentaire",
                    "titre" => $comment->blog->title."<br><i>Commentaire N°".$comment->id."</i>",
                    "message" => "Ce commentaire n'est pas poster",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ],
                    [
                        "btn" => "publish",
                        "route" => ""
                    ]
                ]);
            }
        }

        $tutoriels = $this->tutorielRepository->all();
        foreach ($tutoriels as $tutoriel) {
            if($tutoriel->published == 0) {
                $arrs->push([
                    "state" => 'warning',
                    "sector" => "Tutoriel",
                    "titre" => $tutoriel->title,
                    "message" => "Ce tutoriel n'est pas publier",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ],
                    [
                        "btn" => "publish",
                        "route" => ""
                    ]
                ]);
            }
            if($tutoriel->pathVideo == null) {
                $arrs->push([
                    "state" => 'warning',
                    "sector" => "Tutoriel",
                    "titre" => $tutoriel->title,
                    "message" => "Ce tutoriel n'à pas de lien vidéo",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ]
                ]);
            }
            if($tutoriel->source == 1 && Storage::disk('sftp')->exists('video/tutoriel'.$tutoriel->id.'/source.zip') == false) {
                $arrs->push([
                    "state" => 'danger',
                    "sector" => "Tutoriel",
                    "titre" => $tutoriel->title,
                    "message" => "Ce tutoriel n'à pas de source disponible",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ]
                ]);
            }
            if($tutoriel->demo == 1 && $tutoriel->linkDemo == null) {
                $arrs->push([
                    "state" => 'danger',
                    "sector" => "Tutoriel",
                    "titre" => $tutoriel->title,
                    "message" => "Ce tutoriel n'à pas de lien de démo disponible",
                    "action" => [
                        "btn" => "view",
                        "route" => ""
                    ]
                ]);
            }
        }

        return $this->sendResponse($arrs, "Contenue");
    }
}
