<?php

namespace App\Http\Controllers\Api\Admin\Tutoriel;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Tutoriel\TutorielCommentRepository;
use Illuminate\Http\Request;

class TutorielCommentController extends BaseController
{
    /**
     * @var TutorielCommentRepository
     */
    private $tutorielCommentRepository;

    /**
     * TutorielCommentController constructor.
     * @param TutorielCommentRepository $tutorielCommentRepository
     */
    public function __construct(TutorielCommentRepository $tutorielCommentRepository)
    {
        $this->tutorielCommentRepository = $tutorielCommentRepository;
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
}
