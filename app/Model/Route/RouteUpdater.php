<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteUpdater extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
