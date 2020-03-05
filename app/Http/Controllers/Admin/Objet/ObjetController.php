<?php

namespace App\Http\Controllers\Admin\Objet;

use App\Http\Controllers\Controller;

class ObjetController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view("admin.objet.index");
    }
}
