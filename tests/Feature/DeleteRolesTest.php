<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class DeleteRolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function super_admin_can_delete_a_role()
    {
        $this->signInAsSuperAdmin();

        $role = create('App\Role');

        $this->delete('roles/' . $role->id)->assertRedirect('roles');

        $this->assertDatabaseMissing('roles', $role->toArray());
    }

    /** @test */
    public function non_super_admin_user_cannot_delete_a_role()
    {
        $this->signInAsContentAdmin();

        $role = create('App\Role');

        $this->delete('roles/' . $role->id)->assertStatus(Response::HTTP_FORBIDDEN);
    }

     /** @test */
     public function guests_cannot_delete_a_role()
     {
         $role = create('App\Role');
 
         $this->delete('roles/' . $role->id)->assertRedirect('login');
     }
}
