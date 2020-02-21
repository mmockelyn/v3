<?php

namespace App\Model\Account;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
