<?php

namespace App\Model\Tutoriel;

use Illuminate\Database\Eloquent\Model;

class TutorielSource extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function tutoriel()
    {
        return $this->belongsTo(Tutoriel::class, 'tutoriel_id');
    }
}
