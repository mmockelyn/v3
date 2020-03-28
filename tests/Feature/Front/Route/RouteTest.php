<?php

namespace Tests\Feature\Front\Route;

use App\Model\Route\Route;
use App\Model\Route\RouteAnomalie;
use App\Model\Route\RouteBuild;
use App\Model\Route\RouteDownload;
use App\Model\Route\RouteGalleryCategory;
use App\Model\Route\RouteTypeDownload;
use App\Model\Route\RouteTypeRelease;
use App\Model\Route\RouteVersion;
use App\Model\Route\RouteVersionGare;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    function test_index_show()
    {
        factory(Route::class)->create();

        $this->get('/route')
            ->assertStatus(200)
            ->assertViewIs('front.route.index');
    }
    
}
