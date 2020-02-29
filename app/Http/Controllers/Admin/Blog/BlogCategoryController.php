<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCategoryRepository;
use Illuminate\Http\Request;

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

            toastr()->success("La catégorie à été mis à jours", "Succès");
            return redirect()->route('Back.Blog.Category.index');
        }catch (\Exception $exception) {
            toastr()->error("Erreur lors de la mise à jour de la catégorie", "Erreur Système");
            return redirect()->route('Back.Blog.Category.index');
        }
    }

    public function delete($category_id)
    {
        try {
            $this->blogCategoryRepository->delete($category_id);
            toastr()->success("Une catégorie à été supprimer", "Succès");
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->error("Suppression impossible", "Erreur Système");
            return redirect()->back();
        }
    }
}
