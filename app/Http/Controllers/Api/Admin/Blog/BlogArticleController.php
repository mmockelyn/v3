<?php

namespace App\Http\Controllers\Api\Admin\Blog;

use App\Http\Controllers\Api\BaseController;
use App\Jobs\Blog\ArticlePublishFacebookJob;
use App\Jobs\Blog\ArticlePublishJob;
use App\Jobs\Blog\ArticlePublishTwitterJob;
use App\Repository\Account\UserRepository;
use App\Repository\Blog\BlogCommentRepository;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogArticleController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;
    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * BlogArticleController constructor.
     * @param BlogRepository $blogRepository
     * @param BlogCommentRepository $blogCommentRepository
     * @param UserRepository $userRepository
     */
    public function __construct(BlogRepository $blogRepository, BlogCommentRepository $blogCommentRepository, UserRepository $userRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
        $this->userRepository = $userRepository;
    }

    public function list(Request $request)
    {
        //dd($request->get('query')['generalSearch']);
        if ($request->get('query')) {
            $datas = $this->blogRepository->list($request->sort, $request->get('query')['generalSearch']);
        } else {
            $datas = $this->blogRepository->list($request->sort, null);
        }

        $arr = [];

        foreach ($datas as $data) {
            //Définition de l'image
            if (Storage::disk('public')->exists('blog/' . $data->id . '.png') == false) {
                $img = '/storage/blog/news.png';
            } else {
                $img = '/storage/blog/' . $data->id . '.png';
            }

            // Définition de la publication
            if ($data->published == 1) {
                $published_at = $data->published_at->format('d/m/Y à H:i');
            } else {
                $published_at = null;
            }

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
            "category_id" => "required",
            "title" => "required|min:2",
            "short_content" => "required|min:5|max:255"
        ]);

        if ($validator->fails()) {
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

            return $this->sendResponse("OK", "L'article <strong>" . $article->title . "</strong> à été créer avec succès");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function get($article_id)
    {
        try {
            $data = $this->blogRepository->get($article_id);
            if (Storage::disk('public')->exists('blog/' . $data->id . '.png') == true) {
                $img = '/storage/blog/' . $data->id . '.png';
            } else {
                $img = '/storage/blog/news.png';
            }

            return $this->sendResponse([
                "data" => $data->toArray(),
                "img" => $img,
                "category" => $data->category->name,
                "countComment" => count($this->blogCommentRepository->allFrom($article_id))
            ], "Info");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function verifPublish($article_id)
    {
        $data = $this->blogRepository->get($article_id);
        $errors = [];

        if ($data->short_content == $data->content) {
            $errors[] .= "<li>Aucune différence entre la description courte et la description longue.<br>Veuillez Emmettre une description longue différente de la description courte</li>";
        }

        if ($data->twitter == 1 && $data->twitterText == null) {
            $errors[] .= "<li>L'article doit être publier sur twitter mais aucun texte n'à été définie</li>";
        }

        if (Storage::disk('public')->exists('blog/' . $data->id . '.png') == false) {
            $errors[] .= "<li>L'image de l'article n'est pas définie</li>";
        }

        if (count($data->tags) == 0) {
            $errors[] .= "<li>Aucun tag de définie</li>";
        }

        if (count($errors) == 0) {
            return $this->sendResponse([
                "result" => 'true'
            ], "OK");
        } else {
            return $this->sendResponse([
                "result" => 'false',
                "content" => $errors
            ], "OK");
        }
    }

    public function publish($article_id)
    {
        $article = $this->blogRepository->get($article_id);

        // Verif publication sur twitter

        if($article->twitter == 1) {
            $this->publishTo('twitter', $article);
        }

        // Verif Publication sur facebook
        if($article->facebook == 1) {
            $this->publishTo('facebook', $article);
        }

        // Publication utilisateur
        $this->notifyAllUser($article);

        try {
            $this->blogRepository->publish($article_id);

            return $this->sendResponse("ok", "ok");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function unpublish($article_id)
    {
        try {
            $this->blogRepository->unpublish($article_id);

            return $this->sendResponse("ok", "ok");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editInfo(Request $request, $article_id)
    {
        //dd($request->exists('published'));
        if ($request->exists('published') == true) {
            $published = 1;
        } else {
            $published = 0;
        }
        if ($request->exists('twitter') == true) {
            $twitter = 1;
        } else {
            $twitter = 0;
        }
        if ($request->exists('facebook') == true) {
            $facebook = 1;
        } else {
            $facebook = 0;
        }
        try {
            $this->blogRepository->updateInfo(
                $article_id,
                $request->category_id,
                $request->title,
                $request->short_content,
                $published,
                $request->published_at,
                $twitter,
                $facebook
            );

            return $this->sendResponse("ok", 'ok');
        } catch (\Exception $exception) {
            return $this->sendError("Erreur", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editThumbnail(Request $request, $article_id)
    {
        try {
            $file = $request->file('images');
            if(Storage::disk('public')->exists('blog/'.$article_id.'.png') == true) {
                Storage::disk('public')->delete('blog/'.$article_id.'.png');

                $request->file('images')->storeAs('blog', $article_id . '.png', 'public');

                Storage::disk('public')->setVisibility('blog/'.$article_id.'.png', 'public');
            }else{
                $request->file('images')->storeAs('blog', $article_id . '.png', 'public');

                Storage::disk('public')->setVisibility('blog/'.$article_id.'.png', 'public');
            }

            return redirect()->back()->with('success', "L'image à été mise à jour avec succès");
        } catch (\Exception $exception) {
            return redirect()->back()->with("error", "Erreur lors de la mise à jour de l'image");
        }
    }

    public function textTwitter(Request $request, $article_id)
    {
        $validator = \Validator::make($request->all(), [
            "twitterText" => "max:280"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }

        try {
            $this->blogRepository->updateTwitterText($article_id, $request->twitterText);

            return $this->sendResponse("ok", "ok");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editDescription(Request $request, $article_id)
    {
        try {
            $this->blogRepository->updateContent($article_id, $request->get('content'));

            return $this->sendResponse("ok", "ok");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    private function notifyAllUser($article)
    {
        dispatch(new ArticlePublishJob($article, $this->userRepository->all()))->delay(now()->addSeconds(10));
    }

    private function publishTo($provider, $article)
    {
        switch ($provider) {
            case 'twitter':
                dispatch(new ArticlePublishTwitterJob($article))->delay(now()->addSeconds(10));
                break;

            case 'facebook':
                dispatch(new ArticlePublishFacebookJob($article))->delay(now()->addSeconds(10));
        }
    }
}
