<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteGalleryCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function galleries()
    {
        return $this->hasMany(RouteGallery::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
