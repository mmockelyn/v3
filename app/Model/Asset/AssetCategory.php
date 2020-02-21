<?php

namespace App\Model\Asset;

use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function subcategories() {
        return $this->hasMany(AssetSubCategory::class);
    }
}
