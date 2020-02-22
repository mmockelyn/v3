<?php
namespace App\Repository\Account;

use App\Model\Account\UserPayment;

class UserPaymentRepository
{
    /**
     * @var UserPayment
     */
    private $userPayment;

    /**
     * UserPaymentRepository constructor.
     * @param UserPayment $userPayment
     */

    public function __construct(UserPayment $userPayment)
    {
        $this->userPayment = $userPayment;
    }

    public function getForUser($id)
    {
        return $this->userPayment->newQuery()
            ->where('user_id', $id)
            ->first();
    }

    public function update($id, $id1, $type, $substr)
    {
        $this->userPayment->newQuery()
            ->where('user_id', $id)
            ->first()
            ->update([
                "stripe_id" => $id1,
                "card_brand" => $type,
                "card_last_four" => $substr
            ]);

        return null;
    }

    public function create($id, $type, $substr)
    {
        return $this->userPayment->newQuery()
            ->create([
                "user_id" => auth()->user()->id,
                "stripe_id" => $id,
                "card_brand" => $type,
                "card_last_four" => $substr
            ]);
    }

    public function delete($pm_id)
    {
        return $this->userPayment->newQuery()
            ->where('stripe_id', $pm_id)
            ->first()
            ->delete();
    }

}

