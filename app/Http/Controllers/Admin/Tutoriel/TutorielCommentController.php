<?php

namespace App\Http\Controllers\Admin\Tutoriel;

use App\Http\Controllers\Controller;
use App\Repository\Tutoriel\TutorielCommentRepository;
use Exception;
use Illuminate\Http\Request;

class TutorielCommentController extends Controller
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

    public function publish($tutoriel_id, $comment_id)
    {
        try {
            $this->tutorielCommentRepository->publish($comment_id);

            return redirect()->back()->with("success", "Le commentaire à été publier");
        } catch (Exception $exception) {
            return redirect()->back()->with("error", "Erreur lors de la publication du commentaire");
        }
    }

    public function unpublish($tutoriel_id, $comment_id)
    {
        try {
            $this->tutorielCommentRepository->unpublish($comment_id);

            return redirect()->back()->with("success", "Le commentaire à été dépublier");
        } catch (Exception $exception) {
            return redirect()->back()->with("error", "Erreur lors de la dépublication du commentaire");
        }
    }
}
