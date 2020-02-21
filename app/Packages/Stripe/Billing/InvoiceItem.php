<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 21/02/2020
 * Time: 23:34
 */

namespace App\Packages\Stripe\Billing;


use App\Packages\Stripe\Stripe;

class InvoiceItem extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function retrieve($invoice_id)
    {
        return \Stripe\InvoiceItem::all(["invoice" => $invoice_id]);
    }
}
