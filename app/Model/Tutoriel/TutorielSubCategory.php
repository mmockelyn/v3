<?php

namespace App\Model\Tutoriel;

use Illuminate\Database\Eloquent\Model;

class TutorielSubCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function tutoriels()
    {
        return $this->hasMany(Tutoriel::class);
    }

    public function category() {
        return $this->belongsTo(TutorielCategory::class, 'tutoriel_category_id');
    }
}
