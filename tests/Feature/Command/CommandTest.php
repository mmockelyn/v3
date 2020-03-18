<?php

namespace Tests\Feature\Command;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CommandTest extends TestCase
{
    public function test_clear_system()
    {
        $this->artisan('trainz:clear')
            ->assertExitCode(0);
    }

    public function test_create_helper()
    {
        $this->artisan('make:helper Test TestHelper')
            ->assertExitCode(0);
    }

    public function test_create_repository()
    {
        $this->artisan('make:repository Test TestRepository')
            ->assertExitCode(0);
    }


}
