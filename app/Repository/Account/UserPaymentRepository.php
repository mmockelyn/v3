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

}

