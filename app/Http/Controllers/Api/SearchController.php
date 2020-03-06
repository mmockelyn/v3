<?php

namespace App\Http\Controllers\Api;

use App\Repository\Asset\AssetRepository;
use App\Repository\Blog\BlogRepository;
use App\Repository\Tutoriel\TutorielRepository;
use App\Repository\Wiki\WikiRepository;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;
    /**
     * @var AssetRepository
     */
    private $assetRepository;
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;
    /**
     * @var WikiRepository
     */
    private $wikiRepository;

    /**
     * SearchController constructor.
     * @param BlogRepository $blogRepository
     * @param AssetRepository $assetRepository
     * @param TutorielRepository $tutorielRepository
     * @param WikiRepository $wikiRepository
     */
    public function __construct(BlogRepository $blogRepository, AssetRepository $assetRepository, TutorielRepository $tutorielRepository, WikiRepository $wikiRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->assetRepository = $assetRepository;
        $this->tutorielRepository = $tutorielRepository;
        $this->wikiRepository = $wikiRepository;
    }

    public function search(Request $request) {
        $blogs = $this->blogRepository->search($request->get('query'));
        $assets = $this->assetRepository->search($request->get('query'));
        $tutoriels = $this->tutorielRepository->search($request->get('query'));
        $wikis = $this->wikiRepository->search($request->get('query'));
        ob_start();
        ?>
        <div class="kt-quick-search__result">
            <?php if(count($blogs) && count($assets) && count($tutoriels) && count($wikis)): ?>
            <div class="kt-quick-search__message kt-hidden">
                No record found
            </div>
            <?php endif; ?>
            <div class="kt-quick-search__category">
                Articles
            </div>
            <div class="kt-quick-search__section">
                <?php foreach ($blogs as $blog): ?>
                <div class="kt-quick-search__item">
                    <div class="kt-quick-search__item-img kt-quick-search__item-img--file">
                        <?php if(file_exists('/storage/blog/'.$blog->id.'.png')): ?>
                        <img src="/storage/blog/<?= $blog->id ?>.png" alt="" />
                        <?php else: ?>
                            <img src="/storage/blog/news.png" alt="" />
                        <?php endif; ?>
                    </div>
                    <div class="kt-quick-search__item-wrapper">
                        <a href="<?= route('Front.Blog.show', $blog->slug) ?>" class="kt-quick-search__item-title">
                            <?= $blog->title ?>
                        </a>
                        <div class="kt-quick-search__item-desc">
                            <?= $blog->category->name; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="kt-quick-search__category">
                Objets
            </div>
            <div class="kt-quick-search__section">
                <?php foreach ($assets as $asset): ?>
                    <div class="kt-quick-search__item">
                        <div class="kt-quick-search__item-img kt-quick-search__item-img--file">
                            <?php if(file_exists('/storage/download/'.$asset->category->id.'/'.$asset->subcategory->id.'/'.$asset->id.'.png')): ?>
                                <img src='/storage/download/<?= $asset->category->id.'/'.$asset->subcategory->id.'/'.$asset->id.'.png' ?>' alt="" />
                            <?php else: ?>
                                <img src="/storage/download/download.png" alt="" />
                            <?php endif; ?>
                        </div>
                        <div class="kt-quick-search__item-wrapper">
                            <a href="<?= route('Front.Download.show', [$asset->category->id, $asset->subcategory->id, $asset->id]) ?>" class="kt-quick-search__item-title">
                                <?= $asset->designation ?>
                            </a>
                            <div class="kt-quick-search__item-desc">
                                <?= $asset->category->name; ?> - <?= $asset->subcategory->name; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="kt-quick-search__category">
                Tutoriels
            </div>
            <div class="kt-quick-search__section">
                <?php foreach ($tutoriels as $tutoriel): ?>
                    <div class="kt-quick-search__item">
                        <div class="kt-quick-search__item-img kt-quick-search__item-img--file">
                            <?php if(file_exists('/storage/tutoriel/'.$tutoriel->subcategory->id.'/'.$tutoriel->id.'.png')): ?>
                                <img src='/storage/tutoriel/<?= $tutoriel->subcategory->id.'/'.$tutoriel->id.'.png' ?>' alt="" />
                            <?php else: ?>
                                <img src="/storage/tutoriel/tutoriel.png" alt="" />
                            <?php endif; ?>
                        </div>
                        <div class="kt-quick-search__item-wrapper">
                            <a href="<?= route('Front.Tutoriel.show', [$tutoriel->subcategory->id, $tutoriel->id]) ?>" class="kt-quick-search__item-title">
                                <?= $tutoriel->title ?>
                            </a>
                            <div class="kt-quick-search__item-desc">
                                <?= $tutoriel->category->name; ?> - <?= $tutoriel->subcategory->name; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="kt-quick-search__category">
                Wiki
            </div>
            <div class="kt-quick-search__section">
                <?php foreach ($wikis as $wiki): ?>
                    <div class="kt-quick-search__item">
                        <div class="kt-quick-search__item-img kt-quick-search__item-img--file">
                            <?php if(file_exists('/storage/wiki/'.$wiki->subcategory->id.'/'.$wiki->id.'.png')): ?>
                                <img src='/storage/wiki/<?= $wiki->subcategory->id.'/'.$wiki->id.'.png' ?>' alt="" />
                            <?php else: ?>
                                <img src="/storage/wiki/wiki.png" alt="" />
                            <?php endif; ?>
                        </div>
                        <div class="kt-quick-search__item-wrapper">
                            <a href="<?= route('Front.Wiki.show', [$wiki->category->id, $wiki->subcategory->id, $wiki->id]) ?>" class="kt-quick-search__item-title">
                                <?= $wiki->title ?>
                            </a>
                            <div class="kt-quick-search__item-desc">
                                <?= $wiki->category->name; ?> - <?= $wiki->subcategory->name; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "resultat de la recherche");
    }
}
