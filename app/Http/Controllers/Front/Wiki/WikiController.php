<?php

namespace App\Http\Controllers\Front\Wiki;

use App\Http\Controllers\Controller;
use App\Repository\Wiki\WikiCategoryRepository;
use App\Repository\Wiki\WikiRepository;
use App\Repository\Wiki\WikiSubCategoryRepository;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    /**
     * @var WikiCategoryRepository
     */
    private $wikiCategoryRepository;
    /**
     * @var WikiRepository
     */
    private $wikiRepository;
    /**
     * @var WikiSubCategoryRepository
     */
    private $wikiSubCategoryRepository;

    /**
     * WikiController constructor.
     * @param WikiCategoryRepository $wikiCategoryRepository
     * @param WikiRepository $wikiRepository
     * @param WikiSubCategoryRepository $wikiSubCategoryRepository
     */
    public function __construct(WikiCategoryRepository $wikiCategoryRepository, WikiRepository $wikiRepository, WikiSubCategoryRepository $wikiSubCategoryRepository)
    {
        $this->wikiCategoryRepository = $wikiCategoryRepository;
        $this->wikiRepository = $wikiRepository;
        $this->wikiSubCategoryRepository = $wikiSubCategoryRepository;
    }

    public function index()
    {
        return view("front.wiki.index", [
            "categories" => $this->wikiCategoryRepository->all(),
            "articles" => $this->wikiRepository->allLimit()
        ]);
    }

    public function sub($category_id)
    {
        return view('front.wiki.sub', [
            "category" => $this->wikiCategoryRepository->get($category_id),
            "articles" => $this->wikiRepository->getFromCategory($category_id)
        ]);
    }

    public function list($category_id,$subcategory_id)
    {
        return view("front.wiki.list", [
            "subcategory" => $this->wikiSubCategoryRepository->get($subcategory_id),
            "articles" => $this->wikiRepository->getFromSub($subcategory_id)
        ]);
    }

    public function show($category_id, $subcategory_id, $article_id)
    {
        return view("front.wiki.show", [
            "article" => $this->wikiRepository->get($article_id)
        ]);
    }
}
