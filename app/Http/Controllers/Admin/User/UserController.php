<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('admin.user.index');
    }
}
