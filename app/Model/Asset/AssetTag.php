<?php

namespace App\Model\Asset;

use Illuminate\Database\Eloquent\Model;

class AssetTag extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
