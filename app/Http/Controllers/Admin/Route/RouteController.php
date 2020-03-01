<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view("admin.route.index");
    }
}
