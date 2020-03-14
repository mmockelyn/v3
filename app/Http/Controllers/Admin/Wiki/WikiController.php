<?php

namespace App\Http\Controllers\Admin\Wiki;

use App\Http\Controllers\Controller;

class WikiController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view("admin.wiki.index");
    }
}
