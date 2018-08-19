<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use App\Role;

class CreateRolesTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->role = raw('App\Role');
    }
    
    /** @test */
    public function super_admin_users_can_create_a_new_role()
    {
        $this->signInAsSuperAdmin();

        $this->post('roles', $this->role)->assertRedirect('roles');

        $this->assertDatabaseHas('roles', $this->role);
    }

    /** @test */
    public function user_with_no_superadmin_role_cannot_create_a_role()
    {
        $this->signInAsContentAdmin();

        $this->post('roles', $this->role)->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function users_with_no_role_at_all_cannot_add_a_new_role()
    {
        $this->signInWithNoRole();

        $this->post('roles', $this->role)->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthorized_users_cannot_create_a_new_role()
    {
        $this->signInAsContentAdmin();
 
        $this->post('roles', $this->role)->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function guests_can_not_create_a_new_role()
    {
        $this->post('roles', $this->role)->assertRedirect('login');
    }

    /** @test */
    public function it_requires_a_name()
    {
        $this->signInAsSuperAdmin();

        $this->role['name'] = null;

        $this->post('roles', $this->role)->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_a_unique_name()
    {
        $this->signInAsSuperAdmin();

        Role::create(['name' => 'role']);

        $this->role['name'] = 'role';

        $this->post('roles', $this->role)->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_the_name_to_not_be_longer_than_255_characters()
    {
        $this->signInAsSuperAdmin();

        $this->role['name'] = str_repeat('a', 256);

        $this->post('roles', $this->role)->assertSessionHasErrors('name');
    }
}
