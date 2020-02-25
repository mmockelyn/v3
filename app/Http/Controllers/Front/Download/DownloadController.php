<?php

namespace App\Http\Controllers\Front\Download;

use App\Http\Controllers\Controller;
use App\Repository\Asset\AssetCategoryRepository;
use App\Repository\Asset\AssetRepository;
use App\Repository\Asset\AssetSubCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
     * @var AssetRepository
     */
    private $assetRepository;

    /**
     * DownloadController constructor.
     * @param AssetCategoryRepository $assetCategoryRepository
     * @param AssetSubCategoryRepository $assetSubCategoryRepository
     * @param AssetRepository $assetRepository
     */
    public function __construct(AssetCategoryRepository $assetCategoryRepository, AssetSubCategoryRepository $assetSubCategoryRepository, AssetRepository $assetRepository)
    {
        $this->assetCategoryRepository = $assetCategoryRepository;
        $this->assetSubCategoryRepository = $assetSubCategoryRepository;
        $this->assetRepository = $assetRepository;
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

    public function show($category_id, $sub_id, $asset_id)
    {
        return view("front.download.show", [
            "asset" => $this->assetRepository->get($asset_id)
        ]);
    }

    public function mesh($category_id, $sub_id, $asset_id)
    {
        return view("front.download.mesh", [
            "asset" => $this->assetRepository->get($asset_id)
        ]);
    }

    public function config($category_id, $sub_id, $asset_id)
    {
        return view("front.download.config", [
            "asset" => $this->assetRepository->get($asset_id)
        ]);
    }

    public function download($category_id, $sub_id, $asset_id)
    {
        $asset = $this->assetRepository->get($asset_id);
        $newCount = $asset->countDownload+1;

        try {
            $this->assetRepository->updateCountDownload($asset_id, $newCount);
            return \redirect()->away($asset->downloadLink);
        }catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
