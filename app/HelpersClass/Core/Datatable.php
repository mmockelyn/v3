<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 04/03/2020
 * Time: 18:52
 */

namespace App\HelpersClass\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Datatable
{
    public function render(Request $request,Collection $datas)
    {
        $datatable = collect([
            "pagination" => [],
            "sort" => [],
            "query" => []
        ]);
        $datatable->merge($request->all());
        $filter = isset($datatable['query']['anomalieSearch']) && is_string($datatable['query']['anomalieSearch']) ? $datatable['query']['anomalieSearch'] : '';




    }

    private function filterSearch(Collection $datas, $datatable) {
        $datas->filter(function ($a, $filter) {
            return (boolean)preg_grep("/$filter/i", (array)$a);
        });
        unset($datatable['query']['anomalieSearch']);
    }
}
