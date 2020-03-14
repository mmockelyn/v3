<?php

namespace App\Http\Controllers\Auth;

use App\HelpersClass\Account\AdminHelper;
use App\Http\Controllers\Controller;
use App\Model\Account\UserAccount;
use App\Notifications\Account\AccountCreatedNotification;
use App\Packages\Stripe\Core\Customer;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $this->storeAccount($user);
        $this->createPremium($user);
        $this->createSocial($user);

        $customer = new Customer();

        $cs = $customer->create($user->email, $user->name);

        UserAccount::where('user_id', $user->id)
            ->first()
            ->update(["customer_id" => $cs->id]);

        $user->notify(new AccountCreatedNotification($user));

        AdminHelper::adminsNotification(new \App\Notifications\Admin\Account\AccountCreatedNotification($user));

        return null;
    }

    protected function storeAccount(User $user)
    {
        $account = $user->createAccount();
    }

    protected function createPremium(User $user)
    {
        $premium = $user->premium()->create([
            "user_id" => $user->getId(),
        ]);
    }

    protected function createSocial(User $user)
    {
        $social = $user->social()->create([
            "user_id" => $user->getId()
        ]);
    }

}
