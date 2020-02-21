<?php

namespace App\Http\Controllers\Account;

use App\Events\Account\UpdateInfoEvent;
use App\HelpersClass\Account\AccountActivityHelper;
use App\HelpersClass\Generator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Notifications\Account\UpdateInfoNotification;
use App\Notifications\Account\UpdatePasswordNotification;
use App\Repository\Account\InvoiceRepository;
use App\Repository\Account\UserAccountRepository;
use App\Repository\Account\UserActivityRepository;
use App\Repository\Account\UserRepository;
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
     * @var InvoiceRepository
     */
    private $invoiceRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserAccountRepository
     */
    private $accountRepository;

    /**
     * AccountApiController constructor.
     * @param UserActivityRepository $activityRepository
     * @param InvoiceRepository $invoiceRepository
     * @param UserRepository $userRepository
     * @param UserAccountRepository $accountRepository
     */
    public function __construct(UserActivityRepository $activityRepository, InvoiceRepository $invoiceRepository, UserRepository $userRepository, UserAccountRepository $accountRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->userRepository = $userRepository;
        $this->accountRepository = $accountRepository;
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

        $invoices = $this->invoiceRepository->listForUser(auth()->user()->id, 5);
        //dd($invoices);
        ob_start();
        ?>
        <?php if (count($invoices) != 0): ?>
        <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $invoice->date->format('d/m/Y') ?></td>
                <td><?= Generator::formatCurrency($invoice->total); ?></td>
                <td><a class="kt-font-success kt-font-bold"><i class="la la-download"></i> </a></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td class="text-center">Aucune facture disponible</td>
        </tr>
    <?php endif; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Invoices");
    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            "email" => "required",
            "name" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de Validation", ["errors" => $validator->errors()->all()], 203);
        }

        try {
            $this->userRepository->update(
                auth()->user()->id,
                $request->email,
                $request->name
            );

            $this->accountRepository->update(
                auth()->user()->id,
                $request->site_web,
                $request->trainz_id
            );

            auth()->user()->notify(new UpdateInfoNotification(auth()->user()));
            event(new UpdateInfoEvent(auth()->user()));

            return $this->sendResponse("Done !", "Done");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur de traitement", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function updatePass(Request $request)
    {
        try {
            $this->userRepository->updatePass(
                auth()->user()->id,
                $request->password
            );
            auth()->user()->notify(new UpdatePasswordNotification(auth()->user()));
            return $this->sendResponse("Done !", "Done");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
