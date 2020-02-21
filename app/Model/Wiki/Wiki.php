<?php

namespace App\Model\Wiki;

use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    protected $guarded = [];
    protected $dates = ["created_at", "updated_at", "published_at"];

    public function category()
    {
        return $this->belongsTo(WikiCategory::class, 'wiki_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(WikiSubCategory::class, 'wiki_sub_category_id');
    }
}
