<?php

namespace App;

use App\Model\Account\Invoice;
use App\Model\Account\UserAccount;
use App\Model\Account\UserActivity;
use App\Model\Account\UserPayment;
use App\Model\Account\UserPremium;
use App\Model\Account\UserSocial;
use App\Model\Account\UserView;
use App\Model\Blog\BlogComment;
use App\Model\Tutoriel\Tutoriel;
use App\Model\Tutoriel\TutorielComment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function account()
    {
        return $this->hasOne(UserAccount::class);
    }

    public function premium()
    {
        return $this->hasOne(UserPremium::class);
    }

    public function payments()
    {
        return $this->hasMany(UserPayment::class);
    }

    public function social()
    {
        return $this->hasOne(UserSocial::class);
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function blogcomments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function tutorielcomments()
    {
        return $this->hasMany(TutorielComment::class);
    }

    public function tutoriels()
    {
        return $this->hasMany(Tutoriel::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function views()
    {
        return $this->hasMany(UserView::class);
    }

    public function getId()
    {
        return 'id';
    }

    public function createAccount()
    {
        $this->account()->create([
            "user_id" => $this->getId()
        ]);
    }
}
