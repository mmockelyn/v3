<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('account.index');
    }

    public function invoiceShow($invoice_id)
    {
        return view('account.invoice.show', [
            "invoice_id" => $invoice_id
        ]);
    }
}
