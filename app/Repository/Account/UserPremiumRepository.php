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

    public function update($id, $int, $now, $createFromTimestamp)
    {
        $this->userPremium->newQuery()
            ->where('user_id', $id)
            ->first()
            ->update([
                "premium" => $int,
                "premium_start" => $now,
                "premium_end" => $createFromTimestamp
            ]);

        return $this->userPremium->newQuery()
            ->where('user_id', $id)
            ->first();
    }

    public function create($id)
    {
        return $this->userPremium->newQuery()
            ->create([
                "user_id" => $id
            ]);
    }

}

