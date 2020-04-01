<?php

namespace App\Http\Controllers\Admin\Wiki;

use App\Http\Controllers\Controller;
use App\Repository\Wiki\WikiCategoryRepository;
use App\Repository\Wiki\WikiSubCategoryRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WikiCategoryController extends Controller
{
    /**
     * @var WikiCategoryRepository
     */
    private $categoryRepository;
    /**
     * @var WikiSubCategoryRepository
     */
    private $subCategoryRepository;

    /**
     * WikiCategoryController constructor.
     * @param WikiCategoryRepository $categoryRepository
     * @param WikiSubCategoryRepository $subCategoryRepository
     */
    public function __construct(WikiCategoryRepository $categoryRepository, WikiSubCategoryRepository $subCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function index()
    {
        return view("admin.wiki.category.index", [
            "categories" => $this->categoryRepository->all()
        ]);
    }

    public function deleteCategory($category_id)
    {
        try {
            $this->categoryRepository->delete($category_id);

            Log::info("Suppression d'une catégorie d'un article du wiki");
            return redirect()->back()->with('success', "La catégorie à été supprimer");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', "Erreur lors de la suppression de la catégorie");
        }
    }

    public function deleteSubCategory($subcategory_id)
    {
        try {
            $this->subCategoryRepository->delete($subcategory_id);

            Log::info("Suppression d'une sous catégorie d'un article du wiki");
            return redirect()->back()->with('success', "La sous catégorie à été supprimer");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', "Erreur lors de la suppression de la sous catégorie");
        }
    }
}
