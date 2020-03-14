<?php

namespace App\Http\Controllers\Api\Admin\Wiki;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Wiki\WikiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WikiArticleController extends BaseController
{
    /**
     * @var WikiRepository
     */
    private $wikiRepository;
    /**
     * @var Datatable
     */
    private $datatable;

    /**
     * WikiArticleController constructor.
     * @param WikiRepository $wikiRepository
     * @param Datatable $datatable
     */
    public function __construct(WikiRepository $wikiRepository, Datatable $datatable)
    {
        $this->wikiRepository = $wikiRepository;
        $this->datatable = $datatable;
    }

    public function latest(Request $request)
    {
        $datas = $this->wikiRepository->allWL(5);
        $ars = collect();

        foreach ($datas as $data) {

            if (Storage::disk('public')->exists('wiki/' . $data->id . '.png') == true) {
                $img = 'storage/wiki/' . $data->id . '.png';
            } else {
                $img = 'storage/wiki/wiki.png';
            }

            $ars->push([
                "id" => $data->id,
                "category" => $data->category->name . ' - ' . $data->subcategory->name,
                "title" => $data->title,
                "published" => $data->published,
                "img" => $img
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des articles");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }
}
