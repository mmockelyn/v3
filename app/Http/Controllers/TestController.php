<?php

namespace App\Http\Controllers;


use Webpatser\Uuid\Uuid;

class TestController extends Controller
{
    public function test()
    {
        dd(Uuid::generate());
    }
}
