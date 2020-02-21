<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountPremiumController extends Controller
{
    public function __construct()
    {
    }

    public function index() {
        return view("account.premium.index");
    }
}
