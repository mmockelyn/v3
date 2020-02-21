<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 19/02/2020
 * Time: 03:00
 */

namespace App\Packages\Stripe;


class Stripe
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
