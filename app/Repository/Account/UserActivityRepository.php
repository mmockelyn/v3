<?php
namespace App\Repository\Account;

use App\Model\Account\UserActivity;

class UserActivityRepository
{
    /**
     * @var UserActivity
     */
    private $userActivity;

    /**
     * UserActivityRepository constructor.
     * @param UserActivity $userActivity
     */

    public function __construct(UserActivity $userActivity)
    {
        $this->userActivity = $userActivity;
    }

    public function allWithLimit($int)
    {
        return $this->userActivity->newQuery()
            ->where('user_id', auth()->user()->id)
            ->limit($int)
            ->orderBy('id', 'asc')
            ->get();
    }

}

