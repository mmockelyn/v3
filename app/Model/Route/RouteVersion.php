<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteVersion extends Model
{
    protected $guarded = [];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function gares()
    {
        return $this->hasMany(RouteVersionGare::class);
    }

    public function getDistanceAttribute($value) {
        $distance = $value / 100;
        return number_format($distance, 2, ',', ' ');
    }
}
