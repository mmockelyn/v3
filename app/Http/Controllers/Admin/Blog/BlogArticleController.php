<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCategoryRepository;
use Illuminate\Http\Request;

class BlogArticleController extends Controller
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * BlogArticleController constructor.
     * @param BlogCategoryRepository $blogCategoryRepository
     */
    public function __construct(BlogCategoryRepository $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    public function article() {
        return view("admin.blog.article.index", [
            "categories" => $this->blogCategoryRepository->all()
        ]);
    }
}
