<?php

namespace App\Http\Controllers\Admin\Objet;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCategoryRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ObjetCategoryController extends Controller
{
    /**
     * @var AssetCategoryRepository
     */
    private $assetCategoryRepository;

    /**
     * ObjetCategoryController constructor.
     * @param AssetCategoryRepository $assetCategoryRepository
     */
    public function __construct(AssetCategoryRepository $assetCategoryRepository)
    {
        $this->assetCategoryRepository = $assetCategoryRepository;
    }

    public function index() {
        return view("admin.objet.category.index", [
            "categories" => $this->assetCategoryRepository->all()
        ]);
    }

    public function delete($category_id)
    {
        try {
            $this->assetCategoryRepository->delete($category_id);

            $category = $this->assetCategoryRepository->get($category_id);
            Log::info("Edition d'une catégorie d'objet", [
                "categorie" => $category
            ]);
            return redirect()->back()->with('success', "La catégorie à été supprimer");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
