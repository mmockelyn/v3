<?php

namespace Tests\Feature\Front;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /** @test */
    function it_shown_to_homepage()
    {
        $this->get('/')
            ->assertSuccessful()
            ->assertViewIs('index');
    }

}
