<?php

namespace App\Http\Controllers;


use App\Events\TestEvent;

class TestController extends Controller
{
    public function test()
    {
        event(new TestEvent('Ceci est un test'));
    }
}
