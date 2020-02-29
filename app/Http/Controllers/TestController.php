<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

class TestController extends Controller
{
    public function test()
    {
        //dd(now()->hour);

        if(now()->hour >= 7 && now()->hour <= 18){
            return 'jours';
        }else{
            return 'nuit';
        }
    }
}
