<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class UpdateRolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function super_admin_can_update_a_role()
    {
        $this->signInAsSuperAdmin();

        $role = create('App\Role', ['name' => 'admin']);
        $role->name = 'updated-role';

        $this->put('roles/' . $role->id, $role->toArray())
            ->assertRedirect('roles');

        $this->assertEquals('updated-role', $role->fresh()->name);

        $this->get('roles')->assertSee($role->name);
    }

    /** @test */
    public function non_super_admin_users_cannot_update_a_role()
    {
        $this->signInAsContentAdmin();

        $role = create('App\Role', ['name' => 'admin']);
        $role->name = 'updated-role';

        $this->put('roles/' . $role->id, $role->toArray())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function guests_cannot_update_a_role()
    {
        $role = create('App\Role', ['name' => 'admin']);
        $role->name = 'updated-role';

        $this->put('roles/' . $role->id, $role->toArray())
            ->assertRedirect('login');
    }

    /** @test */
    public function it_requires_a_name()
    {
        $this->signInAsSuperAdmin();

        $role = create('App\Role');

        $role->name = null;

        $this->put('roles/' . $role->id, $role->toArray())->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_a_unique_name()
    {
        $this->signInAsSuperAdmin();

        create('App\Role', ['name' => 'role']);

        $role = create('App\Role');

        $role->name = 'role';

        $this->put('roles/' . $role->id, $role->toArray())->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_doesnt_require_a_unique_name_when_updating_the_same_role()
    {
        $this->signInAsSuperAdmin();

        $role = create('App\Role', ['name' => 'role']);

        $role->name = 'role';

        $this->put('roles/' . $role->id, $role->toArray())->assertSessionMissing('name');
    }

    /** @test */
    public function it_requires_the_name_to_not_be_longer_than_255_characters()
    {
        $this->signInAsSuperAdmin();

        $role = create('App\Role', ['name' => 'role']);

        $role->name = str_repeat('a', 256);

        $this->put('roles/' . $role->id, $role->toArray())->assertSessionHasErrors('name');
    }
}
