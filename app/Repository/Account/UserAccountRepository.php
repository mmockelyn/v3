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

    public function update($id, $site_web, $trainz_id)
    {
        $this->userAccount->newQuery()
            ->where('user_id', $id)
            ->first()
            ->update([
                "site_web" => $site_web,
                "trainz_id" => $trainz_id
            ]);

        return null;
    }

    public function addCustomerId($id)
    {
        $this->userAccount->newQuery()
            ->where('user_id', auth()->user()->id)
            ->first()
            ->update(['customer_id' => $id]);

        return null;
    }

    public function latestLogin()
    {
        return $this->userAccount->newQuery()
            ->where('last_login', '!=', null)
            ->orderBy('last_login', 'desc')
            ->limit(5)
            ->get();
    }

}

