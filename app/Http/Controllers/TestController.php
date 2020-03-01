<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

class TestController extends Controller
{
    public function test()
    {
        dd(file_exists(public_path('storage/blog/4.png')));
    }
}
