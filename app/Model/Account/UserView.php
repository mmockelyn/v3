<?php

namespace App\Model\Account;

use App\Model\Tutoriel\Tutoriel;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserView extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tutoriel()
    {
        return $this->belongsTo(Tutoriel::class, 'tutoriel_id');
    }
}
