<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 29/01/2020
 * Time: 12:10
 */

namespace App\HelpersClass\Account;


use App\User;
use Carbon\Carbon;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Support\Facades\DB;

class AccountHelper
{
    public static function verifAvatar($email)
    {
        if (Gravatar::exists($email)) {
            return Gravatar::get($email);
        } else {
            $user = User::where('email', $email)->first();
            if (file_exists('/storage/avatar/' . $user->id . '.png')) {
                return '/storage/avatar' . $user->id . '.png';
            } else {
                $rand = rand(1, 70);
                return '/storage/avatar/placeholder/'.$rand.'.png';
            }
        }
    }

    public static function listNotificationLimit($limit) {
        $data = DB::table('notifications')->where('notifiable_id', auth()->user()->id)
            ->limit($limit)
            ->get();

        return $data;
    }

    public static function cardIsValid($exp_month, $exp_year)
    {
        $date = Carbon::createFromDate($exp_year, $exp_month, 1);
        if($date <= now()) {
            return '<span class="iconify" data-inline="false" data-icon="uil:times" style="font-size: 16px; color: #dd2e35"></span> Expiré';
        }else{
            return '<span class="iconify" data-inline="false" data-icon="ant-design:check-outlined" style="font-size: 16px; color: #5ec47c"></span> Vérifié';
        }
    }

    public static function typeCardIcon($type_card)
    {
        switch ($type_card) {
            case 'visa': return 'la la-cc-visa'; break;
            case 'amex': return 'la la-cc-amex'; break;
            case 'diners-club': return 'la la-cc-diners-club'; break;
            case 'discover': return 'la la-cc-discover'; break;
            case 'jcb': return 'la la-cc-jcb'; break;
            case 'mastercard': return 'la la-cc-mastercard'; break;
            case 'paypal': return 'la la-cc-paypal'; break;
            case 'stripe': return 'la la-cc-stripe'; break;
            default: return 'la la-cc';
        }
    }
}
