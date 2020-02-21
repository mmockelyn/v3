<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 21/02/2020
 * Time: 19:59
 */

namespace App\Packages\Stripe\Billing;


use App\Packages\Stripe\Stripe;

class Subscription extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($customer, $plan)
    {
        return \Stripe\Subscription::create([
            "customer" => $customer,
            "items" => [["plan" => $plan]]
        ]);
    }

    public function retrieve($sub_id)
    {
        return \Stripe\Subscription::retrieve($sub_id);
    }
}
