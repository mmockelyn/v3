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

}

