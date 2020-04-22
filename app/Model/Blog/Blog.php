<?php

namespace App\Model\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Blog extends Model implements Feedable
{
    use Notifiable;
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

    /**
     * @inheritDoc
     */
    public function toFeedItem()
    {
        $blogs = Blog::all();
        foreach ($blogs as $blog) {
            if($blog->published == 1){
                return FeedItem::create()
                    ->id($this->id)
                    ->title($this->title)
                    ->summary($this->short_content)
                    ->updated(now())
                    ->category($this->category->name)
                    ->link('//')
                    ->author('Trainznation');
            }
        }
    }

    public static function getFeedItems()
    {
        $items = Blog::all();
        return $items;
    }
}
