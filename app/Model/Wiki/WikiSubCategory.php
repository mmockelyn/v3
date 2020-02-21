<?php

namespace App\Model\Wiki;

use Illuminate\Database\Eloquent\Model;

class WikiSubCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(WikiCategory::class, 'wiki_category_id');
    }

    public function wikis()
    {
        return $this->hasMany(Wiki::class);
    }
}
