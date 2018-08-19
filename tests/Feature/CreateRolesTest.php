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

    /** @test */
    public function super_admin_users_can_create_a_new_role()
    {
        $this->withoutExceptionHandling();

        $user = factory('App\User')->create();

        Role::create(['name' => 'super-admin']);

        $user->assignRole('super-admin');

        $this->actingAs($user);

        $role = factory('App\Role')->make();

        $this->post('roles', $role->toArray())->assertSuccessful();

        $this->assertDatabaseHas('roles', $role->toArray());
    }

    /** @test */
    public function user_with_no_superadmin_role_cannot_create_a_role()
    {
        $user = factory('App\User')->create();

        Role::create(['name' => 'another-role']);

        $user->assignRole('another-role');

        $this->actingAs($user);

        $role = factory('App\Role')->make();

        $this->post('roles', $role->toArray())->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function users_with_no_role_at_all_cannot_add_a_new_role     ()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user);

        $role = factory('App\Role')->make();

        $this->post('roles', $role->toArray())->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthorized_users_cannot_create_a_new_role()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user);
 
        $role = factory('App\Role')->make();

        $this->post('roles', $role->toArray())->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function guests_can_not_create_a_new_role()
    {
        $role = factory('App\Role')->make();

        $this->post('roles', $role->toArray())->assertRedirect('login');
    }
}
