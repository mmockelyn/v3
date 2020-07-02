<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends BaseController
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * AccountController constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        dd($request->all());
    }

    public function register(Request $request)
    {
        dd($request->all());
    }
}
