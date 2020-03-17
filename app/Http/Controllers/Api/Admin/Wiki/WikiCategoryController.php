<?php

namespace App\Http\Controllers\Api\Admin\Wiki;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Wiki\WikiCategoryRepository;
use App\Repository\Wiki\WikiSubCategoryRepository;
use Exception;
use Illuminate\Http\Request;

class WikiCategoryController extends BaseController
{
    /**
     * @var WikiCategoryRepository
     */
    private $categoryRepository;
    /**
     * @var Datatable
     */
    private $datatable;
    /**
     * @var WikiSubCategoryRepository
     */
    private $wikiSubCategoryRepository;

    /**
     * WikiCategoryController constructor.
     * @param WikiCategoryRepository $categoryRepository
     * @param Datatable $datatable
     * @param WikiSubCategoryRepository $wikiSubCategoryRepository
     */
    public function __construct(WikiCategoryRepository $categoryRepository, Datatable $datatable, WikiSubCategoryRepository $wikiSubCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->datatable = $datatable;
        $this->wikiSubCategoryRepository = $wikiSubCategoryRepository;
    }

    public function list(Request $request)
    {
        $datas = $this->categoryRepository->all();

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($datas, "Liste des catégories");
        } elseif ($request->get('type') == 'option') {
            ob_start();
            ?>
            <?php foreach ($datas as $data): ?>
                <option value="<?= $data->id; ?>"><?= $data->name; ?></option>
            <?php endforeach; ?>
            <?php
            $content = ob_get_clean();
            return $this->sendResponse($content, "fjdks");

        } else {
            return $this->datatable->loadDatatable($request, $datas->toArray());
        }
    }

    public function listSub(Request $request)
    {
        $datas = $this->wikiSubCategoryRepository->all();
        $ars = collect();

        foreach ($datas as $data) {
            $ars->push([
                "id" => $data->id,
                "category" => $data->category->name,
                "name" => $data->name,
                "description" => $data->description,
                "icon" => $data->icon
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des sous catégories");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function listSubByCategory(Request $request)
    {
        $datas = $this->wikiSubCategoryRepository->allByCategory($request->category_id);
        ob_start();
        ?>
        <div class="form-group">
            <label for="subcategory_id">Sous Catégorie</label>
            <select id="subcategory_id" class="form-control" name="subcategory_id" data-live-search="true">
                <?php foreach ($datas as $data): ?>
                    <option value="<?= $data->id; ?>"><?= $data->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Liste des subs");
    }

    public function store(Request $request)
    {
        try {
            $category = $this->categoryRepository->create($request->name);
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function storeSub(Request $request)
    {
        try {
            $category = $this->wikiSubCategoryRepository->create(
                $request->category_id,
                $request->name,
                $request->description,
                $request->icon
            );
            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
