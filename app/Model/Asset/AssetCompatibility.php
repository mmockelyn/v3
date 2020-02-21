<?php

namespace App\Model\Asset;

use App\Model\Core\TrainzBuild;
use Illuminate\Database\Eloquent\Model;

class AssetCompatibility extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function trainzbuild()
    {
        return $this->belongsTo(TrainzBuild::class, 'trainz_build_id');
    }
}
