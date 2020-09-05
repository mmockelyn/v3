<?php

namespace App\Http\Controllers;


use App\Events\MyEvent;
use App\Events\TestEvent;

class TestController extends Controller
{
    public function test()
    {
        event(new MyEvent('Hello World'));
        dd('OK !');
    }
}
