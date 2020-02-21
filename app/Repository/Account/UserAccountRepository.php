<?php
namespace App\Repository\Account;

use App\Model\Account\UserAccount;

class UserAccountRepository
{
    /**
     * @var UserAccount
     */
    private $userAccount;

    /**
     * UserAccountRepository constructor.
     * @param UserAccount $userAccount
     */

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }

    public function updateTwitter($name)
    {
        return $this->userAccount->newQuery()
            ->where('user_id', auth()->user()->id)
            ->first()
            ->update([
                "pseudo_twitter" => $name
            ]);
    }

    public function updateFacebook($getName)
    {
        return $this->userAccount->newQuery()
            ->where('user_id', auth()->user()->id)
            ->first()
            ->update([
                "pseudo_facebook" => $getName
            ]);
    }

}

