<?php

namespace App\Http\Controllers;

use Inacho\CreditCard;

class TestController extends Controller
{
    public function test()
    {
        dd(CreditCard::validCvc('999', 'visa'));
    }
}
