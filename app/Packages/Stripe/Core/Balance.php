<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 19/02/2020
 * Time: 03:02
 */

namespace App\Packages\Stripe\Core;


use App\Packages\Stripe\Stripe;
use Stripe\Charge;

class Balance extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBalance() {
        return \Stripe\Balance::retrieve();
    }


}
