<?php

namespace App\Model\Route;

use Illuminate\Database\Eloquent\Model;

class RouteTypeRelease extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function downloads()
    {
        return $this->hasMany(RouteDownload::class);
    }
}
