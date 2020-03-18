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

    public function content()
    {
        return $this->hasOne(WikiArticleContent::class);
    }
}
