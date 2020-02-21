<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Repository\Account\UserAccountRepository;
use App\Repository\Account\UserSocialRepository;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    /**
     * @var UserAccountRepository
     */
    private $accountRepository;
    /**
     * @var UserSocialRepository
     */
    private $socialRepository;

    /**
     * ProviderController constructor.
     * @param UserAccountRepository $accountRepository
     * @param UserSocialRepository $socialRepository
     */
    public function __construct(UserAccountRepository $accountRepository, UserSocialRepository $socialRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->socialRepository = $socialRepository;
    }

    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $getInfo = Socialite::driver($provider)->user();
        switch ($provider) {
            case 'twitter':
                $this->accountRepository->updateTwitter($getInfo->getName());
                break;

            case 'facebook':
                $this->accountRepository->updateFacebook($getInfo->getName());
                break;

            case 'discord':
                $this->socialRepository->updateDiscord($getInfo->getId(), $getInfo->getNickname());
                break;
        }

        return redirect()->route('Account.index');
    }
}
