<?php

namespace App\Model\Tutoriel;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TutorielComment extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ["published_at"];

    public function tutoriel()
    {
        return $this->belongsTo(Tutoriel::class, 'tutoriel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
