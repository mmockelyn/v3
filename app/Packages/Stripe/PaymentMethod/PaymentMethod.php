<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 21/02/2020
 * Time: 18:51
 */

namespace App\Packages\Stripe\PaymentMethod;


use App\Packages\Stripe\Stripe;

class PaymentMethod extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($number, $exp_month, $exp_year, $cvc)
    {
        return \Stripe\PaymentMethod::create([
            'type' => 'card',
            'card' => [
                'number' => $number,
                'exp_month' => $exp_month,
                'exp_year' => $exp_year,
                'cvc' => $cvc
            ]
        ]);
    }

    public function attachToCustomer($customer_id, $pm_id)
    {
        $pm = \Stripe\PaymentMethod::retrieve($pm_id);

        return $pm->attach([
            'customer' => $customer_id
        ]);
    }
}
