<?php

namespace App\Http\Controllers\Admin\Objet;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCategoryRepository;
use App\Repository\Asset\AssetRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ObjetObjetController extends Controller
{
    /**
     * @var AssetCategoryRepository
     */
    private $assetCategoryRepository;
    /**
     * @var AssetRepository
     */
    private $assetRepository;

    /**
     * ObjetObjetController constructor.
     * @param AssetCategoryRepository $assetCategoryRepository
     * @param AssetRepository $assetRepository
     */
    public function __construct(AssetCategoryRepository $assetCategoryRepository, AssetRepository $assetRepository)
    {
        $this->assetCategoryRepository = $assetCategoryRepository;
        $this->assetRepository = $assetRepository;
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

    public function show($objet_id)
    {
        return view("admin.objet.objet.show", [
            "asset" => $this->assetRepository->get($objet_id)
        ]);
    }
}
