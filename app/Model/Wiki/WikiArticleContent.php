<?php

namespace App\Model\Wiki;

use Illuminate\Database\Eloquent\Model;

class WikiArticleContent extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'wiki_id');
    }

    public function sommaire()
    {
        return $this->belongsTo(WikiArticleSommaire::class, 'sommaire_id');
    }
}
