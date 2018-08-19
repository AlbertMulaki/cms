<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sign in a user
     *
     * @param App\User $user
     */
    protected function signInWithNoRole($user = null)
    {
        $user = $user?: factory('App\User')->create();

        $this->actingAs($user);

        return $this;
    }
    
    /**
     * Sign in as a super admin user.
     *
     * @param App\User $user
     */
    protected function signInAsSuperAdmin($user = null)
    {
        $user = $user?: factory('App\User')->create();

        Role::create(['name' => 'super-admin']);

        $user->assignRole('super-admin');

        $this->actingAs($user);

        return $this;
    }
    
    /**
     * Sign in as a content admin user.
     *
     * @param App\User $user
     */
    protected function signInAsContentAdmin($user = null)
    {
        $user = $user?: factory('App\User')->create();

        Role::create(['name' => 'content-admin']);

        $user->assignRole('content-admin');

        $this->actingAs($user);

        return $this;
    }
}
