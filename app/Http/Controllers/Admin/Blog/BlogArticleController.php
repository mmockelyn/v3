<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCategoryRepository;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;

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
        try {
            $this->blogRepository->delete($article_id);

            toastr()->success("Un article à été supprimer", "Succès");

            return redirect()->back();
        }catch (\Exception $exception) {
            toastr()->error("Erreur lors de la suppression d'un article", "Erreur Système");
            return redirect()->back();
        }
    }
}
