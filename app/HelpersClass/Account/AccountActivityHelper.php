<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 18/02/2020
 * Time: 23:25
 */

namespace App\HelpersClass\Account;


class AccountActivityHelper
{
    public static function stateActivity($state) {
        switch ($state) {
            case 0: return 'danger';
            case 1: return 'warning';
            case 2: return 'success';
            default: return 'primary';
        }
    }
}
