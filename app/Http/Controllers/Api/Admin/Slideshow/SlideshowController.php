<?php

namespace App\Http\Controllers\Api\Admin\Slideshow;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Core\SlideshowRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SlideshowController extends BaseController
{
    /**
     * @var SlideshowRepository
     */
    private $slideshowRepository;

    /**
     * SlideshowController constructor.
     * @param SlideshowRepository $slideshowRepository
     */
    public function __construct(SlideshowRepository $slideshowRepository)
    {
        $this->slideshowRepository = $slideshowRepository;
    }

    public function list(Request $request)
    {
        $datas = $alldatas = $this->slideshowRepository->getAll()->toArray();

        $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';

        $meta = [];
        $page = !empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
        $perpage = !empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $pages = 1;
        $total = count($datas); // total items in array

        // triage
        usort($datas, function ($a, $b) use ($sort, $field) {
            if (!isset($a->$field) || !isset($b->$field)) {
                return false;
            }

            if ($sort === 'asc') {
                return $a->$field > $b->$field ? true : false;
            }

            return $a->$field < $b->$field ? true : false;
        });

        if ($perpage > 0) {
            $pages = ceil($total / $perpage); // calculate total pages
            $page = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }

            $datas = array_slice($datas, $offset, $perpage, true);
        }

        $meta = array(
            'page' => $page,
            'pages' => $pages,
            'perpage' => $perpage,
            'total' => $total,
        );

        // si tous les enregistrements sont activés, fournissez tous les identifiants
        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
            $meta['rowIds'] = array_map(function ($row) {
                foreach ($row as $first) break;
                return $first;
            }, $alldatas);
        }

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        $result = array(
            'meta' => $meta + array(
                    'sort' => $sort,
                    'field' => $field,
                ),
            'data' => $datas
        );

        return $result;
    }

    public function store(Request $request)
    {

        $slide = $this->slideshowRepository->create(
            '/storage/slideshow/',
            $request->linkArticle
        );
        $this->slideshowRepository->update($slide->id, '/storage/slideshow/'.$slide->id.'.png', $request->linkArticle);

        $file = $request->file('slide');

        $path = 'slideshow/';

        if (Storage::disk('public')->exists($path.$slide->id.'.png') == true) {
            try {
                Storage::disk('public')->delete($path.$slide->id.'.png');
                try {
                    $file->storeAs($path, $slide->id.'.png', 'public');
                    try {
                        Storage::disk('public')->setVisibility($path . $slide->id . '.png', 'public');

                        return $this->sendResponse(null, null);
                    } catch (FileException $exception) {
                            return $this->sendError("Erreur Fichier", [
                                "errors" => $exception->getMessage()
                            ]);
                        }
                } catch (FileException $exception) {
                        return $this->sendError("Erreur Fichier", [
                            "errors" => $exception->getMessage()
                        ]);
                    }
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage()
                    ]);
                }
        } else {
            try {
                $file->storeAs($path, $slide->id.'.png', 'public');
                try {
                    Storage::disk('public')->setVisibility($path . $slide->id . '.png', 'public');

                    return $this->sendResponse(null, null);
                } catch (FileException $exception) {
                    return $this->sendError("Erreur Fichier", [
                        "errors" => $exception->getMessage()
                    ]);
                }
            } catch (FileException $exception) {
                return $this->sendError("Erreur Fichier", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }
    }
}
