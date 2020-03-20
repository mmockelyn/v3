<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 18/02/2020
 * Time: 23:25
 */

namespace App\HelpersClass\Account;


use App\Model\Account\UserActivity;

class AccountActivityHelper
{
    public static function stateActivity($state)
    {
        switch ($state) {
            case 0:
                return 'danger';
            case 1:
                return 'warning';
            case 2:
                return 'success';
            default:
                return 'primary';
        }
    }

    public static function storeActivity($description, $icon, $state)
    {
        $activity = new UserActivity();
        $activity->newQuery()->create([
            "user_id" => auth()->user()->id,
            "description" => $description,
            "icon" => $icon,
            "state" => $state
        ]);
    }
}
