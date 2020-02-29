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
