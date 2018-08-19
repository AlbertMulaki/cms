<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_register()
    {
        $this->get('register')->assertStatus(404);

        $this->post('register')->assertStatus(404);
    }
}
