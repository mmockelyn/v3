<?php

namespace App\Http\Controllers\Admin\Objet;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCategoryRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ObjetObjetController extends Controller
{
    /**
     * @var AssetCategoryRepository
     */
    private $assetCategoryRepository;

    /**
     * ObjetObjetController constructor.
     * @param AssetCategoryRepository $assetCategoryRepository
     */
    public function __construct(AssetCategoryRepository $assetCategoryRepository)
    {
        $this->assetCategoryRepository = $assetCategoryRepository;
    }


    /**
     * @return Factory|View
     */
    public function index()
    {
        return view("admin.objet.objet.index", [
            "categories" => $this->assetCategoryRepository->all()
        ]);
    }
}
