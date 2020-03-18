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

    public function latestSubscribe()
    {
        return $this->user->newQuery()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function create($name, $email, string $bcrypt, $group)
    {
        return $this->user->newQuery()
            ->create([
                "name" => $name,
                "email" => $email,
                "password" => $bcrypt,
                "group" => $group
            ]);
    }

    public function ban($user_id)
    {
        return $this->getUser($user_id)->update([
            "state" => 0
        ]);
    }

    public function unban($user_id)
    {
        return $this->getUser($user_id)->update([
            "state" => 1
        ]);
    }

}

