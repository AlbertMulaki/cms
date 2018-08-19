<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadRolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function super_admin_can_browse_for_roles()
    {
        $this->withoutExceptionHandling();
        $this->signInAsSuperAdmin();

        $role = create('App\Role');
        
        $this->get('roles')->assertSuccessful()
            ->assertSee($role->name);
    }
}
