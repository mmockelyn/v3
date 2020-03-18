<?php

namespace App\Http\Controllers\Admin\Wiki;

use App\Http\Controllers\Controller;
use App\Repository\Wiki\WikiArticleContentRepository;
use App\Repository\Wiki\WikiArticleSommaireRepository;
use App\Repository\Wiki\WikiCategoryRepository;
use App\Repository\Wiki\WikiRepository;
use App\Repository\Wiki\WikiSubCategoryRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WikiArticleController extends Controller
{
    /**
     * @var WikiRepository
     */
    private $wikiRepository;
    /**
     * @var WikiCategoryRepository
     */
    private $categoryRepository;
    /**
     * @var WikiSubCategoryRepository
     */
    private $subCategoryRepository;
    /**
     * @var WikiArticleSommaireRepository
     */
    private $articleSommaireRepository;
    /**
     * @var WikiArticleContentRepository
     */
    private $articleContentRepository;

    /**
     * WikiArticleController constructor.
     * @param WikiRepository $wikiRepository
     * @param WikiCategoryRepository $categoryRepository
     * @param WikiSubCategoryRepository $subCategoryRepository
     * @param WikiArticleSommaireRepository $articleSommaireRepository
     * @param WikiArticleContentRepository $articleContentRepository
     */
    public function __construct(
        WikiRepository $wikiRepository,
        WikiCategoryRepository $categoryRepository,
        WikiSubCategoryRepository $subCategoryRepository,
        WikiArticleSommaireRepository $articleSommaireRepository, WikiArticleContentRepository $articleContentRepository)
    {
        $this->wikiRepository = $wikiRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->articleSommaireRepository = $articleSommaireRepository;
        $this->articleContentRepository = $articleContentRepository;
    }

    public function index()
    {
        return view("admin.wiki.article.index", [
            "categories" => $this->categoryRepository->all()
        ]);
    }

    public function show($article_id)
    {
        return view("admin.wiki.article.show", [
            "article" => $this->wikiRepository->get($article_id),
            "sommaires" => $this->articleSommaireRepository->getForArticle($article_id)
        ]);
    }

    public function edit($article_id)
    {
        return view("admin.wiki.article.edit", [
            "article" => $this->wikiRepository->get($article_id)
        ]);
    }

    public function editThumb(Request $request, $article_id)
    {
        $file = $request->file('images');
        if (Storage::disk('public')->exists('wiki/' . $article_id . '.png') == true) {
            try {
                Storage::disk('public')->delete('wiki/' . $article_id . '.png');
                try {
                    $file->storeAs('wiki/', $article_id . '.png', 'public');

                    try {
                        Storage::disk('public')->setVisibility('wiki/' . $article_id . '.png', 'public');
                        return redirect()->back()->with('success', "L'image à été ajouté avec succès");
                    } catch (Exception $exception) {
                        return redirect()->back()->with('warning', "Erreur lors de la définition du fichier images");
                    }
                } catch (Exception $exception) {
                    return redirect()->back()->with('warning', "Erreur lors de la création de l'image");
                }
            } catch (Exception $exception) {
                return redirect()->back()->with('warning', "Erreur lors de la suppression du fichier");
            }
        } else {
            try {
                $file->storeAs('wiki/', $article_id . '.png', 'public');

                try {
                    Storage::disk('public')->setVisibility('wiki/' . $article_id . '.png', 'public');
                    return redirect()->back()->with('success', "L'image à été ajouté avec succès");
                } catch (Exception $exception) {
                    return redirect()->back()->with('warning', "Erreur lors de la définition du fichier images");
                }
            } catch (Exception $exception) {
                return redirect()->back()->with('warning', "Erreur lors de la création de l'image");
            }
        }
    }

    public function delete($article_id)
    {
        try {
            $this->wikiRepository->delete($article_id);

            return redirect()->back()->with('success', "L'article à été supprimer");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression de l'article");
        }
    }

    public function deleteSommaire($article_id, $sommaire_id)
    {
        try {
            $this->articleSommaireRepository->delete($sommaire_id);
            try {
                $this->articleContentRepository->deleteBySommaire($sommaire_id);
                return redirect()->back()->with('success', "Le contenue de l'article à été supprimer");
            } catch (Exception $exception) {
                return redirect()->back()->with('error', "Erreur lors de la suppression du contenue");
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression du sommaire");
        }
    }
}
