<?php

namespace App\Model\Blog;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $guarded = [];

    public function scopePublished($query)
    {
        return $query->where('state', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
