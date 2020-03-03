<?php

namespace App\Http\Controllers\Api\Admin\Route;

use function App\HelpersClass\list_filter;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Route\RouteDownloadRepository;
use App\Repository\Route\RouteUpdaterRepository;
use Illuminate\Http\Request;

class RouteDownloadController extends BaseController
{
    /**
     * @var RouteDownloadRepository
     */
    private $routeDownloadRepository;
    /**
     * @var RouteUpdaterRepository
     */
    private $routeUpdaterRepository;

    /**
     * RouteDownloadController constructor.
     * @param RouteDownloadRepository $routeDownloadRepository
     * @param RouteUpdaterRepository $routeUpdaterRepository
     */
    public function __construct(RouteDownloadRepository $routeDownloadRepository, RouteUpdaterRepository $routeUpdaterRepository)
    {
        $this->routeDownloadRepository = $routeDownloadRepository;
        $this->routeUpdaterRepository = $routeUpdaterRepository;
    }

    public function loadDownload(Request $request, $route_id)
    {
        $downloads = $this->routeDownloadRepository->listAllFromRoute($route_id);
        $arrs = [];
        foreach ($downloads as $download) {
            $arrs[] = [
                "id" => $download->id,
                "version" => $download->version,
                "build" => $download->build,
                "typedownload" => $download->typeDownload->name,
                "typerelease" => $download->typeRelease->name,
                "published" => $download->published,
                "linkDownload" => $download->linkDownload,
                "note" => $download->note
            ];
        }

        $datas = $alldatas = $arrs;
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $request->all());
        $filter = isset($datatable['query']['downloadSearch']) && is_string($datatable['query']['downloadSearch']) ? $datatable['query']['downloadSearch'] : '';

        // filtre de recherche par mots clés
        if (!empty($filter)) {
            $datas = array_filter($datas, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
            });
            unset($datatable['query']['downloadSearch']);
        }

        //filtrer par requête de champ
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $datas = list_filter($datas, [$key => $val]);
            }
        }

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

    public function loadUpdater(Request $request, $route_id)
    {
        $datas = $alldatas = $this->routeUpdaterRepository->list()->toArray();
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $request->all());
        $filter = isset($datatable['query']['updaterSearch']) && is_string($datatable['query']['updaterSearch']) ? $datatable['query']['updaterSearch'] : '';

        // filtre de recherche par mots clés
        if (!empty($filter)) {
            $datas = array_filter($datas, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
            });
            unset($datatable['query']['updaterSearch']);
        }

        //filtrer par requête de champ
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $datas = list_filter($datas, [$key => $val]);
            }
        }

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

    public function storeDownload(Request $request, $route_id)
    {
        $validator = \Validator::make($request->all(), [
            "version" => "required",
            "build" => "required",
            "linkDownload" => "required|url"
        ]);

        if($validator->fails()) {
            return $this->sendError("Ereur de validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            if($request->exists('published') == true){$published = 1;}else{$published = 0;}
            $download = $this->routeDownloadRepository->create(
                $route_id,
                $request->version,
                $request->build,
                $request->type_download,
                $request->type_release,
                $request->linkDownload,
                $request->note,
                $published
            );

            return $this->sendResponse($download, "OK");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function storeUpdater(Request $request, $route_id)
    {
        $validator = \Validator::make($request->all(), [
            "version" => "required",
            "build" => "required",
            "linkRelease" => "required|url"
        ]);

        if($validator->fails()) {
            return $this->sendError("Ereur de validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            if($request->exists('latest') == true){
                $latest = 1;
                $updates = $this->routeUpdaterRepository->listForRoute($route_id);
                foreach ($updates as $update) {
                    $this->routeUpdaterRepository->updateLatestNone($update->id);
                }
            }else{
                $latest = 0;
            }
            $download = $this->routeUpdaterRepository->create(
                $route_id,
                $request->version,
                $request->build,
                $latest,
                $request->linkRelease
            );

            return $this->sendResponse($download, "OK");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
