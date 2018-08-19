<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_log_in()
    {
        $user = create('App\User', [
            'email' => 'albertmulaki@example.com',
        ]);

        $this->post('login', [
            'email' => 'albertmulaki@example.com',
            'password' => 'secret',
        ]);

        $this->assertAuthenticatedAs($user);
    }
}
