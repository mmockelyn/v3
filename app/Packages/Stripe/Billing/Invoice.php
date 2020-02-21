<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 21/02/2020
 * Time: 23:25
 */

namespace App\Packages\Stripe\Billing;


use App\Packages\Stripe\Stripe;

class Invoice extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        return \Stripe\Invoice::create();
    }

    public function retrieve($invoice_id)
    {
        return \Stripe\Invoice::retrieve($invoice_id);
    }
}
