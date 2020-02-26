<?php
namespace App\Repository\Account;

use App\Model\Account\UserView;

class UserViewRepository
{
    /**
     * @var UserView
     */
    private $userView;

    /**
     * UserViewRepository constructor.
     * @param UserView $userView
     */

    public function __construct(UserView $userView)
    {
        $this->userView = $userView;
    }

    public function getAsLater($tutoriel_id)
    {
        return $this->userView->newQuery()
            ->where('user_id', auth()->user()->id)
            ->where('tutoriel_id', $tutoriel_id)
            ->where('later', 1)
            ->first();
    }

    public function getAsView($tutoriel_id)
    {
        return $this->userView->newQuery()
            ->where('user_id', auth()->user()->id)
            ->where('tutoriel_id', $tutoriel_id)
            ->where('watches', 1)
            ->first();
    }

    public function createAsLater($tutoriel_id)
    {
        return $this->userView->newQuery()
            ->create([
                "user_id" => auth()->user()->id,
                "tutoriel_id" => $tutoriel_id,
                "later" => 1
            ]);
    }

    public function createAsWatches($tutoriel_id)
    {
        return $this->userView->newQuery()
            ->create([
                "user_id" => auth()->user()->id,
                "tutoriel_id" => $tutoriel_id,
                "watches" => 1
            ]);
    }

}

