<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteGallery extends Model
{
    protected $guarded = [];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function category()
    {
        return $this->belongsTo(RouteGalleryCategory::class, 'route_gallery_categorie_id');
    }
}
