<?php

namespace App\Http\Controllers\Admin\Objet;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetSubCategoryRepository;
use Illuminate\Http\Request;

class ObjetSubCategoryController extends Controller
{
    /**
     * @var AssetSubCategoryRepository
     */
    private $assetSubCategoryRepository;

    /**
     * ObjetSubCategoryController constructor.
     * @param AssetSubCategoryRepository $assetSubCategoryRepository
     */
    public function __construct(AssetSubCategoryRepository $assetSubCategoryRepository)
    {
        $this->assetSubCategoryRepository = $assetSubCategoryRepository;
    }

    public function delete($subcategory_id)
    {
        try {
            $this->assetSubCategoryRepository->delete($subcategory_id);

            return redirect()->back()->with('success', "La sous catégorie à été supprimer");
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
