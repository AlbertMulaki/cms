<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UsersTest extends TestCase
{
    /** @test */
    public function it_has_a_first_name()
    {
        $user = new User(['first_name' => 'John']);

        $this->assertEquals('John', $user->first_name);
    }

    /** @test */
    public function it_has_a_last_name()
    {
        $user = new User(['last_name' => 'Doe']);

        $this->assertEquals('Doe', $user->last_name);
    }

    /** @test */
    public function it_has_an_email()
    {
        $user = new User(['email' => 'albertmulaki@example.com']);

        $this->assertEquals('albertmulaki@example.com', $user->email);
    }
}
