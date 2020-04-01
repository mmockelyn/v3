<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogCategoryController extends Controller
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * BlogCategoryController constructor.
     * @param BlogCategoryRepository $blogCategoryRepository
     */
    public function __construct(BlogCategoryRepository $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    public function index()
    {
        return view("admin.blog.category.index");
    }

    public function edit($category_id)
    {
        return view("admin.blog.category.edit", [
            "category" => $this->blogCategoryRepository->get($category_id)
        ]);
    }

    public function update(Request $request, $category_id)
    {
        try {
            $this->blogCategoryRepository->update($category_id, $request->name);
            $category = $this->blogCategoryRepository->get($category_id);

            Log::info("Edition d'une catégorie d'article", [
                "categorie" => $category
            ]);
            return redirect()->route('Back.Blog.Category.index')->with('success', "La catégorie à été mise à jours");
        }catch (\Exception $exception) {
            return redirect()->route('Back.Blog.Category.index')->with('error', "Erreur lors de la mise à jours du système");
        }
    }

    public function delete($category_id)
    {
        try {
            $this->blogCategoryRepository->delete($category_id);

            $category = $this->blogCategoryRepository->get($category_id);

            Log::info("Suppression d'une catégorie d'article", [
                "categorie" => $category
            ]);
            return redirect()->back()->with('success', "La catégorie à bien été supprimer");
        }catch (\Exception $exception){
            return redirect()->back()->with('error', "Erreur lors de la suppression de la catégorie");
        }
    }
}
