<?php

namespace App\Model\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
