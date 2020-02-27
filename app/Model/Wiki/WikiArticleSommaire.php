<?php

namespace App\Model\Wiki;

use Illuminate\Database\Eloquent\Model;

class WikiArticleSommaire extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'wiki_id');
    }

    public function contents()
    {
        return $this->hasMany(WikiArticleContent::class);
    }
}
