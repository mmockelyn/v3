<?php

namespace App\Http\Controllers\Api\Admin;

use App\HelpersClass\Tutoriel\TutorielHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Tutoriel\TutorielRepository;
use Illuminate\Http\Request;

class TutorielController extends BaseController
{
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;

    /**
     * TutorielController constructor.
     * @param TutorielRepository $tutorielRepository
     */
    public function __construct(TutorielRepository $tutorielRepository)
    {
        $this->tutorielRepository = $tutorielRepository;
    }

    public function loadLatest()
    {
        $datas = $this->tutorielRepository->allWL(5);
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
                    <td class="text-center"><i class="la la-circle <?= TutorielHelper::stateTutoriel($data->published); ?>"></i> </td>
                    <td class="text-center">
                        <?php if($data->twitter == 1): ?>
                            <i class="la la-twitter-square kt-font-primary"></i>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= TutorielHelper::countCommentFromTutoriel($data->id); ?></td>
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
}
