<?php

namespace App\Model\Account;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
