<?php

namespace App\Http\Controllers\Api\Admin\Route;

use App\Http\Controllers\Api\BaseController;
use App\Repository\Route\RouteTypeDownloadRepository;
use App\Repository\Route\RouteTypeReleaseRepository;
use Illuminate\Http\Request;

class RouteConfigController extends BaseController
{
    /**
     * @var RouteTypeDownloadRepository
     */
    private $routeTypeDownloadRepository;
    /**
     * @var RouteTypeReleaseRepository
     */
    private $routeTypeReleaseRepository;

    /**
     * RouteConfigController constructor.
     * @param RouteTypeDownloadRepository $routeTypeDownloadRepository
     * @param RouteTypeReleaseRepository $routeTypeReleaseRepository
     */
    public function __construct(RouteTypeDownloadRepository $routeTypeDownloadRepository, RouteTypeReleaseRepository $routeTypeReleaseRepository)
    {
        $this->routeTypeDownloadRepository = $routeTypeDownloadRepository;
        $this->routeTypeReleaseRepository = $routeTypeReleaseRepository;
    }

    public function loadTypeDownload(Request $request)
    {
        $datas = $alldatas = $this->routeTypeDownloadRepository->all()->toArray();
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $request->all());

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
    public function loadTypeRelease(Request $request)
    {
        $datas = $alldatas = $this->routeTypeReleaseRepository->all()->toArray();
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $request->all());

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

    public function deleteType(Request $request, $type_id)
    {
        try {
            $this->routeTypeDownloadRepository->delete($type_id);

            return redirect()->back()->with('success', "Le type de téléchargement à été supprimer");
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression du type de téléchargement");
        }
    }
    public function deleteTypeRelease(Request $request, $release_id)
    {
        try {
            $this->routeTypeReleaseRepository->delete($release_id);

            return redirect()->back()->with('success', "Le type de release à été supprimer");
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', "Erreur lors de la suppression du type de release");
        }
    }

    public function store(Request $request)
    {
        try {
            $this->routeTypeDownloadRepository->create($request->name);

            return $this->sendResponse('ok', 'ok');
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
    public function storeRelease(Request $request)
    {
        try {
            $this->routeTypeReleaseRepository->create($request->name);

            return $this->sendResponse('ok', 'ok');
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
