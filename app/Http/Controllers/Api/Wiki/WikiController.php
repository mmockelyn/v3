<?php

namespace App\Http\Controllers\Api\Wiki;

use App\Http\Controllers\Api\BaseController;
use App\Repository\Wiki\WikiRepository;
use Illuminate\Http\Request;

class WikiController extends BaseController
{
    /**
     * @var WikiRepository
     */
    private $wikiRepository;

    /**
     * WikiController constructor.
     * @param WikiRepository $wikiRepository
     */
    public function __construct(WikiRepository $wikiRepository)
    {
        $this->wikiRepository = $wikiRepository;
    }

    public function search(Request $request)
    {
        $datas = $this->wikiRepository->search($request->search);
        ob_start();
        ?>
        <div class="card-body">
            <div class="kt-notification-v2">
                <?php foreach ($datas as $data): ?>
                <a href="<?= route('Front.Wiki.show', [$data->category->id, $data->subcategory->id, $data->id]) ?>" class="kt-notification-v2__item">
                    <div class="kt-notification-v2__item-icon">
                        <i class="<?= $data->subcategory->icon; ?> kt-font-primary"></i>
                    </div>
                    <div class="kt-notification-v2__itek-wrapper">
                        <div class="kt-notification-v2__item-title">
                            <?= $data->title; ?>
                        </div>
                        <div class="kt-notification-v2__item-desc">
                            <?= $data->category->name; ?> - <?= $data->subcategory->name; ?>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Search Wiki");
    }
}
