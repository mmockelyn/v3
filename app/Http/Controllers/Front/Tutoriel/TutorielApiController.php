<?php

namespace App\Http\Controllers\Front\Tutoriel;

use App\HelpersClass\Account\AccountActivityHelper;
use App\Http\Controllers\Api\BaseController;
use App\Notifications\Tutoriel\PostNewCommentOtherTutoriel;
use App\Notifications\Tutoriel\PostNewCommentTutoriel;
use App\Repository\Account\UserViewRepository;
use App\Repository\Tutoriel\TutorielCommentRepository;
use App\Repository\Tutoriel\TutorielRepository;
use Exception;
use Illuminate\Http\Request;
use Validator;

class TutorielApiController extends BaseController
{
    /**
     * @var UserViewRepository
     */
    private $userViewRepository;
    /**
     * @var TutorielCommentRepository
     */
    private $tutorielCommentRepository;
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;

    /**
     * TutorielApiController constructor.
     * @param UserViewRepository $userViewRepository
     * @param TutorielCommentRepository $tutorielCommentRepository
     * @param TutorielRepository $tutorielRepository
     */
    public function __construct(UserViewRepository $userViewRepository, TutorielCommentRepository $tutorielCommentRepository, TutorielRepository $tutorielRepository)
    {
        $this->userViewRepository = $userViewRepository;
        $this->tutorielCommentRepository = $tutorielCommentRepository;
        $this->tutorielRepository = $tutorielRepository;
    }

    public function viewLater($tutoriel_id)
    {
        $data = $this->userViewRepository->getAsLater($tutoriel_id);
        if($data == null) {
            $this->userViewRepository->createAsLater($tutoriel_id);

            return $this->sendResponse("OK", "OK");
        }else{
            return $this->sendError("Erreur", $data, 203);
        }
    }

    public function view($tutoriel_id)
    {
        $data = $this->userViewRepository->getAsView($tutoriel_id);
        if($data == null) {
            $this->userViewRepository->createAsWatches($tutoriel_id);

            return $this->sendResponse("OK", "OK");
        }else{
            return $this->sendError("Erreur", $data, 203);
        }
    }

    public function postComment($blog_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            "comment" => "required|min:5"
        ]);

        if($validator->fails()){
            return $this->sendError("Erreur Validation", ["errors" => $validator->errors()->all()], 203);
        }

        try {
            $data = $this->tutorielCommentRepository->create($blog_id, auth()->user()->id, $request->comment);
            $tutoriel = $this->tutorielRepository->get($blog_id);

            AccountActivityHelper::storeActivity("Poste d'un commentaire sur le tutoriel <strong>" . $tutoriel->title . "</strong>", 'la la-comment', '2');
            auth()->user()->notify(new PostNewCommentTutoriel($tutoriel));
            foreach ($tutoriel->comments as $comment) {
                $comment->user->notify(new PostNewCommentOtherTutoriel($tutoriel));
            }
            return $this->sendResponse($data, "Post d'un commentaire");
        } catch (Exception $exception) {
            AccountActivityHelper::storeActivity("Poste d'un commentaire sur le tutoriel <strong>" . $tutoriel->title . "</strong>", 'la la-comment', '0');
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteComment(Request $request, $blog_id, $comment_id)
    {
        try {
            $tutoriel = $this->tutorielRepository->get($blog_id);
            $this->tutorielCommentRepository->delete($comment_id);
            AccountActivityHelper::storeActivity("Suppression d'un commentaire sur le tutoriel <strong>" . $tutoriel->title . "</strong>", 'la la-comment', '2');
            return $this->sendResponse("Done", "Suppression du commentaire");
        } catch (Exception $exception) {
            AccountActivityHelper::storeActivity("Suppression d'un commentaire sur le tutoriel <strong>" . $tutoriel->title . "</strong>", 'la la-comment', '0');
            return $this->sendError("Erreur de suppression d'un commentaire", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
