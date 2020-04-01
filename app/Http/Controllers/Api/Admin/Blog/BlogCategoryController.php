<?php

namespace App\Http\Controllers\Api\Admin\Blog;

use App\Http\Controllers\Api\BaseController;
use App\Repository\Blog\BlogCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogCategoryController extends BaseController
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

    public function list(Request $request)
    {
        $datas = $this->blogCategoryRepository->all();

        return $datas->toArray();

    }

    public function create(Request $request){
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
            "name" => "required"
        ]);

        if($validator->fails()){
            Log::warning("Erreur de validation lors de la création d'une catégorie de blog");
            return $this->sendError("Erreur de Validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }else{
            try {
                $this->blogCategoryRepository->create($request->name);
                Log::info("Création d'une catégorie du blog");
                return $this->sendResponse("OK", "Catégorie Créer");
            }catch (\Exception $exception) {
                return $this->sendError("Erreur", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }
    }
}
