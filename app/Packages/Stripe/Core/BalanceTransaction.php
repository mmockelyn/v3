<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 19/02/2020
 * Time: 03:06
 */

namespace App\Packages\Stripe\Core;


use App\Packages\Stripe\Stripe;

class BalanceTransaction extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function allBalances($limit = 3)
    {
        return \Stripe\BalanceTransaction::all(["limit" => $limit]);
    }

    public function getBalance($id)
    {
        return \Stripe\BalanceTransaction::retrieve($id);
    }
}
