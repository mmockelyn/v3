<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function linter()
    {
        exec('cd ../ && tlint lint app --json', $val);
        dd($val);
    }
}
