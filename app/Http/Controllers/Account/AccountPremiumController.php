<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class AccountPremiumController extends Controller
{
    public function __construct()
    {
    }

    public function index() {
        return view("account.premium.index");
    }
}
