<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\HelpersClass\Core\Datatable;
use App\HelpersClass\Generator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Notifications\Account\AccountCreatedNotification;
use App\Packages\Stripe\Core\Customer;
use App\Repository\Account\UserAccountRepository;
use App\Repository\Account\UserPaymentRepository;
use App\Repository\Account\UserPremiumRepository;
use App\Repository\Account\UserRepository;
use App\Repository\Account\UserSocialRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * @var Datatable
     */
    private $datatable;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    /**
     * @var UserPaymentRepository
     */
    private $userPaymentRepository;
    /**
     * @var UserPremiumRepository
     */
    private $userPremiumRepository;
    /**
     * @var UserSocialRepository
     */
    private $userSocialRepository;

    /**
     * UserController constructor.
     * @param Datatable $datatable
     * @param UserRepository $userRepository
     * @param UserAccountRepository $userAccountRepository
     * @param UserPaymentRepository $userPaymentRepository
     * @param UserPremiumRepository $userPremiumRepository
     * @param UserSocialRepository $userSocialRepository
     */
    public function __construct(
        Datatable $datatable,
        UserRepository $userRepository,
        UserAccountRepository $userAccountRepository,
        UserPaymentRepository $userPaymentRepository,
        UserPremiumRepository $userPremiumRepository, UserSocialRepository $userSocialRepository)
    {
        $this->datatable = $datatable;
        $this->userRepository = $userRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->userPaymentRepository = $userPaymentRepository;
        $this->userPremiumRepository = $userPremiumRepository;
        $this->userSocialRepository = $userSocialRepository;
    }

    public function latestSubscribe(Request $request)
    {
        $datas = $this->userRepository->latestSubscribe();
        $ars = collect();
        foreach ($datas as $data) {
            $ars->push([
                "id" => $data->id,
                "name" => $data->name,
                "email" => $data->email,
                "created_at" => $data->created_at->format("d/m/Y à H:i")
            ]);
        }

        return $this->datatable->loadDatatable($request, $ars->toArray());
    }

    public function latestLogin(Request $request)
    {
        $datas = $this->userAccountRepository->latestLogin();
        $ars = collect();
        foreach ($datas as $data) {
            $ars->push([
                "id" => $data->user->id,
                "name" => $data->user->name,
                "ip" => $data->last_ip,
                "last_login" => $data->last_login->format("d/m/Y à H:i")
            ]);
        }

        return $this->datatable->loadDatatable($request, $ars->toArray());
    }

    public function listeUser(Request $request)
    {
        $datas = $this->userRepository->all();
        $ars = collect();

        foreach ($datas as $data) {
            if ($data->account->last_login != null) {
                $last_login = $data->account->last_login->format('d/m/Y à H:i');
            } else {
                $last_login = "Aucune connexion";
            }
            $ars->push([
                "id" => $data->id,
                "name" => $data->name,
                "email" => $data->email,
                "group" => $data->group,
                "created_at" => $data->created_at->format('d/m/Y à H:i'),
                "last_login" => $last_login,
                "state" => $data->state
            ]);
        }

        if ($request->get('type') == 'plain') {
            return $this->sendResponse($ars, "Liste des utilisateur");
        } else {
            return $this->datatable->loadDatatable($request, $ars->toArray());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "group" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }

        $password = Generator::createPassword();

        try {
            $user = $this->userRepository->create(
                $request->name,
                $request->email,
                bcrypt($password),
                $request->group
            );
            try {
                $customer = $this->createCustomer($request->email, $request->name);
                $this->userAccountRepository->create($user->id, $customer);
                $this->userPaymentRepository->createEmpty($user->id);
                $this->userPremiumRepository->create($user->id);
                $this->userSocialRepository->create($user->id);

                try {
                    $user->notify(new AccountCreatedNotification($user, $password));

                    return $this->sendResponse(null, null);
                } catch (Exception $exception) {
                    return $this->sendError("Erreur Système 500", [
                        "errors" => $exception->getMessage()
                    ]);
                }
            } catch (Exception $exception) {
                return $this->sendError("Erreur Système 500", [
                    "errors" => $exception->getMessage()
                ]);
            }
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système 500", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function update(Request $request, $user_id)
    {
        try {
            $this->userRepository->update($user_id, $request->email, $request->name);

            return $this->sendResponse(null, null);
        } catch (Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    private function createCustomer($email, $name)
    {
        $customer = new Customer();
        $query = $customer->create($email, $name);
        return $query->id;
    }
}
