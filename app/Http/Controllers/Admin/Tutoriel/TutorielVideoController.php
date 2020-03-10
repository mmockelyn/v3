<?php

namespace App\Http\Controllers\Admin\Tutoriel;

use App\Http\Controllers\Controller;
use App\Repository\Tutoriel\TutorielCategoryRepository;
use App\Repository\Tutoriel\TutorielRepository;
use Exception;
use Illuminate\Http\Request;

class TutorielVideoController extends Controller
{
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;
    /**
     * @var TutorielCategoryRepository
     */
    private $tutorielCategoryRepository;

    /**
     * TutorielVideoController constructor.
     * @param TutorielRepository $tutorielRepository
     * @param TutorielCategoryRepository $tutorielCategoryRepository
     */
    public function __construct(TutorielRepository $tutorielRepository, TutorielCategoryRepository $tutorielCategoryRepository)
    {
        $this->tutorielRepository = $tutorielRepository;
        $this->tutorielCategoryRepository = $tutorielCategoryRepository;
    }

    public function index()
    {
        return view("admin.tutoriel.video.index", [
            "categories" => $this->tutorielCategoryRepository->all()
        ]);
    }

    public function show($tutoriel_id)
    {
        return view("admin.tutoriel.video.show", [
            "tutoriel" => $this->tutorielRepository->get($tutoriel_id)
        ]);
    }

    public function edit($tutoriel_id)
    {
        return view("admin.tutoriel.video.edit", [
            "categories" => $this->tutorielCategoryRepository->all(),
            "tutoriel" => $this->tutorielRepository->get($tutoriel_id)
        ]);
    }

    public function delete($tutoriel_id)
    {
        try {
            $this->tutorielRepository->delete($tutoriel_id);

            return redirect()->back()->with('success', "Le tutoriel à été supprimer");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression du tutoriel");
        }
    }
}
