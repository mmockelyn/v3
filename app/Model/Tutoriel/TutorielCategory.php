<?php

namespace App\Model\Tutoriel;

use Illuminate\Database\Eloquent\Model;

class TutorielCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function tutoriels()
    {
        return $this->hasMany(Tutoriel::class);
    }

    public function subcategories()
    {
        return $this->hasMany(TutorielSubCategory::class);
    }
}
