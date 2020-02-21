<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteDownload extends Model
{
    protected $guarded = [];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function typeDownload()
    {
        return $this->belongsTo(RouteTypeDownload::class, 'route_type_download_id');
    }

    public function typeRelease()
    {
        return $this->belongsTo(RouteTypeRelease::class, 'route_type_release_id');
    }
}
