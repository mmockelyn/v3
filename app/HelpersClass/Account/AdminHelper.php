<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 04/03/2020
 * Time: 13:17
 */

namespace App\HelpersClass\Account;


use App\User;
use Illuminate\Notifications\Notification;

class AdminHelper
{
    /**
     * Envoie une notification définie dans `param` à tous les administrateurs.
     * @param Notification $notification
     */
    public static function adminsNotification(Notification $notification)
    {
        $users = User::where('group', 1)->get();
        foreach ($users as $user) {
            $user->notify($notification);
        }
    }
}
