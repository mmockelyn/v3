<?php

namespace App\Http\Controllers\Api\Admin\Route;

use function App\HelpersClass\list_filter;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Route\RouteAnomalieRepository;
use App\Repository\Route\RouteRepository;
use Illuminate\Http\Request;


class RouteLabController extends BaseController
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;
    /**
     * @var RouteAnomalieRepository
     */
    private $routeAnomalieRepository;

    /**
     * RouteLabController constructor.
     * @param RouteRepository $routeRepository
     * @param RouteAnomalieRepository $routeAnomalieRepository
     */
    public function __construct(RouteRepository $routeRepository, RouteAnomalieRepository $routeAnomalieRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->routeAnomalieRepository = $routeAnomalieRepository;
    }

    public function store(Request $request, $route_id)
    {
        $validator = \Validator::make($request->all(), [
            "correction" => "required",
            "lieu" => "required",
            "state" => "required"
        ]);

        if($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            $anomalie = $this->routeAnomalieRepository->create(
                $route_id,
                $request->anomalie,
                $request->correction,
                $request->lieu,
                $request->state
            );

            return $this->sendResponse($anomalie, "OK");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function loadAnomalies(Request $request, $route_id)
    {
        $datas = $alldatas = $this->routeAnomalieRepository->listFromRoute($route_id)->toArray();
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $request->all());
        $filter = isset($datatable['query']['anomalieSearch']) && is_string($datatable['query']['anomalieSearch']) ? $datatable['query']['anomalieSearch'] : '';

        // filtre de recherche par mots clés
        if (!empty($filter)) {
            $datas = array_filter($datas, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
            });
            unset($datatable['query']['anomalieSearch']);
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

    public function updateAnomalie(Request $request, $route_id, $anomalie_id)
    {
        try {
            $this->routeAnomalieRepository->update(
                $anomalie_id,
                $request->anomalie,
                $request->correction,
                $request->lieu,
                $request->state
            );

            return $this->sendResponse("ok", "ok");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteAnomalie($route_id, $anomalie_id)
    {
        try {
            $this->routeAnomalieRepository->delete($anomalie_id);

            return redirect()->back()->with('success', "L'anomalie à été supprimer avec succès");
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
