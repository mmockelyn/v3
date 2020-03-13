<?php

namespace App\Model\State;

use App\Model\Tutoriel\Tutoriel;
use Illuminate\Database\Eloquent\Model;

class StateVideo extends Model
{
    protected $guarded = [];

    public function tutoriel()
    {
        return $this->belongsTo(Tutoriel::class, 'tutoriel_id');
    }
}
