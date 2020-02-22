<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view("front.blog.index");
    }
}
