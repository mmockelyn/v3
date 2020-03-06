<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 04/03/2020
 * Time: 18:52
 */

namespace App\HelpersClass\Core;


use Illuminate\Http\Request;
use function App\HelpersClass\list_filter;

class Datatable
{
    public function loadDatatable(Request $request, $datas)
    {
        $alldatas = $datas;
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $request->all());
        $filter = isset($datatable['query']['anomalieSearch']) && is_string($datatable['query']['anomalieSearch']) ? $datatable['query']['anomalieSearch'] : '';

        // filtre de recherche par mots clés
        $this->searchKeyword($datas, $datatable, $filter);

        //filtrer par requête de champ
        $this->searchQuery($datas, $datatable);

        $sort = $this->sort();
        $field = $this->field();

        $coverPage = $this->definePages($datatable, $datas);
        $page = $coverPage['page'];
        $perpage = $coverPage['perpage'];

        $pages = $coverPage['pages'];
        $total = $coverPage['total']; // total items in array

        // triage
        $this->sorting($datas, $sort, $field);

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

        $meta = $this->defineMeta($page, $pages, $perpage, $total);

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

        return $meta->merge([
            'data' => $datas
        ]);
    }


    private function searchKeyword($datas, $datatable, $filter)
    {
        if (!empty($filter)) {
            $datas = array_filter($datas, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
            });
            unset($datatable['query']['anomalieSearch']);
        }
    }

    private function searchQuery($datas, $datatable)
    {
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $datas = list_filter($datas, [$key => $val]);
            }
        }
    }

    private function sort()
    {
        return !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
    }

    private function field()
    {
        return !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';
    }

    private function definePages($datatable, $datas)
    {
        if(!empty($datatable['pagination']['page'])){
            $page = $datatable['pagination']['page'];
        }else{
            $page = 1;
        }

        if(!empty($datatable['pagination']['perpage'])) {
            $perpage = $datatable['pagination']['perpage'];
        }else{
            $perpage = -1;
        }
        return collect([
            "page" => $page,
            "perpage" => $perpage,
            "pages" => 1,
            "total" => count($datas)
        ]);
    }

    private function defineMeta($page, $pages, $perpage, $total)
    {
        return collect([
            'page' => $page,
            'pages' => $pages,
            'perpage' => $perpage,
            'total' => $total,
        ]);
    }

    private function sorting($datas, $sort, $field)
    {
        usort($datas, function ($a, $b) use ($sort, $field) {
            if (!isset($a->$field) || !isset($b->$field)) {
                return false;
            }

            if ($sort === 'asc') {
                return $a->$field > $b->$field ? true : false;
            }

            return $a->$field < $b->$field ? true : false;
        });
    }
}
