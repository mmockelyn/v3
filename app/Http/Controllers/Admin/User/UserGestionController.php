<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Notifications\Account\UserBan;
use App\Repository\Account\UserRepository;
use Exception;
use Illuminate\Http\Request;

class UserGestionController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserGestionController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('admin.user.gestion.index');
    }

    public function edit($user_id)
    {
        return view("admin.user.gestion.edit", [
            "user" => $this->userRepository->getUser($user_id)
        ]);
    }

    public function delete($user_id)
    {
        try {
            $this->userRepository->delete($user_id);

            return redirect()->back()->with('success', "Le compte utilisateur à été supprimer");
        } catch (Exception $exception) {
            return redirect()->back()->with("error", "Erreur lors de la suppressio de l'utilisateur");
        }
    }

    public function ban($user_id)
    {
        try {
            $user = $this->userRepository->getUser($user_id);
            $this->userRepository->ban($user_id);
            $user->notify(new UserBan($user));
            return redirect()->back()->with("success", "L'utilisateur à été ban");
        } catch (Exception $exception) {
            return redirect()->back()->with("error", "Erreur lors du ban de l'utilisateur");
        }
    }

    public function unban($user_id)
    {
        try {
            $this->userRepository->unban($user_id);

            return redirect()->back()->with("success", "L'utilisateur à été débloqué");
        } catch (Exception $exception) {
            return redirect()->back()->with("error", "Erreur lors du déblocage de l'utilisateur");
        }
    }
}
