<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteVersionGare extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function version()
    {
        return $this->belongsTo(RouteVersion::class, 'route_version_id');
    }
}
