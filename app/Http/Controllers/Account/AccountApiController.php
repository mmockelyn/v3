<?php

namespace App\Http\Controllers\Account;

use App\HelpersClass\Account\AccountActivityHelper;
use App\HelpersClass\Generator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Account\UserActivityRepository;
use Carbon\Carbon;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class AccountApiController extends BaseController
{
    /**
     * @var UserActivityRepository
     */
    private $activityRepository;

    /**
     * AccountApiController constructor.
     * @param UserActivityRepository $activityRepository
     */
    public function __construct(UserActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function loadLatestActivity()
    {
        $activities = $this->activityRepository->allWithLimit(10);
        ob_start();
        ?>
        <div class="kt-notification">
            <?php if (count($activities) == 0): ?>
                <a href="#" class="kt-notification__item">
                    <span class="text-center">Aucune activité recente</span>
                </a>
            <?php else: ?>
                <?php foreach ($activities as $activity): ?>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="<?= $activity->icon; ?> kt-font-<?= AccountActivityHelper::stateActivity($activity->state) ?>"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                <?= $activity->description; ?>
                            </div>
                            <div class="kt-notification__item-time">
                                <?= $activity->updated_at->diffForHumans(); ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Activities");
    }

    public function disconnect(Request $request)
    {
        switch ($request->get('provider')) {
            case 'twitter':

        }
    }

    public function loadLatestInvoice()
    {
        $stripe = new Stripe(env("STRIPE_SECRET"));

        $invoices =
        //dd($invoices);
        ob_start();
        ?>
        <?php foreach ($invoices as $k => $invoice): ?>
        <tr>
            <td><?= Carbon::createFromTimestamp($invoice[$k]['data']["created"])->format('d/m/Y') ?></td>
            <td><?= Generator::formatCurrency($invoice->total); ?></td>
            <td><a class="kt-font-success kt-font-bold"><i class="la la-download"></i> </a></td>
        </tr>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Invoices");
    }
}
