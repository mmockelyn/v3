<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogArticleController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * BlogArticleController constructor.
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function list(Request $request)
    {
        //dd($request->get('query')['generalSearch']);
        if($request->get('query')){
            $datas = $this->blogRepository->list($request->sort, $request->get('query')['generalSearch']);
        }else{
            $datas = $this->blogRepository->list($request->sort, null);
        }

        $arr = [];

        foreach ($datas as $data) {
            //Définition de l'image
            if(Storage::disk('public')->exists('blog/'.$data->id.'.png') == false){
                $img = '/storage/blog/news.png';
            } else {
                $img = '/storage/blog/'.$data->id.'.png';
            }

            // Définition de la publication
            if($data->published == 1){$published_at = $data->published_at->format('d/m/Y à H:i');}else{$published_at = null;}

            $arr[] = [
                "id" => $data->id,
                "img" => $img,
                "category" => $data->category->name,
                "title" => $data->title,
                "short_content" => $data->short_content,
                "published_at" => $published_at,
                "published" => $data->published,
                "twitter" => $data->twitter
            ];
        }

        return $this->sendResponse($arr, "Liste des Articles");
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            "category_id"   => "required",
            "title" => "required|min:2",
            "short_content" => "required|min:5|max:255"
        ]);

        if($validator->fails()) {
            return $this->sendError("Erreur", [
                "errors" => $validator->errors()->all()
            ], 203);
        }

        try {
            $article = $this->blogRepository->create(
                $request->category_id,
                $request->title,
                $request->short_content
            );

            return $this->sendResponse("OK", "L'article <strong>".$article->title."</strong> à été créer avec succès");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
