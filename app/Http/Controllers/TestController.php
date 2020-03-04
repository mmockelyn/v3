<?php

namespace App\Http\Controllers;


use App\Notifications\Account\AccountCreatedNotification;
use App\User;
use Carbon\Carbon;

class TestController extends Controller
{
    public function test()
    {
        $user = User::find(1);
        $user->notify(new AccountCreatedNotification($user));
    }
}
