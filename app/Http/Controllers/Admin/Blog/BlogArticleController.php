<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCategoryRepository;
use App\Repository\Blog\BlogRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogArticleController extends Controller
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * BlogArticleController constructor.
     * @param BlogCategoryRepository $blogCategoryRepository
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogCategoryRepository $blogCategoryRepository, BlogRepository $blogRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
        $this->blogRepository = $blogRepository;
    }

    public function article() {
        return view("admin.blog.article.index", [
            "categories" => $this->blogCategoryRepository->all()
        ]);
    }

    public function show($article_id)
    {
        return view("admin.blog.article.show", [
            "article_id" => $article_id,
            "article" => $this->blogRepository->get($article_id)
        ]);
    }

    public function edit($article_id)
    {
        $article = $this->blogRepository->get($article_id);
        if ($article->published == 1) {
            Log::warning("Tentative d'accès à l'édition d'un article publier", [
                "user" => auth()->user()->name,
                "sector" => "Admin/Blog"
            ]);
            return redirect()->back()->with('warning', "Cette article est publier, l'édition est impossible");
        }
        return view("admin.blog.article.edit", [
            "article" => $this->blogRepository->get($article_id),
            "categories" => $this->blogCategoryRepository->all()
        ]);
    }

    public function update(Request $request, $article_id)
    {

    }

    public function delete($article_id)
    {
        $article = $this->blogRepository->get($article_id);
        if ($article->published == 1) {
            Log::warning("Tentative d'accès à la suppression d'un article publier", [
                "user" => auth()->user()->name,
                "sector" => "Admin/Blog"
            ]);
            return redirect()->back()->with('warning', "Cette article est publier, la suppression est impossible");
        }
        try {
            $this->blogRepository->delete($article_id);

            Log::info("Suppression d'un article", [
                "article" => $article
            ]);
            return redirect()->back()->with('success', "L'article à bien été supprimer");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression de l'article");
        }
    }
}
