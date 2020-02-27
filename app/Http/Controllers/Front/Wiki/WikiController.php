<?php

namespace App\Http\Controllers\Front\Wiki;

use App\Http\Controllers\Controller;
use App\Repository\Wiki\WikiCategoryRepository;
use App\Repository\Wiki\WikiRepository;
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
     * WikiController constructor.
     * @param WikiCategoryRepository $wikiCategoryRepository
     * @param WikiRepository $wikiRepository
     */
    public function __construct(WikiCategoryRepository $wikiCategoryRepository, WikiRepository $wikiRepository)
    {
        $this->wikiCategoryRepository = $wikiCategoryRepository;
        $this->wikiRepository = $wikiRepository;
    }

    public function index()
    {
        return view("front.wiki.index", [
            "categories" => $this->wikiCategoryRepository->all(),
            "articles" => $this->wikiRepository->allLimit()
        ]);
    }
}
