<?php
namespace App\Repository\Account;

use App\Model\Account\UserPremium;

class UserPremiumRepository
{
    /**
     * @var UserPremium
     */
    private $userPremium;

    /**
     * UserPremiumRepository constructor.
     * @param UserPremium $userPremium
     */

    public function __construct(UserPremium $userPremium)
    {
        $this->userPremium = $userPremium;
    }

}

