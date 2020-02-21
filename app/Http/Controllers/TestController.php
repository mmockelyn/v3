<?php

namespace App\Http\Controllers;

use App\Packages\Stripe\Billing\Subscription;
use App\Packages\Stripe\Core\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $subscription = new Subscription();
        $sub = $subscription->retrieve('sub_GmIROVz73h3MTv');
        dd($sub);
    }
}
