<?php

namespace App\Model\Tutoriel;

use App\Model\Account\UserView;
use App\Model\State\StateVideo;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Tutoriel extends Model
{
    protected $guarded = [];
    protected $dates = ["created_at", "updated_at", "published_at"];

    /**
     * @return HasMany
     */
    public function tags()
    {
        return $this->hasMany(TutorielTag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(TutorielCategory::class, 'tutoriel_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(TutorielSubCategory::class, 'tutoriel_sub_category_id');
    }

    public function comments()
    {
        return $this->hasMany(TutorielComment::class)->where('published', 1);
    }

    public function requis()
    {
        return $this->hasMany(TutorielRequis::class);
    }

    public function sources()
    {
        return $this->hasMany(TutorielSource::class);
    }

    public function technologies()
    {
        return $this->hasMany(TutorielTechnologie::class);
    }

    public function views()
    {
        return $this->hasMany(UserView::class);
    }

    public function stateVideos()
    {
        return $this->hasMany(StateVideo::class);
    }

    public function scopeLoader($query)
    {
        return $query->load('category', 'subcategory', 'tags', 'comments', 'requis', 'sources', 'technologies');
    }

    /**
     * @param string $tags
     * @param int $tutoriel_id
     */
    public function saveTags(string $tags, int $tutoriel_id)
    {
        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            TutorielTag::create([
                "tutoriel_id"   => $tutoriel_id,
                "name"          => $tag,
                "slug"          => Str::slug($tag)
            ]);
        }
    }
}
