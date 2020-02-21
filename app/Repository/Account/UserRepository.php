<?php
namespace App\Repository\Account;

use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser($id)
    {
        return $this->user->newQuery()
            ->find($id);
    }

}

