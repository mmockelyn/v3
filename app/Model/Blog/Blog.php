<?php

namespace App\Model\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ["published_at"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function scopeOrderAsc($query)
    {
        return $query->orderBy('published_at', 'asc');
    }

    public function scopeOrderDesc($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'categorie_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(BlogTag::class);
    }

    /**
     * Sauvegarde les tags associée à un article
     * @param string $tags
     * @param int $blog_id
     */
    public function saveTags(string $tags, int $blog_id)
    {
        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            BlogTag::create([
                "blog_id" => $blog_id,
                "name" => $tag,
                "slug" => Str::slug($tag)
            ]);
        }
    }
}
