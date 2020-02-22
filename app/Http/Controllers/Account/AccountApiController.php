<?php

namespace App\Http\Controllers\Account;

use App\Events\Account\UpdateInfoEvent;
use App\HelpersClass\Account\AccountActivityHelper;
use App\HelpersClass\Account\AccountHelper;
use App\HelpersClass\Generator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Jobs\Account\NewSubscriptionJob;
use App\Jobs\Account\UpdateInfoJob;
use App\Jobs\Account\UpdatePassJob;
use App\Model\Account\UserAccount;
use App\Notifications\Account\UpdateInfoNotification;
use App\Notifications\Account\UpdatePasswordNotification;
use App\Packages\Stripe\Billing\Invoice;
use App\Packages\Stripe\Billing\InvoiceItem;
use App\Packages\Stripe\Billing\Subscription;
use App\Packages\Stripe\Core\Customer;
use App\Packages\Stripe\PaymentMethod\PaymentMethod;
use App\Repository\Account\InvoiceItemRepository;
use App\Repository\Account\InvoiceRepository;
use App\Repository\Account\UserAccountRepository;
use App\Repository\Account\UserActivityRepository;
use App\Repository\Account\UserPaymentRepository;
use App\Repository\Account\UserPremiumRepository;
use App\Repository\Account\UserRepository;
use App\Repository\Blog\BlogCommentRepository;
use App\Repository\Tutoriel\TutorielCommentRepository;
use Carbon\Carbon;
use Cartalyst\Stripe\Exception\StripeException;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inacho\CreditCard;

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
     * @var UserPaymentRepository
     */
    private $paymentRepository;
    /**
     * @var UserPremiumRepository
     */
    private $premiumRepository;
    /**
     * @var InvoiceItemRepository
     */
    private $invoiceItemRepository;
    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;
    /**
     * @var TutorielCommentRepository
     */
    private $tutorielCommentRepository;

    /**
     * AccountApiController constructor.
     * @param UserActivityRepository $activityRepository
     * @param InvoiceRepository $invoiceRepository
     * @param UserRepository $userRepository
     * @param UserAccountRepository $accountRepository
     * @param UserPaymentRepository $paymentRepository
     * @param UserPremiumRepository $premiumRepository
     * @param InvoiceItemRepository $invoiceItemRepository
     * @param BlogCommentRepository $blogCommentRepository
     * @param TutorielCommentRepository $tutorielCommentRepository
     */
    public function __construct(
        UserActivityRepository $activityRepository,
        InvoiceRepository $invoiceRepository,
        UserRepository $userRepository,
        UserAccountRepository $accountRepository,
        UserPaymentRepository $paymentRepository,
        UserPremiumRepository $premiumRepository,
        InvoiceItemRepository $invoiceItemRepository,
        BlogCommentRepository $blogCommentRepository, TutorielCommentRepository $tutorielCommentRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->userRepository = $userRepository;
        $this->accountRepository = $accountRepository;
        $this->paymentRepository = $paymentRepository;
        $this->premiumRepository = $premiumRepository;
        $this->invoiceItemRepository = $invoiceItemRepository;
        $this->blogCommentRepository = $blogCommentRepository;
        $this->tutorielCommentRepository = $tutorielCommentRepository;
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
        $invoices = $this->invoiceRepository->listForUser(auth()->user()->id, 5);
        //dd($invoices);
        ob_start();
        ?>
        <?php if (count($invoices) != 0): ?>
        <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $invoice->date->format('d/m/Y') ?></td>
                <td><?= Generator::formatCurrency($invoice->total); ?></td>
                <td><a href="<?= route('Account.Invoice.show', $invoice->id) ?>" class="kt-font-success kt-font-bold"><i class="la la-download"></i> </a></td>
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

            dispatch(new UpdateInfoJob(auth()->user()))->delay(now()->addMinute())->onQueue('account');

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
            dispatch(new UpdatePassJob(auth()->user()))->delay(now()->addMinute())->onQueue('account');
            return $this->sendResponse("Done !", "Done");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function delete()
    {
        try {
            $this->userRepository->delete(auth()->user()->id);

            $this->sendResponse("Done", "Done");
        } catch (\Exception $exception) {
            $this->sendError("Erreur Système", [
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function verifCarte()
    {
        $data = $this->paymentRepository->getForUser(auth()->user()->id);

        if ($data->stripe_id == null) {
            return $this->sendResponse(false, "Aucune Carte");
        } else {
            return $this->sendResponse(true, "Carte Disponible");
        }
    }

    public function addMethodPayment(Request $request)
    {
        //dd($request->all());
        $customer = new Customer();
        $pm = new PaymentMethod();
        $subscription = new Subscription();

        $client_id = auth()->user()->account->customer_id;
        if($client_id == null){
            $cs = $customer->create(auth()->user()->email, auth()->user()->name);
            $this->accountRepository->addCustomerId($cs->id);
        }else{
            $cs = $customer->retrieve($client_id);
        }

        try {
            $method = $pm->create($request->number, $request->exp_month, $request->exp_year, $request->cvc);
            $over = $pm->attachToCustomer($cs->id, $method->id);


            $card_brand = CreditCard::validCreditCard($request->number);

            $this->paymentRepository->update(auth()->user()->id, $over->id, $card_brand['type'], Str::substr($request->number, 12, 4));
            $customer->update($cs->id, [
                "invoice_settings" => [
                    "default_payment_method" => $over->id
                ]
            ]);

            try {
                $subs = $subscription->create($cs->id, $request->plan);
                $premium = $this->premiumRepository->update(auth()->user()->id, 1, now(), Carbon::createFromTimestamp($subs->current_period_end));

                $this->registerInvoice($subs->latest_invoice);

                dispatch(new NewSubscriptionJob(auth()->user(), $premium))->delay(now()->addMinute())->onQueue('account');
                return $this->sendResponse($premium->premium_end->format('d/m/Y'), "Création de la souscription");
            }catch (StripeException $exception) {
                return $this->sendError("Erreur lors de la souscription", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }catch (StripeException $exception) {
            return $this->sendError("Erreur de Création de moyen de paiement", [
                "errors" => $exception->getMessage()
            ]);
        }


    }

    public function invoice($invoice_id) {
        $invoice = $this->invoiceRepository->get($invoice_id);
        ob_start();
        ?>
        <?php foreach ($invoice->items as $item): ?>
            <tr>
                <td><?= $item->item; ?></td>
                <td><?= Generator::formatCurrency($item->unitPrice); ?></td>
                <td><?= $item->qte; ?></td>
                <td><?= $item->total_price; ?></td>
            </tr>
        <?php endforeach; ?>
        <?php
        $items = ob_get_clean();

        $array = [
            "invoice_id" => $invoice->id,
            "user" => [
                "name" => $invoice->user->name,
                "email" => $invoice->user->email
            ],
            "number_invoice" => $invoice->number_invoice,
            "date" => $invoice->date->format('d/m/Y'),
            "total" => Generator::formatCurrency($invoice->total)
        ];

        return $this->sendResponse(["invoice" => $array, "items" => $items], "Invoice");
    }

    public function loadContribBlog() {
        $datas = $this->blogCommentRepository->getLastForUser(5);
        ob_start();
        ?>
        <div class="kt-timeline-v3">
            <div class="kt-timeline-v3__items">
                <?php foreach ($datas as $data): ?>
                    <?php if($data->state == 0): ?>
                        <div class="kt-timeline-v3__item kt-timeline-v3__item--danger">
                            <span class="kt-timeline-v3__item-time"><?= $data->updated_at->format('d/m'); ?></span>
                            <div class="kt-timeline-v3__item-desc">
                        <span class="kt-timeline-v3__item-text">
                            <?= $data->comment; ?>
                        </span>
                                <br>
                                <span class="kt-timeline-v3__item-user-name">
                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                <?= $data->blog->title; ?> | Posté le <?= $data->blog->published_at->format('d/m/Y à H:i') ?>
                            </a>
                        </span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="kt-timeline-v3__item kt-timeline-v3__item--success">
                            <span class="kt-timeline-v3__item-time"><?= $data->updated_at->format('d/m'); ?></span>
                            <div class="kt-timeline-v3__item-desc">
                        <span class="kt-timeline-v3__item-text">
                            <?= $data->comment; ?>
                        </span>
                                <br>
                                <span class="kt-timeline-v3__item-user-name">
                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                <?= $data->blog->title; ?> | Posté le <?= $data->blog->published_at->format('d/m/Y à H:i') ?>
                            </a>
                        </span>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Contribution");
    }

    public function loadContribTutoriel()
    {
        $datas = $this->tutorielCommentRepository->getLastForUser(5);
        ob_start();
        ?>
        <div class="kt-timeline-v3">
            <div class="kt-timeline-v3__items">
                <?php foreach ($datas as $data): ?>
                    <?php if($data->published == 0): ?>
                        <div class="kt-timeline-v3__item kt-timeline-v3__item--danger">
                            <span class="kt-timeline-v3__item-time"><?= $data->published_at; ?></span>
                            <div class="kt-timeline-v3__item-desc">
                        <span class="kt-timeline-v3__item-text">
                            <?= $data->content; ?>
                        </span>
                                <br>
                                <span class="kt-timeline-v3__item-user-name">
                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                <?= $data->tutoriel->title; ?> | Posté le <?= $data->tutoriel->published_at->format('d/m/Y à H:i') ?>
                            </a>
                        </span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="kt-timeline-v3__item kt-timeline-v3__item--success">
                            <span class="kt-timeline-v3__item-time"><?= $data->published_at->format('d/m'); ?></span>
                            <div class="kt-timeline-v3__item-desc">
                        <span class="kt-timeline-v3__item-text">
                            <?= $data->content; ?>
                        </span>
                                <br>
                                <span class="kt-timeline-v3__item-user-name">
                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                <?= $data->tutoriel->title; ?> | Posté le <?= $data->tutoriel->published_at->format('d/m/Y à H:i') ?>
                            </a>
                        </span>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Contribution");
    }

    public function invoices(Request $request)
    {
        if($request->state == 'search'){
            $datas = $this->invoiceRepository->listForUserByDate($request->q);
            ob_start();
            ?>
            <?php if(count($datas) == 0): ?>
                <tr>
                    <td colspan="4" class="text-center">Aucune Facture de disponible</td>
                </tr>
            <?php else: ?>
                <?php foreach ($datas as $data): ?>
                    <tr>
                        <td><?= $data->id; ?></td>
                        <td><?= $data->date->format('d/m/Y'); ?></td>
                        <td><?= Generator::formatCurrency($data->total); ?></td>
                        <td>
                            <button id="btnViewInvoice" data-id="<?= $data->id; ?>" class="btn btn-sm btn-primary btn-icon"><i class="la la-eye"></i> </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php
            $content = ob_get_clean();

            return $this->sendResponse($content, "Liste des factures par date");
        }else {
            $datas = $this->invoiceRepository->listForUser(auth()->user()->id);
            ob_start();
            ?>
            <?php if(count($datas) == 0): ?>
                <tr>
                    <td colspan="4" class="text-center">Aucune Facture de disponible</td>
                </tr>
            <?php else: ?>
                <?php foreach ($datas as $data): ?>
                    <tr>
                        <td><?= $data->id; ?></td>
                        <td><?= $data->date->format('d/m/Y'); ?></td>
                        <td><?= Generator::formatCurrency($data->total); ?></td>
                        <td>
                            <button id="btnViewInvoice" data-id="<?= $data->id; ?>" class="btn btn-sm btn-primary btn-icon"><i class="la la-eye"></i> </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php
            $content = ob_get_clean();

            return $this->sendResponse($content, "Liste des factures");
        }
    }

    public function loadPayments() {
        $payment = new PaymentMethod();
        try {
            $pms = $payment->listByCustomer(auth()->user()->account->customer_id);
        }catch (StripeException $exception) {
            return $this->sendError("Erreur de chargement des modes de paiements", [
                "errors" => $exception->getMessage()
            ]);
        }
        ob_start();
        ?>
        <?php if(count($pms) == 0): ?>
            <tr>
                <td colspan="2" class="text-center">Aucun Moyen de paiement enregistrer</td>
            </tr>
        <?php else: ?>
            <?php foreach ($pms as $pm): ?>
                <tr <?php if(Carbon::createFromTimestamp(strtotime('01-'.$pm->card->exp_month.'-'.$pm->card->exp_year)) <= now()): ?> class="table-danger" <?php endif; ?>>
                    <td>
                        <div class="row">
                            <div class="col-md-1"><i class="<?= AccountHelper::typeCardIcon($pm->card->brand) ?> la-3x"></i> </div>
                            <div class="col-md-11">
                                <strong>XXXX XXXX XXXX <?= $pm->card->last4; ?></strong><br>
                                <i>Expiration: <?= $pm->card->exp_month; ?>/<?= $pm->card->exp_year; ?></i>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if(count($pms) >= 2): ?>
                            <button id="btnDeleteMethod" data-id="<?= $pm->id; ?>" class="btn btn-sm btn-danger btn-icon"><i class="la la-trash-o"></i> </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Liste des moyens de paiement");
    }

    public function createMethodPayment(Request $request)
    {
        $customer = new Customer();
        $PaymentMethod = new PaymentMethod();

        //dd($request->all());

        $card = $this->verifCardNumber($request->number);
        $this->verifCardValidity($request->exp_month, $request->exp_year);
        //$this->verifCardCvc($request->cvc, $card['type']);

        try {
            $pm = $PaymentMethod->create($request->number, $request->exp_month, $request->exp_year, $request->cvc);
            $PaymentMethod->attachToCustomer(auth()->user()->account->customer_id, $pm->id);

            try {
                $data = $this->paymentRepository->create($pm->id, $card['type'], Str::substr($request->number, 12, 4));
                $pms = $PaymentMethod->listByCustomer(auth()->user()->account->customer_id);
                $pm = $PaymentMethod->get($data->stripe_id);
                ob_start();
                ?>
                <tr <?php if(Carbon::createFromTimestamp(strtotime('01-'.$pm->card->exp_month.'-'.$pm->card->exp_year)) <= now()): ?> class="table-danger" <?php endif; ?>>
                    <td>
                        <div class="row">
                            <div class="col-md-1"><i class="<?= AccountHelper::typeCardIcon($pm->card->brand) ?> la-3x"></i> </div>
                            <div class="col-md-11">
                                <strong>XXXX XXXX XXXX <?= $pm->card->last4; ?></strong><br>
                                <i>Expiration: <?= $pm->card->exp_month; ?>/<?= $pm->card->exp_year; ?></i>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if(count($pms) >= 2): ?>
                            <button id="btnDeleteMethod" data-id="<?= $pm->id; ?>" class="btn btn-sm btn-danger btn-icon"><i class="la la-trash-o"></i> </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
                $content = ob_get_clean();

                return $this->sendResponse($content, "Nouveau Moyen de paiement");
            }catch (\Exception $exception) {
                return $this->sendError("Erreur Système createMethodPayment Database", [
                    "errors" => $exception->getMessage()
                ]);
            }

        }catch (StripeException $exception) {
            return $this->sendError("Erreur Systeme PaymentMethod Stripe", [
                "errors" => $exception->getMessage()
            ]);
        }

    }

    public function deletePayment($pm_id)
    {
        $paymentMethod = new PaymentMethod();

        try {
            $pm = $paymentMethod->detachToCustomer($pm_id);

            try {
                $this->paymentRepository->delete($pm_id);

                $this->sendResponse($pm, "Suppression du mode de paiement");
            }catch (\Exception $exception) {
                return $this->sendError("Erreur Delete PaymentMethod", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }catch (StripeException $exception) {
            return $this->sendError("Erreur Detach Stripe PaymentMethod", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    private function registerInvoice($latest_invoice_id) {
        $invoice = new Invoice();
        $in = $invoice->retrieve($latest_invoice_id);

        try {
            $inc = $this->invoiceRepository->create(
                auth()->user()->id,
                $in->number,
                Carbon::createFromTimestamp($in->created),
                number_format($in->total/100, 2, '.', ' ')
            );

            foreach ($in->lines->all() as $item) {
                $this->invoiceItemRepository->create($inc->id, $item->description, 1, number_format($item->amount/100, 2, '.', ' '), number_format($item->amount/100, 2, '.', ' '));
            }

            return $this->sendResponse($inc, "Création de facture");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur création facture", [
                "errors" => $exception->getMessage()
            ]);
        }

    }

    private function verifCardNumber($card_number) {
        $data = CreditCard::validCreditCard($card_number);

        if($data['valid'] == true) {
            return $data;
        }else{
            return $this->sendError("Carte Invalide", "Le numéro de la carte est invalide", 203);
        }
    }

    private function verifCardValidity($exp_month, $exp_year) {
        if(Carbon::createFromTimestamp(strtotime('01-'.$exp_month.'-'.$exp_year)) <= now()) {
            return $this->sendError("Carte Invalide", "La carte est arrivée à expiration. Veuillez contacter votre banque !", 203);
        }else{
            return null;
        }
    }

    private function verifCardCvc($cvc, $type) {
        $data = CreditCard::validCvc($cvc, $type);
        if($data == true) {
            return $data;
        }else{
            return $this->sendError("Carte Invalide", "Le code de sécurité est invalide !", 203);
        }
    }

}
