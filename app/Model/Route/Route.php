<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $guarded = [];

    public function anomalies()
    {
        return $this->hasMany(RouteAnomalie::class);
    }

    public function builds()
    {
        return $this->hasMany(RouteBuild::class);
    }

    public function compatibilities()
    {
        return $this->hasMany(RouteCompatibility::class);
    }

    public function downloads()
    {
        return $this->hasMany(RouteDownload::class);
    }

    public function galleries()
    {
        return $this->hasMany(RouteGallery::class);
    }

    public function galleriecategories()
    {
        return $this->hasMany(RouteGalleryCategory::class);
    }

    public function timelines()
    {
        return $this->hasMany(RouteTimeline::class);
    }

    public function versions()
    {
        return $this->hasMany(RouteVersion::class);
    }

    public function updaters()
    {
        return $this->hasMany(RouteUpdater::class);
    }
}
