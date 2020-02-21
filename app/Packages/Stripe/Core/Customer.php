<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 21/02/2020
 * Time: 18:43
 */

namespace App\Packages\Stripe\Core;


use App\Packages\Stripe\Stripe;

class Customer extends Stripe
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($email, $name)
    {
        return \Stripe\Customer::create([
            "email" => $email,
            "name" => $name
        ]);
    }

    public function retrieve($customer_id)
    {
        return \Stripe\Customer::retrieve($customer_id);
    }

    public function update($customer_id, $params = [])
    {
        return \Stripe\Customer::update($customer_id, [
            $params
        ]);
    }

    public function delete($customer_id)
    {
        $customer = \Stripe\Customer::retrieve($customer_id);

        return $customer->delete();
    }

    public function list($limit = null)
    {
        return \Stripe\Customer::all(["limit" => $limit]);
    }
}
