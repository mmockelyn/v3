<?php

namespace Tests\Feature\Front\Route;

use App\Model\Route\Route;
use App\Model\Route\RouteBuild;
use App\Model\Route\RouteVersion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    function test_index_show()
    {
        $this->withoutExceptionHandling();
        factory(Route::class)->create();
        factory(RouteVersion::class)->create();
        factory(RouteBuild::class)->create();

        $this->get('/route')
            ->assertStatus(200)
            ->assertViewIs('front.route.index');
    }

}
