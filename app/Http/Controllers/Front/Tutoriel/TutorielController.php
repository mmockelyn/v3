<?php

namespace App\Http\Controllers\Front\Tutoriel;

use App\Http\Controllers\Controller;
use App\Repository\Tutoriel\TutorielCategoryRepository;
use App\Repository\Tutoriel\TutorielSubCategoryRepository;
use Illuminate\Http\Request;

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
     * TutorielController constructor.
     * @param TutorielCategoryRepository $categoryRepository
     * @param TutorielSubCategoryRepository $tutorielSubCategoryRepository
     */
    public function __construct(TutorielCategoryRepository $categoryRepository, TutorielSubCategoryRepository $tutorielSubCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tutorielSubCategoryRepository = $tutorielSubCategoryRepository;
    }

    public function index()
    {
        return view("front.tutoriel.index", [
            "categories" => $this->categoryRepository->all()
        ]);
    }
}
