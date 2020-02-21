<?php

namespace App\Model\Wiki;

use Illuminate\Database\Eloquent\Model;

class WikiCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function subcategories()
    {
        return $this->hasMany(WikiSubCategory::class);
    }

    public function wikis()
    {
        return $this->hasMany(Wiki::class);
    }
}
