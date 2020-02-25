<?php

namespace App\Http\Controllers\Front\Download;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCategoryRepository;
use App\Repository\Asset\AssetSubCategoryRepository;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * @var AssetCategoryRepository
     */
    private $assetCategoryRepository;
    /**
     * @var AssetSubCategoryRepository
     */
    private $assetSubCategoryRepository;

    /**
     * DownloadController constructor.
     * @param AssetCategoryRepository $assetCategoryRepository
     * @param AssetSubCategoryRepository $assetSubCategoryRepository
     */
    public function __construct(AssetCategoryRepository $assetCategoryRepository, AssetSubCategoryRepository $assetSubCategoryRepository)
    {
        $this->assetCategoryRepository = $assetCategoryRepository;
        $this->assetSubCategoryRepository = $assetSubCategoryRepository;
    }

    public function index()
    {
        return view('front.download.index', [
            "categories" => $this->assetCategoryRepository->all()
        ]);
    }

    public function category($category_id)
    {
        return view('front.download.category', [
            "category" => $this->assetCategoryRepository->get($category_id)
        ]);
    }

    public function list($category_id, $subcategory_id)
    {
        return view('front.download.list', [
            "sub" => $this->assetSubCategoryRepository->get($subcategory_id)
        ]);
    }
}
