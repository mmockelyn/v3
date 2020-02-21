<?php

namespace App\Model\Account;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ["last_login"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
