<?php

namespace App\Http\Controllers\Api\Admin\Tutoriel;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Tutoriel\TutorielCommentRepository;
use Illuminate\Http\Request;

class TutorielCommentController extends BaseController
{
    /**
     * @var TutorielCommentRepository
     */
    private $tutorielCommentRepository;
    /**
     * @var Datatable
     */
    private $datatable;

    /**
     * TutorielCommentController constructor.
     * @param TutorielCommentRepository $tutorielCommentRepository
     * @param Datatable $datatable
     */
    public function __construct(TutorielCommentRepository $tutorielCommentRepository, Datatable $datatable)
    {
        $this->tutorielCommentRepository = $tutorielCommentRepository;
        $this->datatable = $datatable;
    }

    public function latest()
    {
        $datas = $this->tutorielCommentRepository->all();
        ob_start();
        ?>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Tutoriel</th>
                <th>Etat</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($datas as $data): ?>
                <tr>
                    <td>
                        <?= $data->tutoriel->title; ?><br>
                        Commentaire N°<strong><?= $data->id; ?></strong> - <?= $data->user->name; ?>
                    </td>
                    <td>
                        <?php if ($data->published == 0): ?>
                            <i class="fa fa-circle kt-font-danger"></i>
                        <?php else: ?>
                            <i class="fa fa-circle kt-font-success"></i>
                        <?php endif; ?>
                    </td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Liste des commentaires");
    }

    public function listeComments(Request $request, $tutoriel_id)
    {
        $comments = $this->tutorielCommentRepository->all($tutoriel_id);
        $ars = collect();
        foreach ($comments as $comment) {
            $ars->push([
                "id" => $comment->id,
                "user" => $comment->user->name,
                "content" => $comment->content,
                "published" => $comment->published,
                "published_at" => $comment->published_at
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des Tutoriels");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }
}
