<?php

namespace App\Http\Controllers\Api\Download;

use App\HelpersClass\Asset\AssetHelper;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Asset\AssetCategoryRepository;
use App\Repository\Asset\AssetRepository;
use App\Repository\Asset\AssetSubCategoryRepository;
use Illuminate\Support\Facades\Storage;

class DownloadController extends BaseController
{
    /**
     * @var AssetRepository
     */
    private $assetRepository;
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
     * @param AssetRepository $assetRepository
     * @param AssetCategoryRepository $assetCategoryRepository
     * @param AssetSubCategoryRepository $assetSubCategoryRepository
     */
    public function __construct(AssetRepository $assetRepository, AssetCategoryRepository $assetCategoryRepository, AssetSubCategoryRepository $assetSubCategoryRepository)
    {
        $this->assetRepository = $assetRepository;
        $this->assetCategoryRepository = $assetCategoryRepository;
        $this->assetSubCategoryRepository = $assetSubCategoryRepository;
    }

    public function latest()
    {
        $datas = $this->assetRepository->allWithLimit(5);
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-widget5">
                    <div class="kt-widget5__item">
                        <div class="kt-widget5__content">
                            <div class="kt-widget5__pic">
                                <?php if (file_exists('/storage/download/' . $data->category->id . "/" . $data->subcategory->id . "/" . $data->id . ".png")): ?>
                                    <img class="kt-widget7__img"
                                         src="/storage/download/<?= $data->category->id; ?>/<?= $data->subcategory->id; ?>/<?= $data->id; ?>.png"
                                         alt="<?= $data->designation; ?>">
                                <?php else: ?>
                                    <img class="kt-widget7__img" src="/storage/download/download.png"
                                         alt="<?= $data->designation; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="kt-widget5__section">
                                <a href="<?= route('Front.Download.show', [$data->category->id, $data->subcategory->id, $data->id]) ?>"
                                   class="kt-widget5__title">
                                    <?= $data->designation; ?>
                                </a>
                                <p class="kt-widget5__desc">
                                    <?= $data->short_description; ?>
                                </p>
                                <div class="kt-widget5__info">
                                    <?php foreach ($data->compatibilities as $compatibility): ?>
                                        <span class="kt-badge kt-badge--inline kt-badge--<?= AssetHelper::stateClassCompatibility($compatibility->state); ?>"
                                              data-container="body" data-toggle="kt-tooltip"
                                              title="<?= $compatibility->trainzbuild->trainz_version_name; ?>"><?= $compatibility->trainzbuild->build; ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget5__content">
                            <div class="kt-widget5__stats">
                                <?php if ($data->pricing == 0): ?>
                                    <strong>Gratuit</strong>
                                <?php else: ?>
                                    <strong><?= $data->price; ?></strong>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Derniers Objets");
    }

    public function loadMesh($asset_id)
    {
        $data = $this->assetRepository->get($asset_id);

        return $this->sendResponse($data->toArray(), "Load Mesh");
    }

    public function loadConfig($asset_id)
    {
        $file = Storage::disk('sftp')->get('download/' . $asset_id . '/config.txt');
        ob_start();
        ?>
        <code>
            <?= $file; ?>
        </code>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Fichier de configuration");
    }

    public function all()
    {
        $downloads = $this->assetRepository->allWithLimit();

        return response()->json([
            $downloads->toArray()
        ]);
    }

    public function allCategory()
    {
        $categories = $this->assetSubCategoryRepository->all();

        return $this->sendResponse($categories->toArray(), "Liste des catégories");
    }

    public function getAsset($asset_id)
    {
        $asset = $this->assetRepository->get($asset_id);

        return $this->sendResponse($asset->toArray(), $asset->name);
    }

    public function getByCategory($category_id)
    {
        $assets = $this->assetRepository->getByCategory($category_id);

        return $this->sendResponse($assets->toArray(), "Liste des objets par catégorie");
    }

    public function latestMaj() {
        $asset = $this->assetRepository->getLatestAsset();

        return $this->sendResponse($asset->updated_at->toDayDateTimeString(), null);
    }
}
