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

    public function update($id, $email, $name)
    {
        $this->user->newQuery()
            ->find($id)
            ->update([
                "email" => $email,
                "name" => $name
            ]);

        return null;
    }

    public function updatePass($id, $password)
    {
        $this->user->newQuery()
            ->find($id)
            ->update([
                "password" => bcrypt($password)
            ]);

        return null;
    }

    public function delete($id)
    {
        $this->user->newQuery()
            ->find($id)
            ->delete();
    }

    public function all()
    {
        return $this->user->newQuery()
            ->get();
    }

}

