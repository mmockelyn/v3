<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\HelpersClass\Core\Datatable;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Account\UserAccountRepository;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;

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
     * UserController constructor.
     * @param Datatable $datatable
     * @param UserRepository $userRepository
     * @param UserAccountRepository $userAccountRepository
     */
    public function __construct(Datatable $datatable, UserRepository $userRepository, UserAccountRepository $userAccountRepository)
    {
        $this->datatable = $datatable;
        $this->userRepository = $userRepository;
        $this->userAccountRepository = $userAccountRepository;
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
}
