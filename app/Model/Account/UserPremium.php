<?php

namespace App\Model\Account;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserPremium extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ["premium_start", "premium_end", "trial_end_at"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
