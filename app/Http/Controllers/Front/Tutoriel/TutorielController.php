<?php

namespace App\Http\Controllers\Front\Tutoriel;

use App\Http\Controllers\Controller;
use App\Repository\Tutoriel\TutorielCategoryRepository;
use App\Repository\Tutoriel\TutorielCommentRepository;
use App\Repository\Tutoriel\TutorielRepository;
use App\Repository\Tutoriel\TutorielSubCategoryRepository;

class TutorielController extends Controller
{
    /**
     * @var TutorielCategoryRepository
     */
    private $categoryRepository;
    /**
     * @var TutorielSubCategoryRepository
     */
    private $tutorielSubCategoryRepository;
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;
    /**
     * @var TutorielCommentRepository
     */
    private $tutorielCommentRepository;

    /**
     * TutorielController constructor.
     * @param TutorielCategoryRepository $categoryRepository
     * @param TutorielSubCategoryRepository $tutorielSubCategoryRepository
     * @param TutorielRepository $tutorielRepository
     * @param TutorielCommentRepository $tutorielCommentRepository
     */
    public function __construct(TutorielCategoryRepository $categoryRepository,
                                TutorielSubCategoryRepository $tutorielSubCategoryRepository,
                                TutorielRepository $tutorielRepository,
                                TutorielCommentRepository $tutorielCommentRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tutorielSubCategoryRepository = $tutorielSubCategoryRepository;
        $this->tutorielRepository = $tutorielRepository;
        $this->tutorielCommentRepository = $tutorielCommentRepository;
    }

    public function index()
    {
        return view("front.tutoriel.index", [
            "categories" => $this->categoryRepository->all()
        ]);
    }

    public function list($subcategory_id)
    {
        return view("front.tutoriel.list", [
            "sub" => $this->tutorielSubCategoryRepository->get($subcategory_id),
            "tutoriels" => $this->tutorielRepository->listForCategory($subcategory_id)
        ]);
    }

    public function show($subcategory_id, $tutoriel_id)
    {
        return view("front.tutoriel.show", [
            "tutoriel" => $this->tutorielRepository->get($tutoriel_id),
            "comments" => $this->tutorielCommentRepository->allFrom($tutoriel_id)
        ]);
    }

}
