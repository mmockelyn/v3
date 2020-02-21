<?php
namespace App\Repository\Account;

use App\Model\Account\UserSocial;

class UserSocialRepository
{
    /**
     * @var UserSocial
     */
    private $userSocial;

    /**
     * UserSocialRepository constructor.
     * @param UserSocial $userSocial
     */

    public function __construct(UserSocial $userSocial)
    {
        $this->userSocial = $userSocial;
    }

    public function updateDiscord($getId, $getNickname)
    {
        return $this->userSocial->newQuery()
            ->where('user_id', auth()->user()->id)
            ->first()
            ->update([
                "discord_id" => $getId,
                "pseudo_discord" => $getNickname
            ]);
    }

    public function updateGoogle($getNickname)
    {
        return $this->userSocial->newQuery()
            ->where('user_id', auth()->user()->id)
            ->first()
            ->update([
                "pseudo_google" => $getNickname
            ]);
    }

}

