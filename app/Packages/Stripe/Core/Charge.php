<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 19/02/2020
 * Time: 03:08
 */

namespace App\Packages\Stripe\Core;


use App\Packages\Stripe\Stripe;

class Charge extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createCharge(int $amount, int $customer_id)
    {
        return \Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "eur",
            "customer" => $customer_id
        ]);
    }

    public function getCharge(int $charge_id)
    {
        return \Stripe\Charge::retrieve($charge_id);
    }

    public function updateCharge(int $charge_id, array $params = [])
    {
        return \Stripe\Charge::update($charge_id, $params);
    }

    public function captureCharge(int $charge_id)
    {
        $charge = $this->getCharge($charge_id);
        return $charge->capture();
    }

    public function allCharges($limit = 3)
    {
        return \Stripe\Charge::all(["limit" => $limit]);
    }
}
