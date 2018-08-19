<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = create('App\User', [
            'first_name' => 'Albert',
            'last_name' => 'Mulaki',
            'email' => 'albertmulaki@example.com',
        ]);

        $superAdmin = create('App\Role', [
            'name' => 'super-admin'
        ]);

        $contentAdmin = create('App\Role', [
            'name' => 'content-creator'
        ]);

        $user->assignRole($superAdmin);
    }
}
