<?php

namespace App\Http\Controllers\Api\Admin\Objet;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCategoryRepository;
use Illuminate\Http\Request;

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

}
