<?php

namespace App\Model\Route;

use App\Model\Core\TrainzBuild;
use Illuminate\Database\Eloquent\Model;

class RouteCompatibility extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function trainzbuild()
    {
        return $this->belongsTo(TrainzBuild::class, 'trainz_build_id');
    }
}
