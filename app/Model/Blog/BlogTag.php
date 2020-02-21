<?php

namespace App\Model\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
