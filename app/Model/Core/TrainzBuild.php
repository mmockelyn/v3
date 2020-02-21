<?php

namespace App\Model\Core;

use App\Model\Asset\AssetCompatibility;
use App\Model\Route\RouteCompatibility;
use Illuminate\Database\Eloquent\Model;

class TrainzBuild extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function routes()
    {
        return $this->hasMany(RouteCompatibility::class);
    }

    public function assets()
    {
        return $this->hasMany(AssetCompatibility::class);
    }
}
