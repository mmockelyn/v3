<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 21/02/2020
 * Time: 18:52
 */

namespace App\Packages\Stripe\Core;


use App\Packages\Stripe\Stripe;

class Token extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createCardToken($number, $exp_month, $exp_year, $cvc)
    {
        return \Stripe\Token::create([
            "card" => [
                'number' => $number,
                'exp_month' => $exp_month,
                'exp_year' => $exp_year,
                'cvc' => $cvc
            ]
        ]);
    }
}
