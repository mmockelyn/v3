<?php

namespace App\Model\Asset;

use Illuminate\Database\Eloquent\Model;

class AssetSubCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }
}
