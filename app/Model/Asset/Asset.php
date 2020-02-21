<?php

namespace App\Model\Asset;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Asset extends Model
{
    protected $guarded = [];
    protected $dates = ["created_at", "updated_at", "published_at"];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(AssetSubCategory::class, 'asset_sub_category_id');
    }

    public function compatibilities()
    {
        return $this->hasMany(AssetCompatibility::class);
    }

    public function tags()
    {
        return $this->hasMany(AssetTag::class);
    }

    public function saveTags(string $tags, int $asset_id)
    {
        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            AssetTag::create([
                "asset_id" => $asset_id,
                "name" => $tag,
                "slug" => Str::slug($tag)
            ]);
        }
    }
}
