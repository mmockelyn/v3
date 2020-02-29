<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCategoryRepository;
use Illuminate\Http\Request;

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
            return $this->sendError("Erreur de Validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }else{
            try {
                $this->blogCategoryRepository->create($request->name);
                return $this->sendResponse("OK", "Catégorie Créer");
            }catch (\Exception $exception) {
                return $this->sendError("Erreur", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }
    }
}
