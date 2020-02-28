<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 28/02/2020
 * Time: 11:03
 */

namespace App\HelpersClass\Invoice;


use App\HelpersClass\Generator;
use App\Model\Account\Invoice;
use Carbon\Carbon;

class InvoiceHelper
{
    public static function loadRevenueIcomes($year = null) {
        $inv = new Invoice();
        if($year == null) {
            $data = $inv->newQuery()->whereBetween('date', [Carbon::createFromTimestamp(strtotime('01-01-'.now()->year)), Carbon::createFromTimestamp(strtotime('31-12-'.now()->year))])
                ->sum('total');
        }else{
            $data = $inv->newQuery()->whereBetween('date', [Carbon::createFromTimestamp(strtotime('01-01-'.$year)), Carbon::createFromTimestamp(strtotime('31-12-'.$year))])
                ->sum('total');
        }

        return Generator::formatCurrency($data);
    }
}
