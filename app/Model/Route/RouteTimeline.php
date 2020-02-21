<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteTimeline extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ["release_at"];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
